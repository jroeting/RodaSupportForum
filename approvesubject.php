<!-- approvesubject.php changes the subject status to checked = 1, so it will be shown in the subject overview.-->
<?php
	// action is default 0, if action is set to 1, the subject will be actually approved
	$action = $_GET['action'];
	$subject = $_GET['subject'];
	if ($action==0) {
		// warning message if action is 0, go back to the subject if action is 0, otherwise, set action to 1 and continue removing message
		echo "This action will show the content of this subject in the subject overview. This action can be undone by removing the subject. Are
		you sure you would like to continue?</br>";
		echo "<a href=\"index.php?content=approvesubject&action=1&subject=$subject\">yes</a></br>";
	} else if ($action==1) {
		// if action = 1, set checked on 1
		include 'db_con.php';
		$approvesubject = "UPDATE subjects
						SET checked=1
						WHERE subject_id=$subject";
		$db->exec($approvesubject);
		// close database
		$db=NULL;
		// removal message and link to forum overview.
		echo 'This subject has been succesfully approved.</br>';
		// go back to from where you came from
		echo '<a href="javascript:history.go(-2)">Go back</a>';
	}
?>