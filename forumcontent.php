<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <?php
        $categeory=$_GET['category'];
        if(isset($_SESSION['myusername'])) {
            echo "<a href="index.php?content=newpost&category=$category">Make new post</a>"
        }
    ?>
  <table class="forumcontent" align="center">
  		<tr>
            <td class="tablehead">Subject</td>
            <td class="tablehead">Last post</td>
        </tr>
     		<?php
                $categeory=$_GET['category'];
                $db = new PDO('mysql:host=localhost;dbname=webdb13KIC1', 'webdb13KIC1', 'busteqec');
                $sql = "SELECT subject_name FROM subjects WHERE category='$category' ORDER BY subject_id";
                $results = $db->query($count);
                foreach($results as $row)
                {
                    echo "<tr>";
                    echo "<td><a href="index.php?content=topic&subject='.$row['subject_id'].'">" . $row['subject_name']. "</a></td>";
                    echo "</tr>";
                }
                $db = NULL;

				/*$con = mysql_connect("localhost:3306","webdb13KIC1","busteqec");
				if(!$con)
				{
					die('Could not connect ' . mysql_error());
				}
				$selected_db = mysql_select_db("webdb13KIC1",$con);
				$selection = mysql_query("SELECT subject_name FROM subjects WHERE category='car_unrelated' ORDER BY subject_id");
				while($row = mysql_fetch_array($selection))
				{
					echo "<tr>";
					echo "<td>" . $row['subject_name'] ."</td>";
					echo "<td></td>";
					echo "</tr>";
				}
				mysql_close($con);*/
			?>
    </table>
</html>
