<?php
/**
 * MediaWiki is the to-be base class for this whole project
 *
 * @internal documentation reviewed 15 Mar 2010
 */
class MediaWiki {

	/**
	 * Array of options which may or may not be used
	 * FIXME: this seems currently to be a messy halfway-house between globals
	 *     and a config object.  Pick one and run with it
	 * @var array
	 */
	private $params = array();

	/**
	 * The request object
	 * @var WebRequest
	 */
	private $request;

	/**
	 * Output to deliver content to
	 * FIXME: most stuff in the codebase doesn't actually write to this, it'll write to
	 * $wgOut instead.  So in practice this has to be $wgOut;
	 * @var OutputPage
	 */
	private $output;

	/**
	 * The Title we'll be working on
	 * @var Title
	 */
	private $title;

	/**
	 * TODO: fold $output, etc, into this
	 * @var RequestContext
	 */
	private $context;

	/**
	 * Stores key/value pairs to circumvent global variables
	 * Note that keys are case-insensitive!
	 *
	 * @param $key String: key to store
	 * @param $value Mixed: value to put for the key
	 */
	public function setVal( $key, &$value ) {
		$key = strtolower( $key );
		$this->params[$key] =& $value;
	}

	/**
	 * Retrieves key/value pairs to circumvent global variables
	 * Note that keys are case-insensitive!
	 *
	 * @param $key String: key to get
	 * @param $default string default value, defaults to empty string
	 * @return $default Mixed: default value if if the key doesn't exist
	 */
	public function getVal( $key, $default = '' ) {
		$key = strtolower( $key );
		if ( isset( $this->params[$key] ) ) {
			return $this->params[$key];
		}
		return $default;
	}

	public function request( WebRequest &$x = null ){
		return wfSetVar( $this->request, $x );
	}

	public function output( OutputPage &$x = null ){
		return wfSetVar( $this->output, $x );
	}

	public function __construct( WebRequest &$request, /*OutputPage*/ &$output ){
		$this->request =& $request;
		$this->output =& $output;
		$this->title = $this->parseTitle();

		$this->context = new RequestContext();
		$this->context->setRequest( $this->request );
		$this->context->setOutput( $this->output );
		$this->context->setTitle( $this->title );
	}

	/**
	 * Initialization of ... everything
	 * Performs the request too
	 *
	 * @param $article Article
	 * @param $user User
	 */
	public function performRequestForTitle( &$article, &$user ) {
		wfProfileIn( __METHOD__ );

		$this->output->setTitle( $this->title );
		if ( $this->request->getVal( 'printable' ) === 'yes' ) {
			$this->output->setPrintable();
		}

		wfRunHooks( 'BeforeInitialize', array(
			&$this->title,
			&$article,
			&$this->output,
			&$user,
			$this->request,
			$this
		) );

		// If the user is not logged in, the Namespace:title of the article must be in
		// the Read array in order for the user to see it. (We have to check here to
		// catch special pages etc. We check again in Article::view())
		if ( !is_null( $this->title ) && !$this->title->userCanRead() ) {
			$this->output->loginToUse();
			$this->finalCleanup();
			$this->output->disable();
			wfProfileOut( __METHOD__ );
			return false;
		}

		// Call handleSpecialCases() to deal with all special requests...
		if ( !$this->handleSpecialCases() ) {
			// ...otherwise treat it as an article view. The article
			// may be a redirect to another article or URL.
			$new_article = $this->initializeArticle();
			if ( is_object( $new_article ) ) {
				$article = $new_article;
				$this->performAction( $article, $user );
			} elseif ( is_string( $new_article ) ) {
				$this->output->redirect( $new_article );
			} else {
				wfProfileOut( __METHOD__ );
				throw new MWException( "Shouldn't happen: MediaWiki::initializeArticle() returned neither an object nor a URL" );
			}
		}
		wfProfileOut( __METHOD__ );
	}

