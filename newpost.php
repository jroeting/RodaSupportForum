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
		$title = $_POST['title'];
		$category = $_POST['category'];
		$post = $_POST['post'];
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