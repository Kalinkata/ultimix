<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>Installation. Step 2</title>
		<style>
			.active_header
			{
				background			: #BFCFFF;
			}
			.inactive_header
			{
				background			: #E8EDFF;
			}
			.text
			{
				background			: #265CFF;
			}
			.white
			{
				color				: #FFFFFF;
			}
			.button
			{
				padding-right		: 10px;
			}
			input
			{
				border				: 1px solid black;
			}
		</style>
	</head>

	<body>
		<script>
			function	submit_data( FormId )
			{
				document.getElementById( FormId ).submit();
			}
		</script>
		<table cellspacing="0" cellpadding="5" width="100%" height="100%">
			<tr>
				<td align="left" class="inactive_header" width="25%" height="0%">
					&nbsp;License
				</td>
				<td align="left" class="active_header" width="25%" height="0%">
					&nbsp;Database settings
				</td>
				<td align="left" class="inactive_header" width="25%" height="0%">
					&nbsp;Other settings
				</td>
				<td align="left" class="inactive_header" width="25%" height="0%">
					&nbsp;Installation complete
				</td>
			</tr>
			<tr>
				<td colspan="4" class="active_header" height="0%">
					<table width="100%" class="text">
						<tr>
							<td width="90%">
								&nbsp;
							</td>
							<td width="5%">
								<p align="right"><a class="white" href="./install.php?page=1">Back</a>
							</td>
							<td width="5%" class="button">
								<p align="right"><a class="white" href="javascript:submit_data( 'database_form' );">Next</a>
							</td>
						</tr>
					</table>
				</td>
			</tr>
			<tr height="100%">
				<td colspan="4" class="active_header" align="center">
					{error_message}
					<form method="post" action="" id="database_form">
						<input type="hidden" name="setup_db" value="setup_db">
						<table>
							<tr>
								<td>
									Host
								</td>
								<td>
									<input type="text" name="host" id="host" size="70" value="{host}">
								</td>
							</tr>
							<tr>
								<td>
									Database name
								</td>
								<td>
									<input type="text" name="database" id="database" size="70" value="{database}">
								</td>
							</tr>
							<tr>
								<td>
									Table's prefix
								</td>
								<td>
									<input type="text" name="prefix" id="prefix" size="70" value="{prefix}">
								</td>
							</tr>
							<tr>
								<td>
									Databse user
								</td>
								<td>
									<input type="text" name="user" id="user" size="70" value="{user}">
								</td>
							</tr>
							<tr>
								<td>
									Password&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
								</td>
								<td>
									<input type="text" name="password" id="password" size="70" value="{password}">
								</td>
							</tr>
						</table>
					</form>
				</td>
			</tr>
		</table>
	</body>
</html>