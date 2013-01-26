<form id="create_{prefix}_form" method="post" action="" class="form_330">
	<input id="{prefix}_context_action" type="hidden" value="create_record_form" name="{prefix}_context_action">
	<input id="{prefix}_action" type="hidden" value="create_record" name="{prefix}_action">
	<table width="100%">
		<tr>
			<td>
				{lang:master_package}
			</td>
		</tr>
		<tr>
			<td>
				<input type="text" class="width_240 flat" name="master_package_name" value="{http_param:post=1;name=master_package_name;default=ultimix}">&nbsp;<input type="text" class="width_70 flat" name="master_package_version" value="{http_param:post=1;name=master_package_version;default=}">
			</td>
		</tr>
		<tr>
			<td>
				{lang:package}
			</td>
		</tr>
		<tr>
			<td>
				<input type="text" class="width_240 flat" name="package_name" value="{http_param:post=1;name=package_name;default=}">&nbsp;<input type="text" class="width_70 flat" name="package_version" value="{http_param:post=1;name=package_version;default=}">
			</td>
		</tr>
		{composer:condition={options:name=show_buttons;default=1}}<tr>
			<td class="centered">
				{create}&nbsp;{cancel}
			</td>
		</tr>{~composer}
	</table>
</form>