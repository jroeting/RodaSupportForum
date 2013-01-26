	<!-- Layout Profile -->
	<?php
	if(isset($_SESSION['username'])) :
	?>
	<div class="tablehead"> <strong> Profile </strong></div>					
	<!-- displays the left side of profile -->
	<div class="profilecontent">
		<div class="userprofile1">
			<div class="avatar"> <img src="images/avatar.png" height="100px" width="100px" > </div>
			<?php 
			
				include "db_con.php";
				$userID = $_GET["user_id"];
				$sql = "SELECT * FROM user_data WHERE user_id=?";
				$result = $db->prepare($sql);
				$result->bindValue(1, $userID, PDO::PARAM_INT);
				$result->execute();
				// output profilepage
				foreach($result as $row)
				{ 
					echo "<br />";
					echo "<br />";
					echo "Username: " . $row["username"];  
					echo "<br />";
					echo "<br />";
					
					switch ($row["account_type"]) 
					{
                        case "adm": 
                        $accountType = "admin";
                        break;
						
                        case "usr": 
                        $accountType = "user";
                        break;
                    }
                    echo "Account Type: " . $accountType;  
					echo "<br />";
					echo "<br />";
					break;
				}	
			?>	
		</div>

		<!-- displays right side of profile -->
		<div class="userprofile2">
			<?php		
				echo <<<EOT

				<table>
				<!-- displays the personal text of the user-->
					<tr>
						<td> Personal Text:  </td>
					<td> {$row['personal_text']} </td> 
					</tr>

					<tr>
						<td> &nbsp; </td>
					</tr>
				<!-- displays the first name of the user -->
					<tr>
						<td> First Name:  </td>
						<td> {$row['name']}</td> 
					</tr>
		
					<tr>
						<td> &nbsp; </td>
					</tr>
				<!-- displays the last name of the user -->
					<tr>
						<td> Last Name:  </td>
						<td> {$row['surname']} </td>
					</tr>

					<tr>
						<td> &nbsp; </td>
					</tr>
EOT;
			    // checks to see if the user allows their age to be shown	
				if($row['age'] <= 0 || $row['age'] >= 120)
				{ 
					echo "<tr>
							<td> &nbsp;  </td>
						</tr>";
				} else 
				{
					echo "<tr>
							<td> Age:  </td>";
					echo "<td>" . $row['age'] . "</td> 
							</tr>";
				}
				echo "<tr>
						<td> &nbsp; </td>
					</tr>";
				// displays the gender of the user
				echo "<tr><td> Gender:  </td>";
				if($row['gender'] == 0)
				{
					echo "<td> Male </td>"; 
				} else
				{
					echo "<td> Female </td>";
				}
				echo "</tr>";
				
				echo <<<EOT
					<tr>
						<td> &nbsp; </td>
					</tr>
				<!-- displays the country of the user -->
					<tr>
						<td> Country:  </td>
						<td> {$row['country']} </td> 
					</tr>
		
					<tr>
						<td> &nbsp; </td>
					</tr>
				<!-- displays the quote of the user -->
					<tr>
						<td> Quote:  </td>
						<td> {$row['quote']} </td> 
				</tr>
				</table>
		
				<br />
				<br />
