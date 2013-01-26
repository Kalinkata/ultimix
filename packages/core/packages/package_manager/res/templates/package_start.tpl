<form id="{prefix}_form" method="post" action="">
<input type="hidden" value="0" name="ajaxed">
<input id="reorder_field" class="reorder_field" type="hidden" value="" name="reorder_field">
<input id="order" class="order" type="hidden" value="" name="order">
<input id="{prefix}_context_action" type="hidden" value="" name="{prefix}_context_action">
<input id="{prefix}_action" type="hidden" value="" name="{prefix}_action">
<input id="{prefix}_record_id" type="hidden" value="" name="{prefix}_record_id">
</form>
{composer:condition={options:name=toolbar_buttons;default=1}}<div class="toolbar">
	{create_button}{copy_button}{update_button}{delete_button}
</div>
{~composer}<div class="tree_control tree_package"><ul class="ltr"><li id="phtml_system" class="open" rel="root"><a href="#"><ins>&nbsp</ins>/</a><ul>