					<form method="post" id="{prefix}_create_form" class="form_330">
						<input type="hidden" id="{prefix}_context_action"name="{prefix}_context_action" value="create_record_form">
						<input type="hidden" id="{prefix}_action" name="{prefix}_action" value="create_record">
						<table>
							<tr>
								<td align="left" >
									{lang:surname}<br>
									<input class="width_320 flat" type="text" name="surname" value="{http_param:post=1;name=surname}">
								</td>
							</tr>
							<tr>
								<td align="left" >
									{lang:name}<br>
									<input class="width_320 flat" type="text" name="name" value="{http_param:post=1;name=name}">
								</td>
							</tr>
							<tr>
								<td align="left" >
									{lang:second_name}<br>
									<input class="width_320 flat" type="text" name="second_name" value="{http_param:post=1;name=second_name}">
								</td>
							</tr>
							<tr>
								<td align="left" >
									{lang:birth_date}&nbsp;{date_picker:name=birth_date}
								</td>
							</tr>
							<tr>
								<td align="left" >
									{lang:person_address}<br>
									<input class="width_320 flat" type="text" name="person_address" value="{http_param:post=1;name=person_address}">
								</td>
							</tr>
							<tr>
								<td align="left" >
									{lang:company}<br>
									<input class="width_320 flat" type="text" name="company" value="{http_param:post=1;name=company}">
								</td>
							</tr>
							<tr>
								<td align="left" >
									{lang:company_address}<br>
									<input class="width_320 flat" type="text" name="company_address" value="{http_param:post=1;name=company_address}">
								</td>
							</tr>
							<tr>
								<td align="left" >
									{lang:smo_company}<br>
									<input class="width_320 flat" type="text" name="smo_company" value="{http_param:post=1;name=smo_company}">
								</td>
							</tr>
							<tr>
								<td align="left" >
									{lang:rank}<br>
									<input class="width_320 flat" type="text" name="rank" value="{http_param:post=1;name=rank}">
								</td>
							</tr>
							<tr>
								<td align="left" >
									{lang:phone}<br>
									<input class="width_320 flat" type="text" name="phone" value="{http_param:post=1;name=phone}">
								</td>
							</tr>
							<tr>
								<td align="left" >
									{lang:email}<br>
									<input class="width_320 flat" type="text" name="email" value="{http_param:post=1;name=email}">
								</td>
							</tr>
							<tr>
								<td align="left" >
									{lang:education_length}<br>
									<input class="width_320 flat" type="text" name="education_length" value="{http_param:post=1;name=education_length}">
								</td>
							</tr>
							<tr>
								<td align="left" >
									{lang:comments}<br>
									<textarea class="width_320 height_240 flat" name="comments">{http_param:post=1;name=comments}</textarea>
								</td>
							</tr>
							<tr>
								<td class="centered">
									{create}&nbsp;{cancel}
								</td>
							</tr>
						</table>
					</form>