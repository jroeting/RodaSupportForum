<div>
        <div class="tablehead"> <strong> Edit Your Profile </strong></div>
		
		<form action="index.php?content=profile&user_id=2" method="post"> <!-- action klopt niet -->
        <!--<form action="index.php?content=profile&user_id=" method="post">-->
			<table cellpadding="10">
				<tr>
					<td> Avatar: </td> <td> <input type="file" name="avatar" size="100" value="Browse"></td>
				</tr>
				<tr>
					<td>Personal Text: </td> <td><textarea cols="50" rows="5" name="perstxt" value="<?php if ($GLOBALS['errorPersonalText'] == "" && isset($_POST["personal_text"])) { echo $_POST["personal_text"];} ?>">Type here your personal text for your profile visiters.</textarea></td>	
				</tr>
				<tr>
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
				</tr>
				<tr>
					<td><input type="submit" value="Change Profile"></td>
				</tr>
			</table>
		</form>
</div>