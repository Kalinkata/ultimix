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
*	Function sets list view options.
*
*	@param ViewOptions - Extra view generation options.
*
*	@return View options.
*
*	@author Dodonov A.A.
*/
ultimix.category.set_default_options = function( ViewOptions )
{
	if( !ViewOptions )
	{
		ViewOptions = {};
	}

	ViewOptions.meta = ViewOptions.meta ? ViewOptions.meta : 'meta_category_list';
	ViewOptions.package_name = ViewOptions.package_name ? ViewOptions.package_name : 'category::category_view';
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
ultimix.category.get_list_form = function( Fuctions , ViewOptions )
{
	if( !Fuctions )
	{
		Fuctions = {};
	}

	ViewOptions = ultimix.category.set_default_options( ViewOptions );

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
ultimix.category.get_custom_list_form = function( Fuctions , Header , Item , Footer , ViewOptions )
{
	if( !Fuctions )
	{
		Fuctions = {};
	}

	ViewOptions = ultimix.category.set_default_options( ViewOptions );

	ViewOptions.header = Header ? Header : 'category_header.tpl';
	ViewOptions.item = Item ? Item : 'category_item.tpl';
	ViewOptions.footer = Footer ? Footer : 'category_footer.tpl';

	ultimix.ajax_gate.direct_view( ViewOptions , Fuctions );
}

/**
*	Function deletes category.
*
*	@param BannerId - Banner id.
*
*	@param DataSelector - Data selector.
*
*	@author Dodonov A.A.
*/
ultimix.category.delete = function( BannerId , DataSelector )
{
	ultimix.std_dialogs.QuestionMessageBox( 'are_you_shure' , 
		function( Result )
		{
			if( Result == ultimix.std_dialogs.MB_YES )
			{
				var			ProgressDialogId = ultimix.std_dialogs.SimpleWaitingMessageBox();

				ultimix.ajax_gate.direct_controller( 
					{ 
						'package_name' : 'category::category_controller' , 
						'category_context_action' : 'delete_record' , 'category_action' : 'delete_record' , 
						'category_record_id' : BannerId , 'meta' : 'meta_delete_category'
					} , 
					{ 'success' :  ultimix.ajax_gate.succes_delete_function( DataSelector , ProgressDialogId ) } , {}
				);
			}
		}
	)
}