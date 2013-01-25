<?php
	$action = $_GET['action'];
	$subject = $_GET['subject'];
	if ($action==0) {
		echo "This action will remove the subject and it's content from the subject overview. Are you sure you would like to delete this subject?</br>";
		echo "<a href=\"index.php?content=removesubject&action=1&subject=$subject\">yes</a></br>";
	} else if ($action==1) {
		include 'db_con.php';
		$removesubject = "UPDATE subjects
						SET open=0
						WHERE subject_id=$subject";
		$db->exec($removesubject);
		
		$db=NULL;
		echo 'This subject has been succesfully deleted.</br>';
		echo '<a href="index.php?content=forum">Go back to forum overview</a>';
	}
?>