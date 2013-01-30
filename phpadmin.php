<?php
	if(isset($_SESSION['username']) && $_SESSION['account_type'] == 1) :		
?>
<!-- adminpanel.php is a page that is available for all other administrators for checking subjects and other admin related tasks -->
<p> Welcome to the administrator panel. Together with the other members of the administrator panel, you are responsible for the approval of new
submitted subjects, taking care of spam reports, blocking inappropriate users and deleting unactivated accounts.</p>

<?php
	function nrUnverified()
	{
		include 'db_con.php';
		$count_unverified = $db->prepare("SELECT COUNT(*) AS nrUnverified FROM user_data WHERE verified = false AND register_date<DATE_SUB(curdate(), INTERVAL 5 DAY)");
		if ($count_unverified->execute())
		{
			$row = $count_unverified->fetch();
			return $row["nrUnverified"];
		}

		// close database
        $db = NULL;
	}
	
	if(isset($_POST["submit"]))
	{
		if($_POST["button"] == "remove unverified")
		{
			include 'db_con.php';
			$remove_unverified = $db->prepare("DELETE FROM user_data WHERE verified = false AND register_date<DATE_SUB(curdate(), INTERVAL 5 DAY)");
			$remove_unverified->execute();
			// close database
			$db = NULL;
		}
	}
?>
<form action="index.php?content=phpadmin" method="post">
	<input type="hidden" name="button" value="remove unverified" />
	<input type="submit" class="button2" name="submit" value="Remove <?php echo nrUnverified() ?> unverified users" />
</form>

<br />

<table width = "400">
	<tr>
    	<td class="tablehead" colspan="2">Your colleague admins</td>
    <tr>
	<?php
		include 'db_con.php';
		$myUsername = $_SESSION['username'];
		$username;
		$select_admins = "SELECT username, email
						  FROM user_data
						  WHERE account_type = ?";
		$results = $db->prepare($select_admins);
		$results->bindValue(1,'adm',PDO::PARAM_STR);
		$results->execute();
		foreach ($results as $row) {
			$username = $row['username'];
			if ($myUsername != $username) {
				echo '<tr>';
				echo '<td>'. $row['username'] .'</td>';
				echo '<td>'. $row['email'] .'</td>';
				echo '</tr>';
			}
		}
	?>
</table>

<br />

<table width = "400">
	<tr>
    	<td class="tablehead" colspan="2">Subjects waiting for approval</td>
    </tr>
    <?php
		$unchecked = "SELECT *
					  FROM subjects
					  WHERE checked = 0";
		$results = $db->prepare($unchecked);
		$results->execute();
		foreach ($results as $row) {
			echo '<tr>';
			echo "<td><a href=\"index.php?content=topic&checked=0&subject=" . $row['subject_id'] . "&subjectname=" . $row['subject_name'] ."\">" . $row['subject_name'] . "</a></td>";
			echo "<td><a href=\"index.php?content=removesubject&action=0&subject=" . $row['subject_id'] . "\"> remove </a> | <a href=\"index.php?content=approvesubject&action=0&subject=" . $row['subject_id'] . "\"> approve </a>";
			echo '</tr>';
		}
		
	?>	
</table>

<br />

<table width = "400">
	<tr>
    	<td class="tablehead">Subjects with spam reports</td>
    </tr>
    <?php
		$spam = "SELECT subjects.subject_id, posts.subject_id, subjects.subject_name
				 FROM posts,subjects
				 WHERE subjects.subject_id = posts.subject_id
				 AND posts.spam = 1";
		$result = $db->prepare($spam);
		$result->execute();
		foreach($result as $row) {
				echo '<tr>';
				echo "<td><a href=\"index.php?content=topic&subject=" . $row['subject_id'] . "&subjectname=" . $row['subject_name'] ."\">" .$row['subject_name'] ."</a></td></tr>";
		}
		
		// close database
        $db = NULL;
	?>
</table>
<?php
	endif;
?>