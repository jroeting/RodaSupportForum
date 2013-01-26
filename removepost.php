<!-- removepost.php removes the user's message. It does not actually remove the post from the database, but instead resets the content
of the message to 'This message has been deleted ...'-->
<?php
	// get post_id via http url
	$post_id = $_GET['post_id'];
	// message to be inserted
	$message = 'This message has been deleted ...';
	// connect to database
	include 'db_con.php';
	// set post content to $message
	$removeMessage = "UPDATE posts 
					SET content='$message'
					WHERE post_id = '$post_id'";
	$removedpost = $db->query($removeMessage);
	echo "Your message was succesfully deleted.</br>";
	// a link to subject overview
	echo "<a href='" . $_SERVER['HTTP_REFERER'] . "'>Go back to subject overview</a>";
	$db=NULL;
?>