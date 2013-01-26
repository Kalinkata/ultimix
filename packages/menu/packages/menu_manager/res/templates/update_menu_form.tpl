					<form method="post" action="" id="update_{prefix}_form" class="form_330">
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
									<input class="width_320 flat" type="text" name="name" value="{form_value:name=name;type=string;default={name}}">
								</td>
							</tr>
							{composer:condition={options:name=show_buttons;default=1}}<tr>
								<td align="center" valign="center">
									{save}&nbsp;{cancel}
								</td>
							</tr>{~composer}
						</table>
					</form>