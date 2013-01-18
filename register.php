<?php
	$errorName = "";
	$errorSurname = "";
	$errorInfix = "";
	$errorEmail = "";
	$errorPassword = "";
	$errorUsername = "";
	
	if (isset($_POST["submit"])) 
	{	$quote = $_POST["quote"];
		
		checkName();
		checkSurname();
		checkInfix();
		checkEmail();
		checkUsername();
		checkPassword();
		checkQuote();
		inputForm();
	}else
	{
		include "registerform.php";
	}
	
	function checkName()
	{
		if ($_POST["name"] == "" || !(filter_var($_POST["name"], FILTER_SANITIZE_STRING) == $_POST["name"] && str_replace(" ", "", $_POST["name"]) == $_POST["name"] && preg_match('/^[a-z-]+$/i', $_POST["name"])))
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
		if (!(filter_var($_POST["name"], FILTER_SANITIZE_STRING) == $_POST["name"] && preg_match('/^[a-z-]+$/i', $_POST["surname"])))
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
			$con = mysql_connect("localhost:3306","webdb13KIC1","busteqec");
			
			if(!$con)
			{
				die('Could not connect ' . mysql_error());
			}
		
			$selected_db = mysql_select_db("webdb13KIC1",$con);
			$selection = mysql_query("SELECT email FROM user_data WHERE email='$mail'");
	
			if ($row = mysql_fetch_array($selection))
			{
				$GLOBALS['errorEmail'] = "e-mail already in use";
			}
				
			mysql_close();
		}
	}
	
	function checkUsername()
	{
		$username = $_POST["username"];
		$con = mysql_connect("localhost:3306","webdb13KIC1","busteqec");
			
		if(!$con)
		{
			die('Could not connect ' . mysql_error());
		}
		
		$selected_db = mysql_select_db("webdb13KIC1",$con);
		$selection = mysql_query("SELECT username FROM user_data WHERE username='$username'");
			
		if ($_POST["username"] == "" || !(filter_var($_POST["username"], FILTER_SANITIZE_EMAIL)))
		{
			$GLOBALS['errorUsername'] = "invalid username";
		}else
		{
			if ($row = mysql_fetch_array($selection))
			{
				$GLOBALS['errorUsername'] = "username already taken";
			}
		}
		
		mysql_close();
	}
	
	function checkQuote()
	{
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
	
	function inputForm()
	{
		if($GLOBALS['errorName'] == "" && $GLOBALS['errorSurname'] == "" && $GLOBALS['errorInfix'] == "" && $GLOBALS['errorEmail'] == "" && $GLOBALS['errorPassword'] == "" && $GLOBALS['errorUsername'] == "")
		{
			$con = mysql_connect("localhost:3306","webdb13KIC1","busteqec");
				
			if(!$con)
			{
				die('Could not connect ' . mysql_error());
			}
		
			$password = hash('sha256', $_POST["password"]);
			$selected_db = mysql_select_db("webdb13KIC1",$con);
			$selection = mysql_query("INSERT INTO user_data (username, password, email, name, surname, quote, infix) VALUES ('$_POST[username]','$password','$_POST[mail]','$_POST[name]','$_POST[surname]','$_POST[quote]','$_POST[infix]')");
				$to = $_POST["mail"];
			$subject = "Welcome to Roda support forum";
			$message = "You have succesfully registered to Roda support forum!<br/>Now that you are a member you can post subjects and respond to other subjects.";
			$from = "noreply@roda.com";
			$headers = "From:" . $from;
			mail($to,$subject,$message,$headers);
			
			include "registersucces.php";
		}else
		{
			include "registerform.php";
		}
	}
?>