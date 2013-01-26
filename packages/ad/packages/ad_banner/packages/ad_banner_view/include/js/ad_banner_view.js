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
if( !ultimix.ad_banner )
{
	ultimix.ad_banner = {};
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
ultimix.ad_banner.get_list_form = function( Fuctions , ViewOptions )
{
	ultimix.auto.get_list_form( Fuctions , ViewOptions , 'ad_banner' , 'ad::ad_banner::ad_banner_manager' );
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
ultimix.ad_banner.get_custom_list_form = function( Fuctions , Header , Item , Footer , NoDataFound , ViewOptions )
{
	ultimix.auto.get_custom_list_form( 
		Fuctions , Header , Item , Footer , NoDataFound , 
		ViewOptions , 'ad_banner' , 'ad::ad_banner::ad_banner_manager'
	);
}

/**
*	Function deletes ad_banner.
*
*	@param Id - Record id.
*
*	@param DataSelector - Data selector.
*
*	@author Dodonov A.A.
*/
ultimix.ad_banner.delete = function( Id , DataSelector )
{
	ultimix.auto.delete( 
		Id , DataSelector , 
		{ 
			'package_name' : 'ad::ad_banner::ad_banner_controller' , 
			'ad_banner_context_action' : 'delete_record' , 'ad_banner_action' : 'delete_record' , 
			'ad_banner_record_id' : Id , 'meta' : 'meta_delete_ad_banner'
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
ultimix.ad_banner.record_view_form = function( Id , DataSelector )
{
	ultimix.auto.record_view_form( 
		Id , DataSelector , 
		{
			'package_name' : 'ad::ad_banner::ad_banner_view' , 'ad_banner_context_action' : 'record_view_form' , 
			'task_action' : 'record_view_form' , 'ad_banner_record_id' : Id , 
			'meta' : 'meta_record_view_ad_banner_form'
		}
	);
}
