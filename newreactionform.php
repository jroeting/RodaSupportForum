<?php
echo "<form name=\"new_reaction\" method=\"post\" action=\"index.php?content=newreaction&subject=$subject\">";
?>
	<table>
		<tr>
        	<td>
				<textarea name="post" id="new_reaction" rows="4" cols="50">Write reaction here...</textarea></br>
				<input type="submit" value="post" name="submit" />
            </td>
		</tr>
	</table>
</form>
