<!-- removesupbject.php removes a subject from the subject list. It does not actually removes the subject from the database, instead, it sets checked on
3, so the subject isn't selected in the subject overview or in the administration panel.-->
<?php
	// action is default 0, if action is set to 1, the subject will be actually removed
	$action = $_GET['action'];
	$subject = $_GET['subject'];
	if ($action==0) {
		// warning message if action is 0, go back to the subject if action is 0, otherwise, set action to 1 and continue removing message
		echo "This action will remove the subject and it's content from the subject overview. Are you sure you would like to delete this subject?</br>";
		echo "<a href=\"index.php?content=removesubject&action=1&subject=$subject\">yes</a></br>";
	} else if ($action==1) {
		// if action = 1, set checked on 0
		include 'db_con.php';
		$removesubject = "UPDATE subjects
						SET checked=3
						WHERE subject_id=$subject";
		$db->exec($removesubject);
		// close database
		$db=NULL;
		// removal message and link to forum overview.
		echo 'This subject has been succesfully deleted.</br>';
		// go back to from where you came from
		echo '<a href="javascript:history.go(-2)">Go back</a>';
	}
?>