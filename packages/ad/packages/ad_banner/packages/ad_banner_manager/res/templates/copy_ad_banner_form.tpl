					<form method="post" action="" id="create_{prefix}_form" class="form_330">
						<input type="hidden" name="{prefix}_context_action" id="{prefix}_context_action" value="copy_record_form">
						<input type="hidden" name="{prefix}_action" id="{prefix}_action" value="copy_record">
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
									{create}&nbsp;{cancel}
								</td>
							</tr>{~composer}
						</table>
					</form>