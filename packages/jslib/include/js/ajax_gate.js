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
if( !ultimix.ajax_gate )
{
	ultimix.ajax_gate = {};
}

/**
*	Function validates data.
*
*	@param Data - Transfering data.
*
*	@return true/false
*
*	@author Dodonov A.A.
*/
ultimix.ajax_gate.validate_direct_data = function( Data )
{
	if( !Data.package_name )
	{
		ultimix.std_dialogs.ErrorMessageBox( ultimix.get_string( 'the_setting_package_name_was_not_found' ) );
		return( false );
	}

	return( true );
}

/**
*	Function creates result processor.
*
*	@param Functions - Result processing functions.
*
*	@param ResultObject - Result object.
*
*	@author Dodonov A.A.
*/
ultimix.ajax_gate.controller_error = function( Functions , ResultObject )
{
	if( Functions.controller_error )
	{
		Functions.controller_error();
	}

	ultimix.std_dialogs.MessageBox( 
		ultimix.get_string( ResultObject.message ) , ultimix.get_string( 'Error' ) , 
		ultimix.std_dialogs.MB_OK | ultimix.std_dialogs.MB_ICONERROR | ultimix.std_dialogs.MB_MODAL , 
		Functions.controller_error_restore
	)
}

/**
*	Function creates result processor.
*
*	@param Functions - Result processing functions.
*
*	@author Dodonov A.A.
*/
ultimix.ajax_gate.controller_success = function( Functions )
{
	return(
		function( Result )
		{
			eval( 'var			ResultObject = ' + Result + ';' );

			if( ResultObject.code == 1 )
			{
				ultimix.ajax_gate.controller_error( Functions , ResultObject );
			}
			else
			{
				if( Functions.success )
				{
					Functions.success( Result );
				}
			}
		}
	);
}

/**
*	Function executes controller action.
*
*	@param Data - Transfering data.
*
*	@param Functions - Functions to process success and error events.
*
*	@param Options - Request settings.
*
*	@author Dodonov A.A.
*/
ultimix.ajax_gate.direct_controller = function( Data , Functions , Options )
{
	if( ultimix.ajax_gate.validate_direct_data( Data ) == false )
	{
		return;
	}
	if( !Options )
	{
		Options = {};
	}
	jQuery.extend( { 'async' : true , 'dataType' : 'text' } , Options );
	var			CallData = { 'auto_redirect' : 0 , 'template' : 'ajax_result_template' , 'controller' : 1 };
	Data = jQuery.extend( CallData , Data );
	if( Functions && Functions.before_request )
	{
		Functions.before_request();
	}
	var			Request = {
		async : Options.async , type : 'POST' , url : 'direct_controller.html?' + ( new Date() ).getTime() , 
		data : CallData , success : ultimix.ajax_gate.controller_success( Functions ) , 
		error : Functions ? Functions.error : false , dataType : Options.data_type
	};
	jQuery.ajax( Request );
}

/**
*	Function gets view.
*
*	@param Data - Transfering data.
*
*	@param Functions - Functions to process success and error events.
*
*	@param Options - Request settings.
*
*	@author Dodonov A.A.
*/
ultimix.ajax_gate.direct_view = function( Data , Functions , Options )
{
	if( ultimix.ajax_gate.validate_direct_data( Data ) == false )
	{
		return;
	}
	Options = !Options ? {} : Options;
	jQuery.extend( { 'async' : true , 'data_type' : 'html' } , Options );
	var			CallData = { 'auto_redirect' : 0 , 'view' : 1 };
	jQuery.extend( CallData , Data );
	if( Functions && Functions.before_request )
	{
		Functions.before_request();
	}
	var			Request = {
		async : Options.async , type : 'POST' , url : 'direct_view.html?' + ( new Date() ).getTime() , 
		data : CallData , success : Functions ? Functions.success : false , 
		error : Functions ? Functions.error : false , dataType : Options.data_type
	};
	jQuery.ajax( Request );
}

/**
*	Function deletes page.
*
*	@param DataSelector - Data selector.
*
*	@param ProgressDialogId - Progress dialog selector.
*
*	@author Dodonov A.A.
*/
ultimix.ajax_gate.succes_delete_function = function( DataSelector , ProgressDialogId )
{
	return(
		function()
		{
			ultimix.std_dialogs.close_message_box( ProgressDialogId );
			ultimix.std_dialogs.InfoMessageBox( 'all_selected_records_were_deleted' );
			jQuery( DataSelector ).remove();
		}
	);
}
