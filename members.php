	<h1>
		Members of Roda
	</h1>
	 
	<table class="tablemember" border="1" cellpadding="10">
  		<tr>
			<th class="tablehead"><strong> Status </strong></th>
			<th class="tablehead"><strong> Username </strong></th>
			<th class="tablehead"><strong> Email </strong> </th>
			<th class="tablehead"><strong> Posts </strong> </th>
			<th class="tablehead"><strong> Account Type </strong></th>
        </tr>
		<?php
			$con = mysql_connect("localhost:3306","webdb13KIC1","busteqec"); 
			if(!$con)
			{
				die('Could not connect ' . mysql_error());
			}
			$selected_db = mysql_select_db("webdb13KIC1",$con);
			if (!$selected_db)
			{
				die('Cannot use database:' . mysql_error());
			}
			$selection = mysql_query("SELECT * FROM user_data ORDER BY username LIMIT 0,1000");
			
			if (!$selection) 
			{
				echo 'Could not run query: ' . mysql_error();
				exit;
			}
			while($row = mysql_fetch_array($selection))
			{
				echo "<tr>";
				echo "<td>" . /*$row[''] .*/ "</td>";
				echo "<td>" . "<a href=index.php?content=profile>". $row["username"] . "</a>" . "</td>";
				echo "<td>" . $row['email'] . "</td>";
				echo "<td>" . /*$row[''] .*/ "</td>";
				echo "<td>" . $row['account_type'] . "</td>";		
				echo "</tr>";
			}
	
			mysql_close();	
		?>	
    </table>
        



	
	
		

