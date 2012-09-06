					<form method="post" action="" id="{prefix}_copy_form" name="{prefix}_copy_form" class="form_330">
						<input type="hidden" name="{prefix}_context_action" id="{prefix}_context_action" value="copy_record_form">
						<input type="hidden" name="{prefix}_action" id="{prefix}_action" value="copy_record">
						<input type="hidden" name="{prefix}_id" id="{prefix}_record_id" value="{ids}">{permit:user_manager}
						<input type="hidden" name="current_password" value="current_password">
{~permit}
						<table>
							<tr>
								<td valign="top">
									{lang:login}
								</td>
								<td valign="top">
									<input class="width_160 flat" type="text" name="login" value="{form_value:name=login;type=string;default={login}}">
								</td>
							</tr>
							<tr>
								<td valign="top">
									{lang:email}
								</td>
								<td valign="top">
									<input class="width_160 flat" type="text" name="email" value="{form_value:name=email;type=string;default={email}}">
								</td>
							</tr>{no_permit:user_manager}
							<tr>
								<td valign="top">
									{lang:current_password}
								</td>
								<td valign="top">
									<input class="width_160 flat" type="password" name="current_password">
								</td>
							</tr>{no_permit:~user_manager}
							<tr>
								<td valign="top">
									{lang:password}
								</td>
								<td valign="top">
									<input class="width_160 flat" type="password" name="password">
								</td>
							</tr>
							<tr>
								<td valign="top">
									{lang:password_confirmation}
								</td>
								<td valign="top">
									<input class="width_160 flat" type="password" name="password_confirmation">
								</td>
							</tr>
							<tr>
								<td valign="top">
									<label for="active_checkbox">{lang:user_active}</label>
								</td>
								<td valign="top">
									{checkbox:id=active_checkbox;name=active;default={active}}
								</td>
							</tr>
							<tr>
								<td valign="top">
									<label for="active_checkbox">{lang:active_to}</label>
								</td>
								<td valign="top">
									{date_picker:name=active_to;value={active_to}}
								</td>
							</tr>
							<tr>
								<td valign="top">
									<label for="active_checkbox">{lang:banned_to}</label>
								</td>
								<td valign="top">
									{date_picker:name=banned_to;value={banned_to}}
								</td>
							</tr>
							<tr>
								<td colspan="2" align="center" valign="center">
									{copy}&nbsp;{cancel}
								</td>
							</tr>
						</table>
					</form>