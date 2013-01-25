<?php
// username and password sent from form 
$myusername = $_POST['username']; 
$mypassword = $_POST['password'];

// Connect to server and select databse.
include "db_con.php";

$sql = "SELECT * FROM user_data WHERE username='$myusername'";
$result = $db->query($sql);

foreach($result as $row)
{
	if( crypt($mypassword, $row['password']) == $row['password'] && $myusername == $row['username'])
	{
		$_SESSION['username'] = $row['username'];
		$_SESSION['user_id'] = $row['user_id'];
		$account_type = $row['account_type'];
		if($account_type == "adm")
		{
			$_SESSION['account_type'] = 1;
		} else 
		{
			$_SESSION['account_type'] = 0;
		}
			
		if(isset($_SESSION['username']))
		{
			header("location:index.php?content=home");
		}
	}
}
echo "Invalid username/password";
echo "<a href=index.php?content=inlog><br />Go back</a>";
 ?>