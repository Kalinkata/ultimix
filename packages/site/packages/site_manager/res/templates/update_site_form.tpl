<form method="post" id="update_{prefix}_form" class="form_330">	<input type="hidden" id="{prefix}_context_action"name="{prefix}_context_action" value="update_record_form">	<input type="hidden" id="{prefix}_action" name="{prefix}_action" value="update_record">	<input type="hidden" name="{prefix}_record_id" id="{prefix}_record_id" value="{ids}">	<center>		<table>			<tr>				<td valign="top">					{lang:domain}				</td>			</tr>			<tr>				<td align="left" valign="top">					<input class="width_320 flat" name="domain" value="{form_value:name=domain;type=string}">				</td>			</tr>			<tr>				<td valign="top">					{lang:comment}				</td>			</tr>			<tr>				<td align="left" valign="top">					<textarea class="height_240 width_320 flat" name="comment">{form_value:name=comment;type=string}</textarea>				</td>			</tr>{composer:condition={options:name=show_buttons;default=1}}			<tr>				<td colspan="2" align="center">					{save}&nbsp;{cancel}				</td>			</tr>{~composer}		</table>	</center></form>