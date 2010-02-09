/**
 * The base upload interface. 
 * 
 * Progress bars for http-copy-by-url uploading.
 * Ifame upload target 
 *
 * This base upload class is optionally extended by Firefogg
 *
 */
mw.addMessages({
	"mwe-upload-transcode-in-progress" : "Transcode and upload in progress (do not close this window)",
	"mwe-upload-in-progress" : "Upload in progress (do not close this window)",
	"mwe-upload-transcoded-status" : "Transcoded",
	"mwe-uploaded-time-remaining" : "Time remaining: $1",
	"mwe-uploaded-status" : "Uploaded",
	"mwe-upload-stats-fileprogress" : "$1 of $2",
	"mwe-upload_completed" : "Your upload is complete",
	"mwe-upload_done" : "<a href=\"$1\">Your upload <i>should be<\/i> accessible<\/a>.",
	"mwe-upload-unknown-size" : "Unknown size",
	"mwe-cancel-confim" : "Are you sure you want to cancel?",
	"mwe-successfulupload" : "Upload successful",
	"mwe-uploaderror" : "Upload error",
	"mwe-uploadwarning" : "Upload warning",
	"mwe-unknown-error" : "Unknown error:",
	"mwe-return-to-form" : "Return to form",
	"mwe-file-exists-duplicate" : "This file is a duplicate of the following file:",
	"mwe-fileexists" : "A file with this name exists already. Please check <b><tt>$1<\/tt><\/b> if you are not sure if you want to change it.",
	"mwe-fileexists-thumb" : "<center><b>Existing file<\/b><\/center>",
	"mwe-ignorewarning" : "Ignore warning and save file anyway",
	"mwe-file-thumbnail-no" : "The filename begins with <b><tt>$1<\/tt><\/b>",
	"mwe-go-to-resource" : "Go to resource page",
	"mwe-upload-misc-error" : "Unknown upload error",
	"mwe-wgfogg_warning_bad_extension" : "You have selected a file with an unsuported extension (<a href=\"http:\/\/commons.wikimedia.org\/wiki\/Commons:Firefogg#Supported_File_Types\">more information<\/a>)."
});

var default_bui_options = {
	// Target api to upload to
	'api_url' : null,
	
	// The selected form
	'form' : null,
	
	// Callback for once the upload is done
	'done_upload_cb' : null,
	
	// A selector for the form target
	'form_selector' : null,

	// Default upload mode is 'api'
	'upload_mode' : 'api',
	
	// Callback for modifing form data on submit  
	'onsubmit_cb' : null

}
mw.BaseUploadInterface = function( options ) {
	return this.init( options );
}

