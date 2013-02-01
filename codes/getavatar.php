<?php
	if(isset($_SESSION['username']))
	{
		// connect with database
		include 'db_con.php';
		// all registration values are inserted into the database
		$sql= "SELECT avatar FROM user_data WHERE username=?";
		$results = $db->prepare($sql);
		$results->bindValue(1, $_SESSION['username'], PDO::PARAM_STR);
		$results->execute();
		
		
		$results->bindColumn(1, $avatar, PDO::PARAM_LOB);
		$results->fetch(PDO::FETCH_BOUND);
		
		header("Content-Type: image/png");
		echo $avatar;		
	}
?>