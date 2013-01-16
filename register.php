	<div id="registrationcontent">
        <p class="registration">&nbsp;</p>
        <p class="registration">Please fill in the form to register to this forum</p>
        <form action="index.php?content=register" method="post">
			<?php
				$errorName = "";
				$errorSurname = "";
				$errorInfix = "";
				$errorEmail = "";
				$errorPassword = "";
				
				if (isset($_POST["submit"])) 
				{
					$quote = $_POST["quote"];
					
					checkName();
					checkSurname();
					checkInfix();
					checkEmail();
					checkUsername();
					checkPassword();
				}
				
				function checkName()
				{
					if ($_POST["name"] == "" || !(filter_var($_POST["name"], FILTER_SANITIZE_STRING) == $_POST["name"] && str_replace(" ", "", $_POST["name"]) == $_POST["name"] && preg_match('/[^A-Za-z]/', $_POST["name"])))
					{
						$GLOBALS['errorName'] = "invalid name";	
					}
				}
				
				function checkSurname()
				{
					if ($_POST["surname"] == "" || !(filter_var($_POST["surname"], FILTER_SANITIZE_STRING) == $_POST["surname"] && str_replace(" ", "", $_POST["surname"]) == $_POST["surname"] && preg_match('/[^A-Za-z]/', $_POST["surname"]))
					{
						$GLOBALS['errorSurname'] = "invalid surname";	
					} 
				}
				
				function checkInfix()
				{
					if (!(filter_var($_POST["name"], FILTER_SANITIZE_STRING) == $_POST["name"]))
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
			?>
			<table class="registration">
                <tr>
                    <td class="leftcolum">Name*</td>
                    <td class="rightcolum"><input type="text" name="name" maxlength="50" />
						<span class="registerError">
							<?php
								echo $GLOBALS['errorName'];
							?>
						</span>
					</td>
                </tr>
                <tr>
                    <td class="leftcolum">Surname*</td>
                    <td class="rightcolum"><input type="text" name="surname" maxlength="50" />
						<span class="registerError">
							<?php
								echo $GLOBALS['errorSurname'];
							?>
						</span>
					</td>
                </tr>
				<tr>
                    <td class="leftcolum">Infix</td>
                    <td class="rightcolum"><input type="text" name="infix" maxlength="10" />
						<span class="registerError">
							<?php
								echo $GLOBALS['errorInfix'];
							?>
						</span>
					</td>
                </tr>
				<tr>
                    <td class="leftcolum">E-mail*</td>
                    <td class="rightcolum"><input type="text" name="mail" maxlength="100" />
						<span class="registerError">
							<?php
								echo $GLOBALS['errorEmail'];
							?>
						</span>
					</td>
                </tr>
                <tr>
                    <td class="leftcolum">Username*</td>
                    <td class="rightcolum"><input type="text" name="username" maxlength="20" /></td>
                </tr>
				<tr>
                    <td class="leftcolum">Quote</td>
                    <td class="rightcolum"><input type="text" name="quote" maxlength="100" /></td>
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
                    <td colspan="2" class="submit"><input type="submit" value="register" name="submit"></td>
                </tr>
            </table>
        </form>
    </div>