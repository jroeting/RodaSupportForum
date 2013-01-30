<?php
	$connection = ssh2_connect('webdb.science.uva.nl', 22);
	if (!$connection) die('Connection failed');
	
	ssh2_auth_password($connection, 'username', 'secret');
	
	ssh2_scp_send($connection, $_FILES['file']['tmp_name'], 'public_html/avatars', 0644);
?>