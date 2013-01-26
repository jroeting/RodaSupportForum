<!-- newreactionform.php takes the user's message to post it--> 
<?php
echo "<form name=\"new_reaction\" method=\"post\" action=\"index.php?content=newreaction&subject=$subject\">";
?>
	<table>
		<tr>
        	<td>
            	<!-- user text input -->
				<textarea name="post" rows="4" cols="50">Write reaction here...</textarea></br>
                <!-- submit button -->
				<input type="submit" value="post" name="submit" />
            </td>
		</tr>
	</table>
</form>
