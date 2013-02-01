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
		
		// check page_number for pagination
		if (isset($_GET['page_number'])) {
   			$page_number = $_GET['page_number'];
		} else {
   			$page_number = 1;
		}
	
		include 'db_con.php';
		
		// count number of posts in this subject for pagination and highlighting	
		$sql = "SELECT COUNT(*) FROM posts WHERE subject_id = ?";
		$count = $db->prepare($sql);
		$count->bindValue(1,$subject,PDO::PARAM_INT);
		$count->execute();
		foreach($count as $row) 
		{
			// num_rows accounts for the number of posts
			$num_rows = $row[0];
		}
		// if there are more than 14 posts in this subject, highlight is set on 1. (This will become a popular subject).
		if ($num_rows > 14) 
		{
			$sql = "UPDATE subjects
					SET highlight = 1
					WHERE subject_id = ?";
			$set_highlight = $db->prepare($sql);
			$set_highlight->bindValue(1,$subject,PDO::PARAM_INT);
			$set_highlight->execute();
		}
		// how many posts will be shown on one page
		$rows_per_page = 10;
		// to determine when last page is reached
		$lastpage      = ceil($num_rows/$rows_per_page);
		// defines last page
		$page_number = (int)$page_number;
		if ($page_number > $lastpage) {
	   		$page_number = $lastpage;
		} 
		// defines first page
		if ($page_number < 1) {
   			$page_number = 1;
		} 
		// sets limit for every page if needed	
		$limit = 'LIMIT ' .($page_number - 1) * $rows_per_page .',' .$rows_per_page;
		// selection of data to be shown
		$sql = "SELECT user_data.username, user_data.avatar, user_data.quote, user_data.account_type, posts.content, posts.date_time, posts.post_id, 	
				user_data.user_id, posts.spam
				FROM user_data, posts 
				WHERE posts.user_id = user_data.user_id
				AND posts.subject_id = ?
				ORDER BY posts.date_time ASC
				$limit"; // limited by pagination
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
			echo '<tr><td class="avatarpost">' . $user . '<br /><img src="' . $row["avatar"] . '" class="avatarpost"></img></td></tr>';
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
			$db=NULL;
		}
		echo "</table><br/>";
		echo '<table class="centeredtable">';
		// buttons to get to previous page. If there is nog previous page, nothing is shown
		if ($page_number == 1) {
   			echo "";
		} else {
   			echo "<a href='{$_SERVER['REQUEST_URI']}&page_number=1'>&#60;&#60; First&nbsp;</a>";
   			$prevpage = $page_number-1;
   			echo " <a href='{$_SERVER['REQUEST_URI']}&page_number=$prevpage'>&#60; Previous</a> ";
		}	 
		// shows on which page you are
		echo "  Page $page_number of $lastpage  ";
		// buttons to get to next and last page. If there is none, nothing is shown
		if ($page_number == $lastpage) {
   			echo "";
		} else {
   			$nextpage = $page_number+1;
   			echo " <a href='{$_SERVER['REQUEST_URI']}&page_number=$nextpage'> Next &#62; &nbsp;</a> ";
   			echo " <a href='{$_SERVER['REQUEST_URI']}&page_number=$lastpage'>Last &#62;&#62;</a> ";
		}	 
		echo '</table>';
		// when user is logged in, user can make a new post
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
			$include = true;
			include 'newreactionform.php';
			echo '</td></tr></table>';
        }
	?>