					<div class="toolbar">
						{search_form}{create_form}{copy_form}{search_button}{update_button}{delete_button}
					</div>
					<table border="0" width="100%">
						<tr>
							<td width="0%" align="left" class="table_header">
								{header_checkbox:name={prefix}}
							</td>
							<td width="30%" align="left" class="table_header">
								{sort_link:text=domain;dbfield=domain}
							</td>
							<td width="70%" align="left" class="table_header">
								{sort_link:text=comment;dbfield=comment}
							</td>
						</tr>