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

//TODO: convert to lower case

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
ultimix.permit.add_permit = function( PermitName )
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

/**
*	Function sets list view options.
*
*	@param ViewOptions - Extra view generation options.
*
*	@return View options.
*
*	@author Dodonov A.A.
*/
ultimix.permit.set_default_options = function( ViewOptions )
{
	if( !ViewOptions )
	{
		ViewOptions = {};
	}

	ViewOptions.meta = ViewOptions.meta ? ViewOptions.meta : 'meta_permit_list';
	ViewOptions.package_name = ViewOptions.package_name ? ViewOptions.package_name : 'permit::permit_view';
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
ultimix.permit.get_list_form = function( Fuctions , ViewOptions )
{
	if( !Fuctions )
	{
		Fuctions = {};
	}

	ViewOptions = ultimix.permit.set_default_options( ViewOptions );

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
ultimix.permit.get_custom_list_form = function( Fuctions , Header , Item , Footer , ViewOptions )
{
	ultimix.auto.get_custom_list_form( Fuctions , Header , Item , Footer , false , ViewOptions , 'ad_banner' );
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
