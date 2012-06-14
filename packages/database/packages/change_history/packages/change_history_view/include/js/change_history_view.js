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
*	Function sets list view options.
*
*	@param ViewOptions - Extra view generation options.
*
*	@return View options.
*
*	@author Dodonov A.A.
*/
ultimix.change_history_view.set_default_options = function( ViewOptions )
{
	if( !ViewOptions )
	{
		ViewOptions = {};
	}

	ViewOptions.meta = ViewOptions.meta ? ViewOptions.meta : 'meta_change_history_list';
	var			PackageName = 'database::change_history::change_history_view';
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
ultimix.change_history_view.get_list_form = function( ResultAcceptor , ViewOptions )
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
		ViewOptions.meta = 'meta_change_history_list';
	}
	if( !ViewOptions.package_name )
	{
		ViewOptions.package_name = 'database::change_history_view::change_history_view';
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
ultimix.change_history_view.get_custom_list_form = function( Fuctions , Header , Item , Footer , ViewOptions )
{
	if( !Fuctions )
	{
		Fuctions = {};
	}

	ViewOptions = ultimix.change_history_view.set_default_options( ViewOptions );

	ViewOptions.header = Header ? Header : 'change_history_header.tpl';
	ViewOptions.item = Item ? Item : 'change_history_item.tpl';
	ViewOptions.footer = Footer ? Footer : 'change_history_footer.tpl';

	ultimix.ajax_gate.direct_view( ViewOptions , Fuctions );
}
