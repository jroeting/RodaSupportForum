	<div>
        <div class="tablehead"> <strong> Obtain New Password </strong></div>
	
			<form name="retrievepassword" method="post" action="index.php?content=retrievepassword">
			<p class="space">
				If you've forgotten your login data, don't worry, you can obtain a new one. 
				To start this process please enter your username below. 
				After submission, you will receive a mail with a new password. 
				You can change this password in your profile.
			</p>
			<table>
				<tr>
					<td> </td> 
				</tr>
				<tr>
					<td>Username:</td>
				</tr> 
				<tr>
					<td><input type="text" name="username"  /></td>
				</tr>
				<tr><td>&nbsp;</td>
				</tr> 
				<tr>
					<td>To make sure that you are who you say you are, answer the question below:</td>
				</tr>
				<tr>
					<td>What is the sum of your birthdate (dd-mm-year)? For example, if you were born in 01-01-2000, the anwser is 2002:</td>
				</tr>
				<tr>
					<td><input type="text" name="validation" /></td>
				</tr>
				<tr>
					<td><input type="submit" name="submit" value="Obtain New Password" /></td>
				</tr>
			</table>
		</form>
	</div>
