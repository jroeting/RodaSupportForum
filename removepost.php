<?php
	$action = $_GET['action'];
	$post_id = $_GET['post_id'];
	if ($action==0) {
		echo 'This action will reset the content of your message. This action can\'t be undone. Are you sure you would like to delete your post?';
		echo '<a href="index.php?content=removepost&action=1&post_id=$post_id">yes</a></br><a href="'. $_SERVER['HTTP_REFERER'] . '">No, go back</a>';
	} else if ($action==1) {
		$message = 'This message has been deleted ...';
		include 'db_con.php';
		$sql = "UPDATE posts 
				SET content='$message'
				WHERE post_id = $post_id";
		$db->query($sql);
		echo 'Your message was succesfully deleted.</br>';
		echo '<a href="'. $_SERVER['HTTP_REFERER'] . '">Go back</a>';
		$db=NULL;
	}
?>