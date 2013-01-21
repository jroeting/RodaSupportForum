<table class="forumcontent">
	<tr class="tablehead">
    	<td class="tablehead"><strong>&nbsp; &nbsp; Categories</strong></td>
    	<td class="tablehead"><strong>Number of subjects</td>	
    </tr>
  	<tr class="tablebody">
  		<td><p class="blacktext"><a href="index.php?content=technical_issues"><span>Technical Issues</span></a></p></td>
    	<td>
			<?php
                $db = new PDO('mysql:host=localhost;dbname=webdb13KIC1', 'webdb13KIC1', 'busteqec');
                $sql = "SELECT * FROM subjects WHERE category='technical_issues'";
                $count = mysql_num_rows($sql);
                $results = $db->query($count);
                echo "$results";
                $db = NULL;

  	  			/*$con = mysql_connect("localhost:3306","webdb13KIC1","busteqec"); 
	   			if(!$con)
		  		{	
		    		die('Could not connect ' . mysql_error());
		  		}
      			$selected_db = mysql_select_db("webdb13KIC1",$con);
  	  			$selection = mysql_query("SELECT * FROM subjects WHERE category='technical_issues'");
	  			$count = mysql_num_rows($selection);
      			echo "$count";
	  			mysql_close($con);*/
  			?>
        </td>
	</tr>
  	<tr class="tablebody">
  		<td><p class="blacktext"><a href="index.php?content=cartalk" <?php if($content == cartalk) echo "class=\"current\"" ?>><span>Cartalk</span></a></p></td>
    	<td>
			<?php
                $db = new PDO('mysql:host=localhost;dbname=webdb13KIC1', 'webdb13KIC1', 'busteqec');
                $sql = "SELECT * FROM subjects WHERE category='cartalk'";
                $count = mysql_num_rows($sql);
                $results = $db->query($count);
                echo "$results";
                $db = NULL;
            ?>
		</td>
	</tr>
  	<tr class="tablebody" >
  		<td><p class="blacktext"><a href="index.php?content=car_unrelated" <?php if($content == car_unrelated) echo "class=\"current\"" ?>><span>Car-unrelated</span></a></p></td>
    	<td>
			<?php
                $db = new PDO('mysql:host=localhost;dbname=webdb13KIC1', 'webdb13KIC1', 'busteqec');
                $sql = "SELECT * FROM subjects WHERE category='car_unrelated'";
                $count = mysql_num_rows($sql);
                $results = $db->query($count);
                echo "$results";
                $db = NULL;
    		?>
        </td>
  	</tr>
</table>
