<!-- forumcontent.php gives an overview of the subjects that are posted in the selected category, the subjects are ordered on date and time with the most recent post on top. The user can also see who, and on which time, the last reaction was posted in a subject. The subjects are linked to a page with an overview of the reactions on the subject -->
    <?php
		// gets the category that is given in the link
        $category = $_GET['category'];
		// if user is logged in, the user has the ability to make a new subject
        if(isset($_SESSION['username'])) 
		{
			// link to page where the user can make a new subject in the selected category
			echo '<table>';
			echo '<td></td><td><a href="index.php?content=newpost&category=$category"><img src="images/button_newsub.png"></img></a></td></tr></table>';
        }
    ?>
  	<table class="forumcontent">
  		<tr>
        	<!-- gives an overview of all subjects and the last post made in each subject -->
            <td class="tablehead"><strong>Subject</strong></td>
            <td class="smallTableHead"><strong>Last post</strong></td>
        </tr>
     	<?php
			// gets current page number if there is one
			if (isset($_GET['page_number'])) {
   				$page_number = $_GET['page_number'];
			} else {
   				$page_number = 1;
			}
			// open database
            include 'db_con.php';
			// select number of subjects in this category
			$sql = "SELECT COUNT(*) FROM subjects WHERE category=?";
			$count = $db->prepare($sql);
			$count->bindValue(1,$category,PDO::PARAM_INT);
			$count->execute();
			foreach($count as $row) 
			{
				$num_rows = $row[0];
			}
			// how many records per page
			$rows_per_page = 20;
			$lastpage      = ceil($num_rows/$rows_per_page);
			// checks what is last page and first page
			$page_number = (int)$page_number;
			if ($page_number > $lastpage) {
	   			$page_number = $lastpage;
			} 
			if ($page_number < 1) {
   				$page_number = 1;
			} 
			// set limit
			$limit = 'LIMIT ' .($page_number - 1) * $rows_per_page .',' .$rows_per_page;
			// select subjects from given category
            $select_subjects = "SELECT *
								FROM subjects
								WHERE category = ?
								AND checked = 1
								ORDER BY subject_id
								$limit";
            $results = $db->prepare($select_subjects);
			$results->bindValue(1,$category,PDO::PARAM_STR);
			$results->execute();
			// show subject name with a link to topic
			foreach($results as $row)
            {
            	$selectLastPost = $db->query("SELECT date_time FROM posts WHERE subject_id = $row[subject_id] ORDER BY date_time DESC LIMIT 1");
				$dateTime = $selectLastPost->fetch();
				echo "<tr>";
                echo "<td><a href=\"index.php?content=topic&subject=" . $row['subject_id'] . "&subjectname=" . $row['subject_name'] ."\">" . $row['subject_name'] . "</a></td>";
				echo "<td>" . $dateTime["date_time"] . "</td>";
				echo "</tr>";
            }
			// close databae
            $db = NULL;	 
		?>    
    </table>
    <br/>
    <?php
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
	?>