					<div class="toolbar">
						{search_form}{search_button}{delete_button}
					</div>
					<table border="0" width="100%">
						<tr>
							<td width="0%" align="left" class="table_header">
								{header_checkbox:name={prefix}}
							</td>
							<td width="20%" align="left" class="table_header">
								{sort_link:text=author_login;dbfield=author_login}
							</td>
							<td width="40%" align="left" class="table_header">
								{sort_link:text=review;dbfield=review}
							</td>
							<td width="20%" align="left" class="table_header">
								{sort_link:text=creation_date;dbfield=creation_date}
							</td>
							<td width="20%" align="left" class="table_header">
								{sort_link:text=page;dbfield=page}
							</td>
						</tr>