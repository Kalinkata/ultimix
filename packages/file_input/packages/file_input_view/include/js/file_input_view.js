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
*	@param ServerData - Uploaded file description object.
*
*	@param ControlSettings - Upload file control settings.
*
*	@author Dodonov A.A.
*/
ultimix.file_input.set_single_uploaded_file_info = function( ServerData , ControlSettings )
{
	eval( "var			ServerDataObject=" + ServerData );

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
		var			Progress = new FileProgress( File , this.customSettings.progressTarget );

		Progress.setComplete();
		Progress.setStatus( ultimix.get_string( 'complete' ) );
		Progress.toggleCancel( false );

		eval( "var			ServerDataObject=" + ServerData );

		ultimix_file_input_view_after_image_upload_processor.store_file_info( 
			this , ServerDataObject.original_file_name , ServerDataObject.href , ServerDataObject.id
		);
	}
	catch( ex )
	{
		this.debug( ex );
	}
}

/**
*	Function stores file info.
*
*	@param Obj - SWFUpload object.
*
*	@param Name - File name.
*
*	@param Path - File path.
*
*	@param Id - File id.
*
*	@author Dodonov A.A.
*/
ultimix_file_input_view_after_image_upload_processor.store_file_info = function( Obj , Name , Path , Id )
{
	if( !Name || !Path || !Id )
	{
		return;
	}

	jQuery( '#' + Obj.customSettings.statusAcceptor ).html(
		'<img width="320" src="' + Path + '">'
	);

	jQuery( '#' + Obj.customSettings.dataAcceptor ).html( 
		"<input type=\"hidden\" name=\"" + Obj.customSettings.name + "\" value=\"" + Id + "\">" + 
		"<input type=\"hidden\" name=\"" + Obj.customSettings.name + "_name\" value=\"" + Name + "\">" + 
		"<input type=\"hidden\" name=\"" + Obj.customSettings.name + "_path\" value=\"" + Path + "\">"
	);
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
	ultimix.auto.get_list_form( Fuctions , ViewOptions , 'file_input' , 'file_input::file_input_view' );
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
	ultimix.auto.get_custom_list_form(
		Fuctions , Header , Item , Footer , false , ViewOptions , 'file_input' , 'file_input::file_input_view'
	);
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

/**
*	Function shows record.
*
*	@param Id - Record id.
*
*	@param DataSelector - Data selector.
*
*	@return Content of the form.
*
*	@author Dodonov A.A.
*/
ultimix.file_input.record_view_form = function( Id , DataSelector )
{
	ultimix.auto.record_view_form( 
		Id , DataSelector , 
		{
			'package_name' : 'file_input::file_input_view' , 'file_input_context_action' : 'record_view_form' , 
			'file_input_action' : 'record_view_form' , 'file_input_record_id' : Id , 
			'meta' : 'meta_record_view_file_input_form'
		}
	);
}

