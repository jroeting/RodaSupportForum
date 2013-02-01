	<div>
        <div class="tablehead"> <strong> Obtain New Password </strong></div>
			<?php
				$retrievedsucces = "<br /><p>Password retrieval succes, an email is send with your new password</p>";
				$retrieved = NULL;
				
				//setup database connection
				include "db_con.php";
				
				//if username or email is submitted mail will be send withs users usernam and an code to retrieve a password
				if(isset($_POST["submitUsername"]))
				{
					//selects the user with the inputted username or email
					$sql = "SELECT email, username FROM user_data WHERE username='$_POST[username]' OR email='$_POST[username]' LIMIT 1";
					$result = $db->query($sql);
					$results = $result->fetch();
					
					//generates random 6 character code and crypts it
					$code = substr(base64_encode(rand(1000000000,9999999999)),0,6);
					$codecrypted = crypt($code);
					
					//mails users username and a code to retrieve a password
					$to = $results["email"];
					$subject = "Retrieve user data";
					$message = "You sumbitted your email or username to retrieve your user data\nYour username is: " . $results["username"] . "\n\nUse the code below if you have forgotten your password.\nCode: " . $code;
					$from = "noreply@roda.com";
					$headers = "From:" . $from;
					mail($to,$subject,$message,$headers);
				}
				
				//if the code is submitted it will be compared to he code from the users mail, if equal am mail with new password wil be send
				if(isset($_POST["submitCode"]))
				{
					//checks if crypted email code equals the crypted inputted code
					if($_POST["code"] == crypt($_POST["validation"], $_POST["code"]))
					{
						//password is being encrypted
						$password = substr(base64_encode(rand(1000000000,9999999999)),0,10);
						
						//updates the user with a new password
						$sql= "UPDATE user_data SET password=? WHERE email=?";
						$update = $db->prepare($sql);
						$update->bindValue(1, crypt($password), PDO::PARAM_STR);
						$update->bindValue(2, $_POST["mail"], PDO::PARAM_STR);
						$update->execute();
					
						//mails user his new password
						$to = $_POST["mail"];
						$subject = "Retrieve password";
						$message = "Your password has now been set to: " . $password . "\nby the retrieving password process";
						$from = "noreply@roda.com";
						$headers = "From:" . $from;
						mail($to,$subject,$message,$headers);						
					}else
					{
						//if codes arent equal or not inputted an password is not retrieved
						$retrieved = false;
					}
				}
				
				$db=NULL; // closing database
				
				//if the code is submitted and retrieved isn't false a string with the succesfull retrieving will be displayed else the form
				if (isset($_POST["submitCode"]) && $retrieved !== false) :
					echo $retrievedsucces;
				else :
			?>
		<form name="retrievepassword" method="post" action="index.php?content=retrievepasswordform">
			<p class="space">
				If you've forgotten your login data, don't worry, you can obtain a new one. 
				To start this process please enter your username below. 
				After submission, you will receive a mail with a code. 
			</p>
			<table>
				<tr>
					<td> </td> 
				</tr>
				<tr>
					<td>Username or e-mail:</td>
				</tr> 
				<tr>
					<td><input type="text" name="username" 
					<?php
						//if submitted field will be disabled and value will be put there
						if (isset($_POST["submitUsername"]) || isset($_POST["submitCode"]))
						{
							echo "value=\"" . $_POST["username"] . "\" disabled=\"disabled\"";
						}
					?>/>
					</td>
				</tr>
				<tr><td>&nbsp;</td>
				</tr> 
				<tr>
					<td></td>
				</tr>
				<?php
					//if submitted these inputs are displayed
					if (isset($_POST["submitUsername"]) || isset($_POST["submitCode"])) :
				?>
				<tr>
					<td>Now enter the received code below</td>
				</tr>
				<tr>
					<td><input type="password" name="validation" />
						<?php
							//if the codes didn't match, echo
							if($retrieved === false) :
								echo " Code doesn't match given code";
							endif;
						?>
					</td>
				</tr>
				<?php
					endif;
				?>
				<tr>
					<td>
					<?php
						//if first form is submitted dispplay inputs, if form 2 is submitted display inputs different else display different input
						if (isset($_POST["submitUsername"]))
						{
							echo "<input type=\"hidden\" name=\"mail\" value=\"" . $results["email"] . "\" />
								<input type=\"hidden\" name=\"code\" value=\"" . $codecrypted . "\" />
								<input type=\"submit\" name=\"submitCode\" value=\"Submit code\" />";
						}elseif (isset($_POST["submitCode"]))
						{
							if($retrieved === false)
							{
								echo "<input type=\"hidden\" name=\"mail\" value=\"" . $results["email"] . "\" />
								<input type=\"hidden\" name=\"code\" value=\"" . $codecrypted . "\" />
								<input type=\"submit\" name=\"submitCode\" value=\"Submit code\" />";
							}
						}else 
						{
							echo "<input type=\"submit\" name=\"submitUsername\" value=\"Obtain code\" size=\"0\"/>";
						}
					?>						
					</td>
				</tr>
			</table>
		</form>
			<?php
				endif;
			?>
	</div>
