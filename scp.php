<?php
//checks if the file is being included, else redirects to home
if (isset($include)):
	unset($include);
	
	$connection = ssh2_connect('webdb.science.uva.nl', 22);
	if (!$connection) die('Connection failed');
	
	ssh2_auth_password($connection, 'username', 'secret');
	
else :
	header("location:index.php?content=home");
endif;
?>