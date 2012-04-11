					<form method="post" id="message_form" class="form_330">
						<center>
							<input type="hidden" name="message_action" , id="message_action" value="no_action">
							<table>
								<tr>
									<td align="left" >
										{lang:message}<br>
										<textarea class="width_640 flat height_320" name="message">{message}</textarea>
									</td>
								</tr>
								<tr>
									<td valign="top">
										{lang:captcha}
										{captcha}
									</td>
								</tr>
								<tr>
									<td align="center">
										{href:tpl=submit1;form_id=message_form;param1=message_action;value1=send_feedback;text=send}
									</td>
								</tr>
							</table>
						</center>
					</form>