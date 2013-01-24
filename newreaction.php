<?php
/*
	$reaction = $_POST['new_reaction'];
	$username= $_SESSION['username'];
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
*/
if (isset($_POST["submit"]))
	{
	$post = $_POST['post'];
	$username = $_SESSION['username'];
	$userId;
	$subjectName;
	$subjectId = $_GET['subject'];
	
	// connect with database
    include 'db_con.php';
	// selection of all subjects, ordered by subject_id (so most recent is on top)
    $sqlSelectUserId = "SELECT user_id FROM user_data WHERE username='$username'";
	$results = $db->query($sqlSelectUserId);
	foreach($results as $row)
    {
       	$userId = $row['user_id'];
    }
	$sqlinsert = "INSERT INTO posts (user_id, subject_id, content) VALUES ('$userId','$subjectId','$post')";
    $input = $db->query($sqlinsert);
	
	$sqlSelectSubjectName = "SELECT subject_name FROM subjects WHERE (subject_id='$subjectId')";
	$results = $db->query($sqlSelectSubjectName);
	foreach($results as $row)
    {
    	$subjectName = $row['subject_name'];
    }
		
	// close database
    $db = NULL;
		
	header("location:index.php?content=topic&subject=" . $subjectId . "&subjectname=" . $subjectName);
	}
?>