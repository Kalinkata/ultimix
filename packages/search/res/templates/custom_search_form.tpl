<form id="{form_id}" method="post" action="{action}">
	<div id="{prefix}_search_form">
		<input id="search_string" type="text" class="width_320 flat" value="{http_param:post=1;type=string;name=search_string;default=}" name="search_string">&nbsp;{href:tpl=submit0;form_id={form_id};text=search}
	</div>
</form>