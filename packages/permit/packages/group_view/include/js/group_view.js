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
if( !ultimix.group )
{
	ultimix.group = {};
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
ultimix.permit.submit_group_button = function( Group , MasterId , MasterType , Checkboxes , Action )
{
	ultimix.data_form.CreateForm();
	
	if( Checkboxes != '' )
	{
		if( !ultimix.grids.record_selected( Checkboxes , 'at_least_one_record_must_be_selected' ) )
		{
			return;
		}
		
		var			ids = ultimix.grids.get_identificators( Checkboxes );
		var			Data = { 'group' : Group , 'master_id' : MasterId , 'master_type' : MasterType , 'ids' : ids };
	}
	else
	{
		var			Data = { 'group' : Group , 'master_id' : MasterId , 'master_type' : MasterType };
	}
	
	Data[ Action ] = 1;
	
	var			Success = ultimix.permit.success_function( Data , true );
	
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
ultimix.permit.set_group_button = function( Group , MasterId , MasterType , Checkboxes )
{
	ultimix.permit.submit_group_button( Group , MasterId , MasterType , Checkboxes , 'set_group' );
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
ultimix.permit.toggle_group_button = function( Group , MasterId , MasterType , Checkboxes )
{
	ultimix.permit.submit_group_button( Group , MasterId , MasterType , Checkboxes , 'toggle_group' );
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
ultimix.permit.delete_group_button = function( Group , MasterId , MasterType , Checkboxes )
{
	ultimix.permit.submit_group_button( Group , MasterId , MasterType , Checkboxes , 'delete_group' );
}

/**
*	Function adds group of permits to the user.
*	
*	@author Dodonov A.A.
*/
ultimix.permit.add_group = function( GroupName )
{
	if( GroupName != '' )
	{
		document.getElementById( 'group_list' ).removeChild( document.getElementById( GroupName + '_div_id_rest' ) );
		document.getElementById( 'all_groups_div_id' ).innerHTML += 
				"<div class='double_panel_row no_selection_text' id='" + GroupName + "_div_id'></div>";
		document.getElementById( GroupName + '_div_id' ).innerHTML += "<input type='hidden' id='" + GroupName + 
			"_field_id' name='groups[]' value='" + GroupName + 
			"'><a href=\"javascript:ultimix.permit.delete_group( '" + GroupName + 
			"' );\">" + GroupName + "</a><br>";
	}
}

/**
*	Function deletes group of permits.
*	
*	@author Dodonov A.A.
*/
ultimix.permit.delete_group = function( GroupName )
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

/**
*	Function sets list view options.
*
*	@param ViewOptions - Extra view generation options.
*
*	@return View options.
*
*	@author Dodonov A.A.
*/
ultimix.group.set_default_options = function( ViewOptions )
{
	if( !ViewOptions )
	{
		ViewOptions = {};
	}

	ViewOptions.meta = ViewOptions.meta ? ViewOptions.meta : 'meta_group_list';
	ViewOptions.package_name = ViewOptions.package_name ? ViewOptions.package_name : 'permit::group_view';
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
ultimix.group.get_list_form = function( Fuctions , ViewOptions )
{
	if( !Fuctions )
	{
		Fuctions = {};
	}

	ViewOptions = ultimix.group.set_default_options( ViewOptions );

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
ultimix.group.get_custom_list_form = function( Fuctions , Header , Item , Footer , ViewOptions )
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
ultimix.group.delete = function( Id , DataSelector )
{
	ultimix.auto.delete( 
		Id , DataSelector , 
		{ 
			'package_name' : 'permit::group_controller' , 
			'group_context_action' : 'delete_record' , 
			'group_action' : 'delete_record' , 'group_record_id' : Id , 
			'meta' : 'meta_delete_group'
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
ultimix.group.record_view_form = function( Id , DataSelector )
{
	ultimix.auto.record_view_form( 
		Id , DataSelector , 
		{
			'package_name' : 'permit::group_view' , 'group_context_action' : 'record_view_form' , 
			'group_action' : 'record_view_form' , 'group_record_id' : Id , 
			'meta' : 'meta_record_view_group_form'
		}
	);
}
