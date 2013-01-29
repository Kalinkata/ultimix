					<form method="post" action="" id="create_{prefix}_form" class="form_330">
						<input type="hidden" name="{prefix}_context_action" id="{prefix}_context_action" value="copy_record_form">
						<input type="hidden" name="{prefix}_action" id="{prefix}_action" value="copy_record">
						<table>
							<tr>
								<td valign="top" align="left">
									{lang:{prefix}_group}
								</td>
							</tr>
							<tr>
								<td valign="top">
									<input class="width_320 flat" type="text" name="title" value="{http_param:name=title;type=string;post=1;default={title}}">
								</td>
							</tr>
							<tr>
								<td valign="top" align="left">
									{lang:{prefix}_comment}
								</td>
							</tr>
							<tr>
								<td valign="top">
									<textarea class="width_320 flat height_320" name="comment">{http_param:name=comment;type=string;post=1;default={comment}}</textarea>
								</td>
							</tr>
							{composer:condition={options:name=show_buttons;default=1}}<tr>
								<td align="center" valign="center">
									{create}&nbsp;{cancel}
								</td>
							</tr>{~composer}
						</table>
					</form>