<?php
/**
 * This file should be copied to AdminSettings.php, and modified
 * to reflect local settings. It is required for the maintenance
 * scripts which run on the command line, as an extra security
 * measure to allow using a separate user account with higher
 * privileges to do maintenance work.
 *
 * Developers: Do not check AdminSettings.php into Subversion
 *
 * @package MediaWiki
 */

/*
 * This data is used by all database maintenance scripts
 * (see directory maintenance/). The SQL user MUST BE
 * MANUALLY CREATED or set to an existing user with
 * necessary permissions.
 *
 * This is not to be confused with sysop accounts for the
 * wiki.
 */
$wgDBadminuser      = 'root';
$wgDBadminpassword  = '';

/*
 * Whether to enable the profileinfo.php script.
 */
$wgEnableProfileInfo = false;

?>
