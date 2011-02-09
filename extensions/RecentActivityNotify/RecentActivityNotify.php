<?php
if ( ! defined( 'MEDIAWIKI' ) )
die();

/**
* Users who should receive notification mails
*/

function users_age_for_notify() {
return 60*60*4*1; //  4 hours
}

function email_duration() {
  return 60*60*4;//  4 hours
}

function Email_Notify_Page_Title()
  {
      global $wgSitename;
      return($wgSitename . ":Users For Recent Activity Email Notification"); 
  }

 function Make_EN_table_structure()
  {
      global $wgDBprefix;
      $table_name = addslashes($wgDBprefix . 'ext_email_notify');
      $theQuery = "CREATE TABLE IF NOT EXISTS `$table_name` (
    `user` varbinary(255) NOT NULL,
    `last_email_sent_time` varbinary(14) NOT NULL,
    PRIMARY KEY (`user`) );";
      $perform_query = wfQuery($theQuery, DB_WRITE);
  }
  

// ----------------------------------------------------------------------------------------

$wgExtensionCredits['other'][] = array(
'path' => __FILE__,
'name' => 'Recent Activity Email Notification',
'version' => '1.1',
'author' => 'Anonymous',
'url' => 'http://www.mediawiki.org/wiki/Extension:Recent_Activity_Notify',
'description' => 'Sends email notification to selected when activity occurs from anonymous or new users',
'descriptionmsg' => 'recentactivitynotify-desc',
);

$dir = dirname(__FILE__) . '/';
$wgExtensionMessagesFiles['RecentActivityNotify'] = $dir . 'RecentActivityNotify.i18n.php';

/**
* Email address to use as the sender
*/
global $wgPasswordSender;
$wgNewUserNotifySender = $wgPasswordSender;


/**
* Additional email addresses to send mails to
*/
$wgNewUserNotifyEmailTargets = array("");

  include_once './includes/DatabaseFunctions.php';
  

function AgeFromNameEN($name)
{
    
    //  error_log("Value of target: " . $email_target . ":\n");
    
    $name_text = $name->mName;
    
    $nt = Title::makeTitleSafe( NS_USER, $name_text );
    if( is_null( $nt ) ) {
        # Illegal name
        return null;
    }
    $dbr = wfGetDB( DB_SLAVE );
    $s = $dbr->selectRow( 'user', array( 'user_registration' ), array( 'user_name' => $nt->getText() ), __METHOD__ );
    
    if ( $s === false ) {
        return 0;
        } else {
        $theaccountAge = time() - wfTimestampOrNull(TS_UNIX, $name->mRegistration);
        return $theaccountAge;
    }
    
}


   function getArticleLinesEN($db, $article)
  {
      global $wgDBname;
      $dbr = wfGetDB(DB_READ);
      $dbr->selectDB($db);
      $text = false;
      if ($dbr->tableExists('page')) {
          // 1.5 schema
          $dbw =& wfGetDB(DB_READ);
          $dbw->selectDB($db);
          $revision = Revision::newFromTitle(Title::newFromText($article));
          if ($revision) {
              $text = $revision->gettext();
          }
          $dbw->selectDB($wgDBname);
      } else {
          // 1.4 schema
          $cur = $dbr->tableName('cur');
          $title = Title::newFromText($article);
          $text = $dbr->selectField('cur', 'cur_text', array('cur_namespace' => $title->getNamespace(), 'cur_title' => $title->getDBkey()), 'NoName::getArticleLines');
      }
      $dbr->selectDB($wgDBname);
      if ($text !== false) {
          return explode("\n", $text);
      } else {
          return array();
      }
  }

  

function CheckIfNotificationNeeded ($user) {
    global $wgUser, $wgOut;
    //return true; // UNCOMMENT for debug

	if ($wgUser->isAnon()) { return true; }
    if (AgeFromNameEN($user) < (users_age_for_notify())) { return true;  } 
	return false;
}


function SendNotifyEmail ($user_name, $message, $subject) {
        require_once( 'UserMailer.php' );
        global $wgSitename, $wgPasswordSender;
        $user = User::newFromName( $user_name );
        $emailtarget = $user->getEmail();        
        userMailer(
        new MailAddress( $emailtarget ),
        new MailAddress( $wgPasswordSender, 'WikiAdmin' ),
        $subject, "Dear " . $user_name .  ",\n\n" . $message      
        ); 
}

