					<form method="post" id="{prefix}_create_form" class="form_330">
						<input type="hidden" id="{prefix}_context_action"name="{prefix}_context_action" value="create_record_form">
						<input type="hidden" id="{prefix}_action" name="{prefix}_action" value="create_record">
						<input type="hidden" id="master_type" name="master_type" value="{options:name=master_type}">
						<input type="hidden" id="master_id" name="master_id" value="{options:name=master_id}">
						<table>
							<tr>
								<td align="left" >
									{lang:comment}<br>
									<textarea class="width_320 height_240 flat" name="comment">{http_param:post=1;name=comment}</textarea>
								</td>
							</tr>
							<tr>
								<td class="centered">
									{create:text=save}
								</td>
							</tr>
						</table>
					</form>