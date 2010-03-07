/**
*
* Core "loader.js" for mwEmbed
*
* This loader along with all the enabled module loaders is combined with mwEmbed.js
*  via the script-loader. 
*
*/

/**
* The set of modules that you want enable. 
* 
* Each enabledModules array value should be a name
* of a folder in mwEmbed/modules 
*
* Modules must define a loader.js file in the root
*  of the module folder. 
* 
* A loader file should only include:
*  * Class paths of the module classes
*  * Style sheets of the module
*  * Loader function(s) that load module classes
*  * Any code you want run on all pages like checking the DOM 
*  		for a tag that invokes your loader.  
*
* When using the scriptLoader the enabledModules loader code
*  is transcluded into base mwEmbed class include.  
*/
var mwEnabledModuleList = [
	'AddMedia',
	'ClipEdit',
	'EmbedPlayer',
	'ApiProxy',
	'Sequencer',
	'TimedText'	
]; 

/**
* mwEmbed default config values.  
*/  	
mw.setDefaultConfig ( {
	// Default enabled modules: 
	"enabledModules" : mwEnabledModuleList, 
	
	// Default skin name
	"skinName" : "mvpcf",
	
	// Default jquery ui skin name
	"jQueryUISkin" : "redmond",	
	
	/**
	* If jQuery / mwEmbed should be loaded.
	*
	* This flag is automatically set to true if: 
	*  Any script calls mw.ready ( callback_function )
	*  Page DOM includes any tags set in config.rewritePlayerTags at onDomReady 
	*  ( embedPlayer module )
	*
	* This flag increases page performance on pages that do not use mwEmbed 
	* and don't already load jQuery 
	*
	* For example when including the mwEmbed.js in your blog template 
	* mwEmbed will only load extra js on blog posts that include the video tag.
	*
	* NOTE: Future architecture will probably do away with this flag and refactor it into 
	* a smaller "remotePageMwEmbed.js" script similar to ../remoteMwEmbed.js
	*/ 
	"runSetupMwEmbed" : false,	

	// The mediaWiki path of mwEmbed  
	"mediaWikiEmbedPath" : "js/mwEmbed/",
	
	// Api actions that must be submitted in a POST, and need an api proxy for cross domain calls
	'apiPostActions': [ 'login', 'purge', 'rollback', 'delete', 'undelete',
		'protect', 'block', 'unblock', 'move', 'edit', 'upload', 'emailuser',
		'import', 'userrights' ],
	
	//If we are in debug mode ( results in fresh debug javascript includes )
	'debug' : false,
	
	// Valid language codes ( has a file in /languages/classes/Language{code}.js )
	// TODO: mirror the mediaWiki language "fallback" system
	'languageCodeList': ['en', 'am', 'ar', 'bat_smg', 'be_tarak', 'be', 'bh',
		'bs', 'cs', 'cu', 'cy', 'dsb', 'fr', 'ga', 'gd', 'gv', 'he', 'hi',
		'hr', 'hsb', 'hy', 'ksh', 'ln', 'lt', 'lv', 'mg', 'mk', 'mo', 'mt',
		'nso', 'pl', 'pt_br', 'ro', 'ru', 'se', 'sh', 'sk', 'sl', 'sma',
		'sr_ec', 'sr_el', 'sr', 'ti', 'tl', 'uk', 'wa'
	],
	
	// Default request timeout ( for cases where we inlucde js and normal browser timeout can't be used )
	// stored in seconds
	'defaultRequestTimeout' : 20,
	
	// Default user language is "en" Can be overwritten by: 
	// 	"uselang" url param 
	// 	wgUserLang global  
	'userLanguage' : 'en',
	
	// Set the default providers ( you can add more provider via {provider_id}_apiurl = apiUrl	  
	'commons_apiurl' : 'http://commons.wikimedia.org/w/api.php'
} );

/**
* --  Load Class Paths --
* 
* PHP AutoLoader reads this loader.js file along with 
* all the "loader.js" files to determin script-loader 
* class paths
* 
*/

