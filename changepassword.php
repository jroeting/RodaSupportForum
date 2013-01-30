<?php
	// You can only enter this page if you are logged in
	if(isset($_SESSION['username'])) :
?>
<?php
	// input of the form of the user placed in vars
	$oldPassword = $_POST['oldPassword']; 
	$newPassword = $_POST['newPassword'];
	$passwordCheck = $_POST['passwordCheck'];
	
	function checkChangePassword()
	{
		include "db_con.php"; // connection with db
		$userID = $_GET["user_id"];
		// searches for the old passwords in db
		$sql = "SELECT user_id, password FROM user_data WHERE user_id=?";
		$result = $db->prepare($sql);
		$result->bindValue(1, $userID, PDO::PARAM_INT);
		$result->execute();
		
		$oldPassword = $_POST['oldPassword'];
		$newPassword = $_POST['newPassword'];
		$passwordCheck = $_POST['passwordCheck'];
		
		foreach($result as $row)
		{
			//checks input password with password in database
			if( crypt($oldPassword, $row['password']) == $row['password'])
			{
				// encrypts the new password and puts it in a var
				$password = crypt($_POST["newPassword"]);
				// checks whether the new password matches with itself
				if ($newPassword == $passwordCheck)
				{
					// updates the db with the new encrypted password
					$changePW = "UPDATE user_data SET password=? WHERE user_id=? LIMIT 1";
					$result = $db->prepare($changePW);
					$result->bindValue(1, $password, PDO::PARAM_INT);
					$result->bindValue(2, $userID, PDO::PARAM_INT);
					$result->execute();
					// after changing the password, the user is automatically logged out
					session_destroy();
					// outputs the text and stops the process.
					die("Changing you password was a succes. <br /> <a href=\"index.php?content=inlog\"> Go to inlogscreen </a>");
				} else
				{
					// if the new passwords don't match, a try again link will appear
					die ("New passwords don't match! <br /> <a href=\"index.php?content=changepasswordform&user_id=" . $row['user_id'] . "\">" . '<i><strong>Try Again</strong></i>' . "</a>");
				} 
			} else
			{
				// if the old password does not match, a try again link will appear
				die ("Old password does not match! <br /> <a href=\"index.php?content=changepasswordform&user_id=" . $row['user_id'] . "\">" . '<i><strong>Try Again</strong></i>' . "</a>");
			}
		}
	}
   
	// the function will only be called after submission of the form
	if(isset($_POST['submit']))
	{
		checkChangePassword();
	}
?>
<?php
	// prevents not-users viewing this page
	else :
			header("location:index.php?content=inlog");
		endif;
	
?>