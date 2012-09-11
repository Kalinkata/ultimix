					<div class="toolbar">
						{search_form}{create_button}{search_button}{delete_button}{update_button}
					</div>
					<input type="hidden" name="category_id" id="category_id" value="">
					<table border="0" width="100%">
						<tr>
							<td width="0%" class="table_header">
								{header_checkbox:name=category}
							</td>
							<td align="left" width="25%" class="table_header">
								{sort_link:text=category_title;dbfield=ctitle}
							</td>
							<td align="left" width="25%" class="table_header">
								{sort_link:text=category_root_title;dbfield=croot_title}
							</td>
							<td align="left" width="25%" class="table_header">
								{sort_link:text=category_direct_title;dbfield=cdirect_title}
							</td>
							<td align="left" width="25%" class="table_header">
								{sort_link:text=category_mask;dbfield=cmask}
							</td>
							<td align="left" width="25%" class="table_header">
								{sort_link:text=category_name;dbfield=category_name}
							</td>
						</tr>