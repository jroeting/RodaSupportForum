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
					echo "<br /><br />";
					echo "Username: " . $row["username"];  
					echo "<br /><br />";
					
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
					echo "<br /><br />";
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
				if($_SESSION['user_id'] == $row['user_id'] && $_SESSION['account_type'] == 1) 
				{
					echo '<br/><strong><a href="index.php?content=phpadmin">Go to administrator panel</a></strong>';
				}
			?>
		</div>	
	</div> 
	
	<!-- Update Profile -->
	<?php
		// variables that contains form errors of the user
		$errorFile = ""; // avatar error
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
			$_POST['personal_text'] = strip_tags($_POST['personal_text']); // strip HTML and PHP tags from a string
			$_POST['personal_text'] = htmlentities($_POST['personal_text'], ENT_QUOTES); // will convert both double and single quotes to html entities
			$_POST['personal_text'] = trim($_POST['personal_text']); // strip whitespace from the beginning and end of a string
			$_POST['personal_text'] = filter_var($_POST['personal_text'], FILTER_SANITIZE_STRING);// Filters a variable with FILTER_SANITIZE_STRING		
		}
			
		// check the input form for quote
		function checkQuote()
		{
			$_POST['quote'] = strip_tags($_POST['quote']); // strip HTML and PHP tags from a string
			$_POST['quote'] = htmlentities($_POST['quote'], ENT_QUOTES); // will convert both double and single quotes to html entities
			$_POST['quote'] = trim($_POST['quote']); // strip whitespace from the beginning and end of a string
			$_POST['quote'] = filter_var($_POST['quote'], FILTER_SANITIZE_STRING);// Filters a variable with FILTER_SANITIZE_STRING	
		}
		
		// Updates the database, thus updates the profile page
		function inputForm()
		{
			if($GLOBALS['errorFile'] == "")
			{
				include 'db_con.php';
				
				$userID = $_GET['user_id']; 
									
				// checks whether a country exists
				$country = $_POST['country']; // input of user in country
				$sql= "SELECT country FROM country_list"; 
				$countryCheck = $db->query($sql);
								
			// checks whether a country exists
				foreach($countryCheck as $row)
				{
					$contains = false;
					
					if ($country == $row['country']) 
					{	
						$contains = true;
					} 
				}
				if($contains = true)
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
				}
				else
				{
					$selection2 = "UPDATE user_data SET avatar=?, personal_text=?, age=?, gender=?, quote=? WHERE user_id= ? LIMIT 1";
					$result = $db->prepare($selection2);
					$result->bindValue(1, $_POST['avatar'], PDO::PARAM_LOB);
					$result->bindValue(2, $_POST['personal_text'], PDO::PARAM_STR);
					$result->bindValue(3, $_POST['age'], PDO::PARAM_INT);
					$result->bindValue(4, $_POST['gender'], PDO::PARAM_BOOL);
					$result->bindValue(5, $_POST['quote'], PDO::PARAM_STR);
					$result->bindValue(6, $userID, PDO::PARAM_INT);
					$result->execute(); 
				}
			}		
		}
		
			if(isset($_POST["submit"]))
			{	
				$avatar = $_POST['avatar'];
				$personalText = $_POST['personal_text'];
				$age = $_POST['age'];
				$gender = $_POST['gender'];
				$country = $_POST['country'];
				$quote = $_POST['quote'];
				
				if(!isset($_POST['avatar']))
				{
					checkPersonalText();
					checkQuote();
					inputForm();
				} else
				{				
				checkFile();
				checkPersonalText();
				checkQuote();
				inputForm();
				} 
			}
			
			$db=NULL; // closes database
	?>
					
	<?php
		else :
			header("location:index.php?content=inlog");
		endif;
	?>