						<table width="100%" cellpadding="0" cellspacing="0px">
							<tr>
								<td align="left" valign="top">
									<div class="content_title">{title}</div>
								</td>
							</tr>
							<tr>
								<td align="left" valign="top">
									<div class="content_attributes">{lang:content_category}&nbsp;:&nbsp;{category_title}</div>
								<td>
							</tr>
							<tr>
								<td align="left"valign="top">
									<div class="content_attributes">{lang:content_author}&nbsp;:&nbsp;{author_name}</div>
								</td>
							</tr>
							<tr>
								<td valign="top">
									<div class="content">
									{composer:condition={has_demo_content}}{demo_content_unsafe}<p class="{if:condition={has_main_content};then=;else=invisible}"><a href[eq]"./content_view.html?content_id[eq]{id}">{lang:read_more}</a></p>{~composer}
									</div>
								</td>
							</tr>
							<tr>
								<td align="right" valign="top">
									<div class="content_attributes">{lang:content_modification_date} : <nobr>{modification_date}</nobr></div>
								<td>
							</tr>
						</table>
						<br>