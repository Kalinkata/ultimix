						<tr class="grid_row">
							<td align="left" class="table_row_{odd_factor}" class="line_height_19">{item_checkbox:name={prefix};id={id}}</td>
							<td align="left" class="table_row_{odd_factor}" {update_record:id={id};prefix={prefix}}>{code}</td>
							<td align="left" class="table_row_{odd_factor}" {update_record:id={id};prefix={prefix}}>{if:condition={archived};then={lang:ad_banner_yes};else={lang:ad_banner_no}}</td>
							<td align="left" class="table_row_{odd_factor}" {update_record:id={id};prefix={prefix}}>{shows}</td>
							<td align="left" class="table_row_{odd_factor}" {update_record:id={id};prefix={prefix}}>{clicks}</td>
						</tr>