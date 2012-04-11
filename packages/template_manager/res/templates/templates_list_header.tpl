<form method="post" name="template_management_form" id="template_management_form">
	<input type="hidden" name="template_name" id="template_name"/>
	<input type="hidden" name="template_version" id="template_version"/>
	<script>
		function	delete_template( TemplateName , TemplateVersion ){
			document.getElementById( "template_name" ).value = TemplateName;
			document.getElementById( "template_version" ).value = TemplateVersion;
			document.getElementById( "template_management_form" ).submit();
		}
	</script>
</form>
<table width="100%" border="0">
	<tr><td>Название</td><td>Версия</td><td></td></tr>