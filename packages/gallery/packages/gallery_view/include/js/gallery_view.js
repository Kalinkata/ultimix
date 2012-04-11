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
ultimix.gallery.AddItemToGallery = function( ServerData )
{
	var		ServerDataObject;
	eval( "ServerDataObject=" + ServerData );
	
	ItemTemplate = jQuery( '.gallery>.gallery_template' ).html();
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
ultimix_gallery_AfterImageUploadProcessor = function( File , ServerData , ReceivedResponse )
{
	try
	{
		var Progress = new FileProgress( File , this.customSettings.progressTarget );
		Progress.setComplete();
		Progress.setStatus( ultimix.get_string( 'complete' ) );
		Progress.toggleCancel( false );

		ultimix.gallery.AddItemToGallery( ServerData );
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
ultimix.gallery.DetachFileSuccess = function( GalleryId , FileId )
{
	var	LoadingId = ultimix.std_dialogs.MessageBox( 
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
ultimix.gallery.DetachFile = function( GalleryId , FileId )
{
	ultimix.std_dialogs.MessageBox( 
		ultimix.get_string( 'shure_to_delete_file' ) , ultimix.get_string( 'Question' ) , 
		ultimix.std_dialogs.MB_YESNO | ultimix.std_dialogs.MB_ICONQUESTION | ultimix.std_dialogs.MB_MODAL , 
		function()
		{
			ultimix.gallery.DetachFileSuccess( GalleryId , FileId );
		} 
	);
}
