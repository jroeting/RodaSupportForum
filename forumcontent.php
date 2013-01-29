<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<!-- forumcontent.php gives an overview of the subjects that are posted in the selected category, the subjects are ordered on date and time with the most recent post on top. The user can also see who, and on which time, the last reaction was posted in a subject. The subjects are linked to a page with an overview of the reactions on the subject -->
    <?php
		// gets the category that is given in the link
        $category = $_GET['category'];
		// if user is logged in, the user has the ability to make a new subject
        if(isset($_SESSION['username'])) 
		{
			// link to page where the user can make a new subject in the selected category
			echo '<table>';
			echo '<td></td><td><a href="index.php?content=newpost&category=$category"><img src="images/button_new_subject.jpg"></img></a></td></tr></table>';
        }
    ?>
  <table class="forumcontent" align="center">
  		<tr>
        	<!-- gives an overview of all subjects and the last post made in each subject -->
            <td class="tablehead"><strong>Subject</strong></td>
            <td class="tablehead" width="200"><strong>Last post</strong></td>
        </tr>
     		<?php
				// open database
                include 'db_con.php';
				// select subjects from given category
                $select_subjects = "SELECT *
									FROM subjects
									WHERE category = ?
									AND checked = 1
									ORDER BY subject_id";
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
</html>
