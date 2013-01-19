<?php
 // Check if session is not registered, redirect back to main page. 
 session_start();
 if(session_is_registered($myusername))
 {
	header("location:inlog.php");
 }
 ?>

 <html>
 <body>
 Login Successful
 </body>
 </html>