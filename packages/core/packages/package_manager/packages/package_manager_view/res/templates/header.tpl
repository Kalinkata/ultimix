					{href:page=./install_package.html;text=install}<br>
					<input type="hidden" name="package_name" id="package_name" value="">
					<input type="hidden" name="package_version" id="package_version" value="">
					<input type="hidden" name="package_action" id="package_action" value="">
					<table border="0" width="100%">
						<tr>
							<td width="0%" class="table_header">
								{header_checkbox:name=package}
							</td>
							<td align="left" width="50%" class="table_header">
								{sort_link:text=package_name;dbfield=package_name}
							</td>
							<td align="left" width="0%" class="table_header">
								{sort_link:text=package_version;dbfield=package_version}
							</td>
							<td align="left" width="25%" class="table_header">
								{sort_link:text=modify_date;dbfield=modify_date}
							</td>
							<td align="left" width="25%" class="table_header">
								{sort_link:text=access_date;dbfield=access_date}
							</td>{permit:package_manager}
							<td align="left" width="0%" class="table_header">
								{lang:package_actions}
							</td>{~permit}
						</tr>