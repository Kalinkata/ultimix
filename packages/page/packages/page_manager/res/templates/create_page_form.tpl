					<form method="post" action="" id="create_{prefix}_form" class="form_330">
						<input type="hidden" name="{prefix}_context_action" id="{prefix}_context_action" value="create_record_form">
						<input type="hidden" name="{prefix}_action" id="{prefix}_action" value="create_record">
						<table>
							<tr>
								<td valign="top">
									{lang:{prefix}_alias}
								</td>
							</tr>
							<tr>
								<td>
									<input type="text" class="width_320 flat" name="alias" value="{http_param:name=alias;post=1}">
								</td>
							</tr>
							<tr>
								<td valign="top">
									{lang:{prefix}_title}
								</td>
							</tr>
							<tr>
								<td>
									<input type="text" class="width_320 flat" name="title" value="{http_param:name=title;post=1}">
								</td>
							</tr>
							<tr>
								<td valign="top">
									{lang:{prefix}_template}
								</td>
							</tr>
							<tr>
								<td>
									<input type="text" class="width_320 flat" name="template_package_name" value="{http_param:name=template_package_name;post=1}">
								</td>
							</tr>
							<tr>
								<td valign="top">
									{lang:{prefix}_template_version}
								</td>
							</tr>
							<tr>
								<td>
									<input type="text" class="width_320 flat" name="template_package_version" value="{http_param:name=template_package_version;post=1}">
								</td>
							</tr>
							<tr>
								<td valign="top">
									{lang:{prefix}_predefined_packages}
								</td>
							</tr>
							<tr>
								<td>
									{checkbox:name=predefined_packages}
								</td>
							</tr>
							{composer:condition={options:name=show_buttons;default=1}}<tr>
								<td align="center" colspan="2">
									{create}&nbsp;{cancel}
								</td>
							</tr>{~composer}
						</table>
					</form>