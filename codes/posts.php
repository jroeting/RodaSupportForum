<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <?php
        $subject=$_GET['subject'];
		$subject_name=$_GET['subject_name'];
        if(isset($_SESSION['myusername'])) 
		{
            echo "<a href=\"index.php?content=newpost&subject='$subject'\">Place a reaction</a>";
        }
		
		echo "<table class=\"forumcontent\" align=\"center\">";
		echo "<tr class=\"tablehead\">" . $subject_name . "</tr>";
		
		$db = new PDO('mysql:host=localhost;dbname=webdb13KIC1', 'webdb13KIC1', 'busteqec');
        $sql = "SELECT user_data.username, user_data.avatar, user_data.quote, user_data.account_type, posts.content FROM user_data, posts WHERE posts.user_id = user_data.user_id AND posts.subject_id = $subject ORDER BY posts.timestamp ASC";
        $results = $db->query($sql);
        foreach($results as $row)
        {
        	echo "<tr>";
        	echo "<td>" . $row['username']. "</td>";
			echo "<td>" . $row['avatar']. "</td>";
			echo "<td>" . $row['quote'] . "</td>";
			echo "<td>" . $row['content'] . "</td>";
        	echo "</tr>";
        }
        $db = NULL;
    ?>
    
    <table class="forumcontent" align="center">
    	<tr class="tablehead">
</html>