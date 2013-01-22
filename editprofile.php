<div>
        <div class="tablehead"> <strong> Edit Your Profile </strong></div>
		<?php $errorPersonalText = "";
		
		$con = mysql_connect("localhost:3306","webdb13KIC1","busteqec"); 
			if(!$con)
			{
				die('Could not connect ' . mysql_error());
			}
			$selected_db = mysql_select_db("webdb13KIC1",$con);
			if (!$selected_db)
			{
				die('Cannot use database:' . mysql_error());
			}
			$userID = $_GET["user_id"];
			$selection = mysql_query("SELECT * FROM user_data WHERE user_id= $userID" ); 
			
			if (!$selection) 
			{
				echo 'Could not run query: ' . mysql_error();
				exit;
			} 
			
		$row = mysql_fetch_array($selection);
		
			echo "<form action=\"index.php?content=profile&user_id=" . $row["user_id"] . "\" method=\"post\">"; ?>
			<table cellpadding="10">
			<!--	<tr>
					<td> Avatar: </td> <td> <input type="file" name="avatar" size="100" value="Browse"></td>
				</tr> -->
				<tr>
					<td>Personal Text: </td> <td><input type="text" name="personal_text" maxlength="75" value="<?php if ($GLOBALS['errorPersonalText'] == "" && isset($_POST["personal_text"])) { echo $_POST["personal_text"];} ?>"/></td>	
				</tr>
			<!--	<tr>
					<td> Age: </td> 
					<td><input type="text" name="age"></td>	
				</tr>
				<tr>
					<td>Gender: </td> 
					<td><select name="cars">
						<option value="male">Male</option>
						<option value="female">Female</option>
						</select>
					</td>	
				</tr>
				<tr>
					<td> Country </td> 
					<td><input type="text" name="country"></td>	
				</tr>
				<tr><td>Quote: </td> <td><textarea cols="50" rows="5" name="quote">Type here your signature/quote.</textarea></td></td></tr>
				<tr>
				</tr> -->
				<tr>
					<td><input type="submit" value="Change Profile"></td>
				</tr>
			</table>
		</form>
</div>