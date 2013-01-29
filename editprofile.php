<?php
//Reads the url
$protocol = strpos(strtolower($_SERVER['SERVER_PROTOCOL']),'https') 
				=== FALSE ? 'http' : 'https';
$params   = $_SERVER['QUERY_STRING'];

$params = preg_replace("/[^0-9]/", '', $params); //Only numbers from the parameters remain
if ($_SESSION['user_id'] == $params) :
	?>
	<div>
        <div class="tablehead"> <strong> Edit Your Profile </strong></div>
		<?php 	
			// connection with databse
			include "db_con.php";
			$userID = $_GET["user_id"];
			$sql = "SELECT * FROM user_data WHERE user_id=$userID";
            $result = $db->query($sql);
			$data_array = $result->fetch();
			
			// form for edit profile
			echo "<form action=\"index.php?content=profile&user_id=" . $data_array["user_id"] . "\" method=\"post\">"; ?>
			<table class="editprofile">
				<tr>
					<td>Password:</td>
					<td><input type="password" name="oldPassword" />
					</td>
				</tr>
				<tr>
					<td>Avatar &#60;200kB</td>
					<td><input type="hidden" name="MAX_FILE_SIZE" value="200000" />
						<input type="file" name="file" id="file" accept="image/*" />
					</td>
				</tr> 
				<tr>
					<td>Personal Text: </td> 
					<td><input type="text" name="personal_text" maxlength="75" size="75" value="<?php echo $data_array['personal_text']; ?>"/></td>
				</tr> 
				<tr>
					<td>Age: </td> 
					<td><input type="text" name="age" value="<?php echo $data_array['age']; ?>"/></td>	
				</tr>
				<tr>
					<td>Gender: </td> 
					<td><input type="radio" name="gender" id="radio" value= "0" <?php if($_POST['gender']== 0) echo 'checked="checked"'; ?> /> Male </td>
				</tr>
				<tr>
					<td>&nbsp; </td>
					<td><input type="radio" name="gender" id="radio" value= "1" <?php if($_POST['gender']== 1) echo 'checked="checked"'; ?> /> Female </td>	
					
				</tr> 
				<tr>
					<td>Country </td> 
					<td><input type="text" name="country" value="<?php echo $data_array['country']; ?>" />
					</td>	
				</tr> 
				<tr>
					<td>Quote: </td> 
					<td><input type="text" name="quote" maxlength="75" size="75" value="<?php echo $data_array['quote'];?>" /></td>
				</tr> 
				<tr>
				</tr> 
				<tr>
					<td><input type="submit" name="submit" value="Change Profile" /></td>
				</tr>
			</table>
		</form>
		<br />
		<i><strong>Notice: If your profile has not changed, then your input was wrong. <br />
		Go to <a href="index.php?content=faq">FAQ</a> and see the link "How can I edit/update my profile page?" for more info.</i></strong>
	</div>
	<?php
	else :
		header("location:index.php?content=inlog");
	endif;
	?>