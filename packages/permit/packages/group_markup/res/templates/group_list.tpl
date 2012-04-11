					<form method="post" id="group_form_id" class="form_600">
						<input type="hidden" name="context_action" value="change_groups">
						<input type="hidden" name="action" value="save_groups">
						<input type="hidden" name="record_id" value="{object}">
						<table border="0">
							<tr>
								<td width="300px" valign="top" class="table_header padding_10">
									{lang:already_added_groups}
								</td>
								<td width="300px" valign="top" class="table_header padding_10">
									{lang:groups_to_add}
								</td>
							</tr>
							<tr height="250px">
								<td width="300px" valign="top" class="table_row_even padding_10">
									<div id='all_groups_div_id'>
										{object_groups}
									</div>
								</td>
								<td width="300px" valign="top" class="table_row_even padding_10">
									<div id='group_list'>
										{rest_groups}
									</div>
								</td>
							</tr>
							<tr>
								<td colspan="2" align="center">
									{href:tpl=submit0;form_id=group_form_id;text=save}&nbsp;{href:tpl=std;page={http_param:name=page_name;type=command;get=1}.html;text=cancel}
								</td>
							</tr>
						</table>
					</form>