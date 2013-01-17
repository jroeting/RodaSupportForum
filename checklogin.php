<?php
// Connect to server and select databse.
 mysql_connect("localhost:3306", "webdb13KIC1", "busteqec")or die("cannot connect"); 
 mysql_select_db("webdb13KIC1")or die("cannot select DB");

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