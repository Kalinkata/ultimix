/**
*	Global namespace.
*
*	@author Dodonov A.A.
*/
if( !ultimix )
{
	ultimix = {};
}

/**
*	Local namespace.
*
*	@author Dodonov A.A.
*/
if( !ultimix.file_input )
{
	ultimix.file_input = {};
}

/**
*	Function updates control after upload.
*
*	@param ServerDataObject - Uploaded file description object.
*
*	@param ControlSettings - Upload file control settings.
*
*	@author Dodonov A.A.
*/
ultimix.file_input.set_single_uploaded_file_info = function( ServerDataObject , ControlSettings )
{
	jQuery( '#' + ControlSettings.statusAcceptor ).html(
		ServerDataObject.original_file_name
	);

	jQuery( '#' + ControlSettings.dataAcceptor ).html( 
		"<input type=\"hidden\" name=\"" + ControlSettings.name + "\" value=\"" + ServerDataObject.id + "\">" +
		"<input type=\"hidden\" name=\"visible_" + ControlSettings.name + "\" value=\"" + 
		ServerDataObject.original_file_name+ "\">"
	);
}

/**
*	Upload success event handler.
*
*	@param File - File description object.
*
*	@param ServerData - Data received from the server.
*
*	@param ReceivedResponse - Was the response received.
*
*	@author Dodonov A.A.
*/
ultimix_file_input_view_after_image_upload_processor = function( File , ServerData , ReceivedResponse )
{
	try
	{
		var Progress = new FileProgress( File , this.customSettings.progressTarget );
		Progress.setComplete();
		Progress.setStatus( ultimix.get_string( 'complete' ) );
		Progress.toggleCancel( false );

		eval( "var			ServerDataObject=" + ServerData );

		ultimix.file_input.set_single_uploaded_file_info( ServerDataObject , this.customSettings );
	}
	catch( ex )
	{
		this.debug( ex );
	}
}

/**
*	Function sets list view options.
*
*	@param ViewOptions - Extra view generation options.
*
*	@return View options.
*
*	@author Dodonov A.A.
*/
ultimix.file_input.set_default_options = function( ViewOptions )
{
	if( !ViewOptions )
	{
		ViewOptions = {};
	}

	ViewOptions.meta = ViewOptions.meta ? ViewOptions.meta : 'meta_file_input_list';
	ViewOptions.package_name = ViewOptions.package_name ? ViewOptions.package_name : 'file_input::file_input_view';
	ViewOptions.paging_require_form = ViewOptions.paging_require_form ? ViewOptions.paging_require_form : '0';
	ViewOptions.add_hidden_fields = ViewOptions.add_hidden_fields ? ViewOptions.add_hidden_fields : '0';

	return( ViewOptions );
}

/**
*	Function returns list view.
*
*	@param Functions - Functions to process success and error events.
*
*	@param ViewOptions - Extra view generation options.
*
*	@author Dodonov A.A.
*/
ultimix.file_input.get_list_form = function( Fuctions , ViewOptions )
{
	if( !Fuctions )
	{
		Fuctions = {};
	}

	ViewOptions = ultimix.file_input.set_default_options( ViewOptions );

	ultimix.ajax_gate.direct_view( ViewOptions , Fuctions );
}

/**
*	Function returns list view.
*
*	@param Functions - Functions to process success and error events.
*
*	@param Header - List header template file name.
*
*	@param Item - List item template file name.
*
*	@param Footer - List footer template file name.
*
*	@param ViewOptions - Extra view generation options.
*
*	@author Dodonov A.A.
*/
ultimix.file_input.get_custom_list_form = function( Fuctions , Header , Item , Footer , ViewOptions )
{
	if( !Fuctions )
	{
		Fuctions = {};
	}

	ViewOptions = ultimix.file_input.set_default_options( ViewOptions );

	ViewOptions.header = Header ? Header : 'file_input_header.tpl';
	ViewOptions.item = Item ? Item : 'file_input_item.tpl';
	ViewOptions.footer = Footer ? Footer : 'file_input_footer.tpl';

	ultimix.ajax_gate.direct_view( ViewOptions , Fuctions );
}

/**
*	Function deletes file.
*
*	@param Id - File id.
*
*	@param DataSelector - Data selector.
*
*	@author Dodonov A.A.
*/
ultimix.file_input.delete = function( Id , DataSelector )
{
	ultimix.auto.delete( 
		Id , DataSelector , 
		{ 
			'package_name' : 'file_input::file_input_controller' , 
			'file_input_context_action' : 'delete_record' , 
			'file_input_action' : 'delete_record' , 'file_input_record_id' : Id , 
			'meta' : 'meta_delete_file_input'
		}
	);
}
