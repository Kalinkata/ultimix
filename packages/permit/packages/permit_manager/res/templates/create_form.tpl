				<form method="post" id="{prefix}_create_form" class="form_330">
					<input type="hidden" id="{prefix}_context_action"name="{prefix}_context_action" value="">
					<input type="hidden" id="{prefix}_action" name="{prefix}_action" value="">
					<input type="hidden" id="{prefix}_record_id" name="{prefix}_record_id" value="">
					<table>
						<tr>
							<td valign="top" align="left">
								{lang:{prefix}_permit}
							</td>
						</tr>
						<tr>
							<td valign="top">
								<input class="width_320 flat" type="text" name="permit" value="{http_param:name=permit;type=string;post=1;default=}">
							</td>
						</tr>
						<tr>
							<td valign="top" align="left">
								{lang:{prefix}_comment}
							</td>
						</tr>
						<tr>
							<td valign="top">
								<textarea class="width_320 flat height_240" name="comment">{http_param:name=comment;type=string;post=1;default=}</textarea>
							</td>
						</tr>
						<tr>
							<td align="center" valign="center">
								{href:tpl=submit2;form_id={prefix}_create_form;param1={prefix}_action;value1=create_record;param2={prefix}_context_action;value2=create_record_form;text=create_{prefix}}
								&nbsp;{href:tpl=submit1;form_id={prefix}_create_form;param1={prefix}_context_action;value=;text=cancel;action=./{prefix}_manager.html}
							</td>
						</tr>
					</table>
				</form>