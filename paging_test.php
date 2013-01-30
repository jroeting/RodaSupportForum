<?php
	include 'db_con.php';
		// count number of records
		$sql = "SELECT COUNT(*) FROM table WHERE property=something";
		$count = $db->prepare($sql);
		$count->bindValue(1,$subject,PDO::PARAM_INT);
		$count->execute();
		foreach($count as $row) 
		{
			$num_rows = $row[0];
		}
		
		// how many records per page
		$rows_per_page = 10;
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
	
		$sql = "SELECT * FROM table";
        $results = $db->prepare($sql);
		$results->bindValue(1,$subject,PDO::PARAM_INT);
		$results->execute();
		// shows user data and post content
		foreach($results as $row) {
			//data
		}
	echo "</table>";
	
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
	?>