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
if( !ultimix.content )
{
	ultimix.content = {};
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
ultimix.content.get_list_form = function( Fuctions , ViewOptions )
{
	ultimix.auto.get_list_form( Fuctions , ViewOptions , 'content' , 'content::content_view' );
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
ultimix.content.get_custom_list_form = function( Fuctions , Header , Item , Footer , ViewOptions )
{
	ultimix.auto.get_custom_list_form( 
		Fuctions , Header , Item , Footer , false , ViewOptions , 'content' , 'content::content_view'
	);
}

/**
*	Function deletes content.
*
*	@param Id - id of the entity.
*
*	@param DataSelector - Data selector.
*
*	@author Dodonov A.A.
*/
ultimix.content.delete = function( Id , DataSelector )
{
	ultimix.auto.delete( 
		Id , DataSelector , 
		{
			'package_name' : 'content::content_controller' , 
			'content_context_action' : 'delete_record' , 'content_action' : 'delete_record' , 
			'content_record_id' : Id , 'meta' : 'meta_delete_content'
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
ultimix.content.record_view_form = function( Id , DataSelector )
{
	ultimix.auto.record_view_form( 
		Id , DataSelector , 
		{
			'package_name' : 'content::content_view' , 'content_context_action' : 'record_view_form' , 
			'content_action' : 'record_view_form' , 'content_record_id' : Id , 
			'meta' : 'meta_record_view_content_form'
		}
	);
}