mw.BaseUploadInterface.prototype = {
	
	// The form data to be submitted
	formData: {}, 
	
	// Upload warning session key, for continued uploads 
	warnings_sessionkey: null,
	
	// If chunks uploading is supported
	chunks_supported: true,
	
	// If the existing form should be used to post to the api
	// Since file selection can't be "moved" we have to use the exising
	// form and just submit it to a diffrent target  
	form_post_override: false,
	
	// http copy by url mode flag
	http_copy_upload : null,
	
	// If the upload action is done
	action_done: false,
	
	// Edit token for upload
	editToken: false,

	// The DOM node for the upload form
	form: false,

	// The following are really state of the upload, not the interface.
	// we are currently only managing one, so this is okay... for now.
	uploadBeginTime: null,


	/**
	 * Object initialisation
	 * @param {Object} options BaseUpload options see default_bui_options
	 */
	init: function( options ) {
		if ( !options )
			options = {};
		$j.extend( this, default_bui_options, options );
		mw.log( "init mvBaseUploadInterface:: " + this.api_url );
	},

	/**
	 * Set up the upload form, register onsubmit handler.
	 * May remap it to use the API field names.
	 */
	setupForm: function() {
		mw.log( "Base::setupForm::" );
		var _this = this;
		
		// Set up the local pointer to the edit form:
		this.form = this.getForm();		
		
		if ( !this.form ) {
			mw.log( "Upload form not found!" );
			return;
		}		

		// Set up the orig_onsubmit if not set:
		if ( typeof( this.orig_onsubmit ) == 'undefined' && this.form.onsubmit ) {
			this.orig_onsubmit = this.form.onsubmit;
		}
		
		// Set up the submit action:
		$j( this.form ).submit( function() {	
			mw.log( "FORM SUBMIT::" );
			var data = $j( this ).serializeArray();
			for ( var i = 0; i < data.length; i++ ) {
				mw.log( $j( data[i] ).attr('name') + ' : ' + $j(data[i]).val() );
			}		
		
			return _this.onSubmit();
		} );
	},

	/**
	 * onSubmit handler for the upload form
	 */
	onSubmit: function() {
		var _this = this;
		mw.log( 'Base::onSubmit:' );
		// Run the original onsubmit (if not run yet set flag to avoid excessive chaining)
		if ( typeof( this.orig_onsubmit ) == 'function' ) {
			if ( ! this.orig_onsubmit() ) {
				//error in orig submit return false;
				return false;
			}
		}
		// Call the onsubmit_cb option if set:
		if( this.onsubmit_cb && typeof this.onsubmit_cb == 'function' ){
			this.onsubmit_cb();
		}
		
		// Remap the upload form to the "api" form:
		this.remapFormToApi();
		
		// Check for post action override	
		if ( this.form_post_override ) {
			mw.log( 'form_post_override is true, do ordinary form submit' );
			return true;
		}
	
	
		// Put into a try catch so we are sure to return false:
		try {
			// Display a progress dialog
			_this.displayProgressOverlay();

			// For some unknown reason we have to drop down the #p-search z-index:
			$j( '#p-search' ).css( 'z-index', 1 );

			var _this = this;
			_this.detectUploadMode( function( mode ) {
				_this.upload_mode = mode;
				_this.doUpload();
			} );
		} catch( e ) {
			mw.log( '::error in displayProgressOverlay or doUpload' );
		}

		// Don't submit the form we will do the post in ajax
		return false;
	},

	/**
	 * Determine the correct upload mode.
	 *
	 * If this.upload_mode is autodetect, this runs an API call to find out if MW
	 * supports uploading. It then sets the upload mode when this call returns.
	 *
	 * When done detecting, or if detecting is unnecessary, it calls the callback 
	 * with the upload mode as the first parameter.
	 *
	 * @param {Function} callback Function called once upload mode is detected
	 */
	detectUploadMode: function( callback ) {
		var _this = this;
		mw.log( 'detectUploadMode::' +  _this.upload_mode );
		//debugger;
		// Check the upload mode
		if ( _this.upload_mode == 'detect_in_progress' ) {
			// Don't send another request, wait for the pending one.
		} else if ( !_this.isCopyUpload() ) {
			callback( 'post' );
		} else if ( _this.upload_mode == 'autodetect' ) {
			mw.log( 'detectUploadMode::' + _this.upload_mode + ' api:' + _this.api_url );
			if( !_this.api_url ) {
				mw.log( 'Error: can\'t autodetect mode without api url' );
				return;
			}

			// Don't send multiple requests
			_this.upload_mode = 'detect_in_progress';

			// FIXME: move this to configuration and avoid this API request
			mw.getJSON( _this.api_url, { 'action' : 'paraminfo', 'modules' : 'upload' }, function( data ) {
					if ( typeof data.paraminfo == 'undefined'
						|| typeof data.paraminfo.modules == 'undefined' )
					{
						return mw.log( 'Error: bad api results' );
					}
					if ( typeof data.paraminfo.modules[0].classname == 'undefined' ) {
						mw.log( 'Autodetect Upload Mode: \'post\' ' );
						_this.upload_mode = 'post';
						callback( 'post' );
					} else {
						mw.log( 'Autodetect Upload Mode: api ' );
						_this.upload_mode = 'api';
						// Check to see if chunks are supported
						for ( var i in data.paraminfo.modules[0].parameters ) {
							var pname = data.paraminfo.modules[0].parameters[i].name;
							if( pname == 'enablechunks' ) {
								mw.log( 'this.chunks_supported = true' );
								_this.chunks_supported = true;
								break;
							}
						}
						callback( 'api' );
					}
				}
			);
		} else if ( _this.upload_mode == 'api' ) {
			callback( 'api' );
		} else if ( _this.upload_mode == 'post' ) {
			callback( 'post' );
		} else {
			mw.log( 'Error: unrecongized upload mode: ' + _this.upload_mode );
		}
	},

	/**
	 * Do an upload, with the mode given by this.upload_mode	 
	 */
	doUpload: function() {		
		// Note "api" should be called "http_copy_upload" and /post/ should be "form_upload"
 		this.uploadBeginTime = (new Date()).getTime();
		if ( this.upload_mode == 'api' ) {
			this.doApiCopyUpload();
		} else if ( this.upload_mode == 'post' ) {
			this.doPostUpload();
		} else {
			mw.log( 'Error: unrecongized upload mode: ' + this.upload_mode );
		}
	},

	/**
	 * Change the upload form so that when submitted, it sends a request to
	 * the MW API.
	 *
	 * This is rather ugly, but solutions are constrained by the fact that 
	 * file inputs can't be moved around or recreated after the user has 
	 * selected a file in them, which they may well do before DOM ready.
	 *
	 * It is also constrained by upload form hacks on commons.
	 */
	remapFormToApi: function() {
		var _this = this;
		//
		mw.log("remapFormToApi:: " + this.api_url + ' form: ' + this.form);
		
		if ( !this.api_url ){
			mw.log( 'Error: no api url target' ); 
			return false;
		}
		var $form = $j( this.form_selector );		

		// Set the form action
		try{
			$form.attr('action', _this.api_url);
		}catch(e){
			mw.log("IE for some reason error's out when you change the action")
		}

		// Add API action
		if ( $form.find( "[name='action']" ).length == 0 ){
			$form.append( 
				$j('<input />')
				.attr({ 
					'type': "hidden",
					'name' : "action", 
					'value' : "upload"
				})
			)
		}

		// Add JSON response format
		if ( $form.find( "[name='format']" ).length == 0 ){
			$form.append( 
				$j( '<input />' )
				.attr({
					'type' : "hidden",
					'name' : "format",
					'value' : "jsonfm"
				})
			) 
		}

		// Map a new hidden form
		$form.find( "[name='wpUploadFile']" ).attr( 'name', 'file' );
		$form.find( "[name='wpDestFile']" ).attr( 'name', 'filename' );
		$form.find( "[name='wpUploadDescription']" ).attr( 'name', 'comment' );
		$form.find( "[name='wpEditToken']" ).attr( 'name', 'token' );
		$form.find( "[name='wpIgnoreWarning']" ).attr( 'name', 'ignorewarnings' );
		$form.find( "[name='wpWatchthis']" ).attr( 'name', 'watch' );
		
		//mw.log( 'comment: ' + $form.find( "[name='comment']" ).val() );
	},

	/**
	 * Returns true if the current form has copy upload selected, false otherwise.
	 */
	isCopyUpload: function() {	
		if ( $j( '#wpSourceTypeFile' ).length ==  0
			|| $j( '#wpSourceTypeFile' ).get( 0 ).checked )
		{
			this.http_copy_upload = false;
		} else if ( $j('#wpSourceTypeURL').get( 0 ).checked ) {
			this.http_copy_upload = true;
		}
		return this.http_copy_upload;
	},

	/**
	 * Do an upload by submitting the form
	 */
	doPostUpload: function() {
		var _this = this;
		var $form = $j( _this.form );
		mw.log( 'mvBaseUploadInterface.doPostUpload' );
		// Issue a normal post request
		// Get the token from the page
		_this.editToken = $j( "#wpEditToken" ).val();

		// TODO check for sendAsBinary to support Firefox/HTML5 progress on upload
		
		//Update the progress dialog (no bar without XHR request)
		$j( '#upProgressDialog' ).html(		
			mw.loading_spinner()
		);		

		// Add the iframe
		_this.iframeId = 'f_' + ( $j( 'iframe' ).length + 1 );
		//IE only works if you "create element with the name" (not jquery style
		var iframe;
		try {
		  iframe = document.createElement( '<iframe name="' + _this.iframeId + '">' );
		} catch (ex) {
		  iframe = document.createElement('iframe');
		}		
		
		$j( "body" ).append( 
			$j( iframe )
			.attr({
				'src':'javascript:false;',
				'id':_this.iframeId,
				'name':  _this.iframeId
			}) 
			.css('display', 'none')
		);


		// Set the form target to the iframe
		$form.attr( 'target', _this.iframeId );		

		// Set up the completion callback
		$j( '#' + _this.iframeId ).load( function() {
			_this.processIframeResult( $j( this ).get( 0 ) );
		});			
		
		// Do post override
		_this.form_post_override = true;
				
		// Reset the done with action flag
		_this.action_done = false;			
		$form.submit();
	},

	/**
	 * Do an upload by submitting an API request
	 */
	doApiCopyUpload: function() {
		mw.log( 'mvBaseUploadInterface.doApiCopyUpload' );
		mw.log( 'doHttpUpload (no form submit) ' );
		
		var httpUpConf = {
			'url'       : $j( '#wpUploadFileURL' ).val(),
			'filename'  : $j( '#wpDestFile' ).val(),
			'comment'   : this.getUploadDescription(),
			'watch'     : ( $j( '#wpWatchthis' ).is( ':checked' ) ) ? 'true' : 'false',
			'ignorewarnings': ($j('#wpIgnoreWarning' ).is( ':checked' ) ) ? 'true' : 'false'
		}
		//check for editToken
		this.editToken = $j( "#wpEditToken" ).val();
		this.doHttpUpload( httpUpConf );
	},
	
	/**
	* Get the upload description, append the licence if avaliable
	*
	* NOTE: wpUploadDescription should be a configuration option. 
	*
	* @return {String} 
	* 	value of wpUploadDescription 
	*/
	getUploadDescription: function(){
		//Special case of upload.js commons hack: 
		var comment_value = $j( '#wpUploadDescription' ).val();
		if(  comment_value == '' ){
			comment_value = $j( "[name='wpUploadDescription']").val();
		}
		//check for licence tag: 
	},

	/**
	 * Process the result of the form submission, returned to an iframe.
	 * This is the iframe's onload event.
	 */
	processIframeResult: function( iframe ) {
		var _this = this;
		var doc = iframe.contentDocument ? iframe.contentDocument : frames[iframe.id].document;
		// Fix for Opera 9.26
		if ( doc.readyState && doc.readyState != 'complete' ) {
			return;
		}
		// Fix for Opera 9.64
		if ( doc.body && doc.body.innerHTML == "false" ) {
			return;
		}
		var response;
		if ( doc.XMLDocument ) {
			// The response is a document property in IE
			response = doc.XMLDocument;
		} else if ( doc.body ) {
			// Get the json string
			json = $j( doc.body ).find( 'pre' ).text();
			//mw.log( 'iframe:json::' + json_str + "\nbody:" + $j( doc.body ).html() );
			if ( json ) {
				response = window["eval"]( "(" + json + ")" );
			} else {
				response = {};
			}
		} else {
			// response is a xml document
			response = doc;
		}
		// Process the API result
		_this.processApiResult( response );
	},

	/**
	 * Do a generic action=upload API request and monitor its progress
	 */
	doHttpUpload: function( params ) {
		var _this = this;
		// Display the progress overlay (again)
		_this.displayProgressOverlay();

		// Set the HTTP box to "loading", in case we don't get an update for some time
		$j( '#dlbox-centered' ).html( '<h5>' + _this.getProgressTitle() + '</h5>' +
			mw.loading_spinner( 'left:40%;top:20%' )
		);

		// Set up the request
		var request = {
			'action'        : 'upload',
			'asyncdownload' : true // Do async download
		};

		// Add any parameters specified by the caller
		for ( key in params ) {
			if ( !request[key] ) {
				request[key] = params[key];
			}
		}

		// Add the edit token (if available)
		if( !_this.editToken && _this.api_url ) {
			mw.log( 'Error:doHttpUpload: missing token' );
		} else {
			request['token'] =_this.editToken;
		}

		// Reset the done with action flag
		_this.action_done = false;
		
		// Do the api request:
		mw.getJSON(_this.api_url, request, function( data ) {
			_this.processApiResult( data );
		});
	},

	/**
	 * Start periodic checks of the upload status using XHR
	 */
	doAjaxUploadStatus: function() {
		var _this = this;

		//set up the progress display for status updates:
		this.displayProgressOverlay();
		this.upload_status_request = {
			'action'     : 'upload',
			'httpstatus' : 'true',
			'sessionkey' : _this.upload_session_key
		};
		// Add token if present
		if ( this.editToken )
			this.upload_status_request['token'] = this.editToken;

		// Trigger an initial request (subsequent ones will be done by a timer)
		this.onAjaxUploadStatusTimer();
	},

	/**
	 * This is called when the timer which separates XHR requests elapses.
	 * It starts a new request.
	 */
	onAjaxUploadStatusTimer: function() {
		var _this = this;
		//do the api request:
		mw.getJSON( this.api_url, this.upload_status_request, function ( data ) {
			_this.onAjaxUploadStatusResponse( data );
		} );
	},

	/**
	 * Called when a response to an upload status query is available.
	 * Starts the timer for the next upload status check.
	 */
	onAjaxUploadStatusResponse: function( data ) {
		var _this = this;
		// Check if we are done
		if ( data.upload['apiUploadResult'] ) {
			//update status to 100%
			_this.updateProgress( 1 );
			//see if we need JSON
			mw.load( [
				'JSON'
			], function() {
				var apiResult = {};
				try {
					apiResult = JSON.parse( data.upload['apiUploadResult'] ) ;
				} catch ( e ) {
					//could not parse api result
					mw.log( 'errro: could not parse apiUploadResult' )
				}
				_this.processApiResult( apiResult );
			});
			return ;
		}

		// else update status:
		if ( data.upload['content_length'] && data.upload['loaded'] ) {
			//we have content length we can show percentage done:
			var fraction = data.upload['loaded'] / data.upload['content_length'];
			//update the status:
			_this.updateProgress( fraction );
			//special case update the file progress where we have data size:
			$j( '#up-status-container' ).html(
				gM( 'mwe-upload-stats-fileprogress',
					[
						mw.lang.formatSize( data.upload['loaded'] ),
						mw.lang.formatSize( data.upload['content_length'] )
					]
				)
			);
		} else if( data.upload['loaded'] ) {
			_this.updateProgress( 1 );
			mw.log( 'just have loaded (no cotent length: ' + data.upload['loaded'] );
			//for lack of content-length requests:
			$j( '#up-status-container' ).html(
				gM( 'mwe-upload-stats-fileprogress',
					[
						mw.lang.formatSize( data.upload['loaded'] ),
						gM( 'mwe-upload-unknown-size' )
					]
				)
			);
		}
		if ( _this.api_url == 'proxy' ) {
			// Do the updates a bit less often: every 4.2 seconds
			var timeout = 4200;
		} else {
			// We got a result: set timeout to 100ms + your server update
			// interval (in our case 2s)
			var timeout = 2100;
		}
		setTimeout(
			function() {
				_this.onAjaxUploadStatusTimer();
			},
			timeout );
	},

	/**
	 * Returns true if an action=upload API result was successful, false otherwise
	 */
	isApiSuccess: function( apiRes ) {
		if ( apiRes.error || ( apiRes.upload && apiRes.upload.result == "Failure" ) ) {
			return false;
		}
		if ( apiRes.upload && apiRes.upload.error ) {
			return false;
		}
		if ( apiRes.upload && apiRes.upload.warnings ) {
			return false;
		}
		return true;
	},

	/**
	 * Given the result of an action=upload API request, display the error message
	 * to the user.
	 */
	showApiError: function( apiRes ) {
		var _this = this;
		if ( apiRes.error || ( apiRes.upload && apiRes.upload.result == "Failure" ) ) {
			// Generate the error button
			var buttons = {};
			buttons[ gM( 'mwe-return-to-form' ) ] = function() {
				_this.form_post_override = false;
				$j( this ).dialog( 'close' );
			};

			// NOTE should be refactored to more specialUpload page type error handling

			// Check a few places for the error code
			var error_code = 0;
			var errorReplaceArg = '';
			if ( apiRes.error && apiRes.error.code ) {
				error_code = apiRes.error.code;
			} else if ( apiRes.upload.code ) {
				if ( typeof apiRes.upload.code == 'object' ) {
					if ( apiRes.upload.code[0] ) {
						error_code = apiRes.upload.code[0];
					}
					if ( apiRes.upload.code['status'] ) {
						error_code = apiRes.upload.code['status'];
						if ( apiRes.upload.code['filtered'] )
							errorReplaceArg = apiRes.upload.code['filtered'];
					}
				} else {
					apiRes.upload.code;
				}
			}

			var error_msg = '';
			if ( typeof apiRes.error == 'string' )
				error_msg = apiRes.error;

			// There are many possible error messages here, so we don't load all
			// message text in advance, instead we use mw.getRemoteMsg() for some.
			//
			// This code is similar to the error handling code formerly in
			// SpecialUpload::processUpload()
			var error_msg_key = {
				'2' : 'largefileserver',
				'3' : 'emptyfile',
				'4' : 'minlength1',
				'5' : 'illegalfilename'
			};

			// NOTE:: handle these error types
			var error_onlykey = {
				'1': 'BEFORE_PROCESSING',
				'6': 'PROTECTED_PAGE',
				'7': 'OVERWRITE_EXISTING_FILE',
				'8': 'FILETYPE_MISSING',
				'9': 'FILETYPE_BADTYPE',
				'10': 'VERIFICATION_ERROR',
				'11': 'UPLOAD_VERIFICATION_ERROR',
				'12': 'UPLOAD_WARNING',
				'13': 'INTERNAL_ERROR',
				'14': 'MIN_LENGTH_PARTNAME'
			}

			if ( !error_code || error_code == 'unknown-error' ) {
				if ( typeof JSON != 'undefined' ) {
					mw.log( 'Error: apiRes: ' + JSON.stringify( apiRes ) );
				}
				if ( apiRes.upload.error == 'internal-error' ) {
					// Do a remote message load
					errorKey = apiRes.upload.details[0];
					mw.getRemoteMsg( errorKey, function() {
						_this.updateProgressWin( gM( 'mwe-uploaderror' ), gM( errorKey ), buttons );

					});
					return false;
				}

				_this.updateProgressWin(
						gM('mwe-uploaderror'),
						gM('mwe-unknown-error') + '<br>' + error_msg,
						buttons );
				return false;
			}

			if ( apiRes.error && apiRes.error.info ) {
				_this.updateProgressWin( gM( 'mwe-uploaderror' ), apiRes.error.info, buttons );
				return false;
			}

			if ( typeof error_code == 'number'
				&& typeof error_msg_key[error_code] == 'undefined' )
			{
				if ( apiRes.upload.code.finalExt ) {
					_this.updateProgressWin(
						gM( 'mwe-uploaderror' ),
						gM( 'mwe-wgfogg_warning_bad_extension', apiRes.upload.code.finalExt ),
						buttons );
				} else {
					_this.updateProgressWin(
						gM( 'mwe-uploaderror' ),
						gM( 'mwe-unknown-error' ) + ' : ' + error_code,
						buttons );
				}
				return false;
			}

			mw.log( 'get key: ' + error_msg_key[ error_code ] )
			mw.getRemoteMsg( error_msg_key[ error_code ], function() {
				_this.updateProgressWin(
					gM( 'mwe-uploaderror' ),
					gM( error_msg_key[ error_code ], errorReplaceArg ),
					buttons );
			});
			mw.log( "api.error" );
			return false;
		}

		// Check upload.error
		if ( apiRes.upload && apiRes.upload.error ) {
			mw.log( ' apiRes.upload.error: ' +  apiRes.upload.error );
			_this.updateProgressWin(
				gM( 'mwe-uploaderror' ),
				gM( 'mwe-unknown-error' ) + '<br>',
				buttons );
			return false;
		}

		// Check for warnings:
		if ( apiRes.upload && apiRes.upload.warnings ) {
			var wmsg = '<ul>';
			for ( var wtype in apiRes.upload.warnings ) {
				var winfo = apiRes.upload.warnings[wtype]
				wmsg += '<li>';
				switch ( wtype ) {
					case 'duplicate':
					case 'exists':
						if ( winfo[1] && winfo[1].title && winfo[1].title.mTextform ) {
							wmsg += gM( 'mwe-file-exists-duplicate' ) + ' ' +
								'<b>' + winfo[1].title.mTextform + '</b>';
						} else {
							//misc error (weird that winfo[1] not present
							wmsg += gM( 'mwe-upload-misc-error' ) + ' ' + wtype;
						}
						break;
					case 'file-thumbnail-no':
						wmsg += gM( 'mwe-file-thumbnail-no', winfo );
						break;
					default:
						wmsg += gM( 'mwe-upload-misc-error' ) + ' ' + wtype;
						break;
				}
				wmsg += '</li>';
			}
			wmsg += '</ul>';
			if ( apiRes.upload.sessionkey )
				_this.warnings_sessionkey = apiRes.upload.sessionkey;

			// Create the "ignore warning" button
			var buttons = {};
			buttons[ gM( 'mwe-ignorewarning' ) ] = function() {
				//check if we have a stashed key:
				if ( _this.warnings_sessionkey ) {
					//set to "loading"
					$j( '#upProgressDialog' ).html( mw.loading_spinner() );
					//setup request:
					var request = {
						'action': 'upload',
						'sessionkey': _this.warnings_sessionkey,
						'ignorewarnings': 1,
						'filename': $j( '#wpDestFile' ).val(),
						'token' :  _this.editToken,
						'comment' :  $j( '#wpUploadDescription' ).val()
					};
					//run the upload from stash request
					mw.getJSON(_this.api_url, request, function( data ) {
							_this.processApiResult( data );
					} );
				} else {
					mw.log( 'No session key re-sending upload' )
					//do a stashed upload
					$j( '#wpIgnoreWarning' ).attr( 'checked', true );
					$j( _this.editForm ).submit();
				}
			};
			// Create the "return to form" button
			buttons[ gM( 'mwe-return-to-form' ) ] = function() {
				$j( this ).dialog( 'close' );
				_this.form_post_override = false;
			}
			// Show warning
			_this.updateProgressWin(
				gM( 'mwe-uploadwarning' ),
				'<h3>' + gM( 'mwe-uploadwarning' ) + '</h3>' + wmsg + '<p>',
				buttons );
			return false;
		}
		// No error!
		return true;
	},

	/**
	 * Process the result of an action=upload API request. Display the result
	 * to the user.
	 * 
	 * @param {Object} apiRes Api result object
	 * @return {Boolean}
	 * 	false if api error
	 *  true if success & interface has been updated
	 */
	processApiResult: function( apiRes ) {
		var _this = this;
		mw.log( 'processApiResult::' );
		if ( !_this.isApiSuccess( apiRes ) ) {
			// Error detected, show it to the user
			_this.showApiError( apiRes );
			return false;
		}
		if ( apiRes.upload && apiRes.upload.upload_session_key ) {
			// Async upload, do AJAX status polling
			_this.upload_session_key = apiRes.upload.upload_session_key;
			_this.doAjaxUploadStatus();
			mw.log( "set upload_session_key: " + _this.upload_session_key );
			return;
		}

		if ( apiRes.upload.imageinfo && apiRes.upload.imageinfo.descriptionurl ) {
			var url = apiRes.upload.imageinfo.descriptionurl;

			// Upload complete.
			// Call the completion callback if available.
			if ( _this.done_upload_cb && typeof _this.done_upload_cb == 'function' ) {
				mw.log( "call done_upload_cb" );
				// This overrides our normal completion handling so we close the
				// dialog immediately.
				$j( '#upProgressDialog' ).dialog( 'destroy' ).remove();
				_this.done_upload_cb( apiRes.upload );
				return false;
			}

			var buttons = {};
			// "Return" button
			buttons[ gM( 'mwe-return-to-form' ) ] = function() {
				$j( this ).dialog( 'destroy' ).remove();
				_this.form_post_override = false;
			}
			// "Go to resource" button
			buttons[ gM('mwe-go-to-resource') ] = function() {
				window.location = url;
			};
			_this.action_done = true;
			_this.updateProgressWin(
					gM( 'mwe-successfulupload' ),
					gM( 'mwe-upload_done', url),
					buttons );
			mw.log( 'apiRes.upload.imageinfo::' + url );
			return true;
		}
	},

	/**
	 * Update the progress window to display a given message, with a given
	 * list of buttons below it.
	 *
	 * @param title_txt Plain text
	 * @param msg HTML
	 * @param buttons See http://docs.jquery.com/UI/Dialog#option-buttons
	 */
	updateProgressWin: function( title_txt, msg, buttons ) {
		var _this = this;

		if ( !title_txt )
			title_txt = _this.getProgressTitle();

		if ( !msg )
			msg = mw.loading_spinner( 'left:40%;top:40px;' );

		if ( !buttons ) {
			// If no buttons are specified, add a close button
			buttons = {};
			buttons[ gM( 'mwe-ok' ) ] =  function() {
				$j( this ).dialog( 'close' );
			};
		}

		$j( '#upProgressDialog' ).dialog( 'option', 'title',  title_txt );
		$j( '#upProgressDialog' ).html( msg );
		$j( '#upProgressDialog' ).dialog( 'option', 'buttons', buttons );
	},

	/**
	 * Get the default title of the progress window
	 */
	getProgressTitle: function() {
		return gM( 'mwe-upload-in-progress' );
	},

	/**
	 * Get the DOMNode of the form element we are rewriting.
	 * Returns false if it can't be found.
	 */
	getForm: function() {
		
		/*debugger;
		var cat = this.form_selector;
		var forms = document.getElementsByTagName('form');
		mw.log('got ' + forms.length + ' foms ');
		for( var i in forms ){
			var fish = forms[ i ];
			mw.log( 'fish: ' + fish.id );
		}
		var cat = $j( this.form_selector ).get(0);
		mw.log( 'getForm::' + cat.id );
		*/
		if ( this.form_selector && $j( this.form_selector ).length != 0 ) {
			return $j( this.form_selector ).get( 0 );
		} else {
			mw.log( "mvBaseUploadInterface.getForm(): no form_selector" );
			return false;
		}
	},

	/**
	 * Update the progress bar to a given completion fraction (between 0 and 1)
         * XXX This progress bar is used for encoding AND for upload... may need to fix that
	 */
	updateProgress: function( fraction ) {
		var _this = this;
		
		$j( '#up-progressbar' ).progressbar( 'value', parseInt( fraction * 100 ) );
		$j( '#up-pstatus' ).html( parseInt( fraction * 100 ) + '% - ' );

		if (_this.uploadBeginTime) {	
			var elapsedMilliseconds = ( new Date() ).getTime() - _this.uploadBeginTime;
			if (fraction > 0.0 && elapsedMilliseconds > 0) { // or some other minimums for good data
				var fractionPerMillisecond = fraction / elapsedMilliseconds;
				var remainingSeconds = parseInt( ( ( 1.0 - fraction ) / fractionPerMillisecond ) / 1000 ); 
				$j( '#up-etr' ).html( gM( 'mwe-uploaded-time-remaining', mw.seconds2npt(remainingSeconds) ) );
			}
		}
	
	},

	/**
	 * Show a dialog box reporting upload progress and status
	 */
	displayProgressOverlay: function() {
		var _this = this;
		// Remove the old instance if present
		if( $j( '#upProgressDialog' ).length != 0 ) {
			$j( '#upProgressDialog' ).dialog( 'destroy' ).remove();
		}
		// Add a new one
		$j( 'body' ).append( '<div id="upProgressDialog" ></div>' );

		$j( '#upProgressDialog' ).dialog( {
			title: _this.getProgressTitle(),
			bgiframe: true,
			modal: true,
			draggable: true,
			width: 400,
			heigh: 200,
			beforeclose: function( event, ui ) {
				// If the upload is not complete, ask the user if they want to cancel
				if ( event.button == 0 && _this.action_done === false ) {
					_this.onCancel( this );
					return false;
				} else {
					// Complete already, allow close
					return true;
				}
			},
			buttons: _this.getCancelButton()
		} );
		mw.log( 'upProgressDialog::dialog done' );

		$j( '#upProgressDialog' ).html(
			'<div id="up-pbar-container" style="width:90%;height:15px;" >' +
			'<div id="up-progressbar" style="height:15px;"></div>' +
				'<div id="up-status-container">' +
					'<span id="up-pstatus">0% - </span> ' +
					'<span id="up-status-state">' + gM( 'mwe-uploaded-status' ) + '</span> ' +
				'</div>' +
				'<div id="up-etr">' + gM( 'mwe-uploaded-time-remaining', '' ) + '</div>' +
			'</div>'
		);
		// Open the empty progress window
		$j( '#upProgressDialog' ).dialog( 'open' );

		// Create progress bar
		$j( '#up-progressbar' ).progressbar({
			value: 0
		});
	},

	/**
	* Get a standard cancel button in the jQuery.ui dialog format
	*/
	getCancelButton: function() {
		var _this = this;
		mw.log( 'f: getCancelButton()' );
		var cancelBtn = [];
		cancelBtn[ gM( 'mwe-cancel' ) ] = function() {
			$j( dlElm ).dialog( 'close' );
		};
		return cancelBtn;
	},

	/**
	 * UI cancel button handler.
	 * Show a dialog box asking the user whether they want to cancel an upload.
	 * @param Element dialogElement Dialog element to be canceled 
	 */
	onCancel: function( dialogElement ) {
		//confirm:
		if ( confirm( gM( 'mwe-cancel-confim' ) ) ) {
			// NOTE: (cancel the encode / upload)
			$j( dialogElement ).dialog( 'close' );
		}
	}

};

