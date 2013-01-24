<?php
	$errorTitle = "";
	$username = $_SESSION['username'];
	$subject = $_GET['subject'];
	
	function checkMessage()
	{
		$_POST["post"] = trim($_POST["post"]);
		$_POST["post"] = filter_var($_POST["post"], FILTER_SANITIZE_STRING);
	}
	
	function inputPost()
	{
		if ($GLOBALS['errorTitle'] == "")
		{
			$userId;
			$subject;
			$post = $_POST['post'];
			// connect with database
            include 'db_con.php';
			// selection of all subjects, ordered by subject_id (so most recent is on top)
            $sqlSelectUserId = "SELECT user_id FROM user_data WHERE username='$GLOBALS[username]'";
			$results = $db->query($sqlSelectUserId);
			foreach($results as $row)
            {
                $userId = $row['user_id'];
            }
			$sqlinsert = "INSERT INTO posts (user_id, subject_id, content) VALUES ('$userId','$subject','$post')";
            $input = $db->query($sqlinsert);
			
			$sqlSelectSubjectName = "SELECT subject_name FROM subjects WHERE (subject_id='$subject')";
			$results = $db->query($sqlSelectSubjectName);
			foreach($results as $row)
            {
                $subjectname = $row['subject_name'];
            }
			
			$sqlinsert = "INSERT INTO posts (subject_id, user_id, content) VALUES ('$subjectId','$userId','$post')";
			$input = $db->query($sqlinsert);
			
			// close database
            $db = NULL;
			
			header("location:index.php?content=topic&subject=" . $subjectId . "&subjectname=" . $subjectname);
		}else
		{
			include 'newpostform.php';
		}
	}
	
	if(isset($_SESSION['username']))
	{
		if (isset($_POST["submit"]))
		{
			checkMessage();
			inputPost();
		}else
		{
			include 'newreactionform.php';
		}
		
	}else
	{
		header("location:index.php?content=inlog");
	}
?>