<?php
// Check if session is registered, then direct to the homepage. 
if(isset($_SESSION['username']))
{
	echo "Login successful, you will be redirected in 5 seconds.";
	sleep(5);
	header("location:index.php?content=home");
}
?>