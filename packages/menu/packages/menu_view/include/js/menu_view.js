
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
if( !ultimix.menu )
{
	ultimix.menu = {};
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
ultimix.menu.get_list_form = function( Fuctions , ViewOptions )
{
	ultimix.auto.get_list_form( Fuctions , ViewOptions , 'menu' , 'menu::menu_view' );
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
ultimix.menu.get_custom_list_form = function( Fuctions , Header , Item , Footer , ViewOptions )
{
	ultimix.auto.get_custom_list_form(
		Fuctions , Header , Item , Footer , false , ViewOptions , 'menu' , 'menu::menu_view'
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
ultimix.menu.delete = function( Id , DataSelector )
{
	ultimix.auto.delete( 
		DataSelector , 
		{ 
			'package_name' : 'menu::menu_controller' , 
			'menu_context_action' : 'delete_record' , 
			'menu_action' : 'delete_record' , 'menu_record_id' : Id , 
			'meta' : 'meta_delete_menu'
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
ultimix.menu.record_view_form = function( Id , DataSelector )
{
	ultimix.auto.record_view_form( 
		DataSelector , 
		{
			'package_name' : 'menu::menu_view' , 'menu_context_action' : 'record_view_form' , 
			'menu_action' : 'record_view_form' , 'menu_record_id' : Id , 
			'meta' : 'meta_record_view_menu_form'
		}
	);
}
