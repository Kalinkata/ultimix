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
if( !ultimix.category )
{
	ultimix.category = {};
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
ultimix.category.get_list_form = function( Fuctions , ViewOptions )
{
	ultimix.auto.get_list_form( Fuctions , ViewOptions , 'category' , 'category::category_view' );
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
ultimix.category.get_custom_list_form = function( Fuctions , Header , Item , Footer , ViewOptions )
{
	ultimix.auto.get_custom_list_form( 
		Fuctions , Header , Item , Footer , false , ViewOptions , 'category' , 'category::category_view'
	);
}

/**
*	Function creates category.
*
*	@param DataSelector - Data selector.
*
*	@param Data - Request data.
*
*	@param HideDialog - Hide dialog.
*
*	@param Functions - Handlers.
*
*	@author Dodonov A.A.
*/
ultimix.category.create = function( DataSelector , Data , HideDialog , Functions )
{
	Data = jQuery.extend(
		{
			'package_name' : 'category::category_manager' , 'meta' : 'meta_create_category' , 
			'category_action' : 'create_record' , 
			'category_name' : 'category_name'
		} , 
		Data
	);

	ultimix.auto.create( DataSelector , Data , Functions , HideDialog );
}

/**
*	Function updates category.
*
*	@param DataSelector - Data selector.
*
*	@param Id - Record id.
*
*	@param Data - Request data.
*
*	@param HideDialog - Hide dialog.
*
*	@author Dodonov A.A.
*/
ultimix.category.update = function( DataSelector , Id , Data , HideDialog )
{
	Data = jQuery.extend(
		{ 
			'package_name' : 'category::category_manager' , 
			'category_action' : 'update_record' , 
			'category_record_id' : Id , 'meta' : 'meta_update_category'
		} , 
		Data
	);

	ultimix.auto.update( DataSelector , Data , false , HideDialog );
}

/**
*	Function deletes category.
*
*	@param Id - Record id.
*
*	@param DataSelector - Data selector.
*
*	@param HideDialog - Hide dialog.
*
*	@author Dodonov A.A.
*/
ultimix.category.delete = function( Id , DataSelector , HideDialog )
{
	ultimix.auto.delete( 
		DataSelector , 
		{ 
			'package_name' : 'category::category_manager' , 
			'category_action' : 'delete_record' , 
			'category_record_id' : Id , 'meta' : 'meta_delete_category'
		} , 
		false , HideDialog
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
ultimix.category.record_view_form = function( Id , DataSelector )
{
	ultimix.auto.record_view_form( 
		DataSelector , 
		{
			'package_name' : 'category::category_view' , 'category_context_action' : 'record_view_form' , 
			'category_action' : 'record_view_form' , 'category_record_id' : Id , 
			'meta' : 'meta_record_view_category_form'
		}
	);
}
