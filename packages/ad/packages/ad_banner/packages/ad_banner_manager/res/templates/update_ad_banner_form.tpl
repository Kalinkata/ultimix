					<form method="post" action="" id="update_{prefix}_form" class="form_330">
						<input type="hidden" name="{prefix}_context_action" id="{prefix}_context_action" value="update_record_form">
						<input type="hidden" name="{prefix}_action" id="{prefix}_action" value="update_record">
						<input type="hidden" name="{prefix}_record_id" id="{prefix}_record_id" value="{ids}">
						<table>
							<tr>
							<td valign="top">
									{lang:ad_banner_code}
								</td>
							</tr>
							<tr>
								<td align="left" valign="top">
									<textarea class="width_320 height_240 flat" name="code">{form_value:name=code;type=string}</textarea>
								</td>
							</tr>
							{composer:condition={options:name=show_buttons;default=1}}<tr>
								<td align="center" valign="center" colspan="2">
									{save}&nbsp;{cancel}
								</td>
							</tr>{~composer}
						</table>
					</form>