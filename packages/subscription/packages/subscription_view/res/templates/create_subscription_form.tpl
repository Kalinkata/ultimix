<form method="post" id="create_{prefix}_form" class="form_330">	<input type="hidden" id="{prefix}_context_action"name="{prefix}_context_action" value="create_record_form">	<input type="hidden" id="{prefix}_action" name="{prefix}_action" value="create_record">	<center>		<table>			<tr>				<td valign="top">					{lang:subscription_title}				</td>			</tr>			<tr>				<td align="left" valign="top">					<input class="width_320 flat" name="title" value="{http_param:post=1;name=title;type=string;default=}">				</td>			</tr>			<tr>				<td valign="top">					{lang:subscription_description}				</td>			</tr>			<tr>				<td align="left" valign="top">					<textarea class="height_240 width_320 flat" name="description">{http_param:post=1;name=description;type=string;default=}</textarea>				</td>			</tr>			<tr>				<td valign="top">					{lang:subscription_template}				</td>			</tr>			<tr>				<td align="left" valign="top">					<input class="width_320 flat" name="template" value="{http_param:post=1;name=template;type=string;default=}">				</td>			</tr>{composer:condition={options:name=show_buttons;default=1}}			<tr>				<td colspan="2" align="center">					{create}&nbsp;{cancel}				</td>			</tr>{~composer}		</table>	</center></form>