<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<!-- forumcontent.php gives an overview of the subjects that are posted in the selected category, the subjects are ordered on date and time with the most recent post on top. The user can also see who, and on which time, the last reaction was posted in a subject. The subjects are linked to a page with an overview of the reactions on the subject -->
    <?php
		// gets the category that is given in the link
        $category = $_GET['category'];
		// if user is logged in, the user has the ability to make a new subject
        if(isset($_SESSION['myusername'])) 
		{
			// link to page where the user can make a new subject in the selected category
            echo "<a href=\"index.php?content=newsubject&category='$category'\">Make new subject</a>";
        }
    ?>
  <table class="forumcontent" align="center">
  		<tr>
        	<!-- gives an overview of all subjects and the last post made in each subject -->
            <td class="tablehead"><strong>Subject</strong></td>
            <td class="tablehead" width="200"><strong>Last post</strong></td>
        </tr>
     		<?php
				// get category
                $category = $_GET['category'];
				// open database
                $db = new PDO('mysql:host=localhost;dbname=webdb13KIC1', 'webdb13KIC1', 'busteqec');
				// select subjects from given category
                $sql = "SELECT * FROM subjects WHERE category='$category' ORDER BY subject_id";
                $results = $db->query($sql);
				// show subject name with a link to the reaction overview
                foreach($results as $row)
                {
                    echo "<tr>";
                    echo "<td><a href=\"index.php?content=topic&subject=" . $row['subject_id'] . "&subjectname=" . $row['subject_name'] ."\">" . $row['subject_name'] . "</a></td>";
                    echo "</tr>";
                }
				// close databae
                $db = NULL;
			?>
    </table>
</html>
