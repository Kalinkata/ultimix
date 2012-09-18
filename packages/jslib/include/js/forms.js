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
if( !ultimix.forms )
{
	ultimix.forms = {};
}

/**
*	Function processes Enter key press.
*
*	@param e - Event object.
*
*	@param Id - Form's id.
*
*	@author Dodonov A.A.
*/
ultimix.forms.enter_processor = function( e , Id )
{
	if( e.keyCode == 13 )
	{
		document.getElementById( Id ).submit();
	}
}

/**
*	Function returns true if the enter key was pressed.
*
*	@param e - Event object.
*
*	@author Dodonov A.A.
*/
ultimix.forms.enter_was_pressed = function( e )
{
	return( e.keyCode == 13 );
	
}

/**
*	Function processes triple state checkbox.
*
*	@param Name - Checkbox'es name.
*
*	@param Id - Id of the checkbox.
*
*	@author Dodonov A.A.
*/
ultimix.forms.triple_set_checkbox_click = function( Id , Name )
{
	var			Checkbox = document.getElementById( '_checkbox_' + Id );
	var			Value = document.getElementById( Id );
	
	if( Value.value == 0 )
	{
		jQuery( Checkbox ).prop( 'checked' , true );
		Checkbox.disabled = false;
		Value.value = 1;
		return;
	}
	
	if( Value.value == 1 )
	{
		jQuery( Checkbox ).prop( 'checked' , true );
		Checkbox.disabled = true;
		Value.value = 2;
		return;
	}
	
	if( Value.value == 2 )
	{
		jQuery( Checkbox ).prop( 'checked' , false );
		Checkbox.disabled = false;
		Value.value = 0;
		return;
	}
}

/**
*	Function processes double state checkbox.
*
*	@param Name - Checkbox'es name.
*
*	@param Id - Checkbox'es id.
*
*	@author Dodonov A.A.
*/
ultimix.forms.double_set_checkbox_click = function( Id , Name )
{
	var			Checkbox = document.getElementById( '_checkbox_' + Id );
	var			Value = document.getElementById( Id );

	if( Value.value == 0 )
	{
		jQuery( Checkbox ).prop( 'checked' , true );
		Value.value = 1;
		return;
	}
	
	if( Value.value == 1 )
	{
		jQuery( Checkbox ).prop( 'checked' , false );
		Value.value = 0;
		return;
	}
}

/**
*	Function sets action and method fields.
*
*	@param FormId - Form to be submitted.
*
*	@param Action - Destination page.
*
*	@param Method - Submit method.
*
*	@author Dodonov A.A.
*/
ultimix.forms.set_action_and_method = function( FormId , Action , Method )
{
	if( Action )
	{
		document.getElementById( FormId ).setAttribute( 'action' , Action );
	}
	if( Method )
	{
		document.getElementById( FormId ).setAttribute( 'method' , Method );
	}
}

/**
*	Function submits form.
*
*	@param FormId - Form to be submitted.
*
*	@param Action - Destination page.
*
*	@param Waiting - Should user be warned.
*
*	@param Method - Submit method.
*
*	@author Dodonov A.A.
*/
ultimix.forms.submit_form_and_wait = function( FormId , Action , Waiting , Method )
{
	ultimix.forms.set_action_and_method( FormId , Action , Method );

	document.getElementById( FormId ).submit();

	if( Waiting )
	{
		ultimix.std_dialogs.SimpleWaitingMessageBox();
	}
}

/**
*	Function submits form.
*
*	@param ConfirmString - Confirmation question.
*
*	@param Success - Success method.
*
*	@author Dodonov A.A.
*/
ultimix.forms.confirm_submit = function( ConfirmString , Success )
{
	if( ConfirmString )
	{
		ultimix.std_dialogs.QuestionMessageBox( ConfirmString , Success );
		return;
	}

	Success( ultimix.std_dialogs.MB_YES );
}

