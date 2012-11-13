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
if( !ultimix.change_history_view )
{
	ultimix.change_history_view = {};
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
ultimix.change_history_view.get_list_form = function( ResultAcceptor , ViewOptions )
{
	if( !Fuctions )
	{
		Fuctions = {};
	}

	ViewOptions = ultimix.auto.set_default_options( 
		ViewOptions , 'change_history' , 'database::change_history::change_history_view' 
	);

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
ultimix.change_history_view.get_custom_list_form = function( Fuctions , Header , Item , Footer , ViewOptions )
{
	ultimix.auto.get_custom_list_form( Fuctions , Header , Item , Footer , false , ViewOptions , 'change_history' );
}

/**
*	Function deletes change_history_view.
*
*	@param Id - Change history record id.
*
*	@param DataSelector - Data selector.
*
*	@author Dodonov A.A.
*/
ultimix.change_history_view.delete = function( Id , DataSelector )
{
	ultimix.auto.delete( 
		Id , DataSelector , 
		{ 
			'package_name' : 'change_history_view::change_history_view_controller' , 
			'change_history_view_context_action' : 'delete_record' , 
			'change_history_view_action' : 'delete_record' , 'change_history_view_record_id' : Id , 
			'meta' : 'meta_delete_change_history_view'
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
ultimix.change_history_view.record_view_form = function( Id , DataSelector )
{
	ultimix.auto.record_view_form( 
		Id , DataSelector , 
		{
			'package_name' : 'database::change_history_view::change_history_view_view' , 
			'change_history_view_context_action' : 'record_view_form' , 
			'change_history_view_action' : 'record_view_form' , 'change_history_view_record_id' : Id , 
			'meta' : 'meta_record_view_change_history_view_form'
		}
	);
}
