{auth:logged_in}{permit:update_nested}							
							<form id="update_nested_form" method="post" class="form_330">
								<input type="hidden" name="update_nested_form" id="update_nested_form">
								<table>
									<tr>
										<td align="left" valign="top">
											{lang:nested_packages}<br>
											<textarea class="width_640 flat height_320" name="nested_list">{nested_list}</textarea>
										</td>
									</tr>
									<tr>
										<td colspan="2" align="center">
											{link_button:type=0;form_id=update_nested_form;text:save}
										</td>
									</tr>
								</table>
							</form>{~permit}{~auth}