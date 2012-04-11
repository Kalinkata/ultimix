/**
*	Global namespace.
*
*	@author Dodonov A.A.
*/
if( !ultimix )
{
	ultimix = {};
}

// TODO: move to gui::href_markup

/**
*	Local namespace.
*
*	@author Dodonov A.A.
*/
if( !ultimix.grids )
{
	ultimix.grids = {};
}

/**
*	Function checks that at least one checkbox was selected.
*
*	@param Name - Suffix of the checkboxes group.
*
*	@param ErrorMessage - Error message.
*
*	@return true if at least one checkbox was selected.
*
*	@author Dodonov A.A.
*/
ultimix.grids.RecordSelected = function( Name , ErrorMessage )
{
	return( ultimix.grids.RecordSelectedEx( '._' + Name + '_item_checkbox' , ErrorMessage ) );
}

/**
*	Function checks that at least one checkbox was selected.
*
*	@param Selector - Selector of the checkboxes.
*
*	@param ErrorMessage - Error message.
*
*	@return true if at least one checkbox was selected.
*
*	@author Dodonov A.A.
*/
ultimix.grids.RecordSelectedEx = function( Selector , ErrorMessage )
{
	var		Items = jQuery( Selector );
	
	for( i = 0 ; i < Items.length ; i++ )
	{
		if( jQuery( Items[ i ] ).prop( 'checked' ) )
		{
			return( true );
		}
	}

	if( ErrorMessage )
	{
		ultimix.std_dialogs.ErrorMessageBox( ErrorMessage );
	}

	return( false );
}

/**
*	Function returns a list of the ids of the selected checkboxes.
*
*	@param Name - Suffix of the checkboxes group.
*
*	@return Array with the ids array.
*
*	@author Dodonov A.A.
*/
ultimix.grids.GetIdentificators = function( Name )
{
	return( ultimix.grids.GetIdentificatorsEx( '._' + Name + '_item_checkbox' ) );
}

/**
*	Function returns a list of the ids of the selected checkboxes.
*
*	@param Selector - Selector of the checkboxes.
*
*	@return Array with the ids array.
*
*	@author Dodonov A.A.
*/
ultimix.grids.GetIdentificatorsEx = function( Selector )
{
	var		Identificators = new Array();
	
	var		Items = jQuery( Selector );
	
	for( var i = 0 ; i < Items.length ; i++ )
	{
		if( jQuery( Items[ i ] ).prop( 'checked' ) )
		{
			Identificators.push( ( new String( jQuery( Items[ i ] ).attr( 'id' ) ) ).replace( '_id_' , '' ) );
		}
	}
	
	return( Identificators );
}

/**
*	Function processes clicks on the children checkboxes.
*
*	@param Checkbox - Object of the clicked checkbox.
*
*	@author Dodonov A.A.
*/
ultimix.grids.ToggleChildrenCheckboxes = function( Checkbox )
{
	var			ChildrenSelector = jQuery( Checkbox ).attr( 'children_selector' );
	
	var			Checked = jQuery( Checkbox ).prop( 'checked' );
	
	jQuery( ChildrenSelector ).each(
		function()
		{
			jQuery( this ).prop( 'checked' , Checked );
			
			/* if has children */
			if( jQuery( this ).attr( 'children_selector' ) )
			{
				/* ... then toggle children */
				ultimix.grids.ToggleChildrenCheckboxes( this );
			}
		}
	);
}

// TODO convert to lowercase

/**
*	Function processes clicks on the parent checkboxes.
*
*	@param ParentSelector - Selector of the parent.
*
*	@param Checked - Check flag, true/false.
*
*	@author Dodonov A.A.
*/
ultimix.grids.toggle_parent = function( ParentSelector , Checked )
{
	jQuery( ParentSelector ).each(
		function()
		{
			jQuery( this ).prop( 'checked' , Checked );
			ultimix.grids.TryToggleParentCheckbox( this );
		}
	);
}

/**
*	Function processes clicks on the parent checkboxes.
*
*	@param Checkbox - Object of the clicked checkbox.
*
*	@author Dodonov A.A.
*/
ultimix.grids.TryToggleParentCheckbox = function( Checkbox )
{
	var			ParentSelector = jQuery( Checkbox ).attr( 'parent_selector' );
	if( ParentSelector )
	{
		/* try to toggle it */
		var			Checked = jQuery( Checkbox ).prop( 'checked' );
		if( Checked )
		{
			var			SiblingsSelector = jQuery( Checkbox ).attr( 'siblings_selector' );
			if( jQuery( SiblingsSelector ).length == jQuery( SiblingsSelector ).filter( ':checked' ).length )
			{
				ultimix.grids.toggle_parent( ParentSelector , Checked );
			}
		}
		else
		{
			ultimix.grids.toggle_parent( ParentSelector , Checked );
		}
	}
}

