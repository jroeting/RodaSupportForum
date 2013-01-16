	<div id="registrationcontent">
        <p class="registration">&nbsp;</p>
        <p class="registration">Please fill in the form to register to this forum</p>
        <form action="index.php?content=register" method="post">
			<?php
				var $errorName;
				var $errorSurname;
				var $errorEmail;
				
				if (isset($_POST["submit"])) 
				{
					checkName();
					checkSurname();
					/**checkEmail();
					checkUsername();
					checkPassword();
					**/
				}
				
				function checkName()
				{
					if (!(isset($_POST["name"]) && filter_var($_POST["name"], FILTER_SANITIZE_STRING) == $_POST["name"] && str_replace(" ", "", $_POST["name"]) == $_POST["name"]))
					{
						$GLOBALS['errorName'] = "invalid name";	
					} 
				}
				
				function checkSurname()
				{
					if (!(isset($_POST["surname"]) && filter_var($_POST["surname"], FILTER_SANITIZE_STRING) == $_POST["surname"] && str_replace(" ", "", $_POST["surname"]) == $_POST["surname"]))
					{
						$GLOBALS['errorName'] = "invalid surname";	
					} 
				}
				
				function checkEmail()
				{
					if (!(isset($_POST["mail"]) && filter_var($_POST["mail"], FILTER_VALIDATE_EMAIL)
					{
						$GLOBALS['errorEmail'] = "invalid e-mail";
					}
				}
			?>
			<table class="registration">
                <tr>
                    <td class="leftcolum">Name</td>
                    <td class="rightcolum"><input type="text" name="name" maxlength="50" />
						<?php
							echo $GLOBALS['errorName'];
						?>
					</td>
                </tr>
                <tr>
                    <td class="leftcolum">Surname</td>
                    <td class="rightcolum"><input type="text" name="surname" maxlength="50" /></td>
                </tr>
				<tr>
                    <td class="leftcolum">Infix</td>
                    <td class="rightcolum"><input type="text" name="infix" maxlength="10" /></td>
                </tr>
				<tr>
                    <td class="leftcolum">E-mail</td>
                    <td class="rightcolum"><input type="text" name="mail" maxlength="100" /></td>
                </tr>
                <tr>
                    <td class="leftcolum">Username</td>
                    <td class="rightcolum"><input type="text" name="username" maxlength="20" /></td>
                </tr>
				<tr>
                    <td class="leftcolum">Quote</td>
                    <td class="rightcolum"><input type="text" name="Quote" maxlength="100" /></td>
                </tr>
                <tr>
                    <td class="leftcolum">Password</td>
                    <td class="rightcolum"><input type="password" name="password" maxlength="20" /></td>
                </tr>
                <tr>
                    <td class="leftcolum">Password check</td>
                    <td class="rightcolum"><input type="password" name="passwordcheck" id="passwordcheck" maxlength="20" /></td>
                </tr>
                <tr>
                    <td colspan="2" class="submit"><input type="submit" value="register" name="submit"></td>
                </tr>
            </table>
        </form>
    </div>