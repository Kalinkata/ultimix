					<a href="javascript:ultimix.data_form.SubmitDataForm( '#{prefix}_deleted_messages,.{prefix}_final_delete' , '{lang:shure_to_delete_all_pmsg}' );" class="common_button_layout" id="">удалить</a>
					<div class="invisible" class="{prefix}_final_delete"><input type="hidden" name="{prefix}_context_action" value="cleanup_{prefix}"></div>
					<table border="0" width="100%" id="{prefix}_deleted_messages">
						<tr>
							<td width="0%" class="table_header">
								{header_checkbox:name={prefix}_d}
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