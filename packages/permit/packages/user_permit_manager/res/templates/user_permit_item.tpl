
						<tr class="grid_row">
							<!--td class="table_row_{odd_factor}" valign="top" width="0%">{item_checkbox:name={prefix};id={id}}</td-->
							<td align="left" class="table_row_{odd_factor}" valign="top" width="10%">{login}</td>
							<td align="left" class="table_row_{odd_factor}" valign="top" width="45%">{group_list_for_object:object={id};type=user}</td>
							<td align="left" class="table_row_{odd_factor}" valign="top" width="0%">{href:tpl=submit2;form_id=user_permits_form;param1=user_permits_context_action;value1=change_groups;param2=user_permits_record_id;value2={id};text=change}</td>
							<td align="left" class="table_row_{odd_factor}" valign="top" width="45%">{permit_list_for_object:object={id};type=user}</td>
							<td align="left" class="table_row_{odd_factor}" valign="top" width="0%">{href:tpl=submit2;form_id=user_permits_form;param1=user_permits_context_action;value1=change_permits;param2=user_permits_record_id;value2={id};text=change}</td>
						</tr>