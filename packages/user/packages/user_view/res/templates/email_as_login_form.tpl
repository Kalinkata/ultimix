{auth:guest}
					<form method="post" id="login_form" action="" class="padding_0">
						<table class="width_180 margin_0_auto">
							<tr>
								<td align="left" width="40%">{lang:user_email}</td>
								<td align="right" width="60%"><input class="flat width_100" type="text" name="login" value="{http_param:post=1;name=login}"></td>
							</tr>
							<tr>
								<td align="left">{lang:password}</td>
								<td align="right"><input {enter_processor:form_id=login_form} class="flat width_100" type="password" id="password" name="password"><input type="hidden" name="action" value="login"></td>
							</tr>
							<tr>
								<td colspan="2" class="login_buttons">
									{href:tpl=submit0;form_id=login_form;text=sign_in;waiting=false}{registration_link}&nbsp;{href:tpl=std;text=restore_password;page=./restore_password.html}
								</td>
							</tr>
						</table>
					</form>
{auth:~guest}