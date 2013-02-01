<?php 
//checks if the file is being included, else redirects to home
if (isset($include)):
	unset($include);
?>
	<div id="registrationcontent">
		<h2>Register</h2>
		<p class="registration">Please fill in the form to register to this forum</p>
		   <form action="index.php?content=register" method="post" enctype="multipart/form-data">
			
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
					<td class="leftcolum">Infix</td>
					<td class="rightcolum"><input type="text" name="infix" maxlength="10" size="10" value="<?php if ($GLOBALS['errorInfix'] == "" && isset($_POST["infix"])) { echo $_POST["infix"];} ?>" />
						<span class="registerError">
							<?php
								echo $GLOBALS['errorInfix'];
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
					<td class="leftcolum">Avatar &#60;200kB</td>
					<td class="rightcolum">
						<input type="hidden" name="MAX_FILE_SIZE" value="200000" />
						<input type="file" name="file" id="file" accept="image/*" />
						<span class="registerError">
							<?php
								echo $GLOBALS['errorFile'];
							?>
						</span>
						</td>
				</tr>
				<tr>
					<td class="leftcolum">Quote</td>
					<td class="rightcolum"><input type="text" name="quote" maxlength="100" size="34" value="<?php if (isset($_POST["quote"])) { echo $_POST["quote"];} ?>" /></td>
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
<?php 
	else :
		header("location:index.php?content=home");
	endif;
?>