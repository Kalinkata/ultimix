					<div class="toolbar">
						{search_form}{toolbar_button:title=create_button;permit=user_manager;label=create;page=./admin_registration.html?back_page[eq]user_manager;package_name=gui::context_set::common_buttons;size=24;icon=create_24.gif}{search_button}{update_button}{copy_button}{delete_button}{href:text=activate;page=javascript:ultimix.user.ActivateUsers( 'user' )[dot_comma]}
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