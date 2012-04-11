<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		{header}
		<script src="{template_path}/include/js/jquery.layout.min.js"></script>
		<script src="{template_path}/include/js/jquery.layout.autorun.js"></script>
		<link type="text/css" rel="stylesheet" href="{template_path}/res/css/style.css"/>
		<title>{title}</title>
	</head>
	<body>
		{auth:logged_in}
			<!-- Note that all layout_* parameters of the template must be set, and their values must be 1 or 0 -->
			{composer:condition={layout_center}}<div class="ui-layout-center">{center}</div>{~composer}
			{composer:condition={layout_north}}<div class="ui-layout-north">{north}</div>{~composer}
			{composer:condition={layout_south}}<div class="ui-layout-south">{south}</div>{~composer}
			{composer:condition={layout_east}}<div class="ui-layout-east">{east}</div>{~composer}
			{composer:condition={layout_west}}<div class="ui-layout-west">{west}</div>{~composer}
		{auth:~logged_in}
		{auth:guest}
			{auto_open_login_dialog}
		{auth:~guest}
	</body>
</html>