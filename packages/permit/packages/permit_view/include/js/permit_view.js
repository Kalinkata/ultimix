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
ultimix.permit.success_function = function( Data , Waiting )
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
ultimix.permit.submit_permit_button = function( Permit , MasterId , MasterType , Checkboxes , Action )
{
	ultimix.data_form.CreateForm();

	if( Checkboxes != '' )
	{
		if( !ultimix.grids.record_selected( Checkboxes , 'at_least_one_record_must_be_selected' ) )
		{
			return;
		}
		var			ids = ultimix.grids.get_identificators( Checkboxes );
		var			Data = { 'permit' : Permit , 'master_id' : MasterId , 'master_type' : MasterType , 'ids' : ids };
	}
	else
	{
		var			Data = { 'permit' : Permit , 'master_id' : MasterId , 'master_type' : MasterType };
	}
	Data[ Action ] = 1;

	var			Success = ultimix.permit.success_function( Data , true );
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
ultimix.permit.set_permit_button = function( Permit , MasterId , MasterType , Checkboxes )
{
	ultimix.permit.submit_permit_button( Permit , MasterId , MasterType , Checkboxes , 'set_permit' );
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
ultimix.permit.toggle_permit_button = function( Permit , MasterId , MasterType , Checkboxes )
{
	ultimix.permit.submit_permit_button( Permit , MasterId , MasterType , Checkboxes , 'toggle_permit' );
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
ultimix.permit.delete_permit_button = function( Permit , MasterId , MasterType , Checkboxes )
{
	ultimix.permit.submit_permit_button( Permit , MasterId , MasterType , Checkboxes , 'delete_permit' );
}

/**
*	Function adds permit to the user.
*	
*	@author Dodonov A.A.
*/
ultimix.permit.add_permit = function( PermitName )
{
	if( PermitName != '' )
	{
		document.getElementById( 'permit_list' ).removeChild( document.getElementById( PermitName + '_div_id_rest' ) );
		document.getElementById( 'all_permits_div_id' ).innerHTML += 
			"<div class='double_panel_row no_selection_text' id='" + PermitName + "_div_id'></div>";
		document.getElementById( PermitName + '_div_id' ).innerHTML += "<input type='hidden' id='" + PermitName + 
			"_field_id' name='permits[]' value='" + PermitName + 
			"'><a href=\"javascript:ultimix.permit.delete_permit( '" + 
			PermitName + "' );\">" + PermitName + "</a><br>";
	}
}

/**
*	Function deletes permit.
*	
*	@author Dodonov A.A.
*/
ultimix.permit.delete_permit = function( PermitName )
{
	if( PermitName != '' )
	{
		document.getElementById( 'all_permits_div_id' ).removeChild( 
			document.getElementById( PermitName + '_div_id' )
		);
		document.getElementById( 'permit_list' ).innerHTML += "<div class='double_panel_row no_selection_text' id='" + 
			PermitName + "_div_id_rest'></div>";
		document.getElementById( PermitName + '_div_id_rest' ).innerHTML += 
			" <a href=\"javascript:ultimix.permit.add_permit( '" + PermitName + "' );\">" + PermitName + "</a><br>";
	}
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
ultimix.permit.get_list_form = function( Fuctions , ViewOptions )
{
	ultimix.auto.get_list_form( Fuctions , ViewOptions , 'permit' , 'permit::permit_view' );
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
ultimix.permit.get_custom_list_form = function( Fuctions , Header , Item , Footer , ViewOptions )
{
	ultimix.auto.get_custom_list_form(
		Fuctions , Header , Item , Footer , false , ViewOptions , 'permit' , 'permit::permit_view'
	);
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
ultimix.permit.delete = function( Id , DataSelector )
{
	ultimix.auto.delete( 
		Id , DataSelector , 
		{ 
			'package_name' : 'permit::permit_controller' , 
			'permit_context_action' : 'delete_record' , 
			'permit_action' : 'delete_record' , 'permit_record_id' : Id , 
			'meta' : 'meta_delete_permit'
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
ultimix.permit.record_view_form = function( Id , DataSelector )
{
	ultimix.auto.record_view_form( 
		Id , DataSelector , 
		{
			'package_name' : 'permit::permit_view' , 'permit_context_action' : 'record_view_form' , 
			'permit_action' : 'record_view_form' , 'permit_record_id' : Id , 
			'meta' : 'meta_record_view_permit_form'
		}
	);
}
