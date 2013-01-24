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
				$sql = "SELECT * FROM user_data WHERE user_id=$userID";
				$result = $db->query($sql);
				// output profilepage
				foreach($result as $row)
				{ 
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

		<!-- displays right side of profile -->
		<div class="userprofile2">
			<?php		
				echo "<table>";
				// displays the personal text of the user
				echo "<tr><td> Personal Text:  </td>";
				echo "<td>" . $row["personal_text"] . "</td>"; 
				echo "</tr>";
		
				echo "<tr><td> &nbsp; </td></tr>";
				// displays the first name of the user
				echo "<tr><td> First Name:  </td>";
				echo "<td>" . $row["name"] . "</td>"; 
				echo "</tr>";
		
				echo "<tr><td> &nbsp; </td></tr>";
				// displays the last name of the user
				echo "<tr><td> Last Name:  </td>";
				echo "<td>" . $row["surname"] . "</td>"; 
				echo "</tr>";
		
				echo "<tr><td> &nbsp; </td></tr>";
					
				// checks to see if the user allows their age to be shown	
				if($row['age'] <= 0 || $row['age'] >= 120)
				{ 
					echo "<tr><td> &nbsp;  </td></tr>";
				} else 
				{
					echo "<tr><td> Age:  </td>";
					echo "<td>" . $row["age"] . "</td>"; 
					echo "</tr>";
				}
				echo "<tr><td> &nbsp; </td></tr>";
				// displays the gender of the user
				echo "<tr><td> Gender:  </td>";
				if($row["gender"] == 0)
				{
					echo "<td> Male </td>"; 
				} else
				{
					echo "<td> Female </td>";
				}
				echo "</tr>";
		
				echo "<tr><td> &nbsp; </td></tr>";
				// displays the country of the user
				echo "<tr><td> Country:  </td>";
				echo "<td>" . $row["country"] . "</td>"; 
				echo "</tr>";
		
				echo "<tr><td> &nbsp; </td></tr>";
				// displays the quote of the user
				echo "<tr><td> Quote:  </td>";
				echo "<td>" . $row["quote"] . "</td>"; 
				echo "</tr>";
				echo "</table>";
		
				echo "<br />";
				echo "<br />";
					
				// if the user is at his/her own profile, the "Edit Profile" link
				// will appear else not
				if(isset($_SESSION['username']) == $row['username']) 
				{
					echo "<a href=\"index.php?content=editprofile&user_id=" . $row["user_id"] . "\">" . '<i><strong>Edit Profile</strong></i>' . "</a>" ;
				} 
			?>
		</div>	
	</div> 
	
	<!-- Update Profile -->
	<?php
		// variables that contains form errors of the user
		$errorFile = ""; // avatar error
		$errorAge = ""; //
		$errorCountry = ""; // country error
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
		
		// check for personal text in profile
		function checkPersonalText()
		{	
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
			
		// Updates the database, thus updates the profile page
		function inputForm()
		{
		//	if($GLOBALS['errorCountry'] == "" && $GLOBALS['errorFile'] == "")
		//	{
				include 'db_con.php';
				
				$userID = $_GET["user_id"]; 
				$sql= "SELECT * FROM country_list"; 
				$country = $_POST["country"]; // input of user in country
				$results = $db->query($sql);
				
				// checks whether a country exists
				foreach($results as $row)
				{
					// if the input matches with the data in country_list, the country will be updated in user_data, else not
					if ($row['country'] == $country) 
					{
						$selection = "UPDATE user_data SET avatar='$_POST[avatar]', personal_text='$_POST[personal_text]', age='$_POST[age]', gender='$_POST[gender]', country='$_POST[country]', quote='$_POST[quote]' WHERE user_id= $userID LIMIT 1";	
					} else
					{
						$selection = "UPDATE user_data SET avatar='$_POST[avatar]', personal_text='$_POST[personal_text]', age='$_POST[age]', gender='$_POST[gender]', quote='$_POST[quote]' WHERE user_id= $userID LIMIT 1";
					}
				}
				$result = $db->query($selection);
				if (!$selection) 
				{
					echo 'Could not run query: ' . mysql_error();
					exit;
				}				
		//	} 
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
				checkCountry();
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