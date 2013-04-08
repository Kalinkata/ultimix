					<form method="post" id="create_{prefix}_form" class="form_330">
						<input type="hidden" id="{prefix}_context_action"name="{prefix}_context_action" value="create_record_form">
						<input type="hidden" id="{prefix}_action" name="{prefix}_action" value="create_record">
						<input type="hidden" id="master_type" name="master_type" value="{options:name=master_type}">
						<input type="hidden" id="master_id" name="master_id" value="{options:name=master_id}">
						<table class="margin_0_auto">
							<tr>
								<td align="left" >
									{lang:rank} {select:class=flat;name=rank;first=-5,-4,-3,-2,-1,0,1,2,3,4,5;second=-5,-4,-3,-2,-1,0,1,2,3,4,5}
								</td>
							</tr>
							<tr>
								<td align="left" >
									{lang:review}<br>
									<textarea class="width_320 height_240 flat" name="review">{http_param:post=1;name=review}</textarea>
								</td>
							</tr>
							{composer:condition={options:name=show_buttons;default=1}}<tr>
								<td class="centered">
									{create:text=save}
								</td>
							</tr>{~composer}
						</table>
					</form>{lang_file:package_name=review::review_markup}{lang_file:package_name=review::review_view}