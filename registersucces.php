<?php 
if (isset($include)):
	unset($include);
?>
	<div id="registrationcontent">
		<h2>Registration succeeded!</h2>
		<p class="registration">You have succesfully registered to Roda support forum.</p>
		<p class="registration">You will receive an email to verify your account.</p>
	</div>
<?php 
	else :
		header("location:index.php?content=home");
	endif;
?>