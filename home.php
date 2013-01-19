<div id="newestposts">
	<table class="tablemember" celpadding="10">
  		<tr>
    		<th class="tablehead"><strong>10 most recent subjects</strong></th>
        </tr>
        <?php
			$con = mysql_connect("localhost:3306","webdb13KIC1","busteqec"); 
			if(!$con)
			{
				die('Could not connect ' . mysql_error());
			}
			$selected_db = mysql_select_db("webdb13KIC1",$con);
			$selection = mysql_query("SELECT * FROM subjects WHERE open=1 ORDER BY subject_id DESC LIMIT 0,10");
			while($row = mysql_fetch_array($selection))
  			{
  				echo "<tr>";
  				echo "<td>" . $row['subject_name'] . "</td>";
  				echo "</tr>";
  			}
			mysql_close($con);
  		?>
	</table>
  	<table class="tablemember">
	  	<tr>
   			<td class="tablehead"><strong>10 most popular subjects</strong></td>
  		</tr>
        <?php
			$con = mysql_connect("localhost:3306","webdb13KIC1","busteqec");
			if(!$con)
			{
				die('Could not connect ' . mysql_error());
			}
			$selected_db = mysql_select_db("webdb13KIC1",$con);
			$selection = mysql_query("SELECT posts.highlight, subjects.subject_name FROM subjects FULL JOIN posts ON posts.subject_id=subjects.subject_id WHERE posts.highlight=1");
			while($row = mysql_fetch_array($selection))
			{
				echo "<tr>";
				echo "<td>" . $row['subject_name']. "</td>" ;
				echo "</tr>";
			}
			mysql_close($con);
		?>
    </table>
</div>
