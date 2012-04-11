<form id="forms_contact" method="post" class="form_330">
	<input type="hidden" name="form_send" value="1">
	<h3>{lang:contact_us}</h3>
	<table width="100%">
		<tr>
			<td>{lang:forms_name}</td>
			<td><input type="text" class="flat width_180" value="" name="name"></td>
		</tr>
		<tr>
			<td>{lang:forms_email}</td>
			<td><input type="text" class="flat width_180" value="" name="email"></td>
		</tr>
		<tr>
			<td valign="top">{lang:forms_text}</td>
			<td><textarea name="message" class="flat width_240 height_180"></textarea></td>
		</tr>
		<tr>
			<td colspan="2" align="center">{href:tpl=submit0;text=send;form_id=forms_contact}</td>
		</tr>
	</table>
</form>