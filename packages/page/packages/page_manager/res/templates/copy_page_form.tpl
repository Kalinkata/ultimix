					<form method="post" action="" id="copy_{prefix}_form" class="form_330">
						<input type="hidden" name="{prefix}_context_action" id="{prefix}_context_action" value="copy_record_form">
						<input type="hidden" name="{prefix}_action" id="{prefix}_action" value="copy_record">
						<table>
							<tr>
								<td>
									{lang:{prefix}_title}
								</td>
								<td>
									<input type="text" class="width_320 flat" name="{prefix}_title" value="{title}">
								</td>
							</tr>
							<tr>
								<td>
									{lang:{prefix}_template}
								</td>
								<td>
									<input type="text" class="width_320 flat" name="{prefix}_template_name" value="{template}">
								</td>
							</tr>
							<tr>
								<td>
									{lang:{prefix}_template_version}
								</td>
								<td>
									<input type="text" class="width_320 flat" name="{prefix}_template_version" value="{template_version}">
								</td>
							</tr>
							<!--tr>
								<td>
									{lang:{prefix}_predefined_packages}
								</td>
								<td>
									{checkbox:name={prefix}_predefined_packages;default=1}
								</td>
							</tr-->
							{composer:condition={options:name=show_buttons;default=1}}<tr>
								<td align="center" colspan="2">
									{create}&nbsp;{cancel}
								</td>
							</tr>{~composer}
						</table>
					</form>{lang_file:package_name=page::page_manager}