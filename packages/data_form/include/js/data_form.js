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
if( !ultimix.data_form )
{
	ultimix.data_form = {};
}

/**
*	Function submits form.
*
*  	@param Action - Destination page.
*
*	@param Method - Submit method.
*
*	@author Dodonov A.A.
*/
ultimix.data_form.create_form = function( Action , Method )
{
	if( !Method )
	{
		Method = 'post';
	}
	
	if( jQuery( '#data_form' ).length )
	{
		jQuery( '#data_form' ).remove();
	}

	jQuery( 'body' ).append( '<form id="data_form" method="' + Method + '" style="display: none;"></form>' );
	
	if( Action )
	{
		jQuery( '#data_form' ).attr( 'action' , Action );
	}
}

/**
*	Function appends data to form.
*
*	@param Data - Data to append.
*
*	@author Dodonov A.A.
*/
ultimix.data_form.append_data = function( Data )
{
	for( i in Data )
	{
		jQuery( '#data_form' ).append( '<textarea name="' + i + '">' + Data[ i ] + '</textarea>' );
	}
}

/**
*	Function clones form data to submit.
*
*	@param SourceFormSelector - Selector of the submitted data.
*
*	@author Dodonov A.A.
*/
ultimix.data_form.move_form_data = function( SourceFormSelector )
{
	var					Data = ultimix.forms.ExtractFormData( SourceFormSelector );

	ultimix.data_form.append_data( Data );
}

/**
*	Submit form method.
*
*	@param SourceFormSelector - Selector of the submitted data.
*
*	@param Waiting - Should be progress window be displayed.
*
*	@author Dodonov A.A.
*/
ultimix.data_form.success_function = function( SourceFormSelector , Waiting )
{
	return(
		function( Result )
		{
			if( Result == ultimix.std_dialogs.MB_YES )
			{
				ultimix.data_form.move_form_data( SourceFormSelector );
			
				document.getElementById( 'data_form' ).submit();
				
				if( Waiting )
				{
					ultimix.std_dialogs.SimpleWaitingMessageBox();
				}
			}
		}
	);
}

/**
*	Function submits data on the server.
*
*	@param SourceFormSelector - Selector of the submitting data.
*
*	@param ConfirmString - Confirmation string.
*
*  	@param Action - Destination page.
*
*	@param Waiting - Should be progress window be displayed.
*
*	@param Method - Submit method.
*
*	@author Dodonov A.A.
*/
ultimix.data_form.submit_dom_data = function( SourceFormSelector , ConfirmString , Action , Waiting , Method )
{
	ultimix.data_form.create_form( Action , Method );
	
	Success = ultimix.data_form.success_function( SourceFormSelector , Waiting );

	if( ConfirmString )
	{
		ultimix.std_dialogs.QuestionMessageBox( ConfirmString , Success );
		return;
	}
	
	Success( ultimix.std_dialogs.MB_YES );
}

/**
*	Function submits form.
*
*	@param Waiting - Should user be warned.
*
*	@author Dodonov A.A.
*/
ultimix.data_form.wait_for_submit = function( Waiting )
{
	document.getElementById( 'data_form' ).submit();

	if( Waiting )
	{
		ultimix.std_dialogs.WaitingMessageBox( 'wait_please' , 'Info' );
	}
}

/**
*	Function submits data on the server.
*
*	@param Data - Data to submit.
*
*	@param ConfirmString - Confirmation string.
*
*  	@param Action - Destination page.
*
*	@param Waiting - Should be progress window be displayed.
*
*	@param Method - Submit method.
*
*	@author Dodonov A.A.
*/
ultimix.data_form.submit_data = function( Data , ConfirmString , Action , Waiting , Method )
{
	ultimix.data_form.create_form( Action , Method );

	Success = function( Result )
	{
		if( Result == ultimix.std_dialogs.MB_YES )
		{
			ultimix.data_form.append_data( Data );
			ultimix.data_form.wait_for_submit( Waiting );
		}
	}

	if( ConfirmString )
	{
		ultimix.std_dialogs.QuestionMessageBox( ConfirmString , Success );
		return;
	}

	Success( ultimix.std_dialogs.MB_YES );
}

/**
*	Function submits form.
*
*	@param ConfirmString - Confirmation string
*
*  	@param Action - Destination page.
*
*	@param Waiting - Should user be warned.
*
*	@param Method - Submit method.
*
*	@author Dodonov A.A.
*/
ultimix.data_form.SubmitDataForm0 = function( ConfirmString , Action , Waiting , Method )
{
	// TODO replace this method everywere with ultimix.data_form.submit_data
	ultimix.data_form.submit_data( {} , ConfirmString , Action , Waiting , Method );
}

/**
*	Function submits form.
*
*	@param Param1 - First parameter.
*
*	@param Value1 - First parameter's value.
*
*	@param ConfirmString - Confirmation string
*
*  	@param Action - Destination page.
*
*	@param Waiting - Should user be warned.
*
*	@param Method - Submit method.
*
*	@author Dodonov A.A.
*/
ultimix.data_form.SubmitDataForm1 = function( Param1 , Value1 , ConfirmString , Action , Waiting , Method )
{
	// TODO replace this method everywere with ultimix.data_form.submit_data
	var			Data = {};

	Data[ Param1 ] = Value1;

	ultimix.data_form.submit_data( Data , ConfirmString , Action , Waiting , Method );
}

/**
*	Function submits form.
*
*	@param Param1 - First parameter.
*
*	@param Value1 - First parameter's value.
*
*	@param Param2 - Second parameter.
*
*	@param Value2 - Second parameter's value.
*
*	@param ConfirmString - Confirmation string
*
*  	@param Action - Destination page.
*
*	@param Waiting - Should user be warned.
*
*	@param Method - Submit method.
*
*	@author Dodonov A.A.
*/
ultimix.data_form.SubmitDataForm2 = function( Param1 , Value1 , Param2, Value2 , 
																			ConfirmString , Action , Waiting , Method )
{
	// TODO replace this method everywere with ultimix.data_form.submit_data
	var			Data = {};

	Data[ Param1 ] = Value1;
	Data[ Param2 ] = Value2;

	ultimix.data_form.submit_data( Data , ConfirmString , Action , Waiting , Method );
}

/**
*	Function submits form.
*
*	@param Param1 - First parameter.
*
*	@param Value1 - First parameter's value.
*
*	@param Param2 - Second parameter.
*
*	@param Value2 - Second parameter's value.
*
*	@param Param3 - Third parameter.
*
*	@param Value3 - Third parameter's value.
*
*	@param ConfirmString - Confirmation string
*
*  	@param Action - Destination page.
*
*	@param Waiting - Should user be warned.
*
*	@param Method - Submit method.
*
*	@author Dodonov A.A.
*/
ultimix.data_form.SubmitDataForm3 = function( Param1 , Value1 , Param2 , Value2 , Param3 , Value3 , 
																			ConfirmString , Action , Waiting , Method )
{
	// TODO replace this method everywere with ultimix.data_form.submit_data
	var			Data = {};

	Data[ Param1 ] = Value1;
	Data[ Param2 ] = Value2;
	Data[ Param3 ] = Value3;

	ultimix.data_form.submit_data( Data , ConfirmString , Action , Waiting , Method );
}
