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
if( !ultimix.user )
{
	ultimix.user = {};
}

/**
*	Function adds avatar.
*
*	@param ServerData - Data received from the server.
*
*	@author Dodonov A.A.
*/
ultimix.user.AddAvatar = function( ServerData )
{
	var		ServerDataObject;
	eval( "ServerDataObject=" + ServerData );
	
	ItemTemplate = jQuery( '.avatar>.avatar_template' ).html();
	ItemTemplate = ultimix.string_utilities.PrintRecord( ItemTemplate , ServerDataObject );
	
	jQuery( '.avatar>.avatar_item' ).html( ItemTemplate );
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
ultimix_user_AfterAvatarUploadProcessor = function( File , ServerData , ReceivedResponse )
{
	try
	{
		var Progress = new FileProgress( File , this.customSettings.progressTarget );
		Progress.setComplete();
		Progress.setStatus( ultimix.get_string( 'complete' ) );
		Progress.toggleCancel( false );

		ultimix.user.AddAvatar( ServerData );
	}
	catch( ex )
	{
		this.debug( ex );
	}
}
