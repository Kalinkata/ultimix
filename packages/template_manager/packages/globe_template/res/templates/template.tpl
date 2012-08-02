<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		{header}
		<title>{title}</title>
		<meta name="keywords" content="{keywords}" />
		<meta name="description" content="{description}" />
	</head>

	<body>
		<div id="maincontainer">
			<div id="container_out" align="center">
				<div id="container">
					<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
						<tr>
							<td align="left" class="www">&nbsp;</td>
							<td align="right" class="top_bar" valign="top"> 
								<img border="0" src="{template_path}/res/images/icon.gif" alt="" width="109" height="37" usemap="#Map" />
							</td>
						</tr>
					</table>
					
					<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
						<tr>
							<td align="right" class="top_left" valign="middle"></td>
								<td class="top_nav_repeat" valign="bottom"> 
									<div>{some_menu}</div> 
								</td>
								<td  align="left" class="top_nav_right" valign="middle"></td>
						</tr>
					</table>
					<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
						<tr>
							<td class="pw" width="70%">{bread_crumbs}</td>
							<td width="255px" align="right">
								<div class="date">{lang:today_is} {sysdate}&nbsp;{systime} {lang_switch}</div>
							</td>
						</tr>
					</table>
					{layout}<table width="100%" class="foot"  align="center" border="0" cellspacing="0" cellpadding="0">
						<tr>
							<td align="left" valign="top" class="footer"> 
								{lang:page_was_generated_in}{gen_time}<br /><br />
							</td>
							<td valign="top" width="300" class="footer" align="right">{banner}{banners}</td>
						</tr>
					</table>
					<div class="left_aligned">{trace}</div>
				</div>
			</div>
		</div>
		<!--map name="Map" id="Map">
			<area shape="rect" coords="-4,15,28,29" href="index.html" alt="{lang:home}" />
			<area shape="rect" coords="37,15,71,29" href="contacts.html" alt="{lang:contact}" />
			<area shape="rect" coords="80,15,114,29" href="search.html" alt="{lang:search}" />
		</map-->
	</body>
</html>