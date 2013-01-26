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
if( !ultimix.gallery )
{
	ultimix.gallery = {};
}

/**
*	Function adds item to the gallery.
*
*	@param ServerData - Data received from the server.
*
*	@author Dodonov A.A.
*/
ultimix.gallery.add_item_to_gallery = function( ServerData )
{
	eval( "var			ServerDataObject=" + ServerData );
	
	var			ItemTemplate = jQuery( '.gallery>.gallery_template' ).html();
	ItemTemplate = ultimix.string_utilities.print_record( ItemTemplate , ServerDataObject );
	
	jQuery( '.gallery>.gallery_items' ).append( ItemTemplate );
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
ultimix_gallery_after_image_upload_processor = function( File , ServerData , ReceivedResponse )
{
	try
	{
		var			Progress = new FileProgress( File , this.customSettings.progressTarget );

		Progress.setComplete();
		Progress.setStatus( ultimix.get_string( 'complete' ) );
		Progress.toggleCancel( false );

		ultimix.gallery.add_item_to_gallery( ServerData );
	}
	catch( ex )
	{
		this.debug( ex );
	}
}

/**
*	Function deletes file from gallery.
*
*	@param GalleryId  - Galllery's id.
*
*	@param FileId  - File's id.
*
*	@author Dodonov A.A.
*/
ultimix.gallery.detach_file_success = function( GalleryId , FileId )
{
	var			LoadingId = ultimix.std_dialogs.MessageBox( 
		ultimix.get_string( 'wait_please' ) , ultimix.get_string( 'Info' ) , 
		ultimix.std_dialogs.MB_ICONLOADING | ultimix.std_dialogs.MB_MODAL
	);
	
	ultimix.DirectController( 
		{
			'package_name' : 'gallery::gallery_controller' , 'meta' : 'meta_gallery_detach_file' , 
			'gallery_id' : GalleryId , 'file_id' : FileId 
		} , 
		function()
		{
			ultimix.std_dialogs.close_message_box( LoadingId );
			jQuery( '#gallery_file_' + FileId ).remove();
		}
	);
}

/**
*	Function deletes file from gallery.
*
*	@param GalleryId  - Galllery's id.
*
*	@param FileId  - File's id.
*
*	@author Dodonov A.A.
*/
ultimix.gallery.detach_file = function( GalleryId , FileId )
{
	ultimix.std_dialogs.MessageBox( 
		ultimix.get_string( 'shure_to_delete_file' ) , ultimix.get_string( 'Question' ) , 
		ultimix.std_dialogs.MB_YESNO | ultimix.std_dialogs.MB_ICONQUESTION | ultimix.std_dialogs.MB_MODAL , 
		function()
		{
			ultimix.gallery.detach_file_success( GalleryId , FileId );
		} 
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
ultimix.gallery.get_list_form = function( Fuctions , ViewOptions )
{
	ultimix.auto.get_list_form( Fuctions , ViewOptions , 'gallery' , 'gallery::gallery_view' );
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
ultimix.gallery.get_custom_list_form = function( Fuctions , Header , Item , Footer , ViewOptions )
{
	ultimix.auto.get_custom_list_form(
		Fuctions , Header , Item , Footer , false , ViewOptions , 'gallery' , 'gallery::gallery_view'
	);
}

/**
*	Function deletes gallery.
*
*	@param Id - Gallery id.
*
*	@param DataSelector - Data selector.
*
*	@author Dodonov A.A.
*/
ultimix.gallery.delete = function( Id , DataSelector )
{
	ultimix.auto.delete( 
		Id , DataSelector , 
		{ 
			'package_name' : 'gallery::gallery_controller' , 
			'gallery_context_action' : 'delete_record' , 
			'gallery_action' : 'delete_record' , 'gallery_record_id' : Id , 
			'meta' : 'meta_delete_gallery'
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
ultimix.gallery.record_view_form = function( Id , DataSelector )
{
	ultimix.auto.record_view_form( 
		Id , DataSelector , 
		{
			'package_name' : 'gallery::gallery_view' , 'gallery_context_action' : 'record_view_form' , 
			'gallery_action' : 'record_view_form' , 'gallery_record_id' : Id , 
			'meta' : 'meta_record_view_gallery_form'
		}
	);
}
