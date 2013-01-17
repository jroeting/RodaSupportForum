<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<table class="forumcontent" align="center">
  		<tr>
            <td class="tablehead">Subject</td>
            <td class="tablehead">Last post</td>
        </tr>
     <?php
	$con = mysql_connect("localhost:3306","webdb13KIC1","busteqec");
	if(!$con)
	{
		die('Could not connect ' . mysql_error());
	}
	$selected_db = mysql_select_db("webdb13KIC1",$con);
	$selection = mysql_query("SELECT * FROM subjects WHERE category='technical_issues'");
	while($row = mysql_fetch_array($selection))
	{
		echo "<tr>";
		echo "<td>" . $selection['subject_name'] ."</td>";
		echo "<td></td>";
		echo "</tr>";
	}
	mysql_close();
	?>
    </table>
</html>