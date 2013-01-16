<?php

$host="localhost:3306"; // Host name 
$username="webdb13KIC1"; // Mysql username 
$password="busteqec"; // Mysql password 
$db_name="webdb13KIC1"; // Database name 
$tbl_name="user_data"; // Table name 


// Connect to server and select databse.
 mysql_connect("$host", "$username", "$password")or die("cannot connect"); 
 mysql_select_db("$db_name")or die("cannot select DB");

// username and password sent from form 
 $myusername=$_POST['myusername']; 
 $mypassword=$_POST['mypassword'];

// encrypt password
$mypassword = hash('sha256', $mypassword);

// To protect MySQL injection
 $myusername = stripslashes($myusername);
 $mypassword = stripslashes($mypassword);
 $myusername = mysql_real_escape_string($myusername);
 $mypassword = mysql_real_escape_string($mypassword);

$sql="SELECT * FROM $tbl_name WHERE username='$myusername' and password='$mypassword'";
 $result=mysql_query($sql);


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