
						<tr class="grid_row">
							<td class="table_row_{odd_factor}" valign="top" valign="top">{item_checkbox:name={prefix};id={alias}}</td>
							<td align="left" class="table_row_{odd_factor}" valign="top">{href:tpl=blank;page=./{alias}.html;raw_text={alias}}</td>
							<td align="left" class="table_row_{odd_factor}" valign="top" {update_record:id={alias};prefix={prefix}}>{template}</td>
							<td align="left" class="table_row_{odd_factor}" valign="top" {update_record:id={alias};prefix={prefix}}>{template_version}</td>
							<td align="left" class="table_row_{odd_factor}" valign="top" {update_record:id={alias};prefix={prefix}}>{options}</td>
							<td align="left" class="table_row_{odd_factor}" valign="top">{href:tpl=submit2;text=packages;form_id=page_form;param1=page_context_action;value1=update_packages_form;param2=page_record_id;value2={alias}}&nbsp;{href:tpl=submit2;text=permitions;form_id=page_form;param1=page_context_action;value1=update_permitions_form;param2=page_record_id;value2={alias}}</td>
						</tr>