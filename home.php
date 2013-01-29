<!-- home.php displays the 10 most recent subjects and the 10 most popular subjects -->
	<!-- Display's a welcome message -->
	<table class="tablemember">
    	<tr>
        	<td>Welcome at Roda's supportforum. Do you have a question about Roda, cars, or do you just want to come in touch with other Roda fans? Please 	
            	register or login.<br /><br />
       		</td>
        </tr>
        <!-- Display's the 10 most recent subjects -->
  		<tr>
    		<th class="tablehead"><strong>10 most recent subjects</strong></th>
        </tr>
        <?php
			// connect with database
            include 'db_con.php';
			// sql will select all subjects which are checked, they are ordered by subject_id, this will cause to show the
			// most recent subject on top
            $subject_selection = "SELECT * FROM subjects 
								  WHERE checked=1
								  ORDER BY subject_id 
								  DESC LIMIT 0,10";
            $results = $db->prepare($subject_selection);
			$results->execute();
			// makes a table out of the query results, with a link to that subject
            foreach($results as $row)
            {
                echo "<tr>";
                echo "<td><a href=\"index.php?content=topic&subject=" . $row['subject_id'] . "&subjectname=" . $row['subject_name'] . "\">" . $row['subject_name'] . "</a></td>";
                echo "</tr>";
            }
  		?>
	</table>
	<!-- Display's the 10 most recent subjects which are highlighted -->
  	<table class="tablemember">
	  	<tr>
   			<td class="tablehead"><strong>10 most popular subjects</strong></td>
  		</tr>
        <?php
			// selects from all subjects the subjects that are hilighted AND checked.
			$subject_highlight = "SELECT * 
								  FROM subjects 
								  WHERE highlight = 1
								  AND checked = 1";
            $results = $db->prepare($subject_highlight);
			$results->execute();
			// makes a table out of the query results, with a link to the posts in that subject
            foreach($results as $row)
            {
                echo "<tr>";
				echo "<td><a href=\"index.php?content=topic&subject=" . $row['subject_id'] . "&subjectname=" . $row['subject_name'] . "\">" . $row['subject_name'] . "</a></td>";
                echo "</tr>";
            }
			//close database
            $db = NULL;
		?>
    </table>
