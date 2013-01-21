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
		echo "<table class=\"forumcontent\" align=\"center\">";
		echo "<tr class=\"tablehead\">" . $subjectname . "</tr>";
		// open database
		$db = new PDO('mysql:host=localhost;dbname=webdb13KIC1', 'webdb13KIC1', 'busteqec');
		// select user data and post concent as a reaction on selected subject
        $sql = "SELECT user_data.username, user_data.avatar, user_data.quote, user_data.account_type, posts.content FROM user_data, posts 
		WHERE posts.user_id = user_data.user_id AND posts.subject_id = $subject";
        $results = $db->query($sql);
		// shows user data and post content
        foreach($results as $row)
        {
        	echo "<tr>";
        	echo "<td>" . $row['username']. "</td>";
			echo "<td>" . $row['avatar']. "</td>";
			echo "<td>" . $row['quote'] . "</td>";
			echo "<td>" . $row['content'] . "</td>";
        	echo "</tr>";
        }
		// close database
        $db = NULL;
    ?>
