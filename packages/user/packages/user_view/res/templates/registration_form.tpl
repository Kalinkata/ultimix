					<table width="100%" height="100%">
						<tr>
							<td align="center">
								<form id="registration_form" method="post">
									<input type="hidden" id="user_action" name="user_action" value="register">
									<table>
										<tr>
											<td align="left">
												{lang:login}
											</td>
											<td align="left">
												<input class="flat width_240" type="text" name="login" value="{login}">
											</td>
										</tr>
										<tr>
											<td align="left">
												{lang:user_name}
											</td>
											<td align="left">
												<input class="flat width_240" type="text" name="name" value="{name}">
											</td>
										</tr>
										<tr>
											<td align="left">
												{lang:user_sex}
											</td>
											<td align="left">
												{radio:name=sex;value=1;label=male;default}&nbsp;
												{radio:name=sex;value=2;label=female}
											</td>
										</tr>
										<tr>
											<td align="left">
												{lang:site}
											</td>
											<td align="left">
												<input class="flat width_240" type="text" name="site" value="{site}">
											</td>
										</tr>
										<tr>
											<td align="left">
												{lang:about}
											</td>
											<td align="left" valign="top">
												<textarea class="flat width_240 height_160" name="about">{about}</textarea>
											</td>
										</tr>
										<tr>
											<td align="left">
												{lang:email}
											</td>
											<td align="left">
												<input class="flat width_240" type="text" name="email" value="{email}">
											</td>
										</tr>
										<tr>
											<td align="left">
												{lang:password}
											</td>
											<td align="left">
												<input class="flat width_240" type="password" name="password" value="{password}">
											</td>
										</tr>
										<tr>
											<td align="left">
												{lang:password_confirmation}
											</td>
											<td align="left">
												<input class="flat width_240" type="password" name="password_confirmation" value="{password_confirmation}" {enter_processor:form_id=registration_form}>
											</td>
										</tr>
{permit:user_manager}
<tr>
											<td align="left">
												<label for="active_permanently">{lang:active_permanently}</label>
											</td>
											<td align="left">
												<input id="active_permanently" type="checkbox" name="active_permanently" {map:first=on|;second=checked|;value={http_param:name=active_permanently;type=string;post=1;default=}}>
											</td>
										</tr>
{~permit}										<tr>
											<td colspan="2" align="center">
												{href:tpl=submit0;form_id=registration_form;text=registration;waiting=false}&nbsp;{href:page={http_param:get=1;name=back_page;type=command;default=index}.html;text=cancel}
											</td>
										</tr>
									</table>
								</form>
							</td>
						</tr>
					</table>