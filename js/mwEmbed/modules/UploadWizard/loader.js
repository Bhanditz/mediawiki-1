/*
* Loader for UploadWizard module:
*/

// Scope everythign in "mw"  ( keeps the global namespace clean ) 
( function( mw ) {

	mw.addMessages( {
		"mwe-loading-upwiz" : "Loading upload wizard"
	});
	
	// Add class file paths ( From ROOT )
	// "mw.UploadHandler"		: "modules/UploadWizard/mw.UploadHandler.js",
	mw.addClassFilePaths( {		
		"mw.UploadWizard"		: "modules/UploadWizard/mw.UploadWizard.js",
		"mw.UploadApiProcessor"		: "modules/UploadWizard/mw.UploadApiProcessor.js",
		"mw.IframeTransport"		: "modules/UploadWizard/mw.IframeTransport.js",
		"mw.ApiUploadHandler"		: "modules/UploadWizard/mw.ApiUploadHandler.js",

		"mw.MockUploadHandler"		: "modules/UploadWizard/mw.MockUploadHandler.js"			
		
	});	

	mw.addClassStyleSheets( {
		'mw.UploadWizard'		: 'modules/UploadWizard/css/uploadWizard.css'
	} );
	
	//Set a variable for the base upload interface for easy inclution
	var baseUploadlibs = [
		[
			'mw.UploadHandler',
			'mw.UploadInterface',
			'$j.ui'
		],
		[
			'$j.ui.progressbar',
			'$j.ui.dialog',
			'$j.ui.draggable'
		]
	];
		
	var mwBaseFirefoggReq = baseUploadlibs.slice( 0 )
	mwBaseFirefoggReq[0].push('mw.Firefogg');
	

	/**
	* Note: We should move relevant parts of these style sheets to the addMedia/css folder 
	* phase 2: We should separate out sheet sets per sub-module:
	*/ 
	
	mw.addModuleLoader( 'UploadWizard.UploadWizard', function( callback ) {
		//Clone the array: 
		var request = mwBaseFirefoggReq.slice( 0 ) ;
		
		//Add uploadwizard classes to a new "request" var: 
		request.push( [
			'mw.IframeTransport',
			'mw.ApiUploadHandler',
			'mw.UploadWizard'
		] );
		
		mw.load( request, function() {
			callback( 'UploadWizard.UploadWizard' );
		});

	} );
	
	mw.addModuleLoader( 'UploadWizard.UploadWizardTest', function( callback ) {
		//Clone the array: 
		var request = mwBaseFirefoggReq.slice( 0 ) ;
	 	
		//Add uploadwizard classes to a new "request" var: 
		request.push( [
			'mw.IframeTransport',
			'mw.ApiUploadHandler',
			'mw.MockUploadHandler',
			'mw.UploadWizard'
		] );
		
		mw.load( request, function() {
			callback( 'UploadWizard.UploadWizardTest' );
		});

	} );

} )( window.mw );
