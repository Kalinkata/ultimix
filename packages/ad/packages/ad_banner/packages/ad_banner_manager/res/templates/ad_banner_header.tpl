					<div class="toolbar">
						{search_form:form_id={prefix}_form}{create_button}{copy_button}{search_button}{update_button}{delete_button}
					</div>
					<table border="0" width="100%">
						<tr>
							<td width="0%" align="left" class="table_header">
								{header_checkbox:name={prefix}}
							</td>
							<td width="70%" align="left" class="table_header">
								{sort_link:text=ad_banner_code;dbfield=code}
							</td>
							<td width="10%" align="left" class="table_header">
								{sort_link:text=ad_banner_archived;dbfield=archived}
							</td>
							<td width="10%" align="left" class="table_header">
								{sort_link:text=ad_banner_shows;dbfield=shows}
							</td>
							<td width="10%" align="left" class="table_header">
								{sort_link:text=ad_banner_clicks;dbfield=clicks}
							</td>
						</tr>