	/**
	 * Parse $request to get the Title object
	 *
	 * @return Title object to be $wgTitle
	 */
	private function parseTitle() {
		global $wgContLang;

		$curid = $this->request->getInt( 'curid' );
		$title = $this->request->getVal( 'title' );

		if ( $this->request->getCheck( 'search' ) ) {
			// Compatibility with old search URLs which didn't use Special:Search
			// Just check for presence here, so blank requests still
			// show the search page when using ugly URLs (bug 8054).
			$ret = SpecialPage::getTitleFor( 'Search' );
		} elseif ( $curid ) {
			// URLs like this are generated by RC, because rc_title isn't always accurate
			$ret = Title::newFromID( $curid );
		} elseif ( $title == '' && $this->getAction() != 'delete' ) {
			$ret = Title::newMainPage();
		} else {
			$ret = Title::newFromURL( $title );
			// check variant links so that interwiki links don't have to worry
			// about the possible different language variants
			if ( count( $wgContLang->getVariants() ) > 1 && !is_null( $ret ) && $ret->getArticleID() == 0 )
				$wgContLang->findVariantLink( $title, $ret );
		}
		// For non-special titles, check for implicit titles
		if ( is_null( $ret ) || $ret->getNamespace() != NS_SPECIAL ) {
			// We can have urls with just ?diff=,?oldid= or even just ?diff=
			$oldid = $this->request->getInt( 'oldid' );
			$oldid = $oldid ? $oldid : $this->request->getInt( 'diff' );
			// Allow oldid to override a changed or missing title
			if ( $oldid ) {
				$rev = Revision::newFromId( $oldid );
				$ret = $rev ? $rev->getTitle() : $ret;
			}
		}
		return $ret;
	}

	/**
	 * Get the Title object that we'll be acting on, as specified in the WebRequest
	 * @return Title
	 */
	public function getTitle(){
		if( $this->title === null ){
			$this->title = $this->parseTitle();
		}
		return $this->title;
	}

	/**
	 * Initialize some special cases:
	 * - bad titles
	 * - local interwiki redirects
	 * - redirect loop
	 * - special pages
	 *
	 * @return bool true if the request is already executed
	 */
	private function handleSpecialCases() {
		wfProfileIn( __METHOD__ );

		// Invalid titles. Bug 21776: The interwikis must redirect even if the page name is empty.
		if ( is_null( $this->title ) || ( ( $this->title->getDBkey() == '' ) && ( $this->title->getInterwiki() == '' ) ) ) {
			$this->title = SpecialPage::getTitleFor( 'Badtitle' );
			$this->output->setTitle( $this->title ); // bug 21456
			// Die now before we mess up $wgArticle and the skin stops working
			throw new ErrorPageError( 'badtitle', 'badtitletext' );

		// Interwiki redirects
		} else if ( $this->title->getInterwiki() != '' ) {
			$rdfrom = $this->request->getVal( 'rdfrom' );
			if ( $rdfrom ) {
				$url = $this->title->getFullURL( 'rdfrom=' . urlencode( $rdfrom ) );
			} else {
				$query = $this->request->getValues();
				unset( $query['title'] );
				$url = $this->title->getFullURL( $query );
			}
			/* Check for a redirect loop */
			if ( !preg_match( '/^' . preg_quote( $this->getVal( 'Server' ), '/' ) . '/', $url ) && $this->title->isLocal() ) {
				// 301 so google et al report the target as the actual url.
				$this->output->redirect( $url, 301 );
			} else {
				$this->title = SpecialPage::getTitleFor( 'Badtitle' );
				$this->output->setTitle( $this->title ); // bug 21456
				wfProfileOut( __METHOD__ );
				throw new ErrorPageError( 'badtitle', 'badtitletext' );
			}
		// Redirect loops, no title in URL, $wgUsePathInfo URLs, and URLs with a variant
		} else if ( $this->request->getVal( 'action', 'view' ) == 'view' && !$this->request->wasPosted()
			&& ( $this->request->getVal( 'title' ) === null || $this->title->getPrefixedDBKey() != $this->request->getVal( 'title' ) )
			&& !count( array_diff( array_keys( $this->request->getValues() ), array( 'action', 'title' ) ) ) )
		{
			if ( $this->title->getNamespace() == NS_SPECIAL ) {
				list( $name, $subpage ) = SpecialPage::resolveAliasWithSubpage( $this->title->getDBkey() );
				if ( $name ) {
					$this->title = SpecialPage::getTitleFor( $name, $subpage );
				}
			}
			$targetUrl = $this->title->getFullURL();
			// Redirect to canonical url, make it a 301 to allow caching
			if ( $targetUrl == $this->request->getFullRequestURL() ) {
				$message = "Redirect loop detected!\n\n" .
					"This means the wiki got confused about what page was " .
					"requested; this sometimes happens when moving a wiki " .
					"to a new server or changing the server configuration.\n\n";

				if ( $this->getVal( 'UsePathInfo' ) ) {
					$message .= "The wiki is trying to interpret the page " .
						"title from the URL path portion (PATH_INFO), which " .
						"sometimes fails depending on the web server. Try " .
						"setting \"\$wgUsePathInfo = false;\" in your " .
						"LocalSettings.php, or check that \$wgArticlePath " .
						"is correct.";
				} else {
					$message .= "Your web server was detected as possibly not " .
						"supporting URL path components (PATH_INFO) correctly; " .
						"check your LocalSettings.php for a customized " .
						"\$wgArticlePath setting and/or toggle \$wgUsePathInfo " .
						"to true.";
				}
				wfHttpError( 500, "Internal error", $message );
				wfProfileOut( __METHOD__ );
				return false;
			} else {
				$this->output->setSquidMaxage( 1200 );
				$this->output->redirect( $targetUrl, '301' );
			}
		// Special pages
		} else if ( NS_SPECIAL == $this->title->getNamespace() ) {
			/* actions that need to be made when we have a special pages */
			SpecialPage::executePath( $this->title, $this->context );
		} else {
			/* No match to special cases */
			wfProfileOut( __METHOD__ );
			return false;
		}
		/* Did match a special case */
		wfProfileOut( __METHOD__ );
		return true;
	}

