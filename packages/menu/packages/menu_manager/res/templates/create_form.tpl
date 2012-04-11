				<form method="post" id="{prefix}_create_form" class="form_330">
					<input type="hidden" id="{prefix}_context_action"name="{prefix}_context_action" value="">
					<input type="hidden" id="{prefix}_action" name="{prefix}_action" value="">
					<input type="hidden" id="{prefix}_record_id" name="{prefix}_record_id" value="">
					<table>
						<tr>
							<td valign="top">
								{lang:{prefix}_name}
							</td>
						</tr>
						<tr>
							<td valign="top">
								<input class="width_800 flat" type="text" name="name" value="{http_param:name=name;type=string;post=1;default=}">
							</td>
						</tr>
						<tr>
							<td align="center" valign="center">
								{href:tpl=submit2;form_id={prefix}_create_form;param1={prefix}_action;value1=create_record;param2={prefix}_context_action;value2=create_record_form;raw_text={lang:create_{prefix};default=create}}
								&nbsp;{href:tpl=submit1;form_id={prefix}_create_form;param1={prefix}_context_action;value=;text=cancel;action=./{prefix}_manager.html}
							</td>
						</tr>
					</table>
				</form>