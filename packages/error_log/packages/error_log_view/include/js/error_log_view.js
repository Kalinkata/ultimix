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
if( !ultimix.error_log )
{
	ultimix.error_log = {};
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
ultimix.error_log.set_default_options = function( ViewOptions )
{
	if( !ViewOptions )
	{
		ViewOptions = {};
	}

	ViewOptions.meta = ViewOptions.meta ? ViewOptions.meta : 'meta_error_log_list';
	ViewOptions.package_name = ViewOptions.package_name ? ViewOptions.package_name : 'error_log::error_log_view';
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
ultimix.error_log.get_list_form = function( Fuctions , ViewOptions )
{
	if( !Fuctions )
	{
		Fuctions = {};
	}

	ViewOptions = ultimix.error_log.set_default_options( ViewOptions );

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
ultimix.error_log.get_custom_list_form = function( Fuctions , Header , Item , Footer , ViewOptions )
{
	if( !Fuctions )
	{
		Fuctions = {};
	}

	ViewOptions = ultimix.error_log.set_default_options( ViewOptions );

	ViewOptions.header = Header ? Header : 'error_log_header.tpl';
	ViewOptions.item = Item ? Item : 'error_log_item.tpl';
	ViewOptions.footer = Footer ? Footer : 'error_log_footer.tpl';

	ultimix.ajax_gate.direct_view( ViewOptions , Fuctions );
}

/**
*	Function deletes error_log.
*
*	@param BannerId - Banner id.
*
*	@param DataSelector - Data selector.
*
*	@author Dodonov A.A.
*/
ultimix.error_log.delete = function( BannerId , DataSelector )
{
	ultimix.std_dialogs.QuestionMessageBox( 'are_you_shure' , 
		function( Result )
		{
			if( Result == ultimix.std_dialogs.MB_YES )
			{
				var			ProgressDialogId = ultimix.std_dialogs.SimpleWaitingMessageBox();

				ultimix.ajax_gate.direct_controller( 
					{ 
						'package_name' : 'error_log::error_log_controller' , 
						'error_log_context_action' : 'delete_record' , 'error_log_action' : 'delete_record' , 
						'error_log_record_id' : BannerId , 'meta' : 'meta_delete_error_log'
					} , 
					{ 'success' :  ultimix.ajax_gate.succes_delete_function( DataSelector , ProgressDialogId ) } , {}
				);
			}
		}
	)
}