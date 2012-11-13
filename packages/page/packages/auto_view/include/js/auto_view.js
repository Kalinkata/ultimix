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
*	@author Dodonov A.A.
*/
ultimix.auto.get_list_form = function( Fuctions , ViewOptions )
{
	if( !Fuctions )
	{
		Fuctions = {};
	}

	ViewOptions = ultimix.auto.set_default_options( ViewOptions );

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
	ViewOptions.NoDataFound = NoDataFound ? NoDataFound : Prefix + '_no_data_found.tpl';

	ultimix.ajax_gate.direct_view( ViewOptions , Fuctions );
}

/**
*	Function deletes record.
*
*	@param Id - Record id.
*
*	@param DataSelector - Data selector.
*
*	@param Settings - Request settings.
*
*	@author Dodonov A.A.
*/
ultimix.auto.delete = function( Id , DataSelector , Settings )
{
	ultimix.std_dialogs.QuestionMessageBox( 'are_you_shure' , 
		function( Result )
		{
			if( Result == ultimix.std_dialogs.MB_YES )
			{
				var			ProgressDialogId = ultimix.std_dialogs.SimpleWaitingMessageBox();

				ultimix.ajax_gate.direct_controller( 
					Settings , 
					{ 'success' :  ultimix.ajax_gate.succes_delete_function( DataSelector , ProgressDialogId ) } , {}
				);
			}
		}
	)
}

/**
*	Function shows record.
*
*	@param Id - Record id.
*
*	@param DataSelector - Data selector.
*
*	@param Settings - Request settings.
*
*	@return Content of the form.
*
*	@author Dodonov A.A.
*/
ultimix.auto.record_view_form = function( Id , DataSelector , Settings )
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
