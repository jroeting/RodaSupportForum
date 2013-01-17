<?php
// username and password sent from form 
$myusername=$_POST['myusername']; 
$mypassword=$_POST['mypassword'];

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
if(!$select)
{
	echo 'Could not run query: ' . mysql_error();
	exit;
}

// To protect MySQL injection
 $myusername = stripslashes($myusername);
 $mypassword = stripslashes($mypassword);
 $myusername = mysql_real_escape_string($myusername);
 $mypassword = mysql_real_escape_string($mypassword);

// Mysql_num_row is counting table row
 $count=mysql_num_rows($result);

// If result matched $myusername and $mypassword, table row must be 1 row
if($count==1){

// Register $myusername, $mypassword and redirect to file "login_success.php"
 $session_register("myusername");
 $session_register("mypassword"); 
 header("location:login_success.php");
 }
 else {
 echo "Wrong Username or Password";
 }
 ?>