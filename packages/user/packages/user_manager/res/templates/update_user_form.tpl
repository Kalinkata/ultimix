					<form method="post" action="" id="{prefix}_form" name="{prefix}_form" class="margin_0_auto width_400">
						<input type="hidden" name="{prefix}_context_action" id="{prefix}_context_action" value="update_record_form">
						<input type="hidden" name="{prefix}_action" id="{prefix}_action" value="update_record">
						<input type="hidden" name="{prefix}_record_id" id="{prefix}_record_id" value="{ids}">{permit:user_manager}
						<input type="hidden" name="current_password" value="current_password">
{~permit}
						<table>
							<tr>
								<td valign="top" align="left">
									{lang:login}
								</td>
								<td valign="top" align="left">
									{login}
								</td>
							</tr>
							<tr>
								<td align="left">
									{lang:user_name}
								</td>
								<td align="left">
									<input class="flat width_240" type="text" name="name" value="{form_value:name=name}">
								</td>
							</tr>
							<tr>
								<td align="left">
									{lang:user_sex}
								</td>
								<td align="left">
									{radio:name=sex;value=1;label=male;current_value={sex}}&nbsp;
									{radio:name=sex;value=2;label=female;current_value={sex}}
								</td>
							</tr>
							<tr>
								<td align="left">
									{lang:site}
								</td>
								<td align="left">
									<input class="flat width_240" type="text" name="site" value="{http_param:name=site;type=string;post=1;default={site}}">
								</td>
							</tr>
							<tr>
								<td align="left" valign="top">
									{lang:about}
								</td>
								<td align="left">
									<textarea class="flat width_240 height_160" name="about">{http_param:name=about;type=string;post=1;default={about}}</textarea>
								</td>
							</tr>
							<tr>
								<td valign="top" align="left">
									{lang:email}
								</td>
								<td valign="top">
									<input class="width_240 flat" type="text" name="email" value="{http_param:name=email;type=string;post=1;default={email}}">
								</td>
							</tr>
							<tr>
								<td valign="top" align="left">
									{lang:avatar}
								</td>
								<td valign="top">
									<span class="avatar">
										<span class="avatar_item">
											<img src="{avatar_path}" class="avatar_image">
										</span>
										<span class="avatar_template" class="invisible">
											<img src="[href]" class="avatar_image">
										</span>
									</span>
									{file_input:file_types=images;upload_url=update_profile_upload.html;upload_success_handler=ultimix_file_input_view_after_image_upload_processor;file_size_limit=50 KB}
								</td>
							</tr>
							<tr>
								<td valign="top" align="left" colspan="2" class="bold">
									{lang:change_password}
								</td>
							</tr>{no_permit:user_manager}
							<tr>
								<td valign="top" align="left">
									{lang:current_password}
								</td>
								<td valign="top">
									<input class="width_240 flat" type="password" name="current_password">
								</td>
							</tr>{~no_permit}
							<tr>
								<td valign="top" align="left">
									{lang:new_password}
								</td>
								<td valign="top">
									<input class="width_240 flat" type="password" name="password">
								</td>
							</tr>
							<tr>
								<td valign="top" align="left">
									{lang:password_confirmation}
								</td>
								<td valign="top">
									<input class="width_240 flat" type="password" name="password_confirmation">
								</td>
							</tr>{permit:user_manager}
							<tr>
								<td valign="top">
									<label for="active_checkbox">{lang:user_active}</label>
								</td>
								<td valign="top">
									{checkbox:id=active_checkbox;name=active;default={eq:value1=active;value2={active}}}
								</td>
							</tr>
							<tr>
								<td valign="top">
									<label for="active_checkbox">{lang:active_to}</label>
								</td>
								<td valign="top">
									{date_picker:name=active_to;value={active_to}}
								</td>
							</tr>
							<tr>
								<td valign="top">
									<label for="active_checkbox">{lang:banned_to}</label>
								</td>
								<td valign="top">
									{date_picker:name=banned_to;value={banned_to}}
								</td>
							</tr>
{~permit}
							{composer:condition={options:name=show_buttons;default=1}}<tr>
								<td colspan="2" align="center" valign="center">
									{save}&nbsp;{cancel}
								</td>
							</tr>{~composer}
						</table>
					</form>