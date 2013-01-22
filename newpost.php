<?php
	function checkTitle()
	{
		if ($_POST["title"] == "" || !(filter_var($_POST["title"], FILTER_SANITIZE_STRING) == $_POST["title"] && preg_match('/^[a-z0-9]+$/i', $_POST["name"])))
		{
			$GLOBALS['errorTitle'] = "invalid title";	
		}
	}
	
	function checkMessage()
	{
		$_POST["post"] = trim($_POST["post"]);
		$_POST["post"] = filter_var($_POST["post"], FILTER_SANITIZE_STRING);
	}
	
	function inputPost()
	{
		if ($GLOBALS['errorTitle'] != "")
		{
			$title = $_POST['title'];
			$category = $_POST['category'];
			$post = $_POST['post'];
			
			// connect with database
            $db = new PDO('mysql:host=localhost;dbname=webdb13KIC1', 'webdb13KIC1', 'busteqec');
			// selection of all subjects, ordered by subject_id (so most recent is on top)
            $sqlselect = "SELECT user_data.user_id, subjects.subject_id FROM user_data, subjects WHERE user_data.username=$GLOBALS[username]";
            $results = $db->query($sql);
			$sqlinsert = "INSERT INTO posts (subject_id, user_id, content) VALUES ()";
            $input = $db->query($sql);
			// close database
            $db = NULL;
		}
	}
	
	if(isset($_SESSION['username'])) :
		$errorTitle = "";
		$username = $_SESSION['username'];
		
		if (isset($_POST["submit"])) 
		{	
			checkTitle();
			checkMessage();
			inputPost();
		}
?>
	<form name="new_subject" method="post" action="index.php?content=newpost">
	<table>
		<tr>
				<td class="left">Subject Title:</td>
			<td><input type="text" name="title" id="subject_title" />
				<?php
					echo $GLOBALS['errorTitle'];
				?>
			</td>
		</tr>
		<tr>
			<td class="left">Category:</td>
			<td>
				<select name="category" size="3" id="category">
					<option id="technical_issues" selected="selected">technical issues</option>
					<option id="cartalk">cartalk</option>
					<option id="car_unrelated">car unrelated</option>
				</select>
			</td>
		</tr>
		<tr>
			<td colspan="2">
				Write your message in the following textbox<br />
				<textarea name="post" rows="4" cols="50">Write message here...</textarea>
				<input type="submit" value="post" name="submit" />
			</td>
		</tr>
	</table>
<?php
	else :
		header("location:index.php?content=inlog");
	endif;
?>