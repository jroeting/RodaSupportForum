<!-- home.php displays the 10 most recent subjects and the 10 most popular subjects -->
<!-- Display's the 10 most recent subjects -->
	<table class="tablemember" celpadding="10">
  		<tr>
    		<th class="tablehead"><strong>10 most recent subjects</strong></th>
        </tr>
        <?php
			// connect with database
            $db = new PDO('mysql:host=localhost;dbname=webdb13KIC1', 'webdb13KIC1', 'busteqec');
			// selection of all subjects, ordered by subject_id (so most recent is on top)
            $sql = "SELECT * FROM subjects WHERE open=1 ORDER BY subject_id DESC LIMIT 0,10";
            $results = $db->query($sql);
			// makes a table out of the query results, with a link to the posts in that subject
            foreach($results as $row)
            {
                echo "<tr>";
                echo "<td><a href=\"index.php?content=topic&subject=" . $row['subject_id'] . "&subjectname=" . $row['subject_name'] . "\">" . $row['subject_name'] . "</a></td>";
                echo "</tr>";
            }
			// close database
            $db = NULL;
  		?>
	</table>
<!-- Display's the 10 most recent subjects which are highlighted -->
  	<table class="tablemember" celpadding="10">
	  	<tr>
   			<td class="tablehead"><strong>10 most popular subjects</strong></td>
  		</tr>
        <?php
			// select database
            $db = new PDO('mysql:host=localhost;dbname=webdb13KIC1', 'webdb13KIC1', 'busteqec');
			// selects the subjects which are highlighted
            $sql = "SELECT posts.highlight, subjects.subject_name, subjects.subject_id FROM posts, subjects WHERE posts.subject_id=subjects.subject_id 
			AND posts.highlight=1";
            $results = $db->query($sql);
			// makes a table out of the query results, with a link to the posts in that subject
            foreach($results as $row)
            {
                echo "<tr>";
				echo "<td><a href=\"index.php?content=topic&subject=" . $row['subject_id'] . "&subjectname=" . $row['subject_name'] . "\">" . $row['subject_name'] . "</a></td>";
                echo "</tr>";
            }
            $db = NULL;
		?>
    </table>
