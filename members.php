	<h1>
		Members of Roda
	</h1>

<?php
	$link = mysql_connect("localhost:3306","webdb13KIC1","busteqec");
	if (!$link)
	{
		die('Could not connect: ' . mysql_error());
	}
	echo "Connected";
	$selected_db = mysql_select_db('webdb13KIC1', $link);
	if (!$selected_db)
	{
		die('Cannot use database:' . mysql_error());
	}
	echo "database selected";
	
	$result = mysql_query("SELECT * FROM user_data ORDER BY username LIMIT 0, 10"); 
	if (!$result) 
	{
		echo 'Could not run query: ' . mysql_error();
		exit;
	}

	$num=mysql_fetch_row($result); 

	$i=0; /*
	while ($i < $num) { 
		$username=mysql_result($result,$i,"username"); 
		$email=mysql_result($result,$i,"email"); 
		$account_type=mysql_result($result,$i,"account_type"); 
		
		echo "<b>$username</b>E-mail: $email1<br>Account Type: $account_type<br><hr><br>"; 

		$i++; 
	} */
	mysql_close($link);
?>	
	
	
	
		