function NotifyTitleMoved ( &$title, &$newtitle, &$user, $oldid, $newid ) {
    if (CheckIfNotificationNeeded ($user)) {
	global $wgSitename, $wgServer, $wgScriptPath;
		$message = "There was recent activity on " . $wgSitename 
		           . " and you have requested to be notified. A page was moved to a new title by a new/anonymous user. Details of the activity are as follows:"
				   . "\n\n        User: " . $user->mName
				   .   "\n   Old Title: " . $title
				   .   "\n   New Title: " . $newtitle
				   . "\n\nAll Recent Changes can be seen at: " . $wgServer . $wgScriptPath . "/index.php?title=Special:Recentchanges"
				   . "\n\nThank you,\nYour friendly " . $wgSitename . " notification system"
				   . "\n\n(if you'd like to stop receiving these notifications, please reply to this email with the message 'unsubscribe'.)";
		
		//error_log("Message :" . $message . ":\n\n\n");
			 $subject = $wgSitename . " page '". $title . "' has been moved by new/anon user " .  $user->mName;

// For getting time stamp (need to work out)
/*
global $wgContLang;
		$timecorrection = $watchingUser->getOption( 'timecorrection' );
$wgContLang->timeanddate( $this->timestamp, true, false, $timecorrection ),
			$body;
			*/ 
		
         process_notification ($message, $subject);
    }
    return true;
}

function NotifyArticleSaved ( $article, $user, $text, $summary, $minoredit, $watchthis, $sectionanchor, $flags, $revision, $status, $baseRevId ) {

    if (CheckIfNotificationNeeded ($user)) {
		global $wgSitename, $wgServer, $wgScriptPath;
		
		$URL = $wgServer . $wgScriptPath . "/index.php?title=" . $article->mTitle 
				   . "&diff=" . $revision->mId . "&oldid=" . $revision->mParentId;
		$URL = str_replace(' ', '_', $URL); 
		
		global $wgScriptPath;
		
		$message = "There was recent activity from new/anonymous users on " . $wgSitename 
		           . " and you have requested to be notified. Details of the activity are as follows:"
				   . "\n\n           User: " . $user->mName
				   .   "\n        Article: " . $article->mTitle
				   .   "\n   Edit Summary: " . $summary
				   . "\n\nDirect link for diff: " . $URL 
				   . "\n\nIf the above link doesn't work, all Recent Changes can be seen at: " . $wgServer . $wgScriptPath . "/index.php?title=Special:Recentchanges"
				   . "\n\nThank you,\nYour friendly " . $wgSitename . " notification system"
				   . "\n\n(if you'd like to stop receiving these notifications, please reply to this email with the message 'unsubscribe'.)";
	
//		error_log("Message :" . $message . ":\n\n\n");
		$subject = $wgSitename . " page '". $article->mTitle . "' has been changed by new/anon user " .  $user->mName;
		//error_log("Subject :" . $subject . ":\n\n\n");

		process_notification ($message, $subject);
    }
    return true;
}


function process_notification ($message, $subject) {

      Make_EN_table_structure();


      $EmailNotifyList = array();
	  global $wgDBname;
      $db = $wgDBname;
	  $page_title = Email_Notify_Page_Title();
      $EmailNotifyList = getArticleLinesEN($db, $page_title);
      // Strip comments and whitespace, then remove blanks
      $EmailNotifyList = array_filter(array_map('trim', preg_replace('/#.*$/', '', $EmailNotifyList)));

      global $wgDBprefix, $wgNotifyList;
      $db = &wfGetDB(DB_SLAVE);
      $table_name = addslashes($wgDBprefix . 'ext_email_notify');
	  
	  foreach( $EmailNotifyList as $target ) {
	  $send_email = false;
          $query = "SELECT * FROM `" . $table_name . "` WHERE `user` = '" . $target . "';";
          $result = $db->doQuery($query);

		    if (0 != $db->numRows($result)) { // user found, check time
		       $row = $db->fetchObject($result);
			   $d_user = $row->user;
               $sent_time = $row->last_email_sent_time;
			   $time_since_last_email = wfTimestamp(TS_UNIX) - $sent_time;
			  
			   if ($time_since_last_email > email_duration()) {
                   $send_email = true;
				    $query = "UPDATE `" . $table_name . "` SET 
`last_email_sent_time` = '" . wfTimestamp(TS_UNIX) . "' WHERE `user` = '" . $target . "';";
              $perform_query = wfQuery($query, DB_WRITE);

               }
			
			}
			else { // create user and enter data
			
			
			 $query = "INSERT INTO `" . $table_name . "`
                 (`user`,`last_email_sent_time`) VALUES ('" . $target . "', '" . wfTimestamp(TS_UNIX) . "');";
                  $perform_query = wfQuery($query, DB_WRITE);
				  
             $send_email = true;

			
			}

       if ($send_email == true) {
	    SendNotifyEmail ($target, $message, $subject);
		}

    } // for each
	
	
	  

}



global $wgHooks;
$wgHooks['TitleMoveComplete'][] = 'NotifyTitleMoved';
$wgHooks['ArticleSaveComplete'][] = 'NotifyArticleSaved';

?>
