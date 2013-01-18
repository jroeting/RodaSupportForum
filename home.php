
<div id="newestposts">
	<table class="forumcontent" align="center">
  		<tr>
    		<td class="tablehead"><strong>10 most recent subjects</strong></td>
        </tr>
        </table>
        <table border="0px" bgcolor="#333333">
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
		
		mysql_close();
  	?>
	</table>
  	<table class="forumcontent" align="center">
	  	<tr>
   			<td class="tablehead"><strong>10 most popular subjects</strong></td>
  		</tr>
	</table>
    <table border="0px" bgcolor="#333333">
        <?php
	$con = mysql_connect("localhost:3306","webdb13KIC1","busteqec");
	if(!$con)
	{
		die('Could not connect ' . mysql_error());
	}
	$selected_db = mysql_select_db("webdb13KIC1",$con);
	$selection = mysql_query("SELECT posts.highlight, posts.subject_id, subjects.subject_name FROM posts INNER JOIN subjects WHERE posts.highlight=1 ORDER BY subject_id DESC LIMIT 0,10");
	while($row = mysql_fetch_array($selection))
	{
		echo "<tr>";
		echo "<td>" . $subject_selection['subject_name'];
		echo "</tr>";
	}
	mysql_close();
	?>
    </table>
</div>
