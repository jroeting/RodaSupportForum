<?php
	
	function checkUsername()
	{
		$validation = $_POST['validation'];
		$username = $_POST['username'] ; 
		include "db_con.php";

		$sql = "SELECT * FROM user_data WHERE username='$username'";
		$result = $db->query($sql);
		
		foreach($result as $row)
		{
			if($username == $row['username'] && $validation == $row['validateQ'])
			{	
				$randomNumber= rand();
				$dbUser = $row['username'];
				$encrypt = crypt($randomNumber);
				
				$query = "UPDATE user_data SET password=? WHERE username=? LIMIT 1";
				$result = $db->prepare($query);
					$result->bindValue(1, $encrypt, PDO::PARAM_LOB);
					$result->bindValue(2, $dbUser, PDO::PARAM_STR);	
					$result->execute();
				
				$to = $row['email'];
				$subjectMail= "Your new password";

				$message   = $row['username']. " your new password is: " . $randomNumber. "\n\n This was a auto generated message from the  Roda Excellent Cars Forum.";
      
				$header = "From: roda@roda.com";     
				$sent =  mail($to, $subjectMail, $message, $header);
		
				if($sent)
				{	
					die("The mail with the new password was send succesfully. <br /> <a href=\"index.php?content=inlog\"> Go to inlogscreen </a>");
				} else
				{
					die("failed to sent e-mail");
				}
			} 
		} 
		die("The username does not exist or the combination of the question with the username does not match. <br /> <a href=\"index.php?content=retrievepasswordform\"> <i><strong>Try Again</strong></i> </a>");							 	
	}
		
					
   
	
	
	if(isset($_POST['submit']))
	{
		checkUsername();
	}
?>
