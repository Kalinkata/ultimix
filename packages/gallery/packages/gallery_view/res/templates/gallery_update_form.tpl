					<form method="post" id="update_{prefix}_form" class="form_330">
						<input type="hidden" id="{prefix}_context_action"name="{prefix}_context_action" value="update_record_form">
						<input type="hidden" id="{prefix}_action" name="{prefix}_action" value="update_record">
						<input type="hidden" name="{prefix}_record_id" id="{prefix}_record_id" value="{ids}">
						<table>
							<tr>
								<td align="left" >
									{lang:surname}<br>
									<input class="width_320 flat" type="text" name="surname" value="{form_value:name=surname}">
								</td>
							</tr>
							<tr>
								<td align="left" >
									{lang:name}<br>
									<input class="width_320 flat" type="text" name="name" value="{form_value:name=name}">
								</td>
							</tr>
							<tr>
								<td align="left" >
									{lang:second_name}<br>
									<input class="width_320 flat" type="text" name="second_name" value="{form_value:name=second_name}">
								</td>
							</tr>
							<tr>
								<td align="left" >
									{lang:birth_date}&nbsp;{date_picker:name=birth_date;value={form_value:name=birth_date}}
								</td>
							</tr>
							<tr>
								<td align="left" >
									{lang:person_address}<br>
									<input class="width_320 flat" type="text" name="person_address" value="{form_value:name=person_address}">
								</td>
							</tr>
							<tr>
								<td align="left" >
									{lang:company}<br>
									<input class="width_320 flat" type="text" name="company" value="{form_value:name=company}">
								</td>
							</tr>
							<tr>
								<td align="left" >
									{lang:company_address}<br>
									<input class="width_320 flat" type="text" name="company_address" value="{form_value:name=company_address}">
								</td>
							</tr>
							<tr>
								<td align="left" >
									{lang:smo_company}<br>
									<input class="width_320 flat" type="text" name="smo_company" value="{form_value:name=smo_company}">
								</td>
							</tr>
							<tr>
								<td align="left" >
									{lang:rank}<br>
									<input class="width_320 flat" type="text" name="rank" value="{form_value:name=rank}">
								</td>
							</tr>
							<tr>
								<td align="left" >
									{lang:phone}<br>
									<input class="width_320 flat" type="text" name="phone" value="{form_value:name=phone}">
								</td>
							</tr>
							<tr>
								<td align="left" >
									{lang:email}<br>
									<input class="width_320 flat" type="text" name="email" value="{form_value:name=email}">
								</td>
							</tr>
							<tr>
								<td align="left" >
									{lang:education_length}<br>
									<input class="width_320 flat" type="text" name="education_length" value="{form_value:name=education_length}">
								</td>
							</tr>
							<tr>
								<td align="left" >
									{lang:comments}<br>
									<textarea class="width_320 height_240 flat" name="comments">{form_value:name=comments}</textarea>
								</td>
							</tr>
							<tr>
								<td class="centered">
									{save}&nbsp;{cancel}
								</td>
							</tr>
						</table>
					</form>