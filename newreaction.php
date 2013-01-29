<!-- newreaction.php handles the creation of a new post -->
<?php
	// if the user pressed the submit button
	if (isset($_POST["submit"]))
		{
			// the next variables are set.
			$post = $_POST['post'];
			$username = $_SESSION['username'];
			$userId = $_SESSION['user_id'];
			$subjectName;
			$subjectId = $_GET['subject'];
	
			// connect with database
    		include 'db_con.php';
			// insert content of user message into database
			$sqlinsert = "INSERT INTO posts (user_id, subject_id, content) VALUES (?,?,?)";
    		$input = $db->prepare($sqlinsert);
			$input->bindValue(1,$userId,PDO::PARAM_INT);
			$input->bindValue(2,$subjectId,PDO::PARAM_INT);
			$input->bindValue(3,$post,PDO::PARAM_STR);
			$input->execute();
	
			// select the subject name to wich subject_id is belonging
			$sqlSelectSubjectName = "SELECT subject_name FROM subjects WHERE (subject_id=?)";
			$results = $db->prepare($sqlSelectSubjectName);
			$results->bindValue(1,$subjectId,PDO::PARAM_INT);
			$results->execute();
			foreach($results as $row)
    		{
    			$subjectName = $row['subject_name'];
    		}
		
			// close database
    		$db = NULL;
			// heads the user back to the reaction overview
			header("location:index.php?content=topic&subject=" . $subjectId . "&subjectname=" . $subjectName);
		}
?>