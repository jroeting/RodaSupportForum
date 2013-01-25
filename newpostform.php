<?php 
if (isset($include)):
	unset($include);
?>
	<form name="new_subject" method="post" action="index.php?content=newpost">
		<table>
			<tr>
					<td class="left">Subject Title:</td>
				<td><input type="text" name="title" id="subject_title" />
					<span class="registerError">
						<?php
							echo $GLOBALS['errorTitle'];
						?>
					</span>
				</td>
			</tr>
			<tr>
				<td class="left">Category:</td>
				<td>
					<select name="category" size="3" id="category">
						<option id="technical_issues" <?php if ($_GET["category"] == "technical_issues") echo "selected=\"selected\"";?>>technical issues</option>
						<option id="cartalk" <?php if ($_GET["category"] == "cartalk") echo "selected=\"selected\"";?>>cartalk</option>
						<option id="car_unrelated" <?php if ($_GET["category"] == "car_unrelated") echo "selected=\"selected\"";?>>car unrelated</option>
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
	</form>
<?php 
	else :
		header("location:index.php?content=home");
	endif;
?>