<!-- forum.php shows an overview of the different categories of the forum. The user can see how many subjects are already posted in a category. The category names are linked to a page with the different subjects in that category -->
<table class="forumcontent">
	<tr class="tablehead">
    	<!-- A table showing the forum categories and the number of subjects in each category -->
    	<td class="tablehead"><strong>&nbsp; &nbsp; Categories</strong></td>
    	<td class="tablehead" width="200"><strong>Number of subjects</td>	
    </tr>
  	<tr class="tablebody">
    	<!-- Link to subjects belonging to category -->
  		<td><p class="blacktext"><a href="index.php?content=forumcontent&category=technical issues"><span>Technical Issues</span></a></p></td>
    	<td>
			<?php
				// open database
                include 'db_con.php';
				// selection of number of subjects.
                $num_subjects = "SELECT COUNT(subject_id) 
								FROM subjects 
								WHERE category = 'technical issues'
								AND checked=1";
                $result = $db->query($num_subjects);
				// shows the number of subjects.
				foreach($result as $row) 
				{
					echo $row[0];
				}
  			?>
        </td>
	</tr>
  	<tr class="tablebody">
    	<!-- link to subjects overview belonging to category -->
  		<td><p class="blacktext"><a href="index.php?content=forumcontent&category=cartalk"><span>Cartalk</span></a></p></td>
    	<td>
			<?php
				// selection of number of subjects
                $num_subjects = "SELECT COUNT(*) 
								FROM subjects 
								WHERE category = 'cartalk'
								AND checked=1";
                $result = $db->query($num_subjects);
				// shows the number of subjects
				foreach($result as $row) 
				{
					echo $row[0];
				}
            ?>
		</td>
	</tr>
  	<tr class="tablebody" >
    	<!-- link to subjects belonging to category -->
  		<td><p class="blacktext"><a href="index.php?content=forumcontent&category=car unrelated"><span>Car-unrelated</span></a></p></td>
    	<td>
			<?php
				// selection of number of subjects
                $num_subjects = "SELECT COUNT(*) 
								FROM subjects 
								WHERE category = 'car unrelated'
								AND checked=1";
                $result = $db->query($num_subjects);
				// shows the number of subjects
				foreach($result as $row) 
				{
					echo $row[0];
				}
				// close database
                $db = NULL;
    		?>
        </td>
  	</tr>
</table>
