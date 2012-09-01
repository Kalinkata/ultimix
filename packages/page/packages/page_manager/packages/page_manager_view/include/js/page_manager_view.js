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
if( !ultimix.page_manager )
{
	ultimix.page_manager = {};
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
ultimix.page_manager.set_default_options = function( ViewOptions )
{
	if( !ViewOptions )
	{
		ViewOptions = {};
	}

	ViewOptions.meta = ViewOptions.meta ? ViewOptions.meta : 'meta_page_list';
	var			PackageName = 'page::page_manager::page_manager_view';
	ViewOptions.package_name = ViewOptions.package_name ? ViewOptions.package_name : PackageName;
	ViewOptions.paging_require_form = ViewOptions.paging_require_form ? ViewOptions.paging_require_form : '0';
	ViewOptions.add_hidden_fields = ViewOptions.add_hidden_fields ? ViewOptions.add_hidden_fields : '0';

	return( ViewOptions );
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
ultimix.page_manager.get_list_form = function( ResultAcceptor , ViewOptions )
{
	if( !ResultAcceptor )
	{
		ResultAcceptor = function(){};
	}
	if( !ViewOptions )
	{
		ViewOptions = {};
	}
	if( !ViewOptions.meta )
	{
		ViewOptions.meta = 'meta_page_list';
	}
	if( !ViewOptions.package_name )
	{
		ViewOptions.package_name = 'page::page_manager::page_manager_view';
	}
	ultimix.ajax_gate.direct_view( ViewOptions , ResultAcceptor );
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
ultimix.page_manager.get_custom_list_form = function( Fuctions , Header , Item , Footer , ViewOptions )
{
	if( !Fuctions )
	{
		Fuctions = {};
	}

	ViewOptions = ultimix.page_manager.set_default_options( ViewOptions );

	ViewOptions.header = Header ? Header : 'page_header.tpl';
	ViewOptions.item = Item ? Item : 'page_item.tpl';
	ViewOptions.footer = Footer ? Footer : 'page_footer.tpl';

	ultimix.ajax_gate.direct_view( ViewOptions , Fuctions );
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
ultimix.page_manager.delete = function( Id , DataSelector )
{
}
