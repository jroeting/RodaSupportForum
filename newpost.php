<!-- newpost.php handles the creation of a new post-->
<?php
	function checkTitle()
	{
		// connect with database
        include 'db_con.php';
		// selection of all subjects, ordered by subject_id (so most recent is on top)
        $sql= "SELECT subject_name FROM subjects WHERE subject_name='$_POST[title]'";
		$results = $db->query($sql);
		foreach($results as $row)
        {
            if ($row['subject_name'] == $_POST['title'])
			{
				$GLOBALS['errorTitle'] = "invalid title";
			}	
		}
		
		// close database
        $db = NULL;
		
		if ($_POST["title"] == "" || !(filter_var($_POST["title"], FILTER_SANITIZE_STRING) == $_POST["title"] && preg_match('/^[a-z0-9_\s]+$/i', $_POST["title"])))
		{
			$GLOBALS['errorTitle'] = "invalid title";	
		}
	}
	
	function checkMessage()
	{
		$_POST["post"] = trim($_POST["post"]);
		$_POST["post"] = filter_var($_POST["post"], FILTER_SANITIZE_STRING);
	}
	
	function inputPost()
	{
		if ($GLOBALS['errorTitle'] == "")
		{
			$title = $_POST['title'];
			$category = $_POST['category'];
			$post = $_POST['post'];
			$userId;
			$subjectId;
			
			// connect with database
            include 'db_con.php';
			// selection of all subjects, ordered by subject_id (so most recent is on top)
            $sqlSelectUserId = "SELECT user_id FROM user_data WHERE username='$GLOBALS[username]'";
			$results = $db->query($sqlSelectUserId);
			foreach($results as $row)
            {
                $userId = $row['user_id'];
            }
			$sqlinsert = "INSERT INTO subjects (user_id, subject_name, category) VALUES ('$userId','$title','$category')";
            $input = $db->query($sqlinsert);
			
			$sqlSelectSubjectId = "SELECT subject_id FROM subjects WHERE (user_id='$userId' AND subject_name='$title')";
			$results = $db->query($sqlSelectSubjectId);
			foreach($results as $row)
            {
                $subjectId = $row['subject_id'];
            }
			
			$sqlinsert = "INSERT INTO posts (subject_id, user_id, content) VALUES ('$subjectId','$userId','$post')";
			$input = $db->query($sqlinsert);
			
			// close database
            $db = NULL;
			
			header("location:index.php?content=topic&subject=" . $subjectId . "&subjectname=" . $title);
		}else
		{
			$include = true;
			include 'newpostform.php';
		}
	}
	
	if(isset($_SESSION['username']))
	{
		$errorTitle = "";
		$username = $_SESSION['username'];
	
		if (isset($_POST["submit"]))
		{
			checkTitle();
			checkMessage();
			inputPost();
		}else
		{
			$include = true;
			include 'newpostform.php';
		}
		
	}else
	{
		header("location:index.php?content=inlog");
	}
?>