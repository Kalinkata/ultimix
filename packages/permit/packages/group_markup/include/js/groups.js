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
*	Function processes group manipulations.
*
*	@param Group - Group.
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
ultimix.permit.SubmitGroupButton = function( Group , MasterId , MasterType , Checkboxes , Action )
{
	ultimix.data_form.CreateForm();
	
	if( Checkboxes != '' )
	{
		if( !ultimix.grids.RecordSelected( Checkboxes , 'at_least_one_record_must_be_selected' ) )
		{
			return;
		}
		
		var			ids = ultimix.grids.GetIdentificators( Checkboxes );
		var			Data = { 'group' : Group , 'master_id' : MasterId , 'master_type' : MasterType , 'ids' : ids };
	}
	else
	{
		var			Data = { 'group' : Group , 'master_id' : MasterId , 'master_type' : MasterType };
	}
	
	Data[ Action ] = 1;
	
	var			Success = ultimix.permit.SuccessFunction( Data , true );
	
	ultimix.std_dialogs.MessageBox( ultimix.get_string( 'are_you_shure' ) , ultimix.get_string( 'Question' ) , 
	ultimix.std_dialogs.MB_YESNO | ultimix.std_dialogs.MB_ICONQUESTION | ultimix.std_dialogs.MB_MODAL , Success );
	return;
	
	Success( ultimix.std_dialogs.MB_YES );
}

/**
*	Function sets group for the object.
*
*	@param Group - Group.
*
*	@param MasterId - Master object's id.
*
*	@param MasterType - Master object's type.
*
*	@param Checkboxes - Name of the checkbox group.
*
*	@author Dodonov A.A.
*/
ultimix.permit.SetGroupButton = function( Group , MasterId , MasterType , Checkboxes )
{
	ultimix.permit.SubmitGroupButton( Group , MasterId , MasterType , Checkboxes , 'set_group' );
}

/**
*	Function toggles group for the object.
*
*	@param Group - Group.
*
*	@param MasterId - Master object's id.
*
*	@param MasterType - Master object's type.
*
*	@param Checkboxes - Name of the checkbox group.
*
*	@author Dodonov A.A.
*/
ultimix.permit.ToggleGroupButton = function( Group , MasterId , MasterType , Checkboxes )
{
	ultimix.permit.SubmitGroupButton( Group , MasterId , MasterType , Checkboxes , 'toggle_group' );
}

/**
*	Function deletes group for the object.
*
*	@param Group - Group.
*
*	@param MasterId - Master object's id.
*
*	@param MasterType - Master object's type.
*
*	@param Checkboxes - Name of the checkbox group.
*
*	@author Dodonov A.A.
*/
ultimix.permit.DeleteGroupButton = function( Group , MasterId , MasterType , Checkboxes )
{
	ultimix.permit.SubmitGroupButton( Group , MasterId , MasterType , Checkboxes , 'delete_group' );
}

/**
*	Function adds group of permits to the user.
*	
*	@author Dodonov A.A.
*/
function	AddGroup( GroupName )
{
	if( GroupName != '' )
	{
		document.getElementById( 'group_list' ).removeChild( document.getElementById( GroupName + '_div_id_rest' ) );
		document.getElementById( 'all_groups_div_id' ).innerHTML += 
				"<div class='double_panel_row no_selection_text' id='" + GroupName + "_div_id'></div>";
		document.getElementById( GroupName + '_div_id' ).innerHTML += "<input type='hidden' id='" + GroupName + 
			"_field_id' name='groups[]' value='" + GroupName + "'><a href=\"javascript:DeleteGroup( '" + GroupName + 
			"' );\">" + GroupName + "</a><br>";
	}
}

/**
*	Function deletes group of permits.
*	
*	@author Dodonov A.A.
*/
function	DeleteGroup( GroupName )
{
	if( GroupName != '' )
	{
		document.getElementById( 'all_groups_div_id' ).removeChild( document.getElementById( GroupName + '_div_id' ) );
		document.getElementById( 'group_list' ).innerHTML += "<div class='double_panel_row no_selection_text' id='" + 
			GroupName + "_div_id_rest'></div>";
		document.getElementById( GroupName + '_div_id_rest' ).innerHTML += " <a href=\"javascript:AddGroup( '" + 
			GroupName + "' );\">" + GroupName + "</a><br>";
	}
}
