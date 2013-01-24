<?php
	$subject = $_GET['subject'];

echo "<form name=\"new_reaction\" method=\"post\" action=\"index.php?content=newreaction&subject=$subject\">";
?>
	<table>
		<tr>
        	<td>
				Write your reaction in the following textbox<br />
				<textarea name="post" rows="4" cols="50">Write reaction here...</textarea>
				<input type="submit" value="post" name="submit" />
            </td>
		</tr>
	</table>
</form>
