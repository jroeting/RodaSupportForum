<!-- adminpanel.php is a page that is available for all other administrators for checking subjects and other admin related tasks -->
<p> Welcome ad the administrator panel. Together with the other members of the administrator panel, you are responsible for approve new
submitted subjects, block inappropriate users and delete unactivated accounts.</p>

<table width = "400">
	<tr>
    	<td class="tablehead" colspan="2">Your colleague admins</td>
    <tr>
	<?php
		$myUsername = $_SESSION['username'];
		$username;
		include 'db_con.php';
		$select_admins = "SELECT username, email
						  FROM user_data
						  WHERE account_type = 'adm'";
		$results = $db->query($select_admins);
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

<table width = "400">
	<tr>
    	<td class="tablehead" colspan="2">Subjects waiting for approval</td>
    </tr>
    <?php
		$unchecked = "SELECT *
					  FROM subjects
					  WHERE checked = 0";
		$results = $db->query($unchecked);
		foreach ($results as $row) {
			echo '<tr>';
			echo "<td><a href=\"index.php?content=topic&checked=0&subject=" . $row['subject_id'] . "&subjectname=" . $row['subject_name'] ."\">" . $row['subject_name'] . "</a></td>";
			echo "<td><a href=\"index.php?content=removesubject&action=0&subject=" . $row['subject_id'] . "\"> remove </a> | <a href=\"index.php?content=approvesubject&action=0&subject=" . $row['subject_id'] . "\"> approve </a>";
			echo '</tr>';
		}
	?>	
</table>
							 