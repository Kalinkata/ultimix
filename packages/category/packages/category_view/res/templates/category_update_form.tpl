						<form method="post" id="{prefix}_edit_form" class="form_330">
							<input type="hidden" name="{prefix}_context_action" id="{prefix}_context_action" value="update_record_form">
							<input type="hidden" name="{prefix}_action" id="{prefix}_action" value="update_record">
							<input type="hidden" name="{prefix}_record_id" id="{prefix}_record_id" value="{ids}">
							<table>
								<tr>
									<td>
										{lang:category_title}<br>
										<input type="text" class="width_320 flat" name="title" value="{title}">
									</td>
								</tr>
								<tr>
									<td>
										{lang:root_category}<br>
										{select:name=root_id;id={form_value:name=root_id;post=1;default={root_id}};query=SELECT id , title as value FROM umx_category}
									</td>
								</tr>
								<tr>
									<td>
										{lang:category_direct_title}<br>
										{select:name=direct_category;id={form_value:name=direct_category;post=1;default={direct_category}};query=SELECT id , title as value FROM umx_category}
									</td>
								</tr>
								<tr>
									<td>
										{lang:category_mask}<br>
										<input type="text" class="width_320 flat" name="mask" value="{mask}">
									</td>
								</tr>
								<tr>
									<td colspan="2" align="center">
										{save}&nbsp;{cancel}
									</td>
								</tr>
							</table>
						</form>