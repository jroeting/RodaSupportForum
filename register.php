	<div id="registrationcontent">
        <h2>Register</h2>
		<p class="registration">Please fill in the form to register to this forum</p>
        <form action="index.php?content=register" method="post">
			<?php
				$errorName = "";
				$errorSurname = "";
				$errorInfix = "";
				$errorEmail = "";
				$errorPassword = "";
				$errorUsername = "";
				
				if (isset($_POST["submit"])) 
				{	$quote = $_POST["quote"];
					
					checkName();
					checkSurname();
					checkInfix();
					checkEmail();
					checkUsername();
					checkPassword();
					checkQuote();
					inputForm();
				}
				
				function checkName()
				{
					if ($_POST["name"] == "" || !(filter_var($_POST["name"], FILTER_SANITIZE_STRING) == $_POST["name"] && str_replace(" ", "", $_POST["name"]) == $_POST["name"] && preg_match('/^[a-z-]+$/i', $_POST["name"])))
					{
						$GLOBALS['errorName'] = "invalid name";	
					}
				}
				
				function checkSurname()
				{
					if ($_POST["surname"] == "" || !(filter_var($_POST["surname"], FILTER_SANITIZE_STRING) == $_POST["surname"] && str_replace(" ", "", $_POST["surname"]) == $_POST["surname"] && preg_match('/^[a-z-]+$/i', $_POST["surname"])))
					{
						$GLOBALS['errorSurname'] = "invalid surname";	
					} 
				}
				
				function checkInfix()
				{
					if (!(filter_var($_POST["name"], FILTER_SANITIZE_STRING) == $_POST["name"] && preg_match('/^[a-z-]+$/i', $_POST["surname"])))
					{
						$GLOBALS['errorInfix'] = "invalid infix";
					}
				}
				
				function checkEmail()
				{
					if (!filter_var($_POST["mail"], FILTER_VALIDATE_EMAIL))
					{
						$GLOBALS['errorEmail'] = "invalid e-mail";
					}
				}
				
				function checkUsername()
				{
					$con = mysql_connect("localhost:3306","webdb13KIC1","busteqec");
					$usernames;
						
					if(!$con)
					{
						die('Could not connect ' . mysql_error());
					}
					
					$selected_db = mysql_select_db("webdb13KIC1",$con);
					$selection = mysql_query("SELECT username FROM user_data");
					
					if ($_POST["username"] == "" || !(filter_var($_POST["username"], FILTER_SANITIZE_EMAIL)))
					{
						$GLOBALS['errorUsername'] = "invalid username";
					}else
					{
						while($row = mysql_fetch_array($selection))
						{
							if ($_POST["username"] == $row['username'])
							{
								$GLOBALS['errorUsername'] = "username already taken";
								break;
							}
						}
					}
					
					mysql_close();
				}
				
				function checkQuote()
				{
					$GLOBALS['quote'] = filter_var($GLOBALS['quote'], FILTER_SANITIZE_STRING);
					$GLOBALS['quote'] = htmlentities($GLOBALS['quote'], ENT_QUOTES);
				}
				
				function checkPassword()
				{
					if (!($_POST["password"] == $_POST["passwordcheck"]))
					{
						$GLOBALS['errorPassword'] = "passwords don't match";
					}else if ($_POST["password"] == "" || !(str_replace(" ", "", $_POST["password"]) == $_POST["password"]))
					{
						$GLOBALS['errorPassword'] = "invalid password";
					}
				}
				
				function inputForm()
				{
					if($GLOBALS['errorName'] == "" && $GLOBALS['errorSurname'] == "" && $GLOBALS['errorInfix'] == "" && $GLOBALS['errorEmail'] == "" && $GLOBALS['errorPassword'] == "" && $GLOBALS['errorUsername'] == "")
					{
						$con = mysql_connect("localhost:3306","webdb13KIC1","busteqec");
						$usernames;
					
						if(!$con)
						{
							die('Could not connect ' . mysql_error());
						}
					
						$selected_db = mysql_select_db("webdb13KIC1",$con);
						$selection = mysql_query("INSERT INTO user_data (username, password, email, name, surname, quote, infix) VALUES ('$_POST[username]','$_POST[password]','$_POST[mail]','$_POST[name]','$_POST[surname]','$_POST[quote]','$_POST[infix]')");
						
						echo "<script language=\"javascript\">window.replace(\"index.php\");</script>";
					}
				}
			?>
			<table class="registration">
                <tr>
                    <td class="leftcolum">Name*</td>
                    <td class="rightcolum"><input type="text" name="name" maxlength="50" value="<?php if ($GLOBALS['errorName'] == "" && isset($_POST["name"])) { echo $_POST["name"];} ?>" />
						<span class="registerError">
							<?php
								echo $GLOBALS['errorName'];
							?>
						</span>
					</td>
                </tr>
                <tr>
                    <td class="leftcolum">Surname*</td>
                    <td class="rightcolum"><input type="text" name="surname" maxlength="50" value="<?php if ($GLOBALS['errorSurname'] == "" && isset($_POST["surname"])) { echo $_POST["surname"];} ?>" />
						<span class="registerError">
							<?php
								echo $GLOBALS['errorSurname'];
							?>
						</span>
					</td>
                </tr>
				<tr>
                    <td class="leftcolum">Infix</td>
                    <td class="rightcolum"><input type="text" name="infix" maxlength="10" value="<?php if ($GLOBALS['errorInfix'] == "" && isset($_POST["infix"])) { echo $_POST["infix"];} ?>" />
						<span class="registerError">
							<?php
								echo $GLOBALS['errorInfix'];
							?>
						</span>
					</td>
                </tr>
				<tr>
                    <td class="leftcolum">E-mail*</td>
                    <td class="rightcolum"><input type="text" name="mail" maxlength="100" value="<?php if ($GLOBALS['errorEmail'] == "" && isset($_POST["mail"])) { echo $_POST["mail"];} ?>" />
						<span class="registerError">
							<?php
								echo $GLOBALS['errorEmail'];
							?>
						</span>
					</td>
                </tr>
                <tr>
                    <td class="leftcolum">Username*</td>
                    <td class="rightcolum"><input type="text" name="username" maxlength="20" value="<?php if ($GLOBALS['errorUsername'] == "" && isset($_POST["username"])) { echo $_POST["username"];} ?>" />
						<span class="registerError">
							<?php
								echo $GLOBALS['errorUsername'];
							?>
						</span>
					</td>
                </tr>
				<tr>
                    <td class="leftcolum">Quote</td>
                    <td class="rightcolum"><input type="text" name="quote" maxlength="100" value="<?php if (isset($_POST["quote"])) { echo $_POST["quote"];} ?>" /></td>
                </tr>
                <tr>
                    <td class="leftcolum">Password*</td>
                    <td class="rightcolum"><input type="password" name="password" maxlength="20" />
						<span class="registerError">
							<?php
								echo $GLOBALS['errorPassword'];
							?>
						</span>
					</td>
                </tr>
                <tr>
                    <td class="leftcolum">Password check*</td>
                    <td class="rightcolum"><input type="password" name="passwordcheck" id="passwordcheck" maxlength="20" /></td>
                </tr>
                <tr>
                    <td colspan="2" class="submit"><input type="submit" value="register" name="submit" /></td>
                </tr>
            </table>
        </form>
    </div>