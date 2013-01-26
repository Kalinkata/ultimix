						<div class="toolbar">
							{search_form:form_id={prefix}_form}{create_button}{copy_button}{search_button}{update_button}{delete_button}
						</div>
						<table border="0" width="100%">
							<tr>
								<td width="0%" class="table_header">
									{header_checkbox:name={prefix}}
								</td>
								<td width="20%" align="left" class="table_header">
									{sort_link:text={prefix}_page;dbfield=page}
								</td>
								<td width="70%" align="left" class="table_header">
									{sort_link:text={prefix}_root_page;dbfield=root_page}
								</td>
								<td width="10%" align="left" class="table_header">
									{sort_link:text={prefix}_navigation;dbfield=navigation}
								</td>
							</tr>