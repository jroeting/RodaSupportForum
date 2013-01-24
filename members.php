	<!-- member page can only be viewed if the user is logged in -->
	<?php
		if(isset($_SESSION['username'])) :
	?>
	<h1>
		Members of Roda
	</h1>
	<!-- layout of memberlist --> 
	<table class="tablemember" border="1" cellpadding="10">
  		<tr>
			<th class="tablehead"><strong> Username </strong></th>
			<th class="tablehead"><strong> Email </strong> </th>
			<th class="tablehead"><strong> Posts </strong> </th>
			<th class="tablehead"><strong> Account Type </strong></th>
			<th class="tablehead"><strong> Date Registered </strong></th>
        </tr>
		<?php
			include "db_con.php"; // connection with database
			
			$sql = "SELECT * FROM user_data ORDER BY username LIMIT 0,1000";
            $result = $db->query($sql);
				// outputs the memberlist
			foreach($result as $row) 
			{
				echo "<tr>";
				echo "<td>" . "<a href=\"index.php?content=profile&user_id=" . $row["user_id"] . "\">" . $row["username"] . "</a>" . "</td>";
				echo "<td>" . $row['email'] . "</td>";
				echo "<td>" . /*$row[''] .*/ "</td>";
				echo "<td>" . $row['account_type'] . "</td>";	
				echo "<td>" . /*$row[''] .*/ "</td>";
				echo "</tr>";
			}
	
			$db=NULL; // closes database	
		?>	
    </table>
	<!-- if the user is not logged in, the user will be redirected to the inlog page
	<?php
		else :
			header("location:index.php?content=inlog");
		endif;
	?>