	/**
	 * Create an Article object of the appropriate class for the given page.
	 *
	 * @param $title Title
	 * @return Article object
	 */
	public static function articleFromTitle( &$title ) {
		if ( NS_MEDIA == $title->getNamespace() ) {
			// FIXME: where should this go?
			$title = Title::makeTitle( NS_FILE, $title->getDBkey() );
		}

		$article = null;
		wfRunHooks( 'ArticleFromTitle', array( &$title, &$article ) );
		if ( $article ) {
			return $article;
		}

		switch( $title->getNamespace() ) {
			case NS_FILE:
				return new ImagePage( $title );
			case NS_CATEGORY:
				return new CategoryPage( $title );
			default:
				return new Article( $title );
		}
	}

	/**
	 * Returns the action that will be executed, not necesserly the one passed
	 * passed through the "action" parameter. Actions disabled in
	 * $wgDisabledActions will be replaced by "nosuchaction"
	 *
	 * @return String: action
	 */
	public function getAction() {
		global $wgDisabledActions;

		$action = $this->request->getVal( 'action', 'view' );

		// Check for disabled actions
		if ( in_array( $action, $wgDisabledActions ) ) {
			return 'nosuchaction';
		}

		// Workaround for bug #20966: inability of IE to provide an action dependent
		// on which submit button is clicked.
		if ( $action === 'historysubmit' ) {
			if ( $this->request->getBool( 'revisiondelete' ) ) {
				return 'revisiondelete';
			} elseif ( $this->request->getBool( 'revisionmove' ) ) {
				return 'revisionmove';
			} else {
				return 'view';
			}
		} elseif ( $action == 'editredlink' ) {
			return 'edit';
		}

		return $action;
	}

