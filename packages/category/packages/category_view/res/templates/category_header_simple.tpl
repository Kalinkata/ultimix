					{search_form:form_id={prefix}_form}{create_button}{search_button}{delete_button}{update_button}
					<input type="hidden" name="category_action" id="category_action" value="no_action">
					<input type="hidden" name="category_id" id="category_id" value="">
					<table border="0" width="100%">
						<tr>
							<td width="0%" class="table_header">
								{header_checkbox:name=category}
							</td>
							<td align="left" width="100%" class="table_header">
								{sort_link:text=category_title;dbfield=ctitle}
							</td>
						</tr>