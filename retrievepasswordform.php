	<div>
        <div class="tablehead"> <strong> Obtain New Password </strong></div>
			<?php
				$retrievedsucces = "<br /><p>Password retrieval succes, an email is send with your new password</p>";
				$retrieved = NULL;
				
				include "db_con.php";
				
				if(isset($_POST["submitUsername"]))
				{
					
					$sql = "SELECT email, username FROM user_data WHERE username='$_POST[username]' OR email='$_POST[username]' LIMIT 1";
					$result = $db->query($sql);
					$results = $result->fetch();
					
					$code = substr(base64_encode(rand(1000000000,9999999999)),0,6);
					$codecrypted = crypt($code);
					
					$to = $results["email"];
					$subject = "Retrieve user data";
					$message = "You sumbitted your email or username to retrieve your user data\nYour username is: " . $results["username"] . "\n\nUse the code below if you have forgotten your password.\nCode: " . $code;
					$from = "noreply@roda.com";
					$headers = "From:" . $from;
					mail($to,$subject,$message,$headers);
				}
				
				if(isset($_POST["submitCode"]))
				{
					if($_POST["code"] == crypt($_POST["validation"], $_POST["code"]))
					{
						$password = substr(base64_encode(rand(1000000000,9999999999)),0,10);
						
						$sql= "UPDATE user_data SET password=? WHERE email=?";
						$update = $db->prepare($sql);
						$update->bindValue(1, crypt($password), PDO::PARAM_STR);
						$update->bindValue(2, $_POST["mail"], PDO::PARAM_STR);
						$update->execute();
					
						$to = $_POST["mail"];
						$subject = "Retrieve password";
						$message = "Your password has now been set to: " . $password . "\nby the retrieving password process";
						$from = "noreply@roda.com";
						$headers = "From:" . $from;
						mail($to,$subject,$message,$headers);						
					}else
					{
						$retrieved = false;
					}
				}
				
				$db=NULL; // closing database
				
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
					if (isset($_POST["submitUsername"]) || isset($_POST["submitCode"])) :
				?>
				<tr>
					<td>Now enter the received code below</td>
				</tr>
				<tr>
					<td><input type="password" name="validation" />
						<?php
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
