					<form method="post" action="" id="{prefix}_create_form" class="form_330">
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
									<input type="text" class="width_320 flat" name="{prefix}_alias" value="{http_param:name={prefix}_alias;post=1}">
								</td>
							</tr>
							<tr>
								<td valign="top">
									{lang:{prefix}_title}
								</td>
							</tr>
							<tr>
								<td>
									<input type="text" class="width_320 flat" name="{prefix}_title" value="{http_param:name={prefix}_title;post=1}">
								</td>
							</tr>
							<tr>
								<td valign="top">
									{lang:{prefix}_template}
								</td>
							</tr>
							<tr>
								<td>
									<input type="text" class="width_320 flat" name="{prefix}_template" value="{http_param:name={prefix}_template;post=1}">
								</td>
							</tr>
							<tr>
								<td valign="top">
									{lang:{prefix}_template_version}
								</td>
							</tr>
							<tr>
								<td>
									<input type="text" class="width_320 flat" name="{prefix}_template_version" value="{http_param:name={prefix}_template_version;post=1}">
								</td>
							</tr>
							<tr>
								<td valign="top">
									{lang:{prefix}_predefined_packages}
								</td>
							</tr>
							<tr>
								<td>
									{checkbox:name={prefix}_predefined_packages}
								</td>
							</tr>
							<tr>
								<td align="center" colspan="2">
									{create}&nbsp;{cancel}
								</td>
							</tr>
						</table>
					</form>{lang_file:package_name=page::page_manager}