<?php
	include 'db_con.php';
	$post_id = $_GET['post_id'];
	$sql="DELETE FROM posts WHERE post_id = $post_id";
	echo "Your post was succesfully deleted.";
	header("location:javascript://history.go(-1)");
?>