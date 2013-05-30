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
if( !ultimix.auto )
{
	ultimix.auto = {};
}

/**
*	Function sets list view options.
*
*	@param ViewOptions - Extra view generation options.
*
*	@param Prefix - Prefix.
*
*	@param PackageName - Package name.
*
*	@return View options.
*
*	@author Dodonov A.A.
*/
ultimix.auto.set_default_options = function( ViewOptions , Prefix , PackageName )
{
	if( !ViewOptions )
	{
		ViewOptions = {};
	}

	ViewOptions.meta = ViewOptions.meta ? ViewOptions.meta : 'meta_' + Prefix + '_list';
	ViewOptions.package_name = ViewOptions.package_name ? ViewOptions.package_name : PackageName;
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
*	@param Prefix - Prefix.
*
*	@param PackageName - Package name.
*
*	@author Dodonov A.A.
*/
ultimix.auto.get_list_form = function( Fuctions , ViewOptions , Prefix , PackageName )
{
	if( !Fuctions )
	{
		Fuctions = {};
	}

	ViewOptions = ultimix.auto.set_default_options( ViewOptions , Prefix , PackageName );

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
*	@param NoDataFound - No data found template.
*
*	@param ViewOptions - Extra view generation options.
*
*	@param Prefix - Prefix.
*
*	@param PackageName - Package name.
*
*	@author Dodonov A.A.
*/
ultimix.auto.get_custom_list_form = function( Fuctions , Header , Item , Footer , NoDataFound , ViewOptions , 
												Prefix , PackageName )
{
	if( !Fuctions )
	{
		Fuctions = {};
	}

	ViewOptions = ultimix.auto.set_default_options( ViewOptions , Prefix , PackageName );

	ViewOptions.header = Header ? Header : Prefix + '_header.tpl';
	ViewOptions.item = Item ? Item : Prefix + '_item.tpl';
	ViewOptions.footer = Footer ? Footer : Prefix + '_footer.tpl';
	ViewOptions.no_data_found_message = NoDataFound ? NoDataFound : Prefix + '_no_data_found.tpl';

	ultimix.ajax_gate.direct_view( ViewOptions , Fuctions );
}

/**
*	Function processing handler.
*
*	@param DataSelector - Data selector.
*
*	@param Data - Data.
*
*	@param Functions - Callbacks.
*
*	@author Dodonov A.A.
*/
ultimix.auto.processing_handler = function( DataSelector , Data , Functions )
{
	var			ProgressDialogId = ultimix.std_dialogs.SimpleWaitingMessageBox();
	if( !Functions )
	{
		Functions = { 
			'success' :  ultimix.ajax_gate.succes_function( DataSelector , ProgressDialogId )
		};
	}
	else
	{
		if( Functions.success )
		{
			var				SuccessFunction = Functions.success;
			Functions.success = function( Result )
			{
				SuccessFunction( Result );
				ultimix.ajax_gate.succes_calling_function( Result , DataSelector , ProgressDialogId );
			}
		}
	}
	ultimix.ajax_gate.direct_controller( Data , Functions , {} );
}

/**
*	Function runs create/update/delete controllers.
*
*	@param DataSelector - Data selector.
*
*	@param Data - Request data.
*
*	@param Functions - Callbacks.
*
*	@author Dodonov A.A.
*/
ultimix.auto.create_update_delete = function( DataSelector , Data , Functions , HideDialog )
{
	if( HideDialog )
	{
		ultimix.auto.processing_handler( DataSelector , Data , Functions );
	}
	else
	{
		ultimix.std_dialogs.QuestionMessageBox( 'are_you_shure' , 
			function( Result )
			{
				if( Result == ultimix.std_dialogs.MB_YES )
				{
					ultimix.auto.processing_handler( DataSelector , Data , Functions );
				}
			}
		)
	}
}

/**
*	Function creates record.
*
*	@param DataSelector - Data selector.
*
*	@param Data - Request data.
*
*	@param Functions - Callbacks.
*
*	@author Dodonov A.A.
*/
ultimix.auto.create = function( DataSelector , Data , Functions , HideDialog )
{
	ultimix.auto.create_update_delete( DataSelector , Data , Functions , HideDialog );
}

/**
*	Function updates record.
*
*	@param DataSelector - Data selector.
*
*	@param Data - Request data.
*
*	@param Functions - Callbacks.
*
*	@param HideDialog - Hide confirmation dialog.
*
*	@author Dodonov A.A.
*/
ultimix.auto.update = function( DataSelector , Data , Functions , HideDialog )
{
	ultimix.auto.create_update_delete( DataSelector , Data , Functions , HideDialog );
}

/**
*	Function deletes record.
*
*	@param DataSelector - Data selector.
*
*	@param Data - Request data.
*
*	@param Functions - Callbacks.
*
*	@param HideDialog - Hide dialog.
*
*	@author Dodonov A.A.
*/
ultimix.auto.delete = function( DataSelector , Data , Functions , HideDialog )
{
	ultimix.auto.create_update_delete( DataSelector , Data , Functions , HideDialog );
}

/**
*	Function shows record.
*
*	@param DataSelector - Data selector.
*
*	@param Settings - Request settings.
*
*	@return Content of the form.
*
*	@author Dodonov A.A.
*/
ultimix.auto.record_view_form = function( DataSelector , Settings )
{
	ultimix.ajax_gate.direct_view( 
		Settings , 
		{ 
			'success' : function( Result )
			{
				jQuery( DataSelector ).html( Result );
			}
		} , {}
	);
}
