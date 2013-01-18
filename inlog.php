<div id="registrationcontent">
    <p class="registration">&nbsp;</p>
   	<p class="registration">Log in to your account.</p>
    <form>
		<table>
			<tr>
				<form name="login_form" method="post" action="index.php?content=checklogin">
				<td>Username:</td>
				<td><input type="text" name="username" id="myusername"></td>
			</tr>
			<tr>
				<td>Password:</td>
				<td><input type="password" name="password" id="mypassword"></td>
				</form>
			</tr>
		</table>
		<a href="index.php?content=retrievepassword">password forgotten?</a><br /> 
		<a href="index.php?content=register"> register for an account</a><br /><br />
        <input type="checkbox" name="remember" value="me"> Remember me <br />
		<input type="submit" value="Sign in" name="submit" style="margin:5px">
	</form>
</div>
