					<form method="post" action="" id="{prefix}_update_form" class="form_650">
						<input type="hidden" name="{prefix}_context_action" id="{prefix}_context_action" value="update_packages_form">
						<input type="hidden" name="{prefix}_action" id="{prefix}_action" value="save_packages">
						<input type="hidden" name="{prefix}_record_id" id="{prefix}_record_id" value="{page_alias}">
						<table>
							<tr>
								<td valign="top">
									{lang:list_of_{prefix}_packages}
									<textarea class="width_640 flat height_320" name="{prefix}_packages">{{prefix}_packages}</textarea>
								</td>
							</tr>
							<tr>
								<td align="center" colspan="2">
									{save}&nbsp;{cancel}
								</td>
							</tr>
						</table>
					</form>{lang_file:package_name=page::page_manager}