/**
*	Form exists.
*
*	@param FormId - Form to be submitted.
*
*	@return true/false.
*
*	@author Dodonov A.A.
*/
ultimix.forms.form_exists = function( FormId )
{
	if( document.getElementById( FormId ) == null )
	{
		ultimix.std_dialogs.ErrorMessageBox( 'Form ' + FormId + ' was not found' );
		return( false );
	}
	return( true );
}

/**
*	Function submits form.
*
*	@param FormId - Form to be submitted.
*
*	@param ConfirmString - Confirmation question.
*
*	@param Action - Destination page.
*
*	@param Waiting - Should user be warned.
*
*	@param Method - Submit method.
*
*	@author Dodonov A.A.
*/
ultimix.forms.submit_form_0 = function( FormId , ConfirmString , Action , Waiting , Method )
{
	if( !ultimix.forms.form_exists( FormId ) )
	{
		return;
	}
	var			Success = function( Result )
	{
		if( Result == ultimix.std_dialogs.MB_YES )
		{
			ultimix.forms.submit_form_and_wait( FormId , Action , Waiting , Method );
		}
	}
	ultimix.forms.confirm_submit( ConfirmString , Success );
}

/**
*	Item exists.
*
*	@param FormId - Form to be submitted.
*
*	@return true/false.
*
*	@author Dodonov A.A.
*/
ultimix.forms.item_exists = function( Name )
{
	if( document.getElementById( Name ) == null )
	{
		ultimix.std_dialogs.ErrorMessageBox( 'Field ' + Name + ' was not found' );
		return( false );
	}
	return( true );
}

/**
*	Function submits form.
*
*	@param FormId - Form to be submitted.
*
*	@param Param1 - First parameter.
*
*	@param Value1 - First parameter's value.
*
*	@param ConfirmString - Confirmation question.
*
*	@param Action - Destination page.
*
*	@param Waiting - Should user be warned.
*
*	@param Method - Submit method.
*
*	@author Dodonov A.A.
*/
ultimix.forms.submit_form_1 = function( FormId , Param1 , Value1 , ConfirmString , Action , Waiting , Method )
{
	if( !ultimix.forms.form_exists( FormId ) || !ultimix.forms.item_exists( Param1 ) )
	{
		return;
	}
	var			Success = function( Result )
	{
		if( Result == ultimix.std_dialogs.MB_YES )
		{
			document.getElementById( Param1 ).setAttribute( 'value' , Value1 );
			ultimix.forms.submit_form_and_wait( FormId , Action , Waiting , Method );
		}
	}
	ultimix.forms.confirm_submit( ConfirmString , Success );
}

/**
*	Function submits form.
*
*	@param FormId - Form to be submitted.
*
*	@param Param1 - First parameter.
*
*	@param Value1 - First parameter's value.
*
*	@param Param2 - Second parameter.
*
*	@param Value2 - Second parameter's value.
*
*	@param ConfirmString - Confirmation question.
*
*	@param Action - Destination page.
*
*	@param Waiting - Should user be warned.
*
*	@param Method - Submit method.
*
*	@author Dodonov A.A.
*/
ultimix.forms.submit_form_2 = function( FormId , Param1 , Value1 , Param2 , Value2 , 
																			ConfirmString , Action , Waiting , Method )
{	
	if( !ultimix.forms.form_exists( FormId ) || !ultimix.forms.item_exists( Param1 ) || 
		!ultimix.forms.item_exists( Param2 ) )
	{
		return;
	}
	var			Success = function( Result )
	{
		if( Result == ultimix.std_dialogs.MB_YES )
		{
			document.getElementById( Param1 ).setAttribute( 'value' , Value1 );
			document.getElementById( Param2 ).setAttribute( 'value' , Value2 );
			ultimix.forms.submit_form_and_wait( FormId , Action , Waiting , Method );
		}
	}
	ultimix.forms.confirm_submit( ConfirmString , Success );
}