/**
*	OnClick event handler.
*
*	@param Checkbox - Object of the clicked checkbox.
*
*	@author Dodonov A.A.
*/
ultimix.grids.ProcessLinkedCheckboxes = function( Checkbox )
{
	ultimix.grids.ToggleChildrenCheckboxes( Checkbox );
	ultimix.grids.TryToggleParentCheckbox( Checkbox );
}

/**
*	Function submits form.
*
*	@param FormId - id of the form to be submitted.
*
*	@param Action - Destination page.
*
*	@param ConfirmString - Confirmation string.
*
*	@param Name - Name of the checkbox group.
*
*	@param NotSelectedErrorMessage - Error message.
*
*	@param Waiting - Showd user be warned.
*
*	@param Method - Submit method.
*
*	@author Dodonov A.A.
*/
ultimix.grids.SubmitForm0Mass = function( FormId , ConfirmString , Action , Name , NotSelectedErrorMessage , 
																									Waiting , Method )
{
	if( ultimix.grids.RecordSelected( Name ) == false )
	{
		ultimix.std_dialogs.ErrorMessageBox( NotSelectedErrorMessage );
		return;
	}

	ultimix.forms.SubmitForm0( FormId , ConfirmString , Action , Waiting , Method );
}

/**
*	Function submits form.
*
*	@param FormId - id of the form to be submitted.
*
*	@param Param1 - First parameter.
*
*	@param Value1 - First parameter's value.
*
*	@param Action - Destination page.
*
*	@param ConfirmString - Confirmation string.
*
*	@param Name - Name of the checkbox group.
*
*	@param NotSelectedErrorMessage - Error message.
*
*	@param Waiting - Showd user be warned.
*
*	@param Method - Submit method.
*
*	@author Dodonov A.A.
*/
ultimix.grids.SubmitForm1Mass = function( FormId , Param1, Value1 , ConfirmString , Action , Name , 
																			NotSelectedErrorMessage , Waiting , Method )
{
	if( ultimix.grids.RecordSelected( Name ) == false )
	{
		ultimix.std_dialogs.ErrorMessageBox( NotSelectedErrorMessage );
		return;
	}

	ultimix.forms.SubmitForm1( FormId , Param1, Value1 , ConfirmString , Action , Waiting , Method );
}

/**
*	Function submits form.
*
*	@param FormId - id of the form to be submitted.
*
*	@param Param1 - First parameter.
*
*	@param Value1 - First parameter's value.
*
*	@param Param2 - Second parameter.
*
*	@param Value2 - Second parameter's value.
*
*	@param Action - Destination page.
*
*	@param ConfirmString - Confirmation string.
*
*	@param Name - Name of the checkbox group.
*
*	@param NotSelectedErrorMessage - Error message.
*
*	@param Waiting - Showd user be warned.
*
*	@param Method - Submit method.
*
*	@author Dodonov A.A.
*/
ultimix.grids.SubmitForm2Mass = function( FormId , Param1, Value1 , Param2, Value2 , ConfirmString , Action , Name , 
																			NotSelectedErrorMessage , Waiting , Method )
{
	if( ultimix.grids.RecordSelected( Name ) == false )
	{
		ultimix.std_dialogs.ErrorMessageBox( NotSelectedErrorMessage );
		return;
	}
	
	ultimix.forms.SubmitForm2( FormId , Param1, Value1 , Param2, Value2 , ConfirmString , Action , Waiting );
}

/**
*	Function submits form.
*
*	@param FormId - id of the form to be submitted.
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
*	@param Action - Destination page.
*
*	@param ConfirmString - Confirmation string.
*
*	@param Name - Name of the checkbox group.
*
*	@param NotSelectedErrorMessage - Error message.
*
*	@param Waiting - Showd user be warned.
*
*	@param Method - Submit method.
*
*	@author Dodonov A.A.
*/
ultimix.grids.SubmitForm3Mass = function( FormId , Param1, Value1 , Param2, Value2 , Param3, Value3 , ConfirmString , 
															Action , Name , NotSelectedErrorMessage , Waiting , Method )
{
	if( ultimix.grids.RecordSelected( Name ) == false )
	{
		ultimix.std_dialogs.ErrorMessageBox( NotSelectedErrorMessage );
		return;
	}
	
	ultimix.forms.SubmitForm3( 
		FormId , Param1, Value1 , Param2, Value2 , Param3, Value3 , ConfirmString , Action , Waiting
	);
}
