<div class="tablehead"> <strong> Profile </strong></div>

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
			$selection = mysql_query("SELECT * FROM user_data ORDER BY username");
			
			if (!$selection) 
			{
				echo 'Could not run query: ' . mysql_error();
				exit;
			} 
		?>
			<div class="profilecontent">
					<div class="userprofile1">
						
						<br />
			<?php 
				while($row = mysql_fetch_array($selection))
				{ 
			?>
					<div class="avatar"> <?php $row["avatar"]; ?> </div> 
					<br /><br />
			<?php
					echo "Username: " . $row["username"];  
			?>
					<br /><br />
					<?php
						echo "Account Type: " . $row["account_type"]; 
					?>
					<br /><br />
					<a href="mailto: <?php $row["email"]; ?> "> Send Mail</a>
					<?php
					break;
				}
		
				
		?>	
		</div>

		
<div class="userprofile2">
	
	<?php
		echo "<table>";
			echo "<tr><td> Personal Text:  </td>";
			echo "<td>" . $row["personal_text"] . "</td>"; 
			echo "</tr>";
		
			echo "<tr><td> &nbsp; </td></tr>";
		
		
			echo "<tr><td> First Name:  </td>";
			echo "<td>" . $row["name"] . "</td>"; 
			echo "</tr>";
		
			echo "<tr><td> &nbsp; </td></tr>";
		
		
			echo "<tr><td> Last Name:  </td>";
			echo "<td>" . $row["surname"] . "</td>"; 
			echo "</tr>";
		
			echo "<tr><td> &nbsp; </td></tr>";
		
		
			echo "<tr><td> Age:  </td>";
			echo "<td>" . $row["age"] . "</td>"; 
			echo "</tr>";
		
			echo "<tr><td> &nbsp; </td></tr>";
		
		
			echo "<tr><td> Gender:  </td>";
			echo "<td>" . $row["gender"] . "</td>"; 
			echo "</tr>";
		
			echo "<tr><td> &nbsp; </td></tr>";
		
		
			echo "<tr><td> Country:  </td>";
			echo "<td>" . $row["country"] . "</td>"; 
			echo "</tr>";
		
			echo "<tr><td> &nbsp; </td></tr>";
				
			echo "<tr><td> Quote:  </td>";
			echo "<td>" . $row["quote"] . "</td>"; 
			echo "</tr>";
		echo "</table>";
	?>	 
		<br /> <br />
		<a href="index.php?content=editprofile"> <i> <strong> Edit Profile </strong> </i> </a> 
		<?php mysql_close(); ?>
	</div>
	
</div> 