// Set the loaderContext for the classFiles paths call:  
mw.setConfig('loaderContext', '' );

/**
 * Core set of mwEmbed classes:
 */
mw.addClassFilePaths( {
	"mwEmbed"				: "mwEmbed.js",
	"window.jQuery"			: "jquery/jquery-1.4.2.js",
	
	"ctrlBuilder"			: "skins/ctrlBuilder.js",
	"kskinConfig"			: "skins/kskin/kskinConfig.js",
	"mvpcfConfig"			: "skins/mvpcf/mvpcfConfig.js",
	
	"$j.fn.pngFix"			: "jquery/plugins/jquery.pngFix.js",
	"$j.fn.autocomplete"	: "jquery/plugins/jquery.autocomplete.js",
	"$j.fn.hoverIntent"		: "jquery/plugins/jquery.hoverIntent.js",
	"$j.fn.datePicker"		: "jquery/plugins/jquery.datePicker.js",
	"$j.ui"					: "jquery/jquery.ui/ui/ui.core.js",	
	
	"mw.testLang"			:  "tests/testLang.js",		

	"$j.cookie"				: "jquery/plugins/jquery.cookie.js",
	"$j.contextMenu"		: "jquery/plugins/jquery.contextMenu.js",
	"$j.fn.suggestions"		: "jquery/plugins/jquery.suggestions.js",
	"$j.fn.textSelection" 	: "jquery/plugins/jquery.textSelection.js",
	"$j.browserTest"		: "jquery/plugins/jquery.browserTest.js",

	"$j.effects.blind"		: "jquery/jquery.ui/ui/effects.blind.js",
	"$j.effects.drop"		: "jquery/jquery.ui/ui/effects.drop.js",
	"$j.effects.pulsate"	: "jquery/jquery.ui/ui/effects.pulsate.js",
	"$j.effects.transfer"	: "jquery/jquery.ui/ui/effects.transfer.js",
	"$j.ui.droppable"		: "jquery/jquery.ui/ui/ui.droppable.js",
	"$j.ui.slider"			: "jquery/jquery.ui/ui/ui.slider.js",
	"$j.effects.bounce"		: "jquery/jquery.ui/ui/effects.bounce.js",
	"$j.effects.explode"	: "jquery/jquery.ui/ui/effects.explode.js",
	"$j.effects.scale"		: "jquery/jquery.ui/ui/effects.scale.js",
	"$j.ui.datepicker"		: "jquery/jquery.ui/ui/ui.datepicker.js",
	"$j.ui.progressbar"		: "jquery/jquery.ui/ui/ui.progressbar.js",
	"$j.ui.sortable"		: "jquery/jquery.ui/ui/ui.sortable.js",
	"$j.effects.clip"		: "jquery/jquery.ui/ui/effects.clip.js",
	"$j.effects.fold"		: "jquery/jquery.ui/ui/effects.fold.js",
	"$j.effects.shake"		: "jquery/jquery.ui/ui/effects.shake.js",
	"$j.ui.dialog"			: "jquery/jquery.ui/ui/ui.dialog.js",
	"$j.ui.resizable"		: "jquery/jquery.ui/ui/ui.resizable.js",
	"$j.ui.tabs"			: "jquery/jquery.ui/ui/ui.tabs.js",
	"$j.effects.core"		: "jquery/jquery.ui/ui/effects.core.js",
	"$j.effects.highlight"	: "jquery/jquery.ui/ui/effects.highlight.js",
	"$j.effects.slide"		: "jquery/jquery.ui/ui/effects.slide.js",
	"$j.ui.accordion"		: "jquery/jquery.ui/ui/ui.accordion.js",
	"$j.ui.draggable"		: "jquery/jquery.ui/ui/ui.draggable.js",
	"$j.ui.selectable"		: "jquery/jquery.ui/ui/ui.selectable.js"	

} );