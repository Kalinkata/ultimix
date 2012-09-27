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
if( !ultimix.user )
{
	ultimix.user = {};
}

/**
*	Function adds avatar.
*
*	@param ServerData - Data received from the server.
*
*	@author Dodonov A.A.
*/
ultimix.user.add_avatar = function( ServerData )
{
	var		ServerDataObject;
	eval( "ServerDataObject=" + ServerData );
	
	ItemTemplate = jQuery( '.avatar>.avatar_template' ).html();
	ItemTemplate = ultimix.string_utilities.print_record( ItemTemplate , ServerDataObject );
	
	jQuery( '.avatar>.avatar_item' ).html( ItemTemplate );
}

/**
*	Upload success event handler.
*
*	@param File - File description object.
*
*	@param ServerData - Data received from the server.
*
*	@param ReceivedResponse - Was the response received.
*
*	@author Dodonov A.A.
*/
ultimix_user_after_avatar_upload_processor = function( File , ServerData , ReceivedResponse )
{
	try
	{
		var Progress = new FileProgress( File , this.customSettings.progressTarget );
		Progress.setComplete();
		Progress.setStatus( ultimix.get_string( 'complete' ) );
		Progress.toggleCancel( false );

		ultimix.user.add_avatar( ServerData );
	}
	catch( ex )
	{
		this.debug( ex );
	}
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
ultimix.user.set_default_options = function( ViewOptions )
{
	if( !ViewOptions )
	{
		ViewOptions = {};
	}

	ViewOptions.meta = ViewOptions.meta ? ViewOptions.meta : 'meta_user_list';
	ViewOptions.package_name = ViewOptions.package_name ? ViewOptions.package_name : 'user::user_view';
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
ultimix.user.get_list_form = function( Fuctions , ViewOptions )
{
	if( !Fuctions )
	{
		Fuctions = {};
	}

	ViewOptions = ultimix.user.set_default_options( ViewOptions );

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
ultimix.user.get_custom_list_form = function( Fuctions , Header , Item , Footer , ViewOptions )
{
	ultimix.auto.get_custom_list_form( Fuctions , Header , Item , Footer , false , ViewOptions , 'ad_banner' );
}

/**
*	Function process activation success.
*
*	@param ProgressDialogId - Dialog id.
*
*	@param Ids - Identificators of the activating users.
*
*	@param CheckboxGroupName - Name of the checkbox group.
*
*	@author Dodonov A.A.
*/
ultimix.user.activate_success = function( ProgressDialogId , Ids , CheckboxGroupName )
{
	return(
		function()
		{
			ultimix.std_dialogs.close_message_box( ProgressDialogId );
			ultimix.std_dialogs.InfoMessageBox( 'users_were_activated' );
			for( var i = 0 ; i < Ids.length ; i++ )
			{
				jQuery( '#active_' + Ids[ i ] ).html( ultimix.get_string( 'active' ) );
			}
			ultimix.grids.set_checkboxes( CheckboxGroupName , false );
		}
	);
}

/**
*	Function activates users.
*
*	@param Functions - Functions to process success and error events.
*
*	@param Ids - Identificators of the activating users.
*
*	@param CheckboxGroupName - Name of the checkbox group.
*
*	@author Dodonov A.A.
*/
ultimix.user.activate_users_ajax_request = function( Functions , Ids , CheckboxGroupName )
{
	if( !Functions )
	{
		Functions = {};
	}

	var				ProgressDialogId = ultimix.std_dialogs.SimpleWaitingMessageBox();

	if( !Functions.success )
	{
		Functions.success = ultimix.user.activate_success( ProgressDialogId , Ids , CheckboxGroupName );
	}

	ControllerOptions = { 
		'ids' : Ids , 'meta' : 'meta_admin_activate_user' , 'package_name' : 'user::user_controller'
	};

	ultimix.ajax_gate.direct_controller( ControllerOptions , Functions );
}

/**
*	Function activates users.
*
*	@param CheckboxGroupName - Name of the checkbox group.
*
*	@author Dodonov A.A.
*/
ultimix.user.activate_users = function( CheckboxGroupName )
{
	if( !ultimix.grids.record_selected( CheckboxGroupName , 'at_least_one_record_must_be_selected' ) )
	{
		return;
	}

	var			Ids = ultimix.grids.get_identificators( CheckboxGroupName );

	ultimix.user.activate_users_ajax_request( {} , Ids , CheckboxGroupName );
}

/**
*	Function process activation success.
*
*	@param ProgressDialogId - Dialog id.
*
*	@param Ids - Identificators of the activating users.
*
*	@param CheckboxGroupName - Name of the checkbox group.
*
*	@author Dodonov A.A.
*/
ultimix.user.deactivate_success = function( ProgressDialogId , Ids , CheckboxGroupName )
{
	return(
		function()
		{
			ultimix.std_dialogs.close_message_box( ProgressDialogId );
			ultimix.std_dialogs.InfoMessageBox( 'users_were_deactivated' );
			for( var i = 0 ; i < Ids.length ; i++ )
			{
				jQuery( '#active_' + Ids[ i ] ).html( ultimix.get_string( 'not_active' ) );
			}
			ultimix.grids.set_checkboxes( CheckboxGroupName , false );
		}
	);
}

/**
*	Function deactivates users.
*
*	@param Functions - Functions to process success and error events.
*
*	@param Ids - Identificators of the deactivating users.
*
*	@param CheckboxGroupName - Name of the checkbox group.
*
*	@author Dodonov A.A.
*/
ultimix.user.deactivate_users_ajax_request = function( Functions , Ids , CheckboxGroupName )
{
	if( !Functions )
	{
		Functions = {};
	}

	var				ProgressDialogId = ultimix.std_dialogs.SimpleWaitingMessageBox();

	if( !Functions.success )
	{
		Functions.success = ultimix.user.deactivate_success( ProgressDialogId , Ids , CheckboxGroupName );
	}

	ControllerOptions = { 
		'ids' : Ids , 'meta' : 'meta_admin_deactivate_user' , 'package_name' : 'user::user_controller'
	};

	ultimix.ajax_gate.direct_controller( ControllerOptions , Functions );
}

/**
*	Function deactivates users.
*
*	@param CheckboxGroupName - Name of the checkbox group.
*
*	@author Dodonov A.A.
*/
ultimix.user.deactivate_users = function( CheckboxGroupName )
{
	if( !ultimix.grids.record_selected( CheckboxGroupName , 'at_least_one_record_must_be_selected' ) )
	{
		return;
	}

	var			Ids = ultimix.grids.get_identificators( CheckboxGroupName );

	ultimix.user.deactivate_users_ajax_request( {} , Ids , CheckboxGroupName );
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
ultimix.user.delete = function( Id , DataSelector )
{
	ultimix.auto.delete( 
		Id , DataSelector , 
		{ 
			'package_name' : 'user::user_controller' , 
			'user_context_action' : 'delete_record' , 
			'user_action' : 'delete_record' , 'user_record_id' : Id , 
			'meta' : 'meta_delete_user'
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
ultimix.user.record_view_form = function( Id , DataSelector )
{
	ultimix.auto.record_view_form( 
		Id , DataSelector , 
		{
			'package_name' : 'user::user_view' , 'user_context_action' : 'record_view_form' , 
			'user_action' : 'record_view_form' , 'user_record_id' : Id , 
			'meta' : 'meta_record_view_user_form'
		}
	);
}

