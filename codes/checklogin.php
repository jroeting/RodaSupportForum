<?php
//checks if submitted else redirects to home
if (isset($_POST["submit"]))
{
	// username and password sent from form 
	$myusername = $_POST['username']; 
	$mypassword = $_POST['password'];

	// Connect to server and select databse.
	include "db_con.php";
	//selects all where username is users inputted name and verified is true
	$sql = "SELECT * FROM user_data WHERE username='$myusername' AND verified=true";
	$result = $db->query($sql);

	foreach($result as $row)
	{
		//checks if password from row equals inputted password and username from row equals inputted username
		if( crypt($mypassword, $row['password']) == $row['password'] && $myusername == $row['username'])
		{
			//sets sessions variables for a logged in user
			$_SESSION['username'] = $row['username'];
			$_SESSION['user_id'] = $row['user_id'];
			$account_type = $row['account_type'];
			if($account_type == "adm")
			{
				$_SESSION['account_type'] = 1;
			} else 
			{
				$_SESSION['account_type'] = 0;
			}
				
			if(isset($_SESSION['username']))
			{
				header("location:index.php?content=home");
			}
		}
	}
	
	//if login fails this is being echoed
	echo "Invalid username/password";
	echo "<a href=index.php?content=inlog><br />Go back</a>";
}else
{
	header("location:index.php?content=home");
}
 ?>