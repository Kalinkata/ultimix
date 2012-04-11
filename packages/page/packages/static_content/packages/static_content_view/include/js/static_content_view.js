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
if( !ultimix.static_content )
{
	ultimix.static_content = {};
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
ultimix.static_content.set_default_options = function( ViewOptions )
{
	if( !ViewOptions )
	{
		ViewOptions = {};
	}

	ViewOptions.meta = ViewOptions.meta ? ViewOptions.meta : 'meta_static_content_list';
	var			PackageName = 'page::static_content::static_content_view';
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
ultimix.static_content.get_list_form = function( ResultAcceptor , ViewOptions )
{
	if( !ResultAcceptor )
	{
		ResultAcceptor = function(){};
	}

	ViewOptions = ultimix.static_content.set_default_options( ViewOptions );

	ultimix.ajax_gate.direct_view( ViewOptions , ResultAcceptor );
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
*	@param ViewOptions - Extra view generation options.
*
*	@author Dodonov A.A.
*/
ultimix.static_content.get_custom_list_form = function( ResultAcceptor , Header , Item , Footer , ViewOptions )
{
	if( !ResultAcceptor )
	{
		ResultAcceptor = function(){};
	}

	ViewOptions = ultimix.static_content.set_default_options( ViewOptions );

	ViewOptions.header = Header ? Header : 'static_content_header.tpl';
	ViewOptions.item = Item ? Item : 'static_content_item.tpl';
	ViewOptions.footer = Footer ? Footer : 'static_content_footer.tpl';

	ultimix.ajax_gate.direct_view( ViewOptions , ResultAcceptor );
}
