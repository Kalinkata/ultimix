						
						<tr class="grid_row">
							<td class="table_row_{odd_factor}" valign="top">{item_checkbox:name=user;id={id}}</td>
							<td align="left" class="table_row_{odd_factor}" {update_record:id={id};prefix={prefix}}>{login}</td>
							<td align="left" class="table_row_{odd_factor}" {update_record:id={id};prefix={prefix}}>{email}</td>
							<td align="left" class="table_row_{odd_factor}" {update_record:id={id};prefix={prefix}}>{name}</td>
							<td align="left" class="table_row_{odd_factor}" {update_record:id={id};prefix={prefix}}>{map:first=0|1|2;second={lang:sex_undefined}|{lang:male}|{lang:female};value={sex}}</td>
							<td align="left" class="table_row_{odd_factor}" {update_record:id={id};prefix={prefix}}>{site}</td>
							<td align="left" class="table_row_{odd_factor}" {update_record:id={id};prefix={prefix}}>{if:condition={eq:value1=active;value2={active}};then={lang:active};else={lang:not_active}}</td>
							<td align="left" class="table_row_{odd_factor}" {update_record:id={id};prefix={prefix}}>{if:condition={eq:value1=active;value2={active}};then={active_to};else=}</td>
							<td align="left" class="table_row_{odd_factor}" {update_record:id={id};prefix={prefix}}><span class="highlight_{if:cond={banned};result1=red;result2=green}">{if:condition={banned};then={banned_to};else={lang:not_banned}}</span></td>
						</tr>
