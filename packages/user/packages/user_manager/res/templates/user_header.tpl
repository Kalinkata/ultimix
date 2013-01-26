					<div class="toolbar">
						{import_form:form_id=import_{prefix}_form}{search_form:form_id={prefix}_form}{toolbar_button:title=create_button;permit=user_manager;label=create;page=./admin_registration.html?back_page[eq]user_manager&user_context_action=create_record_form;package_name=gui::context_set::common_buttons;size=24;icon=create_024.gif}{copy_button}{search_button}{update_button}{delete_button}
						{toolbar_button:title=activate;permit=user_manager;label=activate;page=javascript:ultimix.user.activate_users( 'user' )[dot_comma];package_name=page::page_composer;size=24;icon=apply_024.gif}
						{toolbar_button:title=deactivate;permit=user_manager;label=deactivate;page=javascript:ultimix.user.deactivate_users( 'user' )[dot_comma];package_name=page::page_composer;size=24;icon=stop_024.gif}{export_button}{import_button}
					</div>
					<table border="0" width="100%">
						<tr>
							<td width="0%" class="table_header">
								{header_checkbox:name=user}
							</td>
							<td align="left" width="15%" class="table_header">
								{sort_link:text=user_login;dbfield=login}
							</td>
							<td align="left" width="15%" class="table_header">
								{sort_link:text=user_email;dbfield=email}
							</td>
							<td align="left" width="20%" class="table_header">
								{sort_link:text=user_name;dbfield=name}
							</td>
							<td align="left" width="10%" class="table_header">
								{sort_link:text=user_sex;dbfield=sex}
							</td>
							<td align="left" width="10%" class="table_header">
								{sort_link:text=site;dbfield=site}
							</td>
							<td align="left" width="10%" class="table_header">
								{sort_link:text=user_active;dbfield=active}
							</td>
							<td align="left" width="10%" class="table_header">
								{sort_link:text=active_to;dbfield=active_to}
							</td>
							<td align="left" width="10%" class="table_header">
								{sort_link:text=banned_to;dbfield=banned_to}
							</td>
						</tr>