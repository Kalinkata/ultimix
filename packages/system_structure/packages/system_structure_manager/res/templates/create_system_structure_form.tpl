				<form method="post" id="create_{prefix}_form" class="form_330">
					<input type="hidden" id="{prefix}_context_action"name="{prefix}_context_action" value="create_record_form">
					<input type="hidden" id="{prefix}_action" name="{prefix}_action" value="create_record">
					<input type="hidden" id="{prefix}_record_id" name="{prefix}_record_id" value="">
					<table>
						<tr>
							<td valign="top">
								{lang:system_structure_page}
							</td>
						</tr>
						<tr>
							<td valign="top">
								<input class="width_320 flat" type="text" name="page" value="{http_param:name=page;type=string;post=1;default=}">
							</td>
						</tr>
						<tr>
							<td valign="top">
								{lang:system_structure_root_page}
							</td>
						</tr>
						<tr>
							<td valign="top">
								<input class="width_320 flat" type="text" name="root_page" value="{http_param:name=root_page;type=string;post=1;default=}">
							</td>
						</tr>
						<tr>
							<td valign="top">
								{lang:system_structure_navigation}
							</td>
						</tr>
						<tr>
							<td valign="top">
								<textarea class="width_320 flat height_320" name="navigation">{http_param:name=navigation;type=raw;post=1;default=}</textarea>
							</td>
						</tr>
						{composer:condition={options:name=show_buttons;default=1}}<tr>
							<td align="center" valign="center">
								{create}&nbsp;{cancel}
							</td>
						</tr>{~composer}
					</table>
				</form>