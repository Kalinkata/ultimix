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
if( !ultimix.subscription )
{
	ultimix.subscription = {};
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
ultimix.subscription.set_default_options = function( ViewOptions )
{
	if( !ViewOptions )
	{
		ViewOptions = {};
	}

	ViewOptions.meta = ViewOptions.meta ? ViewOptions.meta : 'meta_subscription_list';
	ViewOptions.package_name = ViewOptions.package_name ? ViewOptions.package_name : 'subscription::subscription_view';
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
ultimix.subscription.get_list_form = function( Fuctions , ViewOptions )
{
	if( !Fuctions )
	{
		Fuctions = {};
	}

	ViewOptions = ultimix.subscription.set_default_options( ViewOptions );

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
ultimix.subscription.get_custom_list_form = function( Fuctions , Header , Item , Footer , ViewOptions )
{
	if( !Fuctions )
	{
		Fuctions = {};
	}

	ViewOptions = ultimix.subscription.set_default_options( ViewOptions );

	ViewOptions.header = Header ? Header : 'subscription_header.tpl';
	ViewOptions.item = Item ? Item : 'subscription_item.tpl';
	ViewOptions.footer = Footer ? Footer : 'subscription_footer.tpl';

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
ultimix.subscription.delete = function( Id , DataSelector )
{
	ultimix.auto.delete( 
		Id , DataSelector , 
		{ 
			'package_name' : 'subscription::subscription_controller' , 
			'subscription_context_action' : 'delete_record' , 
			'subscription_action' : 'delete_record' , 'subscription_record_id' : Id , 
			'meta' : 'meta_delete_subscription'
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
ultimix.subscription.record_view_form = function( Id , DataSelector )
{
	ultimix.auto.record_view_form( 
		Id , DataSelector , 
		{
			'package_name' : 'subscription::subscription_view' , 'subscription_context_action' : 'record_view_form' , 
			'subscription_action' : 'record_view_form' , 'subscription_record_id' : Id , 
			'meta' : 'meta_record_view_subscription_form'
		}
	);
}
