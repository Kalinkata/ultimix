<form method="post" id="{prefix}_create_form" class="form_330">
	<input type="hidden" id="{prefix}_context_action"name="{prefix}_context_action" value="create_record_form">
	<input type="hidden" id="{prefix}_action" name="{prefix}_action" value="create_record">
	<center>
		<table>
			<tr>
				<td valign="top">
					{lang:author_login}
				</td>
			</tr>
			<tr>
				<td align="left" valign="top">
					<input class="width_320 flat" name="author_login" value="{http_param:post=1;name=author_login;type=string;default=admin}">
				</td>
			</tr>
			<tr>
				<td valign="top">
					{lang:master_id}
				</td>
			</tr>
			<tr>
				<td align="left" valign="top">
					<input class="width_320 flat" name="master_id" value="{http_param:post=1;name=master_id;type=string;default=}">
				</td>
			</tr>
			<tr>
				<td valign="top">
					{lang:master_type}
				</td>
			</tr>
			<tr>
				<td align="left" valign="top">
					<input class="width_320 flat" name="master_type" value="{http_param:post=1;name=master_type;type=string;default=}">
				</td>
			</tr>
			<tr>
				<td valign="top">
					{lang:page}
				</td>
			</tr>
			<tr>
				<td align="left" valign="top">
					<input class="width_320 flat" name="page" value="{http_param:post=1;name=page;type=string;default=}">
				</td>
			</tr>
			<tr>
				<td valign="top">
					{lang:comment}
				</td>
			</tr>
			<tr>
				<td align="left" valign="top">
					<textarea name="comment" class="width_320 height_240 flat">{http_param:post=1;name=comment;type=string;default=}</textarea>
				</td>
			</tr>
			<tr>
				<td colspan="2" align="center">
					{create}&nbsp;{cancel}
				</td>
			</tr>
		</table>
	</center>
</form>