/**
*	Function submits form.
*
*	@param FormId - Form to be submitted.
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
*	@param ConfirmString - Confirmation question.
*
*	@param Action - Destination page.
*
*	@param Waiting - Should user be warned.
*
*	@param Method - Submit method.
*
*	@author Dodonov A.A.
*/
ultimix.forms.submit_form_3 = function( FormId , Param1 , Value1 , Param2 , Value2 , Param3 , Value3 , 
																			ConfirmString , Action , Waiting , Method )
{
	if( !ultimix.forms.form_exists( FormId ) || !ultimix.forms.item_exists( Param1 ) || 
		!ultimix.forms.item_exists( Param2 ) || !ultimix.forms.item_exists( Param3 ) )
	{
		return;
	}
	var			Success = function( Result )
	{
		if( Result == ultimix.std_dialogs.MB_YES )
		{
			document.getElementById( Param1 ).setAttribute( 'value' , Value1 );
			document.getElementById( Param2 ).setAttribute( 'value' , Value2 );
			document.getElementById( Param3 ).setAttribute( 'value' , Value3 );
			ultimix.forms.submit_form_and_wait( FormId , Action , Waiting , Method );
		}
	}
	ultimix.forms.confirm_submit( ConfirmString , Success );
}

/**
*	Function extracts value from item.
*
*	@param Item - Form item.
*
*	@return Item value.
*
*	@author Dodonov A.A.
*/
ultimix.forms.get_item_value = function( Item )
{
	var			TagName = jQuery( Item ).prop( 'tagName' ).toLowerCase();
	switch( TagName )
	{
		case( 'textarea' ):
		case( 'select' ):
			return( jQuery( Item ).val() );
		case( 'input' ):
			var			Type = jQuery( Item ).prop( 'type' ).toLowerCase();
			if( Type == 'checkbox' )
			{
				return( jQuery( Item ).prop( 'checked' ) ? 1 : 0 );
			}
			if( ( Type == 'radio' && jQuery( Item ).prop( 'checked' ) ) || Type == 'text' || 
					Type == 'hidden' || Type == 'password' )
			{
				return( jQuery( Item ).val() );
			}
	}
}

/**
*	Function extracts data from form.
*
*	@param Selector - Selector of the form.
*
*	@return Form data.
*
*	@author Dodonov A.A.
*/
ultimix.forms.extract_form_data = function( Selector )
{
	var			Items = jQuery( Selector ).find( '*' ).andSelf();
	var			Data = new Object();

	for( var i = 0 ; i < Items.length ; i++ )
	{
		if( jQuery( Items[ i ] ).attr( 'name' ) )
		{
			Data[ jQuery( Items[ i ] ).attr( 'name' ) ] = ultimix.forms.get_item_value( Items[ i ] );
		}
	}

	return( Data );
}

/**
*	Function opens update record form.
*
*	@param id - Id of the editing record.
*
*	@param Prefix - Prefix of the form.
*
*	@param Method - Submit method.
*
*	@author Dodonov A.A.
*/
ultimix.forms.update_record = function( id , Prefix , Method )
{
	ultimix.forms.submit_form_2( 
		Prefix + '_form' , Prefix + '_context_action' , 'update_record_form' , Prefix + '_record_id' , 
		id , '' , '' , false , Method
	);
}

/**
*	Function cancels searching.
*
*	@param ElementId - Element id.
*
*	@param Speed - Toggle speed.
*
*	@author Dodonov A.A.
*/
ultimix.forms.cancel_search = function( ElementId , Speed )
{
	if( document.getElementById( 'search_string' ).value == '' )
	{
		ultimix.ToggleElement( ElementId , Speed );
	}
	else
	{
		document.getElementById( 'search_string' ).value = '';
		window.location.href = window.location.href;
	}
}

/**
*	Function moves value to the other object.
*
*	@param Obj - Source object.
*
*	@param DestinationObjectId - Id of the destination object.
*
*	@author Dodonov A.A.
*/
ultimix.forms.move_value_to = function( Obj , DestinationObjectId )
{
	document.getElementById( DestinationObjectId ).value = Obj.value;
}
