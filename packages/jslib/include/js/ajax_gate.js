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

	jQuery.extend( Options , { 'async' : true , 'dataType' : 'text' } );
	jQuery.extend( Data , { 'auto_redirect' : 0 , 'template' : 'ajax_result_template' } );

	if( Functions.before_request )
	{
		Functions.before_request();
	}

	var			Request = {
		async : Options.async , type : 'POST' , url : 'direct_controller.html?' + ( new Date() ).getTime() , 
		data : Data , success : Functions.success , error : Functions.error , dataType : Options.data_type
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
	jQuery.extend( { 'auto_redirect' : 0 , 'template' : 'ajax_result_template' } , Data );

	if( Functions.before_request )
	{
		Functions.before_request();
	}
	var			Request = {
		async : Options.async , type : 'POST' , url : 'direct_view.html?' + ( new Date() ).getTime() , 
		data : Data , success : Functions.success , error : Functions.error , dataType : Options.data_type
	};
	jQuery.ajax( Request );
}
