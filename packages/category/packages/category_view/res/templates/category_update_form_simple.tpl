						<form method="post" id="{prefix}_edit_form" class="form_330">
							<input type="hidden" name="{prefix}_context_action" id="{prefix}_context_action" value="update_record_form">
							<input type="hidden" name="{prefix}_action" id="{prefix}_action" value="update_record">
							<input type="hidden" name="{prefix}_record_id" id="{prefix}_record_id" value="{ids}">
							<input type="hidden" name="mask" value="{mask}">
							<input type="hidden" name="root_category" value="{root_category}">
							<input type="hidden" name="direct_category" value="{direct_category}">
							<table>
								<tr>
									<td>
										{lang:category_title}<br>
										<input type="text" class="width_320 flat" name="title" value="{title}">
									</td>
								</tr>
								<tr>
									<td colspan="2" align="center">
										{save}&nbsp;{cancel}
									</td>
								</tr>
							</table>
						</form>