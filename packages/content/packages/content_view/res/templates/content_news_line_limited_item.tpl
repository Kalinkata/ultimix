						<table width="100%" cellpadding="0" cellspacing="0px">
							<tr>
								<td width="50%" align="left" valign="top">
									<div class="content_title">{title}</div>
								</td>
								<td width="50%" align="left" colspan="2" valign="top">
									<div class="content_attributes">{lang:content_author}&nbsp;:&nbsp;{author_name}</div>
								</td>
							</tr>
							<tr>
								<td colspan="5" valign="top">
									{composer:condition={has_demo_content}}{demo_content_unsafe}<p class="{if:condition={has_main_content};then=;else=invisible}"><a href[eq]"./content_view.html?content_id[eq]{id}">{lang:read_more}</a></p>{~composer}
								</td>
							</tr>
							<tr>
								<td align="left" valign="top">
									&nbsp;
								<td>
								<td align="left" valign="top">
									<div class="content_attributes">{lang:content_category}&nbsp;:&nbsp;{category_title}</div>
								<td>
								<td align="left" valign="top">
									<div class="content_attributes">{lang:content_modification_date}&nbsp;:&nbsp;{nbsp:{modification_date}}</div>
								<td>
							</tr>
						</table>
						<br>