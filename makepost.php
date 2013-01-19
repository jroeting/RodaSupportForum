<?php
	$subject_title = $_POST['subject_title'];
	$category = $_POST['category'];
	$username = $_SESSION['myusername'];
	$message = $_POST['message'];
	
	$con = mysql_connect("localhost:3306","webdb13KIC1","busteqec");		
	if(!$con)
	{
		die('Could not connect ' . mysql_error());
	}
	$selected_db = mysql_select_db("webdb13KIC1",$con);
?>
			