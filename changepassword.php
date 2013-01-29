<?php

	if(isset($_SESSION['username'])) :
?>
<?php
	$oldPassword = $_POST['oldPassword'];
	$newPassword = $_POST['newPassword'];
	$passwordCheck = $_POST['passwordCheck'];
	
	function checkChangePassword()
	{
		include "db_con.php";
		$userID = $_GET["user_id"];
		$sql = "SELECT user_id, password FROM user_data WHERE user_id=?";
		$result = $db->prepare($sql);
		$result->bindValue(1, $userID, PDO::PARAM_INT);
		$result->execute();
		
		$oldPassword = $_POST['oldPassword'];
		$newPassword = $_POST['newPassword'];
		$passwordCheck = $_POST['passwordCheck'];
		
		foreach($result as $row)
		{
		//check input password with password in database
		
			if( crypt($oldPassword, $row['password']) == $row['password'])
			{
				$password = crypt($_POST["newPassword"]);
				if ($newPassword == $passwordCheck)
				{
					$password = crypt($_POST["newPassword"]);
					$changePW = "UPDATE user_data SET password=? WHERE user_id=? LIMIT 1";
					$result = $db->prepare($changePW);
					$result->bindValue(1, $password, PDO::PARAM_INT);
					$result->bindValue(2, $userID, PDO::PARAM_INT);
					$result->execute();
				
					session_destroy();
					die("Changing you password was a succes. <br /> <a href=\"index.php?content=inlog\"> Go to inlogscreen </a>");
				} else
				{
					die ("New passwords don't match! <br /> <a href=\"index.php?content=changepasswordform&user_id=" . $row['user_id'] . "\">" . '<i><strong>Try Again</strong></i>' . "</a>");
				} 
			} else
			{
				die ("Old password does not match! <br /> <a href=\"index.php?content=changepasswordform&user_id=" . $row['user_id'] . "\">" . '<i><strong>Try Again</strong></i>' . "</a>");
			}
		}
	}
   
	
	
	if(isset($_POST['submit']))
	{
		checkChangePassword();
	}
?>
<?php
	else :
			header("location:index.php?content=inlog");
		endif;
	
?>