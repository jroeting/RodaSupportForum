<head>
	<script type="application/javascript">
	// Code van voorbeeldcode
	// this function checks the strength of the new password
		function pwstrength()
		{
			id = document.getElementById("password");
			count = document.getElementById("count");
			strength = "Bad";
			if (id.value.length > 6) 
			{
				strength= "Medium";
			}
			if (id.value.length > 12) 
			{
				strength= "Good";
			}
			count.innerHTML = "Password strength is " + strength; // outputs the strength of password on page
		}
	</script>
</head>

<?php
	// the user can only change his/her password
	//Reads the url
	$protocol = strpos(strtolower($_SERVER['SERVER_PROTOCOL']),'https') 
				=== FALSE ? 'http' : 'https';
	$params   = $_SERVER['QUERY_STRING'];

	$params = preg_replace("/[^0-9]/", '', $params); //Only numbers from the parameters remain
	if ($_SESSION['user_id'] == $params) :
?>
	<div>
        <div class="tablehead"> <strong> Change Your Password </strong></div>
		<?php 	
			
			// connection with databse
			include "db_con.php";
			$userID = $_GET["user_id"];
			$sql = "SELECT * FROM user_data WHERE user_id=$userID";
            $result = $db->query($sql);
			$data_array = $result->fetch();
			
			// form to change your password
			echo "<form action=\"index.php?content=changepassword&user_id=" . $data_array["user_id"] . "\" method=\"post\">"; ?>
			<table class="editprofile">
				<?php echo "<td> Logged in as ". $data_array['username'] . "</td> 
							</tr>"; ?>
				<tr>
					<td>Old Password:</td>
					<td><input type="password" name="oldPassword"  />
					</td>
				</tr> 
				<tr>
					<td id="count">New Password: </td> 
					<td><input type="password" name="newPassword" id="password" maxlength="20" onkeyup="pwstrength()"/></td>
				</tr> 
				<tr>
					<td> Repeat New Password: </td> 
					<td><input type="password" name="passwordCheck" maxlength="20" /></td>	
				</tr>
				<tr>
				</tr> 
				<tr>
					<td><input type="submit" name="submit" value="Change Password" /></td>
				</tr>
			</table>
		</form>
	</div>
<?php
	// If you are not logged in as a user, you will be redirected to the login screen
	else :
		header("location:index.php?content=inlog");
	endif;
?>