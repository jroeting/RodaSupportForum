<!-- The memberlist will only be shown after you are logged in -->
<?php
	if(isset($_SESSION['username'])) :
?>
	<h1>
		Members of Roda
	</h1>
	 
	<table class="memberlist">
  		<tr>
			<th class="tablehead2"><strong> Username </strong></th>
			<th class="tablehead2"><strong> Email </strong> </th>
			<th class="tablehead2"><strong> Posts </strong> </th>
			<th class="tablehead2"><strong> Account Type </strong></th>
			<th class="tablehead2"><strong> Date Registered </strong></th>
            <?php
				if(isset($_SESSION['username']) && $_SESSION['account_type'] == 1) {
					echo '<th class="tablehead2"><strong> Block/Unblock</strong></th>';
				}
			?>
        </tr>
		<?php
			include "db_con.php";
			
			// check page_number for pagination
			if (isset($_GET['page_number'])) 
			{
				$page_number = $_GET['page_number'];
			} 
			else 
			{
				$page_number = 1;
			}
			// count number of members in db for pagination 	
			$sql = "SELECT COUNT(*) FROM user_data ";
			$count = $db->query($sql);
			foreach($count as $row) 
			{
				// num_rows contains the number of members
				$num_rows = $row[0];
			}
			
			// how many posts will be shown on one page
			$rows_per_page = 8;
			// to determine when last page is reached
			$lastpage = ceil($num_rows/$rows_per_page);
			// defines last page
			$page_number = (int)$page_number;
			if ($page_number > $lastpage) 
			{
				$page_number = $lastpage;
			} 
			// defines first page
			if ($page_number < 1) 
			{
				$page_number = 1;
			} 
			// sets limit for every page if needed	
			$limit = 'LIMIT ' .($page_number - 1) * $rows_per_page .',' .$rows_per_page;
			
			
			// Query for output of memberlist
			$sql = "SELECT * FROM user_data ORDER BY username $limit";
            $result = $db->query($sql);
			
			// shows the memberlist with info of members
			foreach($result as $row) 
			{
				echo "<tr class=cellpadding>";
				echo "<td class=cellpadding>" . "<a href=\"index.php?content=profile&user_id=" . $row["user_id"] . "\">" . $row["username"] . "</a>" . "</td>";
				echo "<td class=cellpadding>" . $row['email'] . "</td>";
				
				$userID = $row['user_id'];
				
				// Query to count number of posts for each member
				$numberOfPosts = "SELECT count(*) FROM posts WHERE user_id = $userID";
				$count = $db->query($numberOfPosts);
				$data_array = $count->fetch();
				echo "<td class=cellpadding>" . $data_array[0] . "</td>";
				// checks which account-type to output
				switch ($row["account_type"]) {
								case "adm": 
									$accountType = "admin";
									break;
								case "usr": 
									$accountType = "user";
									break;
							}
				echo "<td class=cellpadding>" . $accountType . "</td>";	
				echo "<td class=cellpadding>" . $row['register_date'] . "</td>";
				if(isset($_SESSION['username']) && $_SESSION['account_type'] == 1)
				{
					if ($row['verified'] == 1) {
						echo '<td class=cellpadding><a href="index.php?content=block_user&block=1&user_id='. $row['user_id'] .'"> block </a></td>';
					} else {
						echo '<td class=cellpadding><a href="index.php?content=block_user&block=0&user_id='. $row['user_id'] .'"> unblock </a></td>';
					}
				}
				echo "</tr>";
			}
			$db=NULL; // closing database	
		?>	
    </table>
<?php
	echo '<table class="centeredtable">';
		// buttons to get to previous page. If there is no previous page, nothing is shown
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
		echo '</table>';

	else :
		header("location:index.php?content=inlog");
	endif;
?>