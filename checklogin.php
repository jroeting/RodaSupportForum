<?php
// username and password sent from form 
$myusername = $_POST['username']; 
$mypassword = $_POST['password'];

// encrypt password
$mypassword = hash('sha256', $mypassword);

// Connect to server and select databse.
include "db_con.php";

$sql = "SELECT * FROM user_data WHERE username='$myusername' and password='$mypassword'");
$result = $db->query($sql);

foreach($result as $row)
{
	if($mypassword == $row['password'] && $myusername == $row['username'])
	{
		$_SESSION['username'] = $row['username'];
		$account_type = $row['account_type'];
		if($account_type == "adm")
		{
			$_SESSION['account_type'] = 1;
		}
			
		if(isset($_SESSION['username']))
		{
			header("location:index.php?content=home");
		}
	}
}

else
{
	echo "Invalid username/password";
	echo "<a href=index.php?content=inlog><br />Go back</a>";
}
 ?>