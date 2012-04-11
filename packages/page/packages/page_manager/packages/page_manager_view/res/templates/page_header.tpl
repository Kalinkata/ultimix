						{search_form}{create_button}{search_button}{update_button}{delete_button}
						<table border="0" width="100%">
							<tr>
								<td width="0%" class="table_header">
									{header_checkbox:name={prefix}}
								</td>
								<td align="left" class="table_header">
									{sort_link:text={prefix}_alias;dbfield=alias}
								</td>
								<td align="left" class="table_header">
									{sort_link:text={prefix}_template;dbfield=template}
								</td>
								<td align="left" class="table_header">
									{sort_link:text={prefix}_template_version;dbfield=template_version}
								</td>
								<td align="left" class="table_header">
									{lang:{prefix}_options}
								</td>
								<td width="0%" align="left" class="table_header">
								</td>
							</tr>{lang_file:package_name=page::page_manager}