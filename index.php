<?xml version="1.0"?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML Basic 1.1//EN"
"http://www.w3.org/TR/xhtml-basic/xhtml-basic11.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <title>Roda Support Forum</title>
        <link rel="stylesheet" type="text/css" href="stylesheetbasis.css" />
		<?php
			$content = "";
			
			if (isset($_GET["content"]))
			{
				$content =  $_GET["content"];
			} else
			{		
				$content = "home";
			}				
		?>
	</head>
    <body>
        <div id="topspace"></div>
		<div id="header">
			<div class="headertext">
				<p class="logintext">
					<a href="index.php?content=inlog">Login</a> | <a href="index.php?content=register">Register</a>&nbsp;
				</p>
			</div>
		</div>
        <div id="menu">
			<div id="menucontainer">
			    <div id="nav">
				  <ul>
					<li><a href="index.php?content=home" <?php if($content == "home") echo "class=\"current\"" ?>><span>Home</span></a></li>
					<li><a href="index.php?content=members" <?php if($content == "members") echo "class=\"current\"" ?>><span>Members</span></a></li>
					<li><a href="index.php?content=forum" <?php if($content == "forum") echo "class=\"current\"" ?>><span>Forum</span></a></li>
					<li><a href="index.php?content=faq" <?php if($content == "faq") echo "class=\"current\"" ?>><span>FAQ</span></a></li>
				  </ul>
			    </div>
			</div>
		</div>
        <div id="content">
            <?php
			if(file_exists($content . '.php'))
			{
				include $content . '.php';
			}
			else
			{
				echo "<p>Sorry page not found</p>";
			}
			?>
        </div>
        <div id="footer">Copyright &#169; 2013 Disclaimer <a href="mailto:123@abc.nl">Contact</a>
        	<table>
        		<tr>
                	<td width="193">Copyright &#169; 2013</td>
                    	<td width="193">Disclaimer</td>
                    	<td width="401"><a href="mailto:123@abc.nl">Contact</a></td>
                    	<td width="114"><a href="http://validator.w3.org/check?uri=referer"><img src="http://www.w3.org/Icons/valid-xhtml11" alt="Valid XHTML 1.1" height="15px" width="auto" /></a>
			<a href="http://jigsaw.w3.org/css-validator/check/referer"><img src="http://jigsaw.w3.org/css-validator/images/vcss" alt="Valid CSS!" height="15px" width="auto"/></a></td>
		</table>
        </div>
    
    </body>
</html>

