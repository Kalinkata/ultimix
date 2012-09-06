
						<tr class="grid_row">
							<td class="table_row_{odd_factor}" valign="top">{item_checkbox:name={prefix};id={id}}</td>
							<td align="left" class="table_row_{odd_factor}" valign="top" {update_record:id={id};prefix={prefix}}>{title}</td>
							<td align="left" class="table_row_{odd_factor}" valign="top" {update_record:id={id};prefix={prefix}}>{comment}</td>
							<td align="left" class="table_row_{odd_factor}" valign="top" width="60%">{permit_list_for_object:object={id};type=group}</td>
							<td align="left" class="table_row_{odd_factor}" valign="top" width="0%">{href:tpl=submit2;form_id=group_form;param1=group_context_action;value1=change_permits;param2=group_record_id;value2={id};text=change}</td>
						</tr>