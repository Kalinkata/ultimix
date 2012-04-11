					<form {enter_processor:form_id=switch_user_form} method="post" id="switch_user_form" action="" class="padding_0">
						<table cellpadding="0" width="100%" height="100%">
							<tr>
								<td align="center">
									<table>
										<tr>
											<td align="left">{lang:login}</td>
											<td align="left"><input class="flat width_100" type="text" name="login"></td>
										</tr>
										<tr>
											<td align="left">{lang:password}</td>
											<td align="left"><input class="flat width_100" type="password" id="password" name="password"><input type="hidden" name="action" value="login"></td>
										</tr>
										<tr>
											<td colspan="2" align="center">
												{href:tpl=submit0;form_id=switch_user_form;text=sign_in;waiting=false}&nbsp;{registration_link}
											</td>
										</tr>
									</table>
								</td>
							</tr>
						</table>
					</form>