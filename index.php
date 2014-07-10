<!DOCTYPE html >
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Sipcom Asterisk Service</title>

</head>
<body>
	<div style="width: 500px; margin: 200px auto 0 auto;">
		<form name="form" method="post" action="pages/actions/login.php">
			<table border="0" cellpadding="0" cellspacing="0" align="center">
				<tr>
					<td align="center">
						<table border="0" cellpadding="0" cellspacing="0">
							<tr>
								<td width="80" height="24" align="right">Login</td>
								<td width="80" height="24" align="left"><input name="username"
									type="text" size="20"></td>
							</tr>
							<tr>
								<td width="80" height="24" align="right">Mot de pass</td>
								<td width="80" height="24" align="left"><input name="password"
									type="password" size="20"></td>
							</tr>
							<tr>
								<td height="24" colspan="2" align="right"><input type="submit"
									name="sumbit" value="Login" onclick="return check(form);"></td>
							</tr>
						</table>
					</td>
				</tr>
			</table>
		</form>
	</div>
	<script type="text/javascript">
	function check(form){
		if(form.username.value==""){
			alert("Nom d'utilisateur!");
			form.username.focus();
			return false;
		}
		if(form.password.value==""){
			alert("Mot de pass !");
			form.password.focus();
			return false;
		}
	form.submit();
	}
</script>
</body>
</html>
