<?php
/**
 * Creative Commons Skin
 *
 * @todo document
 * @package MediaWiki
 * @subpackage Skins
 */

if( !defined( 'MEDIAWIKI' ) )
	die();

/** */
require_once('includes/SkinTemplate.php');

/**
 * Inherit main code from SkinTemplate, set the CSS and template filter.
 * @todo document
 * @package MediaWiki
 * @subpackage Skins
 */
class SkinCC4 extends SkinTemplate {
	function initPage( &$out ) {
		SkinTemplate::initPage( $out );
		$this->skinname  = 'cc4';
		$this->stylename = 'cc4';
		$this->template  = 'CC4Template';
	}
}
	
class CC4Template extends QuickTemplate {
	/**
	 * Template filter callback for Springboard skin.
	 * Takes an associative array of data set from a SkinTemplate-based
	 * class, and a wrapper for MediaWiki's localization database, and
	 * outputs a formatted page.
	 *
	 * @access private
	 */
	function execute() {
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="<?php $this->text('lang') ?>" lang="<?php $this->text('lang') ?>" dir="<?php $this->text('dir') ?>">
  <head>
    <meta http-equiv="Content-Type" content="<?php $this->text('mimetype') ?>; charset=<?php $this->text('charset') ?>" />
    <?php $this->html('headlinks') ?>
    <title><?php $this->text('pagetitle') ?></title>
    <link rel="shortcut icon"
          href="<?php $this->text('stylepath') ?>/<?php $this->text('stylename') ?>/favicon.ico"
	  type="image/x-icon" />
    <style type="text/css" media="screen,projection">/*<![CDATA[*/ @import "<?php $this->text('stylepath') ?>/<?php $this->text('stylename') ?>/main.css"; /*]]>*/</style>
    <link href="http://creativecommons.org/wp-content/themes/cc4/support.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" type="text/css" media="print" href="<?php $this->text('stylepath') ?>/common/commonPrint.css" />
    <!--[if lt IE 5.5000]><style type="text/css">@import "<?php $this->text('stylepath') ?>/<?php $this->text('stylename') ?>/IE50Fixes.css";</style><![endif]-->
    <!--[if IE 5.5000]><style type="text/css">@import "<?php $this->text('stylepath') ?>/<?php $this->text('stylename') ?>/IE55Fixes.css";</style><![endif]-->
    <!--[if gte IE 6]><style type="text/css">@import "<?php $this->text('stylepath') ?>/<?php $this->text('stylename') ?>/IE60Fixes.css";</style><![endif]-->

    <!--[if IE]><script type="text/javascript" src="<?php $this->text('stylepath') ?>/common/IEFixes.js"></script>
    <meta http-equiv="imagetoolbar" content="no" /><![endif]-->
    <?php if($this->data['jsvarurl'  ]) { ?><script type="text/javascript" src="<?php $this->text('jsvarurl'  ) ?>"></script><?php } ?>
    <script type="text/javascript" src="<?php                                   $this->text('stylepath' ) ?>/common/wikibits.js"></script>
    <?php if($this->data['usercss'   ]) { ?><style type="text/css"><?php              $this->html('usercss'   ) ?></style><?php    } ?>
    <?php if($this->data['userjs'    ]) { ?><script type="text/javascript" src="<?php $this->text('userjs'    ) ?>"></script><?php } ?>
    <?php if($this->data['userjsprev']) { ?><script type="text/javascript"><?php      $this->html('userjsprev') ?></script><?php   } ?>

   <?php $this->html('headscripts') ?>

  </head>
  <body <?php if($this->data['body_ondblclick']) { ?>ondblclick="<?php $this->text('body_ondblclick') ?>"<?php } ?>
        <?php if($this->data['nsclass'        ]) { ?>class="<?php      $this->text('nsclass')         ?>"<?php } ?>
        <?php echo ' id="page-'.htmlspecialchars(preg_replace("/( |:)/","",$this->data['title'])).'"'; ?>>
	<script type="text/javascript"> if (window.isMSIE55) fixalpha(); </script>
	<!-- HEADER -->
	<div id="header-wrapper">
      <div id="header-main" class="box">
        <span class="publish">
          <a href="http://creativecommons.org/license/" class="cc-actions">
            <span class="img">
              <img src="http://creativecommons.org/images/license-8.png" border="0" class="publish"/>
            </span> 
            <span class="option">License</span>Your Work
          </a>
        </span>
        <span class="find">
          <a href="http://search.creativecommons.org/" class="cc-actions">
            <span class="img">
              <img src="http://creativecommons.org/images/find-8.png" border="0"/>
            </span>
            <span class="option">Search</span>CC Licensed Work
          </a>
        </span>
        
       <span class="logo">
         <a href="<?php echo htmlspecialchars($this->data['nav_urls']['mainpage']['href'])?>">
           <span>
             <img src="/images/cc-title-8.png" alt="creative commons" id="cc-title" border="0"/>
           </span>
         </a>
       </span>
      </div>
    </div>
    <!-- END HEADER -->
        <div id="mainmenu">
      <ul id="navbar" class="box">
        <li class="inactive"><a href="http://creativecommons.org/" title="Home"><span>Home</span></a></li>      <li class="inactive"><a href="http://creativecommons.org/about/" title="About"><span>About</span></a></li>      <li class="inactive"><a href="http://support.creativecommons.org" title="Support"><span>Support</span></a></li>      <li class="inactive"><a href="http://creativecommons.org/projects/" title="Projects"><span>Projects</span></a></li>      <li class="active"><a href="<?php echo htmlspecialchars($this->data['nav_urls']['mainpage']['href'])?>" title="Participate"><span>Participate</span></a></li>      <li class="inactive"><a href="http://creativecommons.org/international/" title="International"><span>International</span></a></li>      <li class="inactive"><a href="http://creativecommons.org/contact/" title="Contact"><span>Contact</span></a></li> 
      </ul>
      <div class="clear"></div>
    </div>
	<div class="box"> 	<div id="wrapper-ie">
	
    <div id="main-content">
    	  <?php
          if ($this->data['title'] != 'Main Page') {
              echo '<div id="title" class="block"><h2 class="firstHeading">'.htmlspecialchars($this->data['title']).'</h2></div>';
          }
      ?>
      
    <!-- LOGIN SECTION -->
	        <?php 
            $i="";
            $navlist="";

            foreach($this->data['personal_urls'] as $key => $item) {
                $i++;
                $navlist .= '<span id="pt-'.htmlspecialchars($key).'"><a href="'.htmlspecialchars($item['href']).'"';
                if(!empty($item['class'])) { 
                    $navlist .= ' class="'.htmlspecialchars($item['class']).'"'; 
                } 
                $navlist .= '>';
                $navlist .= htmlspecialchars($item['text']).'</a></span> ';
                if ($i < 2) $navlist .= ":<br/>";
            }
           // Hack to work-around broken MediaWiki stuff... 
            
            if (!ereg("Special:Userlogin",$navlist) || (!$this->data['personal_urls'])) {
                $userLoggedIn = true;
            } ?>

	  <?php if($this->data['sitenotice']) { ?><div id="siteNotice"><?php $this->html('sitenotice') ?></div><?php } ?>

	  <div class="block" id="bodyContent">
	    <div id="contentSub"><?php $this->html('subtitle') ?></div>
	    <?php if($this->data['undelete']) { ?><div id="contentSub"><?php     $this->html('undelete') ?></div><?php } ?>
	    <?php if($this->data['newtalk'] ) { ?><div class="usermessage"><?php $this->html('newtalk')  ?></div><?php } ?>
	    <!-- start content -->
	    <?php $this->html('bodytext') ?>
	    <?php if($this->data['catlinks']) { ?><div id="catlinks"><?php       $this->html('catlinks') ?></div><?php } ?>
	    <!-- end content -->
	    <div class="visualClear"></div>
	  </div>
	</div> <!-- end main-content -->
	
	
				<div id="sidebar" class="content-box">
    			<div class="sideitem">
    			  <h4><a href="http://creativecommons.org/worldwide" class="jurisdiction">International</a></h4>
            <select id="international" name="sortby" onchange="orderby(this)">
              <option value="">Select a jurisdiction</option>
              <script type="text/javascript" src="http://api.creativecommons.org/rest/dev/support/jurisdictions.js"></script>
            </select>
            <span class="international"><a href="http://creativecommons.org/worldwide">More information</a></span>
          </div>

          <div class="sideitem">
            <h4>Search</h4>
            <form name="searchform" action="<?php $this->text('searchaction') ?>" id="searchform">
              <!--<label for="searchInput"><?php $this->msg('search') ?></label>-->
      	      <input id="s" name="search" type="text"
      	        <?php if($this->haveMsg('accesskey-search')) {
      	          ?>accesskey="<?php $this->msg('accesskey-search') ?>"<?php }
      	        if( isset( $this->data['search'] ) ) {
      	          ?> value="<?php $this->text('search') ?>"<?php } ?> />
      	      <input type='submit' name="go" id="searchsubmit"
      	        value="<?php $this->msg('search') ?>" /> 
                        <!--
                      <input type='submit' name="fulltext"
      	        class="searchButton"
      	        value="<?php $this->msg('search') ?>" />
                      -->
      	    </form>
            <div class="clear"></div>
          </div>

      <!-- logged in stuff -->
      <?
      if ($userLoggedIn) {
          echo '<div class="sideitem">';
          echo '<h4>Wiki Toolbox</h4>';
          echo "<p>Logged in as ";
          echo $navlist;
          echo '</p>';
          echo "</div>"
      ?>
        
      <div class="sideitem">
        <h4 style="margin-bottom:0">Views</h4>
        <ul>
          <?php foreach($this->data['content_actions'] as $key => $action) {
             ?><li id="ca-<?php echo htmlspecialchars($key) ?>"
             <?php if($action['class']) { ?>class="<?php echo htmlspecialchars($action['class']) ?>"<?php } ?> >
               <a href="<?php echo htmlspecialchars($action['href']) ?>"><?php echo htmlspecialchars($action['text']) ?></a>
             </li>
          <?php } ?>
        </ul>
      </div>
      
      <div class="sideitem">
        <h4 style="margin-bottom:0"><?php $this->msg('toolbox') ?></h4>
  	    <ul>
    			<li><a href="http://wiki.creativecommons.org/Special:Recentchanges">Recent Changes</a></li>
    				<!--
    					in the array just  below, 
    					may have to add before 'whatlinkshere' : 'recentchanges',
    				-->
    		  <?php if($this->data['notspecialpage']) { foreach( array( 'whatlinkshere', 'recentchangeslinked' ) as $special ) { ?>
    		  <li id="t-<?php echo $special?>"><a href="<?php
    		    echo htmlspecialchars($this->data['nav_urls'][$special]['href']) 
    		    ?>"><?php echo $this->msg($special) ?></a></li>
    		  <?php } } ?>
    	      <?php if($this->data['feeds']) { ?><li id="feedlinks"><?php foreach($this->data['feeds'] as $key => $feed) {
    	        ?><span id="feed-<?php echo htmlspecialchars($key) ?>"><a href="<?php
    	        echo htmlspecialchars($feed['href']) ?>"><?php echo htmlspecialchars($feed['text'])?></a>&nbsp;</span>
    	        <?php } ?></li>
    	      <?php } ?>
    	      <?php foreach( array('contributions', 'emailuser', 'upload', 'specialpages') as $special ) { ?>
    	      	<?php if($this->data['nav_urls'][$special]) {?><li id="t-<?php echo $special ?>"><a href="<?php
    	        echo htmlspecialchars($this->data['nav_urls'][$special]['href'])
    	        ?>"><?php $this->msg($special) ?></a></li><?php } ?>
    	      <?php } ?>
  	    </ul>
	    </div>
       
	<?php if( $this->data['language_urls'] ) { ?>
	  <div class="sideitem">
  	  <div id="p-lang" class="portlet">
    	  <h5><?php $this->msg('otherlanguages') ?></h5>
    	  <div class="pBody">
    	    <ul>
    	      <?php foreach($this->data['language_urls'] as $langlink) { ?>
    	      <li>
    	      <a href="<?php echo htmlspecialchars($langlink['href'])
    	        ?>"><?php echo $langlink['text'] ?></a>
    	      </li>
    		  <?php } ?>
    	    </ul>
    	  </div>
      </div>
    </div>
      <?php 
        }
      } else { /* user not logged in */
    ?>

    <div class="sideitem">
      <ul>
    	    <?php
    	    if ($this->data['personal_urls']['login']) {
    		    $loginvar="login";
    	    } else {
    		    $loginvar="anonlogin";
    	    }
          echo '<li><a href="'.htmlspecialchars($this->data['personal_urls'][$loginvar]['href']).'">'.htmlspecialchars($this->data['personal_urls'][$loginvar]['text']).'</a>'.'</li>';
          ?><li style="background: url(<?php $this->text('stylepath'); ?>/<?php $this->text('stylename'); ?>/images/openid.gif) no-repeat 4px 40%; padding-left: 25px;"><a href="/Special:OpenIDLogin">log in with OpenID</a></li>
      </ul>
    </div>
    <?
	  }
    ?>
    
    <div class="sideitem">
			<ul>
			 <li><a href="/">Main Page</a></li>
			 <li><a href="/Developer">Developer Portal</a></li>
			 <li><a href="/Casestudies">Case Studies</a></li>
			 <li><a href="/Salon">CC Salons</a></li>
			 <li><a href="/Frequently_Asked_Questions">CC FAQ</a></li>
			 <li><a href="/Content_Curators">Content Directories</a></li>
			</ul>
		</div>

<!-- end logged in stuff -->
  	  <div class="sideitem">
  			<h4>The Commons</h4>
  			<ul> 
  			  <li><img src="<?php $this->text('stylepath') ?>/<?php $this->text('stylename') ?>/images/sc.png"/> <a href="http://sciencecommons.org">Science Commons</a></li>
  			  <li><img src="<?php $this->text('stylepath') ?>/<?php $this->text('stylename') ?>/images/cci.png"/> <a href="http://creativecommons.org/international">ccInternational</a></li>
  			  <li><img src="<?php $this->text('stylepath') ?>/<?php $this->text('stylename') ?>/images/learn.png"/> <a href="http://learn.creativecommons.org">ccLearn</a></li>
  			</ul>
  		</div>

			</div>

      </div> <!-- end wrapper-ie -->
      </div> <!-- end wrapper -->
  <div id="footer">
   <div class="box">

 
 	  <ul>
	    <?php foreach($this->data['content_actions'] as $key => $action) {
	       ?><li><a href="<?php echo htmlspecialchars($action['href']) ?>"><?php
	       echo htmlspecialchars($action['text']) ?></a></li><?php
	     } ?>
    	  <?php if($this->data['lastmod'   ]) { ?><li><?php    $this->html('lastmod')    ?></li><?php } ?>
	  </ul>
    
    <ul> 

 	  <?php if($this->data['about'     ]) { ?><li><?php      $this->html('about')      ?></li><?php } ?>
    </ul>
    
	  <div id="p-search">

	  </div>

	<?php /*if($this->data['copyrightico']) { ?><div id="f-copyrightico"><?php $this->html('copyrightico') ?></div><?php } */?>
	<ul>

	  <?php if($this->data['viewcount' ] && $userLoggedIn) { ?><div id="f-viewcount"><?php  $this->html('viewcount')  ?></div><?php } ?>
	  <?php if($this->data['credits'   ]) { ?><li id="f-credits"><?php    $this->html('credits')    ?></li><?php } ?>
	  <?php /*if($this->data['disclaimer']) { ?><div id="f-disclaimer"><?php $this->html('disclaimer') ?></div><?php }*/ ?>

          </ul>
        </div>
        <div id="license">
          <p class="box">
            <a href="http://www.mediawiki.org/"><img src="<?php $this->text('stylepath') ?>/<?php $this->text('stylename') ?>/images/mediawiki.png" border="0" alt="" id="mw" /></a>
            <a rel="license" href="http://creativecommons.org/licenses/by/3.0/"><img src="http://i.creativecommons.org/l/by/3.0/88x31.png" alt="Creative Commons License" style="border: medium none ;" height="31" width="88"></a>
            Except where otherwise <a class="subfoot" href="/policies#license">noted</a>, content on this site is<br/>licensed under a <a rel="license" href="http://creativecommons.org/licenses/by/3.0/" class="subfoot">Creative Commons Attribution 3.0 License</a>
          </p>
        </div>
      </div> <!-- end footer -->
    <?php $this->html('reporttime') ?>

<script src="http://www.google-analytics.com/urchin.js" type="text/javascript"></script>
<script type="text/javascript">_uacct = "UA-2010376-5"; urchinTracker();</script>
</body>
</html>
<?php
	}
}

?>
