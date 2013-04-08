						<div class="toolbar">
							{search_form:form_id={prefix}_form}{create_button}{copy_button}{search_button}{update_button}{delete_button}
						</div>
						<table border="0" width="100%">
							<tr>
								<td width="0%" class="table_header">
									{header_checkbox:name={prefix}}
								</td>
								<td width="10%" align="left" class="table_header">
									{sort_link:text={prefix}_alias;dbfield=alias}
								</td>
								<td width="20%" align="left" class="table_header">
									{sort_link:text={prefix}_template;dbfield=template}
								</td>
								<td width="10%" align="left" class="table_header">
									{sort_link:text={prefix}_template_version;dbfield=template_version}
								</td>
								<td width="60%" align="left" class="table_header">
									{lang:{prefix}_options}
								</td>
								<td width="0%" align="left" class="table_header">
								</td>
							</tr>{lang_file:package_name=page::page_manager}