// jQuery plugins

( function( $ ) {
	/**
	 * Check the upload destination filename for conflicts and show a conflict
	 * error message if there is one
	 */
	$.fn.doDestCheck = function( opt ) {
		var _this = this;
		mw.log( 'doDestCheck::' + _this.selector );

		// Set up option defaults
		if ( !opt.warn_target )
			opt.warn_target = '#wpDestFile-warning';

		// Add the wpDestFile-warning row
		if ( $j( '#wpDestFile-warning' ).length == 0 ) {
			$j( '#mw-htmlform-options tr:last' )
				.after( 
				$j('<tr />' )
				.append( '<td />' )
				.append( '<td />' )
					.attr('id', 'wpDestFile-warning')
				);
		}
		mw.log( 'past dest');
		// Remove any existing warning
		$j( opt.warn_target ).empty();
		mw.log( 'past remove warn:: ' +  _this.selector);
		// Show the AJAX spinner
		$j( _this.selector ).after( 
			$j('<img />')
			.attr({
				'id' : "mw-spinner-wpDestFile",
				'src' : stylepath + '/common/images/spinner.gif' 
			})
		);		
		mw.log("added spiner");	
		var request =  {
			'titles': 'File:' + $j( _this.selector ).val(),
			'prop':  'imageinfo',
			'iiprop': 'url|mime|size',
			'iiurlwidth': 150
		};
				
		// Do the destination check ( on the local wiki )
		mw.getJSON( request, function( data ) {
				// Remove spinner
				$j( '#mw-spinner-wpDestFile' ).remove();

				if ( !data || !data.query || !data.query.pages ) {
					// Ignore a null result
					return;
				}

				if ( data.query.pages[-1] ) {
					// No conflict found
					return;
				}
				for ( var page_id in data.query.pages ) {
					if ( !data.query.pages[ page_id ].imageinfo ) {
						continue;
					}

					// Conflict found, show warning
					if ( data.query.normalized ) {
						var ntitle = data.query.normalized[0].to;
					} else {
						var ntitle = data.query.pages[ page_id ].title
					}
					var img = data.query.pages[ page_id ].imageinfo[0];
					$j( '#wpDestFile-warning' ).html(
						gM( 'mwe-fileexists', ntitle ) +
						'<div class="thumb tright">' +
						'<div ' +
							'style="width: ' + ( parseInt( img.thumbwidth ) + 2 ) + 'px;" ' +
							'class="thumbinner">' +
						'<a ' +
							'title="' + ntitle + '" ' +
							'class="image" ' +
							'href="' + img.descriptionurl + '">' +
						'<img ' +
							'width="' + img.thumbwidth + '" ' +
							'height="' + img.thumbheight + '" ' +
							'border="0" ' +
							'class="thumbimage" ' +
							'src="' + img.thumburl + '" ' +
							'alt="' + ntitle + '"/>' +
						'</a>' +
						'<div class="thumbcaption">' +
						'<div class="magnify">' +
						'<a title="' + gM('thumbnail-more') + '" class="internal" ' +
							'href="' + img.descriptionurl +'">' +
						'<img width="15" height="11" alt="" ' +
							'src="' + stylepath + "/common/images/magnify-clip.png\" />" +
						'</a>' +
						'</div>' +
						gM( 'mwe-fileexists-thumb' ) +
						'</div>' +
						'</div>' +
						'</div>'
					);
				}
			}
		);
	}
})( jQuery );
