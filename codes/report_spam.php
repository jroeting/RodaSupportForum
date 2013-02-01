<!-- rapport_spam.php changes the post status spam to 1, this message will be shown in the admin panel. If it is actually spam, the admin can remove the post.-->
<?php
	// get post_id
	$postID = $_GET['post_id'];
	// if action = 1, set checked on 1
	include 'db_con.php';
	$spam = "UPDATE posts
		     SET spam=1
			 WHERE post_id=$postID";
	$db->exec($spam);
	// close database
	$db=NULL;
	// removal message and link to forum overview.
	echo 'This message has been reported as spam. An administrator will take a look at it.</br>';
	// go back to from where you came from
	echo '<a href="javascript:history.go(-1)">Go back</a>';
?>