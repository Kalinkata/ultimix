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
if( !ultimix.template_content )
{
	ultimix.template_content = {};
}

/**
*	Function returns list view.
*
*	@param ResultAcceptor - Result accepting function.
*
*	@param ViewOptions - Extra view generation options.
*
*	@author Dodonov A.A.
*/
ultimix.template_content.get_list_form = function( ResultAcceptor , ViewOptions )
{
	ultimix.auto.get_list_form(
		Fuctions , ViewOptions , 'template_content' , 'page::template_content::template_content_view'
	);
}

/**
*	Function returns list view.
*
*	@param ResultAcceptor - Result accepting function.
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
ultimix.template_content.get_custom_list_form = function( ResultAcceptor , Header , 
																			Item , Footer , NoDataFound , ViewOptions )
{
	ultimix.auto.get_custom_list_form(
		Fuctions , Header , Item , Footer , NoDataFound , ViewOptions , 
		'template_content' , 'page::template_content::template_content_view'
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
ultimix.template_content.delete = function( Id , DataSelector )
{
	ultimix.auto.delete( 
		DataSelector , 
		{ 
			'package_name' : 'page::template_content::template_content_controller' , 
			'template_content_context_action' : 'delete_record' , 
			'template_content_action' : 'delete_record' , 'template_content_record_id' : Id , 
			'meta' : 'meta_delete_template_content'
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
ultimix.template_content.record_view_form = function( Id , DataSelector )
{
	ultimix.auto.record_view_form( 
		DataSelector , 
		{
			'package_name' : 'page::template_content::template_content_view' , 
			'template_content_context_action' : 'record_view_form' , 
			'template_content_action' : 'record_view_form' , 'template_content_record_id' : Id , 
			'meta' : 'meta_record_view_template_content_form'
		}
	);
}
