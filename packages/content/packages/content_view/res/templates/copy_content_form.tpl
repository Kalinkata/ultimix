				<form method="post" id="{prefix}_copy_form" class="form_650">
					<input type="hidden" id="{prefix}_context_action"name="{prefix}_context_action" value="copy_record_form">
					<input type="hidden" id="{prefix}_action" name="{prefix}_action" value="copy_record">
					{composer:condition={neq:value1={options:name=category_name};value2=}}
					<input type="hidden" name="category" value="{category_id:names={options:name=category_name}}">
{~composer}<center>
						<table>
							<tr>
								<td valign="top">
									{lang:{prefix}_author}
								</td>
							</tr>
							<tr>
								<td valign="top">
									{session_login}
									<input type="hidden" name="author" value="{user_id}">
								</td>
							</tr>
							<tr>
								<td valign="top">
									{lang:{prefix}_title}
								</td>
							</tr>
							<tr>
								<td valign="top">
									<input class="width_640 flat" type="text" name="title" value="{form_value:name=title}">
								</td>
							</tr>
							{composer:condition={eq:value1={options:name=category_name};value2=}}<tr>
								<td valign="top">
									{lang:{prefix}_category}
								</td>
							</tr>
							<tr>
								<td valign="top">
									{category:direct_category=9;value={form_value:name=category}}
								</td>
							</tr>
							{~composer}<tr>
								<td valign="top">
									{lang:{prefix}_keywords}
								</td>
							</tr>
							<tr>
								<td valign="top">
									<textarea name="keywords" class="flat width_640 height_80">{form_value:name=keywords}</textarea>
								</td>
							</tr>
							<tr>
								<td valign="top">
									{lang:{prefix}_description}
								</td>
							</tr>
							<tr>
								<td valign="top">
									<textarea name="description" class="flat width_640 height_80">{form_value:name=description}</textarea>
								</td>
							</tr>
							<tr>
								<td valign="top">
									{lang:{prefix}_demo}
								</td>
							</tr>
							<tr>
								<td valign="top">
									{textarea:class=width_640 flat height_480;name=demo_content}{form_value:name=demo_content}{~textarea}
								</td>
							</tr>
							<tr>
								<td valign="top">
									{lang:{prefix}_main}
								</td>
							</tr>
							<tr>
								<td valign="top">
									{textarea:class=width_640 flat height_480;name=main_content}{form_value:name=main_content}{~textarea}
								</td>
							</tr>
							<tr>
								<td valign="top">
									{lang:{prefix}_print} <input type="checkbox" onclick="TogglePrintVersion( this );">
									<script>
										function			TogglePrintVersion( Object )
										{
											if( jQuery( Object ).prop( 'checked' ) )
											{
												jQuery( '#content_print_toggle' ).attr( 'class' , 'visible' );
											}
											else
											{
												jQuery( '#content_print_toggle' ).attr( 'class' , 'invisible' );
												CKEDITOR.instances.print_content.setData( '' );
											}
										}
									</script>
								</td>
							</tr>
							<tr>
								<td valign="top">
									<div id="content_print_toggle" class="invisible">
										{textarea:class=width_640 flat height_320;name=print_content}{form_value:post=1;name=print_content}{~textarea}
									</div>
								</td>
							</tr>
							<tr>
								<td align="center" colspan="2" valign="center">
									{copy}&nbsp;{cancel}
								</td>
							</tr>
						</table>
					</center>
				</form>