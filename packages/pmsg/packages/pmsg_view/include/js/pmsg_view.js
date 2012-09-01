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
*	Function sets list view options.
*
*	@param ViewOptions - Extra view generation options.
*
*	@return View options.
*
*	@author Dodonov A.A.
*/
ultimix.pmsg.set_default_options = function( ViewOptions )
{
	if( !ViewOptions )
	{
		ViewOptions = {};
	}

	ViewOptions.meta = ViewOptions.meta ? ViewOptions.meta : 'meta_pmsg_list';
	ViewOptions.package_name = ViewOptions.package_name ? ViewOptions.package_name : 'pmsg::pmsg_view';
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
ultimix.pmsg.get_list_form = function( Fuctions , ViewOptions )
{
	if( !Fuctions )
	{
		Fuctions = {};
	}

	ViewOptions = ultimix.pmsg.set_default_options( ViewOptions );

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
ultimix.pmsg.get_custom_list_form = function( Fuctions , Header , Item , Footer , ViewOptions )
{
	if( !Fuctions )
	{
		Fuctions = {};
	}

	ViewOptions = ultimix.pmsg.set_default_options( ViewOptions );

	ViewOptions.header = Header ? Header : 'pmsg_header.tpl';
	ViewOptions.item = Item ? Item : 'pmsg_item.tpl';
	ViewOptions.footer = Footer ? Footer : 'pmsg_footer.tpl';

	ultimix.ajax_gate.direct_view( ViewOptions , Fuctions );
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
