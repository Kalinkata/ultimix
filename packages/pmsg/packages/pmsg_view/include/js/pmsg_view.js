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
ultimix.pmsg.set_read = function( Id )
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

/**
*	Function returns list view.
*
*	@param Functions - Functions to process success and error events.
*
*	@param ViewOptions - Extra view generation options.
*
*	@author Dodonov A.A.
*/
ultimix.pmsg.get_list_form = function( Fuctions , ViewOptions )
{
	ultimix.auto.get_list_form( Fuctions , ViewOptions , 'pmsg' , 'pmsg::pmsg_view' );
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
ultimix.pmsg.get_custom_list_form = function( Fuctions , Header , Item , Footer , ViewOptions )
{
	ultimix.auto.get_custom_list_form(
		Fuctions , Header , Item , Footer , false , ViewOptions , 'pmsg' , 'pmsg::pmsg_view'
	);
}

/**
*	Function deletes record.
*
*	@param Id - Record id.
*
*	@param DataSelector - Data selector.
*
*	@author Dodonov A.A.
*/
ultimix.pmsg.delete = function( Id , DataSelector )
{
	ultimix.auto.delete( 
		Id , DataSelector , 
		{ 
			'package_name' : 'pmsg::pmsg_controller' , 
			'pmsg_context_action' : 'delete_record' , 
			'pmsg_action' : 'delete_record' , 'pmsg_record_id' : Id , 
			'meta' : 'meta_delete_pmsg'
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
ultimix.pmsg.record_view_form = function( Id , DataSelector )
{
	ultimix.auto.record_view_form( 
		Id , DataSelector , 
		{
			'package_name' : 'pmsg::pmsg_view' , 'pmsg_context_action' : 'record_view_form' , 
			'pmsg_action' : 'record_view_form' , 'pmsg_record_id' : Id , 
			'meta' : 'meta_record_view_pmsg_form'
		}
	);
}
