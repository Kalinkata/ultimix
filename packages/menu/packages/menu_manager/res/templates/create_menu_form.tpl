				<form method="post" id="{prefix}_create_form" class="form_330">
					<input type="hidden" id="{prefix}_context_action" name="{prefix}_context_action" value="create_record_form">
					<input type="hidden" id="{prefix}_action" name="{prefix}_action" value="create_record">
					<input type="hidden" id="{prefix}_record_id" name="{prefix}_record_id" value="">
					<table>
						<tr>
							<td valign="top">
								{lang:{prefix}_name}
							</td>
						</tr>
						<tr>
							<td valign="top">
								<input class="width_320 flat" type="text" name="name" value="{http_param:name=name;type=string;post=1;default=}">
							</td>
						</tr>
						<tr>
							<td align="center" valign="center">
								{create}&nbsp;{cancel}
							</td>
						</tr>
					</table>
				</form>