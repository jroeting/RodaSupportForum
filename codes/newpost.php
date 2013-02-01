<!-- newpost.php handles the creation of a new post-->
<?php
	function checkTitle()
	{
		// connect with database
        include 'db_con.php';
		// selects subjects name where subject name is inputted title
        $sql= "SELECT subject_name FROM subjects WHERE subject_name=?";
		$results = $db->prepare($sql);
		$results->bindValue(1,$_POST['title'],PDO::PARAM_STR);
		$results->execute();
		foreach($results as $row)
        {
            //if there is a mtach an errormessages wil bee assigned
			if ($row['subject_name'] == $_POST['title'])
			{
				$GLOBALS['errorTitle'] = "invalid title";
			}	
		}
		
		// close database
        $db = NULL;
		
		//checks title for a number of conditions
		if ($_POST["title"] == "" || !(filter_var($_POST["title"], FILTER_SANITIZE_STRING) == $_POST["title"]))
		{
			$GLOBALS['errorTitle'] = "invalid title";	
		}
	}
	
	//chcks message for certain conditions
	function checkMessage()
	{
		$_POST["post"] = trim($_POST["post"]);
		$_POST["post"] = filter_var($_POST["post"], FILTER_SANITIZE_STRING);
	}
	
	//inputs post in database
	function inputPost()
	{
		//if no errors post is inserted in database
		if ($GLOBALS['errorTitle'] == "")
		{
			$title = $_POST['title'];
			$category = $_POST['category'];
			$post = $_POST['post'];
			$userId;
			$subjectId;
			
			// connect with database
            include 'db_con.php';
			// selects user id for logged in user
            $sqlSelectUserId = "SELECT user_id FROM user_data WHERE username=?";
			$results = $db->prepare($sqlSelectUserId);
			$results->bindValue(1,$GLOBALS['username'],PDO::PARAM_STR);
			$results->execute();
			foreach($results as $row)
            {
                $userId = $row['user_id'];
            }
			//inserts subjects into subjects
			$sqlinsert = "INSERT INTO subjects (user_id, subject_name, category) VALUES (?,?,?)";
            $input = $db->prepare($sqlinsert);
			$input->bindValue(1,$userId,PDO::PARAM_INT);
			$input->bindValue(2,$title,PDO::PARAM_STR);
			$input->bindValue(3,$category,PDO::PARAM_STR);
			$input->execute();
			
			//selects subject id  with use of the user id and subject name
			$sqlSelectSubjectId = "SELECT subject_id FROM subjects WHERE (user_id = :userId AND subject_name = :title)";
			$results = $db->prepare($sqlSelectSubjectId);
			$results->bindValue(':userId',$userId,PDO::PARAM_INT);
			$results->bindValue(':title',$title,PDO::PARAM_STR);
			$results->execute();
			foreach($results as $row)
            {
                $subjectId = $row['subject_id'];
            }
			
			//inserts post into posts
			$sqlinsert = "INSERT INTO posts (subject_id, user_id, content) VALUES (?,?,?)";
			$input = $db->prepare($sqlinsert);
			$input->bindValue(1,$subjectId,PDO::PARAM_INT);
			$input->bindValue(2,$userId,PDO::PARAM_INT);
			$input->bindValue(3,$post,PDO::PARAM_STR);
			$input->execute();
			
			// close database
            $db = NULL;
			
			//after posting, redirected to post
			header("location:index.php?content=topic&subject=" . $subjectId . "&subjectname=" . $title);
		}else
		{
			//include is true and form is again included
			$include = true;
			include 'newpostform.php';
		}
	}
	
	//if logged in sets veriables and checks then inputs post 
	if(isset($_SESSION['username']))
	{
		$errorTitle = "";
		$username = $_SESSION['username'];
		
		//checks if submitted else form is again included
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
		//if not logged in, redirected to inlog
		header("location:index.php?content=inlog");
	}
?>