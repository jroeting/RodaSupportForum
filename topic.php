<!-- topic.php gives an overview of the reactions in a subject. It is showed with the user that wrote the reaction, the user's avatar and the user's quote. -->
    <?php
		// get subject ID and name from variables given in url
        $subject = $_GET['subject'];
		$subjectname = $_GET['subjectname'];
		// if the user is logged in, the user can place a new reaction in this subject
        if(isset($_SESSION['myusername'])) 
		{
            echo "<a href=\"index.php?content=newpost&subject='$subject'\">Place a reaction</a>";
        }
		// shows subject name
		
		echo '<table align="center">';
		echo '<tr>';
		echo '<td class="tablehead" colspan="2"><strong>' . $subjectname . '</strong></td>';
		echo '</tr>';
		// open database
		$db = new PDO('mysql:host=localhost;dbname=webdb13KIC1', 'webdb13KIC1', 'busteqec');
		// select user data and post concent as a reaction on selected subject
        $sql = "SELECT user_data.username, user_data.avatar, user_data.quote, user_data.account_type, posts.content, posts.date_time, user_data.user_id FROM 
		user_data, posts WHERE posts.user_id = user_data.user_id AND posts.subject_id = $subject ORDER BY posts.date_time ASC";
        $results = $db->query($sql);
		// shows user data and post content
        foreach($results as $row)
        {
			echo '<tr border="1px">';
			echo '<td width="100"></td>';
			echo '<td width="850"> Reaction placed at &nbsp;' . date("d-m-Y H:i:s", $row['date_time']) . '</td>';
			echo '</tr>';
			echo '<tr border="1px">';
			echo '<td><strong><a href="index.php?content=profile&user_id=' . $row['user_id'] . '">' . $row['username'] . '</a></strong></td>';
			echo '<td rowspan="2">' . $row['content'] .'</td>';
			echo '</tr>';
			echo '<tr border="1px">';
			echo '<td height="110" width="100">'. $row['account_type'] . '</br><img src="images/avatar.png" width="100" height="100"></img></td>';
			echo '</tr>';
			echo '<tr border="1px">';
			echo '<td></td>';
			echo '<td></br>' . $row['quote'] . '</td>';
			echo '</tr>';
			echo '<tr><td colspan="2" height="10px"></td></tr>';
        }
		// close database
        $db = NULL;
		echo "</table>";
    ?>
