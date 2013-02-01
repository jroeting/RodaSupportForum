<?php
	$user = $_GET['user_id'];
	$block = $_GET['block'];
	$username;
	include 'db_con.php';
		
	$sql = "SELECT username
			FROM user_data
			WHERE user_id = ?";
	$result = $db->prepare($sql);
	$result->bindValue(1,$user,PDO::PARAM_INT);
	$result->execute();
	foreach ($result as $row) 
	{
		$username = $row['username'];
	}
	if($block == 1) 
	{
		$sql = "UPDATE user_data
				SET verified = 0
				WHERE user_id = ?";
		$block = $db->prepare($sql);
		$block->bindValue(1,$user,PDO::PARAM_INT);
		$block->execute();
		echo 'User with username '.$username.' has been blocked<br/>';
	} else if ($block == 0)
	{
		$sql = "UPDATE user_data
				SET verified = 1
				WHERE user_id =?";
		$unblock = $db->prepare($sql);
		$unblock->bindValue(1,$user,PDO::PARAM_INT);
		$unblock->execute();
		echo 'User with username '.$username.' has been unblocked<br/>';
	}

	$db = NULL;

	echo '<a href="javascript:history.go(-1)">Go back</a>';
?>
