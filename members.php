<?php
	if(isset($_SESSION['username'])) :
?>
	<h1>
		Members of Roda
	</h1>
	 
	<table class="tablemember" border="1" cellpadding="10">
  		<tr>
			<th class="tablehead"><strong> Username </strong></th>
			<th class="tablehead"><strong> Email </strong> </th>
			<th class="tablehead"><strong> Posts </strong> </th>
			<th class="tablehead"><strong> Account Type </strong></th>
			<th class="tablehead"><strong> Date Registered </strong></th>
        </tr>
		<?php
			include "db_con.php";
			
			$sql = "SELECT * FROM user_data ORDER BY username LIMIT 0,1000";
            $result = $db->query($sql);
				// shows the memberlist
			foreach($result as $row) 
			{
				echo "<tr>";
				echo "<td>" . "<a href=\"index.php?content=profile&user_id=" . $row["user_id"] . "\">" . $row["username"] . "</a>" . "</td>";
				echo "<td>" . $row['email'] . "</td>";
				$userId = $row['user_id'];
				echo "<td>" . /*$row[''] .*/ "</td>";
				echo "<td>" . $row['account_type'] . "</td>";	
				echo "<td>" . /*$row[''] .*/ "</td>";
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