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
if( !ultimix.grids )
{
	ultimix.grids = {};
}

/**
*	Function checks that at least one element was selected.
*
*	@param Name - Selector of the checkboxes.
*
*	@param ErrorMessage - Error message.
*
*	@return true if at least one element was selected.
*
*	@author Dodonov A.A.
*/
ultimix.forms.tree_item_selected = function( Name , ErrorMessage )
{
	if( !jQuery( '.tree_' + Name ).jstree )
	{
		return( false );
	}

	var 		Node = jQuery( '.tree_' + Name ).jstree( 'get_selected' );

	if( Node.length )
	{
		return( true );
	}

	if( ErrorMessage )
	{
		ultimix.std_dialogs.ErrorMessageBox( ErrorMessage );
	}

	return( false );
}

/**
*	Saving selected node.
*
*	@param Name - Name of the entity.
*
*	@author Dodonov A.A.
*/
ultimix.forms.get_selected_node_id = function( Name )
{
	if( ultimix.forms.tree_item_selected( Name ) )
	{
		var			Node = ultimix.jstree.get_selected_node( '.tree_' + Name );

		var			id = jQuery( Node ).attr( 'id' );

		id = ultimix.string_utilities.str_replace( 'phtml_' , '' , id );

		return( id );
	}

	return( -1 );
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
ultimix.grids.record_selected = function( Name , ErrorMessage )
{
	if( ultimix.grids.record_selected_ex( '._' + Name + '_item_checkbox' , ErrorMessage ) )
	{
		return( true );
	}

	if( ultimix.forms.tree_item_selected( Name , ErrorMessage ) )
	{
		return( true );
	}

	return( false );
}

/**
*	Function resets checkboxes.
*
*	@param Name - Suffix of the checkboxes group.
*
*	@param Value - true/false.
*
*	@author Dodonov A.A.
*/
ultimix.grids.set_checkboxes = function( Name , Value )
{
	jQuery( '._' + Name + '_item_checkbox' ).prop( 'checked' , Value );
	jQuery( '._' + Name + '_header_checkbox' ).prop( 'checked' , Value );
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
ultimix.grids.record_selected_ex = function( Selector , ErrorMessage )
{
	var			Items = jQuery( Selector );
	
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
ultimix.grids.get_identificators = function( Name )
{
	return( ultimix.grids.get_identificators_ex( '._' + Name + '_item_checkbox' ) );
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
ultimix.grids.get_identificators_ex = function( Selector )
{
	var			Identificators = new Array();
	
	var			Items = jQuery( Selector );
	
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
ultimix.grids.toggle_children_checkboxes = function( Checkbox )
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
				ultimix.grids.toggle_children_checkboxes( this );
			}
		}
	);
}

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
			ultimix.grids.try_toggle_parent_checkbox( this );
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
ultimix.grids.try_toggle_parent_checkbox = function( Checkbox )
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
ultimix.grids.process_linked_checkboxes = function( Checkbox )
{
	ultimix.grids.toggle_children_checkboxes( Checkbox );
	ultimix.grids.try_toggle_parent_checkbox( Checkbox );
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
ultimix.grids.submit_form_0_mass = function( FormId , ConfirmString , Action , Name , NotSelectedErrorMessage , 
																									Waiting , Method )
{
	if( ultimix.grids.record_selected( Name ) == false )
	{
		ultimix.std_dialogs.ErrorMessageBox( NotSelectedErrorMessage );
		return;
	}

	ultimix.grids.store_selected_node( Name );

	ultimix.forms.submit_form_0( FormId , ConfirmString , Action , Waiting , Method );
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
ultimix.grids.submit_form_1_mass = function( FormId , Param1 , Value1 , ConfirmString , Action , Name , 
																			NotSelectedErrorMessage , Waiting , Method )
{
	if( ultimix.grids.record_selected( Name ) == false )
	{
		ultimix.std_dialogs.ErrorMessageBox( NotSelectedErrorMessage );
		return;
	}

	ultimix.forms.submit_form_1( FormId , Param1, Value1 , ConfirmString , Action , Waiting , Method );
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
ultimix.grids.submit_form_2_mass = function( FormId , Param1 , Value1 , Param2 , Value2 , ConfirmString , Action , 
																	Name , NotSelectedErrorMessage , Waiting , Method )
{
	if( ultimix.grids.record_selected( Name ) == false )
	{
		ultimix.std_dialogs.ErrorMessageBox( NotSelectedErrorMessage );
		return;
	}

	Value2 = ultimix.forms.get_selected_node_id( Name );

	ultimix.forms.submit_form_2( FormId , Param1, Value1 , Param2, Value2 , ConfirmString , Action , Waiting );
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
ultimix.grids.submit_form_3_mass = function( FormId , Param1 , Value1 , Param2 , Value2 , Param3 , Value3 , 
										ConfirmString , Action , Name , NotSelectedErrorMessage , Waiting , Method )
{
	if( ultimix.grids.record_selected( Name ) == false )
	{
		ultimix.std_dialogs.ErrorMessageBox( NotSelectedErrorMessage );
		return;
	}

	Value2 = ultimix.forms.get_selected_node_id( Name );

	ultimix.forms.submit_form_3( 
		FormId , Param1, Value1 , Param2, Value2 , Param3, Value3 , ConfirmString , Action , Waiting 
	);
}
