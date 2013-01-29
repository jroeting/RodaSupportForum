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
        </tr>
		<?php
			include "db_con.php";
			// Query for output of memberlist
			$sql = "SELECT * FROM user_data ORDER BY username LIMIT 0,1000";
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
				echo "</tr>";
			}
	
			$db=NULL; // closing database	
		?>	
    </table>
<?php
	else :
		header("location:index.php?content=inlog");
	endif;
?>