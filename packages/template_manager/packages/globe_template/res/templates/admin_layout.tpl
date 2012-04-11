{auth:logged_in}<table height="100%" width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
						<tr height="100%">
							<td valign="top" class="col">
								<div>{menu}</div>
							</td>
							<td class="bgline">
								<img src="{template_path}/res/images/space.gif" alt="" width="7" border="0"/>
							</td>
							<td valign="top"  width="100%"> 
								<table width="100%"  border="0" cellspacing="0" cellpadding="0">
									<tr valign="top" >
										<td colspan="1" align="center" class="left_aligned">
											<div>{error_message}{success_message}{main}</div>
										</td>
									</tr>
									<tr>
										<td colspan="1"></td>
									</tr>			 
									<tr>
										<td colspan="1"></td>
									</tr>
									<tr>
										<td colspan="1" valign="top" class="left_aligned">
											<div>{bottom}</div>
										</td>
									</tr>
								</table>
							</td>
						</tr>
					</table>
					{auth:~logged_in}{auth:guest}<table height="100%" width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
						<tr height="100%">
							<td valign="top" width="100%"> 
								<table width="100%"  border="0" cellspacing="0" cellpadding="0">
									<tr valign="top">
										<td colspan="1" class="left_aligned">
											<div>{error_message}{success_message}{main}</div>
										</td>
									</tr>
									<tr>
										<td colspan="1"></td>
									</tr>			 
									<tr>
										<td colspan="1"></td>
									</tr>
									<tr>
										<td colspan="1" valign="top">
											<div>{bottom}</div>
										</td>
									</tr>
								</table>
							</td>
						</tr>
					</table>
					{auth:~guest}