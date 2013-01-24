<?php
	$reaction = $_POST['new_reaction'];
	$userName= $_SESSION['username'];
	$subject = $_GET['subject'];

	include 'db_con.php';
	$selectUserId = "SELECT user_id FROM user_data WHERE username='$userName'";
	$result = $db->query($selectUserId);
	foreach($results as $row)
    {
    	$userId = $row['user_id'];
    }
	
	$sql = "INSERT INTO posts (subject_id, user_id, content) VALUES ('$subject', '$userId', '$reaction')";
	$input = $db->query($sql);

	$results->execute(array(':subject_id'=>$subject_id,
							':user_id'=>$userId,
							':content'=>$reaction));
	$db = NULL;
	header("location:index.php?content=home");
?>