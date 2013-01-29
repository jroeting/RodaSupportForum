<!-- nospam.php removes the spam label from posts which have been rapported as spam'-->
<?php
	// get post_id via http url
	$post_id = $_GET['post_id'];
	// connect to database
	include 'db_con.php';
	// set post content to $message
	$noSpam = "UPDATE posts 
			   SET spam = 0
			   WHERE post_id = ?";
	$result = $db->prepare($noSpam);
	$result->bindValue(1,$post_id, PDO::PARAM_INT);
	$result->execute();
	echo "This message isn't reported as spam anymore.</br>";
	// a link to subject overview
	echo "<a href='" . $_SERVER['HTTP_REFERER'] . "'>Go back</a>";
	$db=NULL;
?>
