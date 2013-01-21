<div class="tablehead"> <strong> Profile </strong></div>

	<?php
		$errorFile = "";
		$errorPersonalText = "";
		$errorAge = "";
		$errorCountry = "";
		$imgData = addslashes (file_get_contents("images/avatar.png"));
		
		if (isset($_POST["submit"])) 
		{	
			$quote = $_POST["quote"];
			checkFile();
			checkPersonalText();
			//checkAge();
			//checkGender();
			//checkCountry();
			checkQuote();
			inputForm();	
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
					if ($_FILES["file"]["error"] > 0)
					{
						$GLOBALS['errorFile'] = "file error";
					}else
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
		
		function checkPersonalText()
		{
			if ($_POST["personal_text"] == "" || !(filter_var($_POST["personal_text"], FILTER_SANITIZE_STRING) == $_POST["personal_text"] && str_replace(" ", "", $_POST["personal_text"]) == $_POST["personal_text"] && preg_match('/^[a-z-]+$/i', $_POST["personal_text"])))
			{
				$GLOBALS['errorPersonalText'] = "invalid personal_text";	
			}
		}
		
		/*	
		function checkAge()
		{
			
		}
			
		function checkGender()
		{
			
		}
			
		function checkCountry()
		{
			
		}
		*/
			
		function checkQuote()
		{
			$GLOBALS['quote'] = trim($GLOBALS['quote']);
			$GLOBALS['quote'] = filter_var($GLOBALS['quote'], FILTER_SANITIZE_STRING);
			$GLOBALS['quote'] = htmlentities($GLOBALS['quote'], ENT_QUOTES);
		}
			
		function inputForm()
		{
			if($GLOBALS['errorFile'] == "" && $GLOBALS['errorPersonalText'] == "")
			{
				$con = mysql_connect("localhost:3306","webdb13KIC1","busteqec");
				
				if(!$con)
				{
					die('Could not connect ' . mysql_error());
				}
			
				$selected_db = mysql_select_db("webdb13KIC1",$con);
				$selection = mysql_query("INSERT INTO user_data (avatar, personal_text, age, gender, country, quote) VALUES ('$GLOBALS[imgData]','$_POST[personal_text]','$_POST[age]','$_POST[gender]','$_POST[country]','$_POST[quote]')");	
				if (!$selection) 
				{
					echo 'Could not run query: ' . mysql_error();
					exit;
				}
			}else
			{
				include "editprofile.php";
			}
			mysql_close();
		}
			
//////////////////////Output Layout Profile////////////////////////////////////////////////////////////////////
		/*	$host = localhost;
			$dbname = webdb13KIC1;
			$username = webdb13KIC1;
			$password = busteqec;
			
			$db = new PDO("mysql:host=$host;dbname=$dbname;charset=UTF-8", $username, $password);
			
			$stmt = $db->prepare('SELECT * FROM user_data WHERE user_id=?');
			$stmt-> bindValue(1, 2, PDO::PARAM_INT);
			$stmt->execute();
		*/
		
			
			
		
			$con = mysql_connect("localhost:3306","webdb13KIC1","busteqec"); 
			if(!$con)
			{
				die('Could not connect ' . mysql_error());
			}
			$selected_db = mysql_select_db("webdb13KIC1",$con);
			if (!$selected_db)
			{
				die('Cannot use database:' . mysql_error());
			}
			$userID = $_GET["user_id"];
			$selection = mysql_query("SELECT * FROM user_data WHERE user_id= $userID" ); 
			
			if (!$selection) 
			{
				echo 'Could not run query: ' . mysql_error();
				exit;
			} 
		?>
		<div class="profilecontent">
			<div class="userprofile1">
				
				<?php 
					while($row = mysql_fetch_array($selection))
					{ 
				?>
						<div class="avatar"> <?php $row["avatar"]; ?> </div> 
						
						<?php
							echo "<br />";
							echo "<br />";
							echo "Username: " . $row["username"];  
							echo "<br />";
							echo "<br />";
							echo "Account Type: " . $row["account_type"]; 
							echo "<br />";
							echo "<br />";
							break;
					}				
				?>	
			</div>

		
			<div class="userprofile2">
	
				<?php
					echo "<table>";
					echo "<tr><td> Personal Text:  </td>";
					echo "<td>" . $row["personal_text"] . "</td>"; 
					echo "</tr>";
		
					echo "<tr><td> &nbsp; </td></tr>";
		
					echo "<tr><td> First Name:  </td>";
					echo "<td>" . $row["name"] . "</td>"; 
					echo "</tr>";
		
					echo "<tr><td> &nbsp; </td></tr>";
		
					echo "<tr><td> Last Name:  </td>";
					echo "<td>" . $row["surname"] . "</td>"; 
					echo "</tr>";
		
					echo "<tr><td> &nbsp; </td></tr>";
		
					echo "<tr><td> Age:  </td>";
					echo "<td>" . $row["age"] . "</td>"; 
					echo "</tr>";
		
					echo "<tr><td> &nbsp; </td></tr>";
		
					echo "<tr><td> Gender:  </td>";
					echo "<td>" . $row["gender"] . "</td>"; 
					echo "</tr>";
		
					echo "<tr><td> &nbsp; </td></tr>";
		
					echo "<tr><td> Country:  </td>";
					echo "<td>" . $row["country"] . "</td>"; 
					echo "</tr>";
		
					echo "<tr><td> &nbsp; </td></tr>";
				
					echo "<tr><td> Quote:  </td>";
					echo "<td>" . $row["quote"] . "</td>"; 
					echo "</tr>";
					echo "</table>";
					
					mysql_close();
		
					echo "<br />";
					echo "<br />";
					
					echo "<a href=\"index.php?content=editprofile&user_id=" . $row["user_id"] . "\">" . '<i><strong>Edit Profile</strong></i>' . "</a>" ;
				?>	
					
				
			</div>	
		</div> 

