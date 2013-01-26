					<form method="post" action="" id="update_{prefix}_form" class="form_650">
						<input type="hidden" name="{prefix}_context_action" id="{prefix}_context_action" value="update_record_form">
						<input type="hidden" name="{prefix}_action" id="{prefix}_action" value="update_record">
						<input type="hidden" name="{prefix}_id" id="{prefix}_record_id" value="{ids}">
						<table>
							<tr>
								<td valign="top">
									{lang:Content}
								</td>
							</tr>
							<tr>
								<td align="left" valign="top">
									{textarea:simple_editor={http_param:get=1;post=1;name=simple_editor;default=0};class=width_640 height_320 flat;name=content}{form_value:name=content;type=string}{~textarea}
								</td>
							</tr>
							{composer:condition={options:name=show_buttons;default=1}}<tr>
								<td align="center" valign="center" colspan="2">
									{save}&nbsp;{cancel}
								</td>
							</tr>{~composer}
						</table>
					</form>