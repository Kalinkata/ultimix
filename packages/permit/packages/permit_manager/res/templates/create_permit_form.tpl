				<form method="post" id="create_{prefix}_form" class="form_330">
					<input type="hidden" id="{prefix}_context_action"name="{prefix}_context_action" value="create_record_form">
					<input type="hidden" id="{prefix}_action" name="{prefix}_action" value="create_record">
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
						{composer:condition={options:name=show_buttons;default=1}}<tr>
							<td align="center" valign="center">
								{create}&nbsp;{cancel}
							</td>
						</tr>{~composer}
					</table>
				</form>