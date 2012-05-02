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
if( !ultimix.template_content )
{
	ultimix.template_content = {};
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
ultimix.template_content.set_default_options = function( ViewOptions )
{
	if( !ViewOptions )
	{
		ViewOptions = {};
	}

	ViewOptions.meta = ViewOptions.meta ? ViewOptions.meta : 'meta_template_content_list';
	var			PackageName = 'page::template_content::template_content_view';
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
ultimix.template_content.get_list_form = function( ResultAcceptor , ViewOptions )
{
	if( !ResultAcceptor )
	{
		ResultAcceptor = function(){};
	}

	ViewOptions = ultimix.template_content.set_default_options( ViewOptions );

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
ultimix.template_content.get_custom_list_form = function( ResultAcceptor , Header , Item , Footer , ViewOptions )
{
	if( !ResultAcceptor )
	{
		ResultAcceptor = function(){};
	}

	ViewOptions = ultimix.template_content.set_default_options( ViewOptions );

	ViewOptions.header = Header ? Header : 'template_content_header.tpl';
	ViewOptions.item = Item ? Item : 'template_content_item.tpl';
	ViewOptions.footer = Footer ? Footer : 'template_content_footer.tpl';

	ultimix.ajax_gate.direct_view( ViewOptions , ResultAcceptor );
}