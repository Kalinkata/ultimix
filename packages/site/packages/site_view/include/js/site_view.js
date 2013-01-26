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
if( !ultimix.site )
{
	ultimix.site = {};
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
ultimix.site.get_list_form = function( Fuctions , ViewOptions )
{
	ultimix.auto.get_list_form( Fuctions , ViewOptions , 'site' , 'site::site_view' );
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
*	@param NoDataFound - No data found template.
*
*	@param ViewOptions - Extra view generation options.
*
*	@author Dodonov A.A.
*/
ultimix.site.get_custom_list_form = function( Fuctions , Header , Item , Footer , ViewOptions )
{
	ultimix.auto.get_custom_list_form( 
		Fuctions , Header , Item , Footer , false , ViewOptions , 'site' , 'site::site_view'
	);
}

/**
*	Function deletes record.
*
*	@param Id - Record id.
*
*	@param DataSelector - Data selector.
*
*	@param Functions - Callbacks.
*
*	@author Dodonov A.A.
*/
ultimix.site.delete = function( Id , DataSelector , Functions )
{
	ultimix.auto.delete( 
		Id , DataSelector , 
		{ 
			'package_name' : 'site::site_controller' , 'site_context_action' : 'delete_record' , 
			'site_action' : 'delete_record' , 'site_record_id' : Id , 
			'meta' : 'meta_delete_site'
		} , Functions
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
ultimix.site.record_view_form = function( Id , DataSelector )
{
	ultimix.auto.record_view_form( 
		Id , DataSelector , 
		{
			'package_name' : 'site::site_view' , 'site_context_action' : 'record_view_form' , 
			'site_action' : 'record_view_form' , 'site_record_id' : Id , 
			'meta' : 'meta_record_view_site_form'
		}
	);
}
