<div id="{prefix}_search_form" class="{if:condition={strlen:str={http_param:post=1;type=string;name=search_string;default=}};then=block;else=invisible} padding_0">
<input id="search_string" type="text" class="width_320 flat" value="{http_param:post=1;type=string;name=search_string;default=}" name="search_string">&nbsp;{href:tpl=submit0;form_id={form_id};text=search}&nbsp;{href:page=javascript[dot_dot]ultimix.forms.CancelSearch( '{prefix}_search_form' , {speed} )[dot_comma];text=cancel}
</div>