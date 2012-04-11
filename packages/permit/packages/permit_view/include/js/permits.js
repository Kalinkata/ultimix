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
if( !ultimix.permit )
{
	ultimix.permit = {};
}

/**
*	Submit form function.
*
*	@param Data - Form data.
*
*	@param Waiting - Should be progress window be displayed.
*
*	@author Dodonov A.A.
*/
ultimix.permit.SuccessFunction = function( Data , Waiting )
{
	return(
		function( Result )
		{
			if( Result == ultimix.std_dialogs.MB_YES )
			{
				ultimix.data_form.AddDataToForm( Data );
				document.getElementById( 'data_form' ).submit();
				if( Waiting )
				{
					ultimix.std_dialogs.MessageBox( 
						ultimix.get_string( 'wait_please' ) , ultimix.get_string( 'Info' ) , 
						ultimix.std_dialogs.MB_ICONLOADING | ultimix.std_dialogs.MB_MODAL
					);
				}
			}
		}
	);
}

/**
*	Function processes permit manipulations.
*
*	@param Permit - Permit.
*
*	@param MasterId - Master object's id.
*
*	@param MasterType - Master object's type.
*
*	@param Checkboxes - Name of the checkbox group.
*
*	@param Action - Name of the action.
*
*	@author Dodonov A.A.
*/
ultimix.permit.SubmitPermitButton = function( Permit , MasterId , MasterType , Checkboxes , Action )
{
	ultimix.data_form.CreateForm();

	if( Checkboxes != '' )
	{
		if( !ultimix.grids.RecordSelected( Checkboxes , 'at_least_one_record_must_be_selected' ) )
		{
			return;
		}
		var			ids = ultimix.grids.GetIdentificators( Checkboxes );
		var			Data = { 'permit' : Permit , 'master_id' : MasterId , 'master_type' : MasterType , 'ids' : ids };
	}
	else
	{
		var			Data = { 'permit' : Permit , 'master_id' : MasterId , 'master_type' : MasterType };
	}
	Data[ Action ] = 1;

	var			Success = ultimix.permit.SuccessFunction( Data , true );
	ultimix.std_dialogs.QuestionMessageBox( ultimix.get_string( 'are_you_shure' ) , Success )
}

/**
*	Function sets permit for the object.
*
*	@param Permit - Permit.
*
*	@param MasterId - Master object's id.
*
*	@param MasterType - Master object's type.
*
*	@param Checkboxes - Name of the checkbox group.
*
*	@author Dodonov A.A.
*/
ultimix.permit.SetPermitButton = function( Permit , MasterId , MasterType , Checkboxes )
{
	ultimix.permit.SubmitPermitButton( Permit , MasterId , MasterType , Checkboxes , 'set_permit' );
}

/**
*	Function toggles permit for the object.
*
*	@param Permit - Permit.
*
*	@param MasterId - Master object's id.
*
*	@param MasterType - Master object's type.
*
*	@param Checkboxes - Name of the checkbox group.
*
*	@author Dodonov A.A.
*/
ultimix.permit.TogglePermitButton = function( Permit , MasterId , MasterType , Checkboxes )
{
	ultimix.permit.SubmitPermitButton( Permit , MasterId , MasterType , Checkboxes , 'toggle_permit' );
}

/**
*	Function deletes permit for the object.
*
*	@param Permit - Permit.
*
*	@param MasterId - Master object's id.
*
*	@param MasterType - Master object's type.
*
*	@param Checkboxes - Name of the checkbox group.
*
*	@author Dodonov A.A.
*/
ultimix.permit.DeletePermitButton = function( Permit , MasterId , MasterType , Checkboxes )
{
	ultimix.permit.SubmitPermitButton( Permit , MasterId , MasterType , Checkboxes , 'delete_permit' );
}

/**
*	Function adds permit to the user.
*	
*	@author Dodonov A.A.
*/
function	AddPermit( PermitName )
{
	if( PermitName != '' )
	{
		document.getElementById( 'permit_list' ).removeChild( document.getElementById( PermitName + '_div_id_rest' ) );
		document.getElementById( 'all_permits_div_id' ).innerHTML += 
			"<div class='double_panel_row no_selection_text' id='" + PermitName + "_div_id'></div>";
		document.getElementById( PermitName + '_div_id' ).innerHTML += "<input type='hidden' id='" + PermitName + 
			"_field_id' name='permits[]' value='" + PermitName + "'><a href=\"javascript:DeletePermit( '" + 
			PermitName + "' );\">" + PermitName + "</a><br>";
	}
}

/**
*	Function deletes permit.
*	
*	@author Dodonov A.A.
*/
function	DeletePermit( PermitName )
{
	if( PermitName != '' )
	{
		document.getElementById( 'all_permits_div_id' ).removeChild( 
			document.getElementById( PermitName + '_div_id' )
		);
		document.getElementById( 'permit_list' ).innerHTML += "<div class='double_panel_row no_selection_text' id='" + 
			PermitName + "_div_id_rest'></div>";
		document.getElementById( PermitName + '_div_id_rest' ).innerHTML += " <a href=\"javascript:AddPermit( '" + 
			PermitName + "' );\">" + PermitName + "</a><br>";
	}
}
