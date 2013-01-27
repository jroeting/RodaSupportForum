<?php
	if(!isset($_SESSION['username']) && isset($_GET["code"]))
	{
		// connect with database
		include 'db_con.php';
		// selection of all subjects, ordered by subject_id (so most recent is on top)
		$sql= "SELECT username FROM user_data WHERE verified=0";
		$results = $db->query($sql);
		
		$check = false;
		
		foreach ($results as $row)
		{
			if (crypt($row['username'], $_GET["code"]) == $_GET["code"])
			{
				$sql= "DELETE FROM user_data WHERE verified=? AND username=?";
				$update = $db->prepare($sql);
				$update->bindValue(1, FALSE, PDO::PARAM_BOOL);
				$update->bindValue(2, $row["username"], PDO::PARAM_STR);
				$update->execute();
				echo "Thanks for reporting this wrong email.";
				$check = true;
				break;
			}
		}

		if (!$check)
		{
			header("location:index.php?content=home");
		}
		
		// close database
		$db = NULL;
	}else
	{
		header("location:index.php?content=home");
	}
?>