EOT;

				// if the user is at his/her own profile, the "Edit Profile" link
				// will appear else not
				if($_SESSION['user_id'] == $row['user_id']) 
				{
					echo "<a href=\"index.php?content=editprofile&user_id=" . $row['user_id'] . "\">" . '<i><strong>Edit Profile</strong></i>' . "</a>" ;
				} 
			?>
		</div>	
	</div> 
	
	<!-- Update Profile -->
	<?php
		// variables that contains form errors of the user
		$errorFile = ""; // avatar error
		//$errorAge = ""; //
		//$errorCountry = ""; // country error
		// adds slashes and read the contents of a file into a string
		$imgData = addslashes (file_get_contents("images/avatar.png")); 
		
		/**** Functions ****/ 
		
		// check for upload avatar
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
		
		// checks personal text in profile
		function checkPersonalText()
		{	
			//$GLOBALS['personal_text'] = strip_tag($GLOBALS['personal_text']);
			$GLOBALS['personal_text'] = trim($GLOBALS['personal_text']);
			$GLOBALS['personal_text'] = filter_var($GLOBALS['personal_text'], FILTER_SANITIZE_STRING);
			$GLOBALS['personal_text'] = htmlentities($GLOBALS['personal_text'], ENT_QUOTES);
		}
	
	/*	function checkAge()
		{
			if (!is_numeric($_POST["age"]))
			{
				$GLOBALS['errorAge'] = "not a number";
			}
		}
	*/
			
		// check the input form for quote
		function checkQuote()
		{
			$GLOBALS['quote'] = trim($GLOBALS['quote']);
			$GLOBALS['quote'] = filter_var($GLOBALS['quote'], FILTER_SANITIZE_STRING);
			$GLOBALS['quote'] = htmlentities($GLOBALS['quote'], ENT_QUOTES);
		}
		
	/*	function checkCountry()
		{
			include 'db_con.php';
				
			 
			$country = $_POST['country']; // input of user in country
			$sql= "SELECT * FROM country_list"; 
			$countryCheck = $db->query($sql);
			$bool = "";
								
			// checks whether a country exists
			foreach($countryCheck as $row)
			{
				if ($country == $row['country']) 
				{
					$bool = 'true';
				}
			}
			$db=NULL; // closes database
				
		}*/
		// Updates the database, thus updates the profile page
		function inputForm()
		{
		//	if($GLOBALS['errorFile'] == "")
		//	{
				include 'db_con.php';
				
				$userID = $_GET['user_id']; 
									
				// checks whether a country exists
				
				$country = $_POST['country']; // input of user in country
				$sql= "SELECT * FROM country_list"; 
				$countryCheck = $db->query($sql);
				$bool = "";
								
			// checks whether a country exists
				foreach($countryCheck as $row)
				{
					if ($country==$row['country']) 
					{
						$bool = 'true';
					} else 
					{
						$bool = 'false';
					}
				}
				if($bool = 'true')
				{
					$selection = "UPDATE user_data SET avatar=?, personal_text=?, age=?, gender=?, country=?, quote=? WHERE user_id= ? LIMIT 1";
					$result = $db->prepare($selection);
					$result->bindValue(1, $_POST['avatar'], PDO::PARAM_LOB);
					$result->bindValue(2, $_POST['personal_text'], PDO::PARAM_STR);
					$result->bindValue(3, $_POST['age'], PDO::PARAM_INT);
					$result->bindValue(4, $_POST['gender'], PDO::PARAM_BOOL);
					$result->bindValue(5, $_POST['country'], PDO::PARAM_STR);
					$result->bindValue(6, $_POST['quote'], PDO::PARAM_STR);
					$result->bindValue(7, $userID, PDO::PARAM_INT);
					$result->execute();
				} else
				{
					$selection2 = "UPDATE user_data SET avatar=?, personal_text=?, age=?, gender=?, quote=? WHERE user_id= ? LIMIT 1";
					$result = $db->prepare($selection2);
					$result->bindValue(1, $_POST['avatar'], PDO::PARAM_STR);
					$result->bindValue(2, $_POST['personal_text'], PDO::PARAM_STR);
					$result->bindValue(3, $_POST['age'], PDO::PARAM_INT);
					$result->bindValue(4, $_POST['gender'], PDO::PARAM_BOOL);
					$result->bindValue(5, $_POST['quote'], PDO::PARAM_STR);
					$result->bindValue(6, $userID, PDO::PARAM_INT);
					$result->execute();
				}		
		}
		
			if(isset($_POST["submit"]))
			{	
				$personalText = $_POST['personal_text'];
				$age = $_POST['age'];
				$gender = $_POST['gender'];
				$country = $_POST['country'];
				$quote = $_POST['quote'];
				
				checkFile();
				checkPersonalText();
				checkQuote();
				inputForm();
			} 
			
			$db=NULL; // closes database
	?>
					
	<?php
		else :
			header("location:index.php?content=inlog");
		endif;
	?>