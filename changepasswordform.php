<head>
	<script type="application/javascript">
	// Code van voorbeeldcode
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
			count.innerHTML = "Password strength is " + strength; 
		}
	</script>
</head>

<?php
	if(isset($_SESSION['username'])) :
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
			
			
			
			// form for edit profile
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
	else :
		header("location:index.php?content=inlog");
	endif;
?>