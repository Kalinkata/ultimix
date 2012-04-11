					<form method="post" action="" id="{prefix}_form" class="form_330">
						<input type="hidden" name="{prefix}_context_action" id="{prefix}_context_action" value="update_record_form">
						<input type="hidden" name="{prefix}_action" id="{prefix}_action" value="update_record">
						<input type="hidden" name="{prefix}_record_id" id="{prefix}_record_id" value="{ids}">
						<table>
							<tr>
								<td valign="top" align="left">
									{lang:{prefix}_permit}
								</td>
							</tr>
							<tr>
								<td valign="top">
									<input class="width_320 flat" type="text" name="permit" value="{http_param:name=permit;type=string;post=1;default={permit}}">
								</td>
							</tr>
							<tr>
								<td valign="top" align="left">
									{lang:{prefix}_comment}
								</td>
							</tr>
							<tr>
								<td valign="top">
									<textarea class="width_320 flat height_240" name="comment">{http_param:name=comment;type=string;post=1;default={comment}}</textarea>
								</td>
							</tr>
							<tr>
								<td align="center" valign="center">
									{href:tpl=submit0;form_id={prefix}_form;text=save_{prefix}}&nbsp;{href:tpl=submit1;form_id={prefix}_form;param1={prefix}_context_action;value=;text=cancel;action=./{prefix}_manager.html}
								</td>
							</tr>
						</table>
					</form>