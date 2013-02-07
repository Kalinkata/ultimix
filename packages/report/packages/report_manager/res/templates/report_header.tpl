					<div class="toolbar">
						{search_form:form_id={prefix}_form}{create_button}{copy_button}{search_button}{update_button}{delete_button}
					</div>
					<table border="0" width="100%">
						<tr>
							<td width="0%" align="left" class="table_header">
								{header_checkbox:name={prefix}}
							</td>
							<td width="30%" align="left" class="table_header">
								{sort_link:text=name;dbfield=name}
							</td>
							<td width="35%" align="left" class="table_header">
								{sort_link:text=package_name;dbfield=package_name}
							</td>
							<td width="35%" align="left" class="table_header">
								{sort_link:text=package_version;dbfield=package_version}
							</td>
						</tr>