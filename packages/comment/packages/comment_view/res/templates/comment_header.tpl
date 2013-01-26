					<div class="toolbar">
						{search_form:form_id={prefix}_form}{create_button}{copy_button}{search_button}{delete_button}
					</div>
					<table border="0" width="100%">
						<tr>
							<td width="0%" align="left" class="table_header">
								{header_checkbox:name={prefix}}
							</td>
							<td width="10%" align="left" class="table_header">
								{sort_link:text=author_login;dbfield=author_login}
							</td>
							<td width="60%" align="left" class="table_header">
								{sort_link:text=comment;dbfield=comment}
							</td>
							<td width="20%" align="left" class="table_header">
								{sort_link:text=creation_date;dbfield=creation_date}
							</td>
							<td width="10%" align="left" class="table_header">
								{sort_link:text=page;dbfield=page}
							</td>
						</tr>