<!-- topic.php gives an overview of the reactions in a subject. It is showed with the user that wrote the reaction, the user's avatar and the user's quote. -->
    <?php
		
		// get subject ID and name from variables given in url
        $subject = $_GET['subject'];
		$subjectname = $_GET['subjectname'];
		// if the user is logged in, the user can place a new reaction in this subject
		if(isset($_SESSION['username'])) {
			if  ($_SESSION['account_type'] == 1)  {
				echo "<a href=\"index.php?content=removesubject&subject='$subject'&action=0\">Close this subject</a><br />";
			}
		} 
		// shows subject name
		
		echo '<table class="centeredtable">';
		echo '<tr>';
		echo '<td class="tablehead" colspan="2"><strong>' . $subjectname . '</strong></td>';
		echo '</tr>';
		// open database
		include 'db_con.php';
		$count = "SELECT COUNT(*) FROM posts WHERE subject_id = ?";
		$num_posts = $db->prepare($count);
		$num_posts->bindValue(1,$subject,PDO::PARAM_INT);
		$num_posts->execute();
		foreach($num_posts as $row) 
		{
			$num = $row[0];
		}
		
		if ($num > 14) 
		{
			$sql = "UPDATE subjects
					SET highlight = 1
					WHERE subject_id = ?";
			$set_highlight = $db->prepare($sql);
			$set_highlight->bindValue(1,$subject,PDO::PARAM_INT);
			$set_highlight->execute();
		}
		// select user data and post concent as a reaction on selected subject
        $sql = "SELECT user_data.username, user_data.avatar, user_data.quote, user_data.account_type, posts.content, posts.date_time, posts.post_id, 	
				user_data.user_id, posts.spam
				FROM user_data, posts 
				WHERE posts.user_id = user_data.user_id
				AND posts.subject_id = ?
				ORDER BY posts.date_time ASC";
        $results = $db->prepare($sql);
		$results->bindValue(1,$subject,PDO::PARAM_INT);
		$results->execute();
		// shows user data and post content
        foreach($results as $row)
        {
			// shows whether the user is an administrator or a user
			if($row['account_type']== 'usr') {
				$user = 'user';
			} else {
				$user = 'administrator';
			}
			echo '<tr>';
			echo '<td class="post"></td>';
			// date and time of when the post was created
			echo '<td class="contentpost"><p class="datetime"> Reaction placed at &nbsp;' . $row['date_time'] . '</p></td>';
			echo '</tr>';
			echo '<tr>';
			// username and link to user profile
			echo '<td><strong><a href="index.php?content=profile&user_id=' . $row['user_id'] . '">' . $row['username'] . '</a></strong></td>';
			// content of the post
			echo '<td rowspan="2">' . $row['content'] .'</td>';
			echo '</tr>';
			echo '<tr></tr>';
			// user avatar
			echo '<tr><td class="avatarpost">' . $user . '<br /><img src="images/avatar.png" class="avatarpost" alt=""></img></td></tr>';
			echo '<tr>';
			echo '<td></td>';
			// user quote
			echo '<td><br /><p class="quote">' . $row['quote'] . '</p></td>';
			echo '</tr>';
			// enables the admin to remove posts from other users and enables users to remove their own posts
			if(isset($_SESSION['username'])) 
			{
				if ($_SESSION['username'] == $row['username'] || $_SESSION['account_type'] == 1) 
				{
					echo '<tr><td></td><td><a href="index.php?content=removepost&post_id='.$row['post_id'].'">Remove this post</a> | 
						  <a href="index.php?content=report_spam&post_id='. $row['post_id'] . '"> Report as spam </a></td></tr>';
				}
			}
			if (isset($_SESSION['username'])) 
			{
				if ($_SESSION['account_type'] == 1 && $row['spam'] == 1 )
				{
					echo '<tr><td></td><td><strong><a href="index.php?content=removepost&post_id='.$row['post_id'].'">Remove spam</a> | <a href="index.php?content=nospam&post_id='.$row['post_id'].'"> No spam</a></strong></td></tr>';
				}
			}
			echo '<tr><td></td><td class="barpost"></td></tr>';
        }
		// close database 
		echo "</table>";
		// if the user is logged in, the user can place a reaction in the subject
		if(isset($_SESSION['username'])) 
		{
			echo '<br />';
			echo '<table>';
			echo '<tr>';
			echo '<td class="post"></td>';
			echo '<td>';
            echo '&nbsp;Write a new reaction in this subject';
			echo '</td>';
			echo '<tr>';
			echo '<td></td>';
			echo '<td>';
			include 'newreactionform.php';
			echo '</td></tr></table>';
        }
		?>
