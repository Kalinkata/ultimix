<form id="{prefix}_update_form" method="post" action="" class="form_330">
	<input id="{prefix}_context_action" type="hidden" value="update_record_form" name="{prefix}_context_action">
	<input id="{prefix}_action" type="hidden" value="update_record" name="{prefix}_action">
	<table width="100%">
		<tr>
			<td>
				{lang:master_package}
			</td>
		</tr>
		<tr>
			<td>
				<input type="text" class="width_240 flat" name="master_package_name" value="{form_value:post=1;name=master_package_name;default=}">&nbsp;<input type="text" class="width_70 flat" name="master_package_version" value="{form_value:post=1;name=master_package_version;default=}">
			</td>
		</tr>
		<tr>
			<td>
				{lang:package}
			</td>
		</tr>
		<tr>
			<td>
				<input type="text" class="width_240 flat" name="package_name" value="{form_value:post=1;name=package_name;default=}">&nbsp;<input type="text" class="width_70 flat" name="package_version" value="{form_value:post=1;name=package_version;default=}>
			</td>
		</tr>
		<tr>
			<td class="centered">
				{update}&nbsp;{cancel}
			</td>
		</tr>
	</table>
</form>