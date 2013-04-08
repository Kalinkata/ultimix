					<form method="post" id="update_{prefix}_form" class="form_330">
						<input type="hidden" id="{prefix}_context_action"name="{prefix}_context_action" value="update_record_form">
						<input type="hidden" id="{prefix}_action" name="{prefix}_action" value="update_record">
						<input type="hidden" id="{prefix}_record_id" name="{prefix}_record_id" value="{id}">
						<input type="hidden" id="master_type" name="master_type" value="{options:name=master_type}">
						<input type="hidden" id="master_id" name="master_id" value="{options:name=master_id}">
						<table class="margin_0_auto">
							<tr>
								<td align="left" >
									{lang:comment}<br>
									<textarea class="width_320 height_240 flat" name="comment">{form_value:name=comment}</textarea>
								</td>
							</tr>
							{composer:condition={options:name=show_buttons;default=1}}<tr>
								<td class="centered">
									{save}&nbsp;{cancel}
								</td>
							</tr>{~composer}
						</table>
					</form>