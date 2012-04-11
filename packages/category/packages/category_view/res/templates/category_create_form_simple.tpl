						<form method="post" id="{prefix}_create_form" class="form_330">
							<input type="hidden" id="{prefix}_context_action"name="{prefix}_context_action" value="create_record_form">
							<input type="hidden" id="{prefix}_action" name="{prefix}_action" value="create_record">
							<input type="hidden" name="mask" value="0">
							<input type="hidden" name="root_category" value="{options:name=root_category}">
							<input type="hidden" name="direct_category" value="{options:name=direct_category}">
							<table>
								<tr>
									<td valign="top">
										{lang:category_title}<br>
										<input type="text" class="width_320 flat" name="title" value="{http_param:name=title;post=1}">
									</td>
								</tr>
								<tr>
									<td align="center">
										{create}&nbsp;{cancel}
									</td>
								</tr>
							</table>
						</form>