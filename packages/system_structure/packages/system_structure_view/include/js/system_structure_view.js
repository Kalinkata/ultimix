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
if( !ultimix.system_structure )
{
	ultimix.system_structure = {};
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
ultimix.system_structure.get_list_form = function( Fuctions , ViewOptions )
{
	ultimix.auto.get_list_form(
		Fuctions , ViewOptions , 'system_structure' , 'system_structure::system_structure_view'
	);
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
ultimix.system_structure.get_custom_list_form = function( Fuctions , Header , Item , Footer , ViewOptions )
{
	ultimix.auto.get_custom_list_form(
		Fuctions , Header , Item , Footer , false , ViewOptions , 
		'system_structure' , 'system_structure::system_structure_manager'
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
ultimix.system_structure.delete = function( Id , DataSelector )
{
	ultimix.auto.delete( 
		Id , DataSelector , 
		{ 
			'package_name' : 'system_structure::system_structure_controller' , 
			'system_structure_context_action' : 'delete_record' , 
			'system_structure_action' : 'delete_record' , 'system_structure_record_id' : Id , 
			'meta' : 'meta_delete_system_structure'
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
ultimix.system_structure.record_view_form = function( Id , DataSelector )
{
	ultimix.auto.record_view_form( 
		Id , DataSelector , 
		{
			'package_name' : 'system_structure::system_structure_view' , 
			'system_structure_context_action' : 'record_view_form' , 
			'system_structure_action' : 'record_view_form' , 'system_structure_record_id' : Id , 
			'meta' : 'meta_record_view_system_structure_form'
		}
	);
}
