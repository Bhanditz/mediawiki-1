/**
* libEmbedPlayer loader
* 
*/

/**
* Default player module configuration: 
*/
	
//If the Timed Text interface should be displayed: 
// 'always' Displays link and call to contribute always
// 'auto' Looks for child timed text elements or "apiTitleKey" & load interface
// 'off' Does not display the timed text interface
mw.setConfig( 'textInterface', 'auto' ); 
	
// Timed Text provider presently just "commons",
// NOTE: Each player instance can also specify a provider  
mw.setConfig( 'timedTextProvider', 'commons' );

// What tags will be re-written to video player by default
// Set to empty string or null to avoid automatic tag rewrites 
mw.setConfig( 'rewritePlayerTags', 'video,audio,playlist' );

// Default video size ( if no size provided )
mw.setConfig( 'video_size', '400x300' );
	
// If the k-skin video player should attribute kaltura
mw.setConfig( 'k_attribution', true );


// Add class file paths 
mw.addClassFilePaths( {
	"mw.EmbedPlayer"	: "modules/EmbedPlayer/mw.EmbedPlayer.js",
	"flowplayerEmbed"	: "modules/EmbedPlayer/flowplayerEmbed.js",
	"kplayerEmbed"		: "modules/EmbedPlayer/kplayerEmbed.js",
	"genericEmbed"		: "modules/EmbedPlayer/genericEmbed.js",
	"htmlEmbed"			: "modules/EmbedPlayer/htmlEmbed.js",
	"javaEmbed"			: "modules/EmbedPlayer/javaEmbed.js",
	"nativeEmbed"		: "modules/EmbedPlayer/nativeEmbed.js",
	"quicktimeEmbed"	: "modules/EmbedPlayer/quicktimeEmbed.js",
	"vlcEmbed"			: "modules/EmbedPlayer/vlcEmbed.js"
} );

// Add style sheet dependencies ( From ROOT )
mw.addClassStyleSheets( {
	"kskinConfig" : "skins/kskin/EmbedPlayer.css",
	"mvpcfConfig" : "skins/mvpcf/EmbedPlayer.css"	
} );
 
/**
* Check the current DOM for any tags in "rewritePlayerTags"
* 
* NOTE: this function can be part of setup can run prior to jQuery being ready
*/
mw.documentHasPlayerTags = function(){
	var rewriteTags = mw.getConfig( 'rewritePlayerTags' );			
	if( rewriteTags ){
		var jtags = rewriteTags.split( ',' );
		for ( var i = 0; i < jtags.length; i++ ) {	
			if( document.getElementsByTagName( jtags[i] )[0] )
				return true;
		};
	}
	return false;
}	

// Add a dom ready check for player tags
mw.addDOMReadyHook( function(){
	if( mw.documentHasPlayerTags() ) {
		// Add the setup hook since we have player tags
		mw.addSetupHook( function( callback ){
			// Load the embedPlayer module ( then run queued hooks )
			mw.load( 'EmbedPlayer', function ( ) {
				// Rewrite the rewritePlayerTags with the 
				$j( mw.getConfig( 'rewritePlayerTags' ) ).embedPlayer();				
				// Run the setup callback now that we have setup all the players
				callback();
			})
		});
	
		// Tell mwEmbed to run setup
		mw.setConfig( 'runSetupMwEmbed', true );			
	}
});



// Add the module loader function:
mw.addModuleLoader( 'EmbedPlayer', function( callback ){
	var _this = this;	
	
	// Set module specific class videonojs to loading:
	$j( '.videonojs' ).html( gM( 'mwe-loading_txt' ) );
	
	// Set up the embed video player class request: (include the skin js as well)
	var dependencyRequest = [
		[
			'$j.ui',
			'mw.EmbedPlayer',
			'ctrlBuilder',
			'$j.cookie',
			'JSON'
		],
		[
			'$j.fn.menu',
			'$j.ui.slider'
		]
	];
	
	var addTimedTextReqFlag = false;
	
	// Merge in the timed text libs 
	if( mw.getConfig( 'textInterface' ) == 'always' ){		
		addTimedTextReqFlag = true;	
	}
		
	// Get the class of all embed video elements 
	// to add the skin to the load request
	$j( mw.getConfig( 'rewritePlayerTags' ) ).each( function(){
		var playerElement = this;		
		var cName = $j( playerElement ).attr( 'class' );
		for( var n=0; n < mw.valid_skins.length ; n++ ){
			// Get any other skins that we need to load 
			// That way skin js can be part of the single script-loader request: 
			if( cName.indexOf( mw.valid_skins[ n ] ) !== -1){
				dependencyRequest[0].push(  mw.valid_skins[n]  + 'Config' );
			}
		}
		//Also add the text library to request set if any video element has text sources:
		if(!addTimedTextReqFlag){
			if( $j( playerElement ).find( 'itext' ).length != 0 ){
				// Has an itext child include timed text request
				addTimedTextReqFlag = true;
			}else{			
				$j( playerElement ).find( 'source' ).each(function(na, sourceElement){
					if( $j( sourceElement ).attr('type') == 'text/xml' && 
						$j( sourceElement ).attr('codec') == 'roe' 
					){						
						// Has a roe src
						addTimedTextReqFlag = true;
					}
				});
			}
		}
	} );	
	
	// Add timed text items if flag set.  	
	if( addTimedTextReqFlag ){
		dependencyRequest[0].push( 'mw.TimedText' )
	}
	
	// Add PNG fix code needed:
	if ( $j.browser.msie || $j.browser.version < 7 ){
		dependencyRequest[0].push( '$j.fn.pngFix' );
	}
	
	// Do short detection, to avoid extra player library request in ~most~ cases. 
	//( If browser is firefox include native, if browser is IE include java ) 
	if( $j.browser.msie ){
		dependencyRequest[0].push( 'javaEmbed' )
	}
	
	// Safari gets slower load since we have to detect ogg support 
	if( typeof HTMLVideoElement == 'object' &&  !$j.browser.safari  ){
		dependencyRequest[0].push( 'nativeEmbed' )
	}
	

	// Load the video libs:
	mw.load( dependencyRequest, function() {
		//Setup userConfig 
		mw.setupUserConfig( function(){
			// Remove no video html elements:
			$j( '.videonojs' ).remove();
			
			// Detect supported players:  
			mw.EmbedTypes.init();		
			
			//mw.log(" run callback: " + callback );
						
			// Run the callback with name of the module  
			if( typeof callback == 'function' )		
				callback( 'EmbedPlayer' );		
			
		} ); // setupUserConfig
	} );
	
} );