						<div class="toolbar">
							{search_form}{create_button}{copy_button}{search_button}{update_button}{delete_button}
						</div>
						<table border="0" width="100%">
							<tr>
								<td width="0%" class="table_header">
									{header_checkbox:name={prefix}}
								</td>
								<td width="20%" align="left" class="table_header">
									{sort_link:text={prefix}_group;dbfield=title}
								</td>
								<td width="20%" align="left" class="table_header">
									{sort_link:text={prefix}_comment;dbfield=comment}
								</td>
								<td width="60%" align="left" class="table_header" colspan="2">
									{lang:permits}
								</td>
							</tr>