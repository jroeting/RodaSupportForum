<!-- topic.php gives an overview of the reactions in a subject. It is showed with the user that wrote the reaction, the user's avatar and the user's quote. -->
    <?php
		// get subject ID and name from variables given in url
        $subject = $_GET['subject'];
		$subjectname = $_GET['subjectname'];
		// if the user is logged in, the user can place a new reaction in this subject
        if(isset($_SESSION['username'])) 
		{
            echo "<a href=\"index.php?content=newpost&subject='$subject'\">Place a reaction</a></br>";
        } 
		if(isset($_SESSION['account_type']) == 1) {
			echo "<a href=\"index.php?content=removesubject&subject=$subject&action=0\">Remove this subject</a></br>";
		}
		// shows subject name
		
		echo '<table align="center">';
		echo '<tr>';
		echo '<td class="tablehead" colspan="2"><strong>' . $subjectname . '</strong></td>';
		echo '</tr>';
		// open database
		include 'db_con.php';
		// select user data and post concent as a reaction on selected subject
        $sql = "SELECT user_data.username, user_data.avatar, user_data.quote, user_data.account_type, posts.content, posts.date_time, posts.post_id, 	
				user_data.user_id 
				FROM user_data, posts 
				WHERE posts.user_id = user_data.user_id 
				AND posts.subject_id = $subject 
				ORDER BY posts.date_time ASC";
        $results = $db->query($sql);
		// shows user data and post content
        foreach($results as $row)
        {
			if($row['account_type']== 'usr') {
				$user = 'user';
			} else {
				$user = 'administrator';
			}
			echo '<tr>';
			echo '<td width="100"></td>';
			echo '<td width="850"><p class="datetime"> Reaction placed at &nbsp;' . $row['date_time'] . '</p></td>';
			echo '</tr>';
			echo '<tr>';
			echo '<td><strong><a href="index.php?content=profile&user_id=' . $row['user_id'] . '">' . $row['username'] . '</a></strong></td>';
			echo '<td rowspan="2">' . $row['content'] .'</td>';
			echo '</tr>';
			echo '<tr>';
			echo '<tr>';
			echo '<td height="110" width="110">' . $user . '</br><img src="images/avatar.png" width="100" height="100"></img></td>';
			echo '</tr>';
			echo '<tr>';
			echo '<td></td>';
			echo '<td></br><p class="quote">' . $row['quote'] . '</p></td>';
			echo '</tr>';
			if(isset($_SESSION['username']) && ($_SESSION['username'] == $row['username'] || $_SESSION['account_type'] == 1)) 
			{
				echo '<tr><td></td><td><a href="index.php?content=removepost&post_id='.$row['post_id'].'&action=0">Remove this post</a></td></tr>';
			}
			echo '<tr><td></td><td height="2px" class="bar"></td></tr>';
        }
		// close database <img src="images/removebutton.png" width="157" height="23"></img>
        $db = NULL;
		echo "</table>";
    ?>
