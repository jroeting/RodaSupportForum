<?php
// username and password sent from form 
$myusername = $_POST['username']; 
$mypassword = $_POST['password'];

// encrypt password
$mypassword = hash('sha256', $mypassword);

// Connect to server and select databse.
$connectie = mysql_connect("localhost:3306", "webdb13KIC1", "busteqec");
if(!$connectie)
{
	die('Could not connect to database ' . mysql_error());
}
$select_db = mysql_select_db("webdb13KIC1", $connectie);
if(!$select_db)
{
	die('Could not connect ' . mysql_error());
}
$select = mysql_query("SELECT * FROM user_data WHERE username='$myusername' and password='$mypassword'");
if(!$select)
{
	echo 'Could not run query: ' . mysql_error();
	exit;
}

$row = mysql_fetch_array($select);

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
		echo "Login successful, you will be redirected in 5 seconds.";
		header("location:index.php?content=home");
	}
}else
{
	echo "Invalid username/password";
	echo "<a href=index.php?content=inlog><br />Go back</a>";
}
 ?>