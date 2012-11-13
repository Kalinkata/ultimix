					<div class="toolbar">
						{search_form:form_id={prefix}_form}{create_button:text=create_message}{search_button}{delete_button:name=pmsg_i}
					</div>
					<input type="hidden" name="message_action" id="message_action" value="no_action">
					<input type="hidden" name="message_id" id="message_id" value="-1">
					<table border="0" width="100%">
						<tr>
							<td width="0%" class="table_header">
								{header_checkbox:name=pmsg_i}
							</td>
							<td width="20%" align="left" class="table_header">
								{sort_link:text=message_author;dbfield=author}
							</td>
							<td width="20%" align="left" class="table_header">
								{sort_link:text=message_recipient;dbfield=recipient}
							</td>
							<td width="30%" align="left" class="table_header">
								{sort_link:text=message_subject;dbfield=subject}
							</td>
							<td width="30%" align="left" class="table_header">
								{sort_link:text=message_creation_date;dbfield=creation_date}
							</td>
						</tr>