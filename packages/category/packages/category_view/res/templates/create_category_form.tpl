						<form method="post" id="create_{prefix}_form" class="form_330">
							<input type="hidden" id="{prefix}_context_action"name="{prefix}_context_action" value="create_record_form">
							<input type="hidden" id="{prefix}_action" name="{prefix}_action" value="create_record">
							<table>
								<tr>
									<td valign="top">
										{lang:category_title}<br>
										<input type="text" class="width_320 flat"  name="title" value="{http_param:name=title;post=1}">
									</td>
								</tr>
								<tr>
									<td valign="top">
										{lang:root_category}<br>
										{select:name=root_id;query=SELECT id , title as value FROM umx_category}
									</td>
								</tr>
								<tr>
									<td valign="top">
										{lang:category_direct_title}<br>
										{select:name=direct_category;query=SELECT id , title as value FROM umx_category}
									</td>
								</tr>
								<tr>
									<td valign="top">
										{lang:category_mask}<br>
										<input type="text" class="width_320 flat" name="mask" value="{http_param:name=mask;post=1}">
									</td>
								</tr>
								<tr>
									<td align="center">
										{create}&nbsp;{cancel}
									</td>
								</tr>
							</table>
						</form>