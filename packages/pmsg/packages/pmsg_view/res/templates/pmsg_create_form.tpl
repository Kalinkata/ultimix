					<form method="post" id="{prefix}_create_form" class="form_330">
						<input type="hidden" id="{prefix}_context_action"name="{prefix}_context_action" value="create_record_form">
						<input type="hidden" id="{prefix}_action" name="{prefix}_action" value="create_record">
						<table>
							<tr>
								<td align="left" >
									{lang:message_recipient}<br>
									<input class="width_320 flat" type="text" name="recipient" value="{http_param:post=1;name=recipient}">
								</td>
							</tr>
							<tr>
								<td align="left" >
									{lang:message_subject}<br>
									<input class="width_320 flat" type="text" name="subject" value="{http_param:post=1;name=subject}">
								</td>
							</tr>
							<tr>
								<td align="left" >
									{lang:message}<br>
									<textarea class="width_320 flat height_240" name="message">{http_param:post=1;name=message}</textarea>
								</td>
							</tr>
							<tr>
								<td class="centered">
									{href:tpl=submit0;form_id={prefix}_create_form;text=send}
									&nbsp;{href:page=pmsg.html;text=cancel}{action_list}
								</td>
							</tr>
						</table>
					</form>