	<div id="registrationcontent">
        <p class="registration">&nbsp;</p>
        <p class="registration">Please fill in the form to register to this forum</p>
        <form action="index.php?content=register" method="post">
			<?php
				if (isset($_POST["submit"])) 
				{
					checkName();
					checkSurename();
					checkEmail();
					checkUsername();
					checkPassword();
				}
			?>
			<table class="registration">
                <tr>
                    <td class="leftcolum">Name</td>
                    <td class="rightcolum"><input type="text" name="name" />
						
					</td>
                </tr>
                <tr>
                    <td class="leftcolum">Surname</td>
                    <td class="rightcolum"><input type="text" name="surname" /></td>
                </tr>
				<tr>
                    <td class="leftcolum">Infix</td>
                    <td class="rightcolum"><input type="text" name="infix" /></td>
                </tr>
				<tr>
                    <td class="leftcolum">E-mail</td>
                    <td class="rightcolum"><input type="text" name="mail" /></td>
                </tr>
                <tr>
                    <td class="leftcolum">Username</td>
                    <td class="rightcolum"><input type="text" name="username" /></td>
                </tr>
				<tr>
                    <td class="leftcolum">Quote</td>
                    <td class="rightcolum"><input type="text" name="Quote" /></td>
                </tr>
                <tr>
                    <td class="leftcolum">Password</td>
                    <td class="rightcolum"><input type="password" name="password" /></td>
                </tr>
                <tr>
                    <td class="leftcolum">Password check</td>
                    <td class="rightcolum"><input type="password" name="passwordcheck" id="passwordcheck"/></td>
                </tr>
                <tr>
                    <td colspan="2" class="submit"><input type="submit" value="register" name="submit"></td>
                </tr>
            </table>
        </form>
    </div>