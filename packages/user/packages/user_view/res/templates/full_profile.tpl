<table cellpadding="0" cellspacing="0" border="0" class="form_450">
	<tr><td valign="top">{lang:login}</td><td>{login}</td><td rowspan="4" valign="top"><img src="{avatar_path}" class="avatar_image"></td></tr>
	<tr><td valign="top">{lang:user_name}</td><td>{name}</td></tr>
	<tr><td valign="top">{lang:user_sex}</td><td>{map:first=0|1|2;second={lang:sex_undefined}|{lang:male}|{lang:female};value={sex}}</td></tr>
	<tr><td valign="top">{lang:months_on_site}</td><td>{months_on_site:user_id={id}}</td></tr>
	{composer:condition={eq:value1={user_id};value2={id}}}<tr><td valign="top" colspan="3" align="right">{href:page=./update_profile.html;text=edit_profile}</td></tr>{~composer}
</table>