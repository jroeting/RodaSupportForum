<?php
	if(!isset($_SESSION['username'])) :
?>
	<div id="registrationcontent">
    <p class="registration">&nbsp;</p>
   	<p class="registration">Log in to your account.</p>
    <form name="login_form" method="post" action="index.php?content=checklogin">
		<table>
			<tr>
				<td>Username:</td>
				<td><input type="text" name="username" id="myusername" /></td>
			</tr>
			<tr>
				<td>Password:</td>
				<td><input type="password" name="password" id="mypassword" /></td>
			</tr>
		</table>
		<p><a href="index.php?content=retrievepasswordform">password forgotten?</a></p>
		<p><a href="index.php?content=register"> register for an account</a></p>
        <p><input type="submit" value="Sign in" name="submit" /></p>
	</form>
</div>
<?php
	else :
		header("location:index.php?content=home");
	endif;
?>
