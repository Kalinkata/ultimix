						<div class="toolbar">
						{search_form:form_id={prefix}_form}{create_button}{search_button}{copy_button}{update_button}{delete_button}
						</div>
						<table border="0" width="100%">
							<tr>
								<td width="0%" class="table_header">
									{header_checkbox:name={prefix}}
								</td>
								<td width="10%" align="left" class="table_header">
									{sort_link:text={prefix}_title;dbfield=title}
								</td>
								<td width="10%" align="left" class="table_header">
									{sort_link:text={prefix}_author;dbfield=author_name}
								</td>
								<td width="24%" align="left" class="table_header">
									{sort_link:text={prefix}_creation_date;dbfield=creation_date}
								</td>
								<td width="24%" align="left" class="table_header">
									{sort_link:text={prefix}_modification_date;dbfield=modification_date}
								</td>
								<td width="24%" align="left" class="table_header">
									{sort_link:text={prefix}_publication_date;dbfield=publication_date}
								</td>
								<td width="10%" align="left" class="table_header">
									{sort_link:text={prefix}_category;dbfield=category_title}
								</td>
							</tr>