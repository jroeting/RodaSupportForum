<?php
	//checks name on a number of conditions, if one doenst pass an errormessage will be assigned
	function checkName()
	{
		if ($_POST["name"] == "" || !(filter_var($_POST["name"], FILTER_SANITIZE_STRING) == $_POST["name"] && str_replace(" ", "", $_POST["name"]) == $_POST["name"] && preg_match('/^[a-z]+$/i', $_POST["name"]) ))
		{
			$GLOBALS['errorName'] = "invalid name";	
		}
	}
	
	//checks surname on a number of conditions, if one doenst pass an errormessage will be assigned
	function checkSurname()
	{
		if ($_POST["surname"] == "" || !(filter_var($_POST["surname"], FILTER_SANITIZE_STRING) == $_POST["surname"] && str_replace(" ", "", $_POST["surname"]) == $_POST["surname"] && preg_match('/^[a-z-]+$/i', $_POST["surname"])))
		{
			$GLOBALS['errorSurname'] = "invalid surname";	
		} 
	}
	
	//checks infix on a number of conditions, if one doenst pass an errormessage will be assigned
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
	
	//checks name on mail account condition, if it doenst pass an errormessage will be assigned
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
			// selects mail with value of the mail of the registering user
			$sql= "SELECT email FROM user_data WHERE email='$mail'";
			$results = $db->query($sql);
			
			//if email exists errormessage is assinged			
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
		// selects username with the value of the risterings users username
		$sql= "SELECT username FROM user_data WHERE username='$username'";
		$results = $db->query($sql);
					
		//checks username for some conditions, if one doesnt pass an errormessage will be assigned
		if ($_POST["username"] == "" || !(filter_var($_POST["username"], FILTER_SANITIZE_EMAIL)))
		{
			$GLOBALS['errorUsername'] = "invalid username";
		}else
		{
			//if an username i found its already taken, and an errormessage wil be assigned
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
	
	//sanitizes the quote
	function checkQuote()
	{
		$GLOBALS['quote'] = trim($GLOBALS['quote']);
		$GLOBALS['quote'] = filter_var($GLOBALS['quote'], FILTER_SANITIZE_STRING);
	}
	
	//checks password for some conditions, if one doesnt pass an errormessage will be assigned
	function checkPassword()
	{
		//checks if password and passwordcheck match, then for a valid email
		if (!($_POST["password"] == $_POST["passwordcheck"]))
		{
			$GLOBALS['errorPassword'] = "passwords don't match";
		}else if ($_POST["password"] == "" || !(str_replace(" ", "", $_POST["password"]) == $_POST["password"]))
		{
				$GLOBALS['errorPassword'] = "invalid password";
		}
	}
	
	//checks the file for several conditions, errormessages will be assigned if conditions dont pass
	function checkFile()
	{
		$allowedExts = array("jpg", "jpeg", "gif", "png");
		$extension = end(explode(".", $_FILES["file"]["name"]));
		
		if ($_FILES["file"]["name"] != "")
		{
			//checks for right extension, size ,height and width
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
				}elseif ($size["0"] > 1000 && $size["1"] > 1000)
				{
					$GLOBALS['errorFile'] = "file width or height must be less then 1000px";
				}else
				{
					$GLOBALS['imgData'] = fopen($_FILES['file']['tmp_name'], 'rb');
				}
			}
			else
			{
				$GLOBALS['errorFile'] = "invalid file, only .gif, .jpg, .jpg or .png and less then 200kb ";
			}
			
			
		}
	}
	
	//inputs all the values in the database and emails the user, then notifies the user of the registration succes
	function inputForm()
	{
		//if there are no errormessages the values will be put into the database
		if($GLOBALS['errorName'] == "" && $GLOBALS['errorSurname'] == "" && $GLOBALS['errorInfix'] == "" && $GLOBALS['errorEmail'] == "" && $GLOBALS['errorPassword'] == "" && $GLOBALS['errorUsername'] == "" && $GLOBALS['errorFile'] == "")
		{
			//crypts the password
			$password = crypt($_POST["password"]);
			
			// connect with database
			include 'db_con.php';
			// all registration values are inserted into the database
			$sql= "INSERT INTO user_data (username, password, email, name, surname, avatar, quote, infix) VALUES (?,?,?,?,?,?,?,?)";
			$results = $db->prepare($sql);
			$results->bindValue(1, htmlentities($_POST["username"]), PDO::PARAM_STR);
			$results->bindValue(2, $password, PDO::PARAM_STR);
			$results->bindValue(3, $_POST["mail"], PDO::PARAM_STR);
			$results->bindValue(4, $_POST["name"], PDO::PARAM_STR);
			$results->bindValue(5, $_POST["surname"], PDO::PARAM_STR);
			$results->bindValue(6, $GLOBALS["imgData"], PDO::PARAM_LOB);
			$results->bindValue(7, $_POST["quote"], PDO::PARAM_STR);
			$results->bindValue(8, $_POST["infix"], PDO::PARAM_STR);
			$results->execute();
			
			// close database
            $db = NULL;
			
			//assembles the complete name of the user
			if ($_POST["infix"] == "")
			{
				$name = $_POST["name"] . " " . $_POST["surname"];
			}else
			{
				$name = $_POST["name"] . " " . $_POST["infix"] . " " . $_POST["surname"];
			}
			
			//crypts users username
			$code = crypt($_POST["username"]);
			
			//mail with welcoming text and 2 links, one to verify the account and one to report a wrong email
			$to = $_POST["mail"];
			$subject = "Welcome to Roda support forum";
			$message = "Welcome " . $name . "\n\nYou have succesfully registered to Roda support forum!\nThe only thing left to do is verify your account, please click the link below to verify your account:\n http://webdb.science.uva.nl/~10343865/index.php?content=verify&code=" . $code . "\n\nNow that you are a member you can post subjects and respond to other subjects.\n\nFor the forum's rules and questions about the forum please see the FAQ.\n\nIs this e-mail not meant for you, please click the following link:\n http://webdb.science.uva.nl/~10343865/index.php?content=wrongemail&code=" . $code;
			$from = "noreply@roda.com";
			$headers = "From:" . $from;
			mail($to,$subject,$message,$headers);
			
			//sets include true and includes registersucces.php
			$include = true;
			include "registersucces.php";
		}else
		{
			//if there are errormessages set include true and includes the registerform again
			$include = true;
			include "registerform.php";
		}
	}
	
	//if the user i not logged in errormessages are set to empty 
	if(!isset($_SESSION['username']))
	{
		$errorName = "";
		$errorSurname = "";
		$errorInfix = "";
		$errorEmail = "";
		$errorPassword = "";
		$errorUsername = "";
		$errorFile = "";
		$imgData = fopen('images/avatar.png','rb');
		
		//is the form is submitted a number of check functions are done and eventually tried to be inserted into the database, else the form wil be included 
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
			//sets include true and includes the registerform
			$include = true;
			include "registerform.php";
		}
		
		
	}else
	{
		//if the user is logged in, will be redirected to home page
		header("location:index.php?content=home");
	}
?>