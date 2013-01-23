<?php
	if(isset($_SESSION['username']))
	{
		$username = $_SESSION['username'];
		
		// connect with database
		include 'db_con.php';
		// selection of all subjects, ordered by subject_id (so most recent is on top)
		$sql= "SELECT avatar FROM user_data WHERE username='$username'";
		$results = $db->query($sql);

		foreach($results as $row)
		{
			$avatar = ($row['avatar']);
		}
		header("Content-type: image/png");
		echo $avatar;
	}
?>