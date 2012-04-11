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
		ViewOptions.package_name = 'database::change_history_view::change_history_view_view';
	}
	ultimix.ajax_gate.direct_view( ViewOptions , ResultAcceptor );
}
