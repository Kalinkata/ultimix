					<form method="post" action="" id="update_{prefix}_form" class="form_330">
						<input type="hidden" name="{prefix}_context_action" id="{prefix}_context_action" value="update_record_form">
						<input type="hidden" name="{prefix}_action" id="{prefix}_action" value="update_record">
						<input type="hidden" name="{prefix}_record_id" id="{prefix}_record_id" value="{ids}">
						<table>
							<tr>
								<td valign="top">
									{lang:{prefix}_page}
								</td>
							</tr>
							<tr>
								<td valign="top">
									<input type="hidden" name="{prefix}_page_original" value="{page_original}">
									<input class="width_800 flat" type="text" name="{prefix}_page" value="{http_param:name={prefix}_page;type=string;post=1;default={page}}">
								</td>
							</tr>
							<tr>
								<td valign="top">
									{lang:{prefix}_root_page}
								</td>
							</tr>
							<tr>
								<td valign="top">
									<input type="hidden" name="{prefix}_root_page_original" value="{root_page_original}">
									<input class="width_800 flat" type="text" name="{prefix}_root_page" value="{http_param:name={prefix}_root_page;type=string;post=1;default={root_page}}">
								</td>
							</tr>
							<tr>
								<td valign="top">
									{lang:{prefix}_navigation}
								</td>
							</tr>
							<tr>
								<td valign="top">
									<input type="hidden" name="{prefix}_navigation_original" value="{navigation_original}">
									<textarea class="width_800 flat height_320" name="{prefix}_navigation">{http_param:name={prefix}_navigation;type=raw;post=1;default={navigation}}</textarea>
								</td>
							</tr>
							{composer:condition={options:name=show_buttons;default=1}}<tr>
								<td align="center" valign="center">
									{save}&nbsp;{cancel}
								</td>
							</tr>{~composer}
						</table>
					</form>