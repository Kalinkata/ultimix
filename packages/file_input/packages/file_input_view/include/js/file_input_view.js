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
ultimix.file_input.SetSingleUploadedFileInfo = function( ServerDataObject , ControlSettings )
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
ultimix_file_input_view_AfterImageUploadProcessor = function( File , ServerData , ReceivedResponse )
{
	try
	{
		var Progress = new FileProgress( File , this.customSettings.progressTarget );
		Progress.setComplete();
		Progress.setStatus( ultimix.get_string( 'complete' ) );
		Progress.toggleCancel( false );
		
		var ServerDataObject = {};
		eval( "ServerDataObject=" + ServerData );
		
		ultimix.file_input.SetSingleUploadedFileInfo( ServerDataObject , this.customSettings );
	}
	catch( ex )
	{
		this.debug( ex );
	}
}