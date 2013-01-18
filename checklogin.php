<?php
// username and password sent from form 
$myusername = $_POST['myusername']; 
$mypassword = $_POST['mypassword'];

// encrypt password
$mypassword = hash('sha256', $mypassword);

// Connect to server and select databse.
$connectie = mysql_connect("localhost:3306", "webdb13KIC1", "busteqec");
if(!$connectie)
{
	die('Could not connect to database ' . mysql_error());
}
$select_db = mysql_select_db("webdb13KIC1", $connectie);
if(!select_db)
{
	die('Could not connect ' . mysql_error());
}
$select = mysql_query("SELECT * FROM $user_data WHERE username='$myusername' and password='$mypassword'");
echo $select;
if(!$select)
{
	echo 'Could not run query: ' . mysql_error();
	exit;
}

while($row = mysql_fetch_array($select))
{
	if($mypassword == $row['password'] && $myusername == $row['username'])
	{
		session_register("myusername");
		session_register("mypassword"); 
		header("location:login_success.php");
	}
}
echo ''Invalid username/password''; 
 ?>