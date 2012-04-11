					{href:tpl=submit1mass;name=error_log;form_id=error_log_form;param1=error_action;value1=massive_delete;no_select_msg=no_logs_selected;text=delete;confirm_string=shure_to_delete}
					<input type="hidden" id="error_action" name="error_action" value="no_action">
					<table border="0" width="100%">
						<tr>
							<td width="0%" class="table_header">
								{header_checkbox:name=error_log}
							</td>
							<td align="left" width="0%" class="table_header">
								{sort_link:text=error_message_severity;dbfield=severity}
							</td>
							<td align="left" width="0%" class="table_header">
								{sort_link:text=error_message_title;dbfield=title}
							</td>
							<td align="left" width="80%" class="table_header">
								{sort_link:text=error_message_description;dbfield=description}
							</td>
							<td align="left" width="20%" class="table_header">
								{sort_link:text=error_message_date;dbfield=error_date}
							</td>
						</tr>