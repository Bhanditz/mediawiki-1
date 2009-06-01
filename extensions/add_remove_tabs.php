<?php

# As suggested by:
# http://www.mediawiki.org/wiki/Help:FAQ#How_do_I_remove_the_article.2Fedit_etc_tabs_for_users_who_are_not_logged_in.3F
# (nkinkade 2008-03-12)

$wgHooks['SkinTemplateContentActions'][] = 'ReplaceTabs';

function ReplaceTabs ($content_actions) {  
	unset( $content_actions['talk'] ); # Remove the "discussion" tab
	return true;
}

?>