	/**
	 * Initialize the object to be known as $wgArticle for "standard" actions
	 * Create an Article object for the page, following redirects if needed.
	 *
	 * @return mixed an Article, or a string to redirect to another URL
	 */
	private function initializeArticle() {
		wfProfileIn( __METHOD__ );

		$action = $this->request->getVal( 'action', 'view' );
		$article = self::articleFromTitle( $this->title );
		// NS_MEDIAWIKI has no redirects.
		// It is also used for CSS/JS, so performance matters here...
		if ( $this->title->getNamespace() == NS_MEDIAWIKI ) {
			wfProfileOut( __METHOD__ );
			return $article;
		}
		// Namespace might change when using redirects
		// Check for redirects ...
		$file = ( $this->title->getNamespace() == NS_FILE ) ? $article->getFile() : null;
		if ( ( $action == 'view' || $action == 'render' ) 	// ... for actions that show content
			&& !$this->request->getVal( 'oldid' ) &&    // ... and are not old revisions
			!$this->request->getVal( 'diff' ) &&    // ... and not when showing diff
			$this->request->getVal( 'redirect' ) != 'no' &&	// ... unless explicitly told not to
			// ... and the article is not a non-redirect image page with associated file
			!( is_object( $file ) && $file->exists() && !$file->getRedirected() ) )
		{
			// Give extensions a change to ignore/handle redirects as needed
			$ignoreRedirect = $target = false;

			wfRunHooks( 'InitializeArticleMaybeRedirect',
				array( &$this->title, &$this->request, &$ignoreRedirect, &$target, &$article ) );

			// Follow redirects only for... redirects.
			// If $target is set, then a hook wanted to redirect.
			if ( !$ignoreRedirect && ( $target || $article->isRedirect() ) ) {
				// Is the target already set by an extension?
				$target = $target ? $target : $article->followRedirect();
				if ( is_string( $target ) ) {
					if ( !$this->getVal( 'DisableHardRedirects' ) ) {
						// we'll need to redirect
						wfProfileOut( __METHOD__ );
						return $target;
					}
				}
				if ( is_object( $target ) ) {
					// Rewrite environment to redirected article
					$rarticle = self::articleFromTitle( $target );
					$rarticle->loadPageData();
					if ( $rarticle->exists() || ( is_object( $file ) && !$file->isLocal() ) ) {
						$rarticle->setRedirectedFrom( $this->title );
						$article = $rarticle;
						$this->title = $target;
						$this->output->setTitle( $this->title );
					}
				}
			} else {
				$this->title = $article->getTitle();
			}
		}
		wfProfileOut( __METHOD__ );
		return $article;
	}

	/**
	 * Cleaning up request by doing deferred updates, DB transaction, and the output
	 */
	public function finalCleanup() {
		wfProfileIn( __METHOD__ );
		// Now commit any transactions, so that unreported errors after
		// output() don't roll back the whole DB transaction
		$factory = wfGetLBFactory();
		$factory->commitMasterChanges();
		// Output everything!
		$this->output->output();
		// Do any deferred jobs
		wfDoUpdates( 'commit' );
		// Close the session so that jobs don't access the current session
		session_write_close();
		$this->doJobs();
		wfProfileOut( __METHOD__ );
	}

	/**
	 * Do a job from the job queue
	 */
	private function doJobs() {
		global $wgJobRunRate;

		if ( $wgJobRunRate <= 0 || wfReadOnly() ) {
			return;
		}
		if ( $wgJobRunRate < 1 ) {
			$max = mt_getrandmax();
			if ( mt_rand( 0, $max ) > $max * $wgJobRunRate ) {
				return;
			}
			$n = 1;
		} else {
			$n = intval( $wgJobRunRate );
		}

		while ( $n-- && false != ( $job = Job::pop() ) ) {
			$output = $job->toString() . "\n";
			$t = -wfTime();
			$success = $job->run();
			$t += wfTime();
			$t = round( $t * 1000 );
			if ( !$success ) {
				$output .= "Error: " . $job->getLastError() . ", Time: $t ms\n";
			} else {
				$output .= "Success, Time: $t ms\n";
			}
			wfDebugLog( 'jobqueue', $output );
		}
	}

