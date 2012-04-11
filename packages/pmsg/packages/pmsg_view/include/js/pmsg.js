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
if( !ultimix.pmsg )
{
	ultimix.pmsg = {};
}

/**
*	Function sets message read.
*
*	@param Id - id of the message.
*
*	@note This function send ajax request to the pmsg.html page
*
*	@author Dodonov A.A.
*/
ultimix.pmsg.SetRead = function( Id )
{
	Success = function( Response )
	{
		jQuery( '#record_view_opener_' + Id + '_in' ).children().removeClass( 'not_read' );
		jQuery( '#record_view_opener_' + Id + '_in' ).children().addClass( 'read' );
	}
	
	if( jQuery( '#record_view_opener_' + Id + '_in' ).children().hasClass( 'not_read' ) )
	{
		Data = { 'package_name' : 'pmsg::pmsg_controller' , 'action' : 'set_read' , 'pmsg_read' : 1 , 'id' : Id };
		ultimix.DirectController( Data , Success , { 'async' : true } );
	}
}
