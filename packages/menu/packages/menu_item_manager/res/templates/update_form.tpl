					<form method="post" action="" id="{prefix}_form" class="form_330">
						<input type="hidden" name="{prefix}_context_action" id="{prefix}_context_action" value="update_record_form">
						<input type="hidden" name="{prefix}_action" id="{prefix}_action" value="update_record">
						<input type="hidden" name="{prefix}_record_id" id="{prefix}_record_id" value="{ids}">
						<table>
							<tr>
								<td valign="top">
									{lang:{prefix}_name}
								</td>
							</tr>
							<tr>
								<td valign="top">
									<input class="width_800 flat" type="text" name="name" value="{http_param:name=name;type=string;post=1;default={name}}">
								</td>
							</tr>
							<tr>
								<td valign="top">
									{lang:{prefix}_menu}
								</td>
							</tr>
							<tr>
								<td valign="top">
									<!--input class="width_800 flat" type="text" name="menu" value="{http_param:name=menu;type=string;post=1;default={menu}}"-->
									{select:name=menu;query=SELECT '' AS id , '' AS value UNION (SELECT name as id , name AS value FROM umx_menu ORDER BY name);id={http_param:name=menu;type=string;post=1;default={menu}}}
								</td>
							</tr>
							<tr>
								<td valign="top">
									{lang:{prefix}_href}
								</td>
							</tr>
							<tr>
								<td valign="top">
									<input class="width_800 flat" type="text" name="href" value="{http_param:name=href;type=string;post=1;default={href}}">
								</td>
							</tr>
							<tr>
								<td align="center" valign="center">
									{href:tpl=submit0;form_id={prefix}_form;raw_text={lang:save_{prefix};default=save}}&nbsp;{href:tpl=submit1;form_id={prefix}_form;param1={prefix}_context_action;value=;text=cancel;action=./{prefix}_manager.html}
								</td>
							</tr>
						</table>
					</form>