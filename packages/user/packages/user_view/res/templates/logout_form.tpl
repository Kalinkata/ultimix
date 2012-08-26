{auth:logged_in}					
					<form method="post" id="logout_form">
						<a href="./edit_profile.html?back_page={request_uri}" title="{lang:edit_profile}">{session_login}</a>&nbsp;|&nbsp;<input type="hidden" name="action" value="logout">{href:class=logout_button;tpl=submit0;form_id=logout_form;text=logout;waiting=false}
					</form>
{~auth}