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
	ItemTemplate = ultimix.string_utilities.PrintRecord( ItemTemplate , ServerDataObject );
	
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
*	Function sets list view options.
*
*	@param ViewOptions - Extra view generation options.
*
*	@return View options.
*
*	@author Dodonov A.A.
*/
ultimix.gallery.set_default_options = function( ViewOptions )
{
	if( !ViewOptions )
	{
		ViewOptions = {};
	}

	ViewOptions.meta = ViewOptions.meta ? ViewOptions.meta : 'meta_gallery_list';
	ViewOptions.package_name = ViewOptions.package_name ? ViewOptions.package_name : 'gallery::gallery_view';
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
ultimix.gallery.get_list_form = function( Fuctions , ViewOptions )
{
	if( !Fuctions )
	{
		Fuctions = {};
	}

	ViewOptions = ultimix.gallery.set_default_options( ViewOptions );

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
ultimix.gallery.get_custom_list_form = function( Fuctions , Header , Item , Footer , ViewOptions )
{
	if( !Fuctions )
	{
		Fuctions = {};
	}

	ViewOptions = ultimix.gallery.set_default_options( ViewOptions );

	ViewOptions.header = Header ? Header : 'gallery_header.tpl';
	ViewOptions.item = Item ? Item : 'gallery_item.tpl';
	ViewOptions.footer = Footer ? Footer : 'gallery_footer.tpl';

	ultimix.ajax_gate.direct_view( ViewOptions , Fuctions );
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
