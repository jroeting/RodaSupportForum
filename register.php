<?php
function checkName()
	{
		if ($_POST["name"] == "" || !(filter_var($_POST["name"], FILTER_SANITIZE_STRING) == $_POST["name"] && str_replace(" ", "", $_POST["name"]) == $_POST["name"] && preg_match('/^[a-z]+$/i', $_POST["name"])))
		{
			$GLOBALS['errorName'] = "invalid name";	
		}
	}
	
	function checkSurname()
	{
		if ($_POST["surname"] == "" || !(filter_var($_POST["surname"], FILTER_SANITIZE_STRING) == $_POST["surname"] && str_replace(" ", "", $_POST["surname"]) == $_POST["surname"] && preg_match('/^[a-z-]+$/i', $_POST["surname"])))
		{
			$GLOBALS['errorSurname'] = "invalid surname";	
		} 
	}
	
	function checkInfix()
	{
		if ($_POST["infix"] != "")
		{
			$_POST["infix"] = trim($_POST["infix"]);
		}else
		
		if ($_POST["infix"] != "" && !(filter_var($_POST["infix"], FILTER_SANITIZE_STRING) == $_POST["infix"] && preg_match('/^[a-z-]+$/i', $_POST["infix"])))
		{
			$GLOBALS['errorInfix'] = "invalid infix";
		}
	}
	
	function checkEmail()
	{
		if (!filter_var($_POST["mail"], FILTER_VALIDATE_EMAIL))
		{
			$GLOBALS['errorEmail'] = "invalid e-mail";
		}else
		{
			$mail = $_POST["mail"];
			
			// connect with database
			include 'db_con.php';
			// selection of all subjects, ordered by subject_id (so most recent is on top)
			$sql= "SELECT email FROM user_data WHERE email='$mail'";
			$results = $db->query($sql);
				
			foreach($results as $row)
			{
				if ($row['email'] == $mail)
				{
					$GLOBALS['errorEmail'] = "e-mail already in use";
				}
			}
			
			// close database
			$db = NULL;
		}
	}
	
	function checkUsername()
	{
		$username = $_POST["username"];
		
		// connect with database
		include 'db_con.php';
		// selection of all subjects, ordered by subject_id (so most recent is on top)
		$sql= "SELECT username FROM user_data WHERE username='$username'";
		$results = $db->query($sql);
					
		if ($_POST["username"] == "" || !(filter_var($_POST["username"], FILTER_SANITIZE_EMAIL)))
		{
			$GLOBALS['errorUsername'] = "invalid username";
		}else
		{
			foreach($results as $row)
			{
				if ($row['username'] == $username)
				{
					$GLOBALS['errorUsername'] = "username already taken";
				}
			}
		}
		
		// close database
		$db = NULL;
	}
	
	function checkQuote()
	{
		$GLOBALS['quote'] = trim($GLOBALS['quote']);
		$GLOBALS['quote'] = filter_var($GLOBALS['quote'], FILTER_SANITIZE_STRING);
		$GLOBALS['quote'] = htmlentities($GLOBALS['quote'], ENT_QUOTES);
	}
	
	function checkPassword()
	{
		if (!($_POST["password"] == $_POST["passwordcheck"]))
		{
			$GLOBALS['errorPassword'] = "passwords don't match";
		}else if ($_POST["password"] == "" || !(str_replace(" ", "", $_POST["password"]) == $_POST["password"]))
		{
				$GLOBALS['errorPassword'] = "invalid password";
		}
	}
	
	function checkFile()
	{
		$allowedExts = array("jpg", "jpeg", "gif", "png");
		$extension = end(explode(".", $_FILES["file"]["name"]));
		
		if ($_FILES["file"]["name"] != "")
		{
			
			if ((($_FILES["file"]["type"] == "image/gif")
			|| ($_FILES["file"]["type"] == "image/jpeg")
			|| ($_FILES["file"]["type"] == "image/png")
			|| ($_FILES["file"]["type"] == "image/pjpeg"))
			&& ($_FILES["file"]["size"] < 200000)
			&& in_array($extension, $allowedExts))
			{
				$size = getimagesize($_FILES['file']['tmp_name']);
				
				if ($_FILES["file"]["error"] > 0)
				{
					$GLOBALS['errorFile'] = "file error";
				}else if ($size["0"] > 1000 && $size["1"] > 1000)
				{
					$GLOBALS['errorFile'] = "file width or height must be less then 1000px";
				}
				else
				{
					$GLOBALS['imgData'] = addslashes(file_get_contents($_FILES['file']['tmp_name']));
				}
			}
			else
			{
				$GLOBALS['errorFile'] = "invalid file, only .gif, .jpg, .jpg or .png and less then 200kb ";
			}
			
			
		}
	}
	
	function inputForm()
	{
		if($GLOBALS['errorName'] == "" && $GLOBALS['errorSurname'] == "" && $GLOBALS['errorInfix'] == "" && $GLOBALS['errorEmail'] == "" && $GLOBALS['errorPassword'] == "" && $GLOBALS['errorUsername'] == "" && $GLOBALS['errorFile'] == "")
		{
			$password = crypt($_POST["password"]);
			
			// connect with database
			include 'db_con.php';
			// selection of all subjects, ordered by subject_id (so most recent is on top)
			$sql= "INSERT INTO user_data (username, password, email, name, surname, avatar, quote, infix) VALUES ('$_POST[username]','$password','$_POST[mail]','$_POST[name]','$_POST[surname]','$GLOBALS[imgData]','$_POST[quote]','$_POST[infix]')";
			$results = $db->query($sql);
			// close database
            $db = NULL;
			
			if ($_POST["infix"] == "")
			{
				$name = $_POST["name"] . " " . $_POST["surname"];
			}else
			{
				$name = $_POST["name"] . " " . $_POST["infix"] . " " . $_POST["surname"];
			}
			
			$to = $_POST["mail"];
			$subject = "Welcome to Roda support forum";
			$message = "Welcome " . $name . "\n\nYou have succesfully registered to Roda support forum!\nThe only thing left to do is verify your email, please click the link below to verify our email:\n\nNow that you are a member you can post subjects and respond to other subjects.\n\nFor the forum's rules and questions about the forum please see the FAQ.\n\nIs this e-mail not meant for you, please click the following link
			\n";
			$from = "noreply@roda.com";
			$headers = "From:" . $from;
			mail($to,$subject,$message,$headers);
			
			include "registersucces.php";
		}else
		{
			$include = true;
			include "registerform.php";
		}
	}
	
	if(!isset($_SESSION['username']))
	{
		$errorName = "";
		$errorSurname = "";
		$errorInfix = "";
		$errorEmail = "";
		$errorPassword = "";
		$errorUsername = "";
		$errorFile = "";
		$imgData = addslashes (file_get_contents("images/avatar.png"));
		
		if (isset($_POST["submit"])) 
		{	
			$quote = $_POST["quote"];
			
			checkName();
			checkSurname();
			checkInfix();
			checkEmail();
			checkUsername();
			checkPassword();
			checkQuote();
			checkFile();
			inputForm();
		}else
		{
			$include = true;
			include "registerform.php";
		}
		
		
	}else
	{
		header("location:index.php?content=home");
	}
?>