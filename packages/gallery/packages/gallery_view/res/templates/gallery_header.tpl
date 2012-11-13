					<div class="toolbar">
						{search_form:form_id={prefix}_form}{create_button}{copy_button}{search_button}{update_button}{update_button}
					</div>
					<table border="0" width="100%">
						<tr>
							<td width="0%" align="left" class="table_header">
								{header_checkbox:name={prefix}}
							</td>
							<td width="20%" align="left" class="table_header">
								{sort_link:text=surname;dbfield=surname}
							</td>
							<td width="20%" align="left" class="table_header">
								{sort_link:text=name;dbfield=name}
							</td>
							<td width="20%" align="left" class="table_header">
								{sort_link:text=second_name;dbfield=second_name}
							</td>
							<td width="20%" align="left" class="table_header">
								{sort_link:text=birth_date;dbfield=birth_date}
							</td>
							<td width="20%" align="left" class="table_header">
								&nbsp;
							</td>
						</tr>