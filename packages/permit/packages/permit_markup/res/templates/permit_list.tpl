					<form method="post" id="permit_form_id" class="form_640">
						<input type="hidden" name="context_action" value="change_permits">
						<input type="hidden" name="action" value="save_permits">
						<input type="hidden" name="record_id" value="{object}">
						<table border="0">
							<tr>
								<td valign="top" class="table_header">
									{lang:already_added_permits}
								</td>
								<td valign="top" class="table_header"">
									{lang:permit_to_add}
								</td>
							</tr>
							<tr>
								<td valign="top" class="table_row_even padding_10">
									<div id="all_permits_div_id" class="panel_250 width_300">
										{object_permits}
									</div>
								</td>
								<td valign="top" class="table_row_even padding_10">
									<div id="permit_list" class="panel_250 width_300">
										{rest_permits}
									</div>
								</td>
							</tr>
							<tr>
								<td colspan="2" align="center">
									{href:tpl=submit0;form_id=permit_form_id;text=save}&nbsp;{href:tpl=std;page={http_param:name=page_name;type=command;get=1}.html;text=cancel}
								</td>
							</tr>
						</table>
					</form>