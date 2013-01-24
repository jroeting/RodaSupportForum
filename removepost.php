<?php
	$post_id = $_GET['post_id'];
	$message = 'This message has been deleted ...';
	include 'db_con.php';
	$sql = "UPDATE posts 
			SET content='$message'
			WHERE post_id = '$post_id'";
	$removedpost = $db->query($sql);
	echo "Your message was succesfully deleted.</br>";
	echo "<a href='" . $_SERVER['HTTP_REFERER'] . "'>Go back to subject overview</a>";
	$db=NULL;
?>