	/**
	 * Ends this task peacefully
	 */
	public function restInPeace() {
		MessageCache::logMessages();
		wfLogProfilingData();
		// Commit and close up!
		$factory = wfGetLBFactory();
		$factory->commitMasterChanges();
		$factory->shutdown();
		wfDebug( "Request ended normally\n" );
	}

	/**
	 * Perform one of the "standard" actions
	 *
	 * @param $article Article
	 * @param $user User
	 */
	private function performAction( &$article, &$user ) {
		wfProfileIn( __METHOD__ );

		if ( !wfRunHooks( 'MediaWikiPerformAction', array(
				$this->output, $article, $this->title,
				$user, $this->request, $this ) ) )
		{
			wfProfileOut( __METHOD__ );
			return;
		}

		$action = $this->getAction();

		switch( $action ) {
			case 'view':
				$this->output->setSquidMaxage( $this->getVal( 'SquidMaxage' ) );
				$article->view();
				break;
			case 'raw': // includes JS/CSS
				wfProfileIn( __METHOD__ . '-raw' );
				$raw = new RawPage( $article );
				$raw->view();
				wfProfileOut( __METHOD__ . '-raw' );
				break;
			case 'watch':
			case 'unwatch':
			case 'delete':
			case 'revert':
			case 'rollback':
			case 'protect':
			case 'unprotect':
			case 'info':
			case 'markpatrolled':
			case 'render':
			case 'deletetrackback':
			case 'purge':
				$article->$action();
				break;
			case 'print':
				$article->view();
				break;
			case 'dublincore':
				if ( !$this->getVal( 'EnableDublinCoreRdf' ) ) {
					wfHttpError( 403, 'Forbidden', wfMsg( 'nodublincore' ) );
				} else {
					$rdf = new DublinCoreRdf( $article );
					$rdf->show();
				}
				break;
			case 'creativecommons':
				if ( !$this->getVal( 'EnableCreativeCommonsRdf' ) ) {
					wfHttpError( 403, 'Forbidden', wfMsg( 'nocreativecommons' ) );
				} else {
					$rdf = new CreativeCommonsRdf( $article );
					$rdf->show();
				}
				break;
			case 'credits':
				Credits::showPage( $article );
				break;
			case 'submit':
				if ( session_id() == '' ) {
					/* Send a cookie so anons get talk message notifications */
					wfSetupSession();
				}
				/* Continue... */
			case 'edit':
				if ( wfRunHooks( 'CustomEditor', array( $article, $user ) ) ) {
					$internal = $this->request->getVal( 'internaledit' );
					$external = $this->request->getVal( 'externaledit' );
					$section = $this->request->getVal( 'section' );
					$oldid = $this->request->getVal( 'oldid' );
					if ( !$this->getVal( 'UseExternalEditor' ) || $action == 'submit' || $internal ||
					   $section || $oldid || ( !$user->getOption( 'externaleditor' ) && !$external ) ) {
						$editor = new EditPage( $article );
						$editor->submit();
					} elseif ( $this->getVal( 'UseExternalEditor' ) && ( $external || $user->getOption( 'externaleditor' ) ) ) {
						$mode = $this->request->getVal( 'mode' );
						$extedit = new ExternalEdit( $article, $mode );
						$extedit->edit();
					}
				}
				break;
			case 'history':
				if ( $this->request->getFullRequestURL() == $this->title->getInternalURL( 'action=history' ) ) {
					$this->output->setSquidMaxage( $this->getVal( 'SquidMaxage' ) );
				}
				$history = new HistoryPage( $article );
				$history->history();
				break;
			case 'revisiondelete':
				// For show/hide submission from history page
				$special = SpecialPage::getPage( 'Revisiondelete' );
				$special->execute( '' );
				break;
			case 'revisionmove':
				// For revision move submission from history page
				$special = SpecialPage::getPage( 'RevisionMove' );
				$special->execute( '' );
				break;
			default:
				if ( wfRunHooks( 'UnknownAction', array( $action, $article ) ) ) {
					$this->output->showErrorPage( 'nosuchaction', 'nosuchactiontext' );
				}
		}
		wfProfileOut( __METHOD__ );
	}
}
