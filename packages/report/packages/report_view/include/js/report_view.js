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
if( !ultimix.report )
{
	ultimix.report = {};
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
ultimix.report.get_list_form = function( Fuctions , ViewOptions )
{
	ultimix.auto.get_list_form( Fuctions , ViewOptions , 'report' , 'report::report_view' );
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
ultimix.report.get_custom_list_form = function( Fuctions , Header , Item , Footer , ViewOptions )
{
	ultimix.auto.get_custom_list_form(
		Fuctions , Header , Item , Footer , false , ViewOptions , 'report' , 'report::report_view'
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
ultimix.report.delete = function( Id , DataSelector )
{
	ultimix.auto.delete( 
		DataSelector , 
		{ 
			'package_name' : 'report::report_controller' , 'report_context_action' : 'delete_record' , 
			'report_action' : 'delete_record' , 'report_record_id' : Id , 
			'meta' : 'meta_delete_report'
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
ultimix.report.record_view_form = function( Id , DataSelector )
{
	ultimix.auto.record_view_form( 
		DataSelector , 
		{
			'package_name' : 'report::report_view' , 'report_context_action' : 'record_view_form' , 
			'report_action' : 'record_view_form' , 'report_record_id' : Id , 
			'meta' : 'meta_record_view_report_form'
		}
	);
}
