<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML Basic 1.1//EN"
"http://www.w3.org/TR/xhtml-basic/xhtml-basic11.dtd">
<!-- index.php shows a framework for the entire site, consisting of a header, a menubar, content and a footer. This is build up
by divs. All the website content is shown in the div with id 'content'.-->
<?php
	// start user session
	session_start();
?>
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <title>Roda Support Forum</title>
        <link rel="stylesheet" type="text/css" href="stylesheetbasis.css" />
		<?php
			// show the content as given in http url. If that's not given, show home.
			$content = "";
			
			
			if (isset($_GET["content"]))
			{
				$content =  $_GET["content"];
			} else
			{		
				$content = "home";
			}	
			// devision of different kind of pages
			$homepages = array("home");
			$memberspages = array("members", "profile", "editprofile", "changepassword", "phpadmin");
			$forumpages = array("forum", "forumcontent", "newpost", "newpostform", "topic", "newreaction", "newreactionform", "report_spam", "removepost", "nospam", "removesubject");
			$faqpages = array("faq", "rules", "faq1",  "faq2", "faq3", "faq4", "faq5", "faq6", "faq7", "faq8", "faq9", "faq10", "faq11");
		?>
	</head>
    <body>
        <div id="topspace"></div>
		<div id="header">
			<p class="logintext">
				<?php
				// if user is logged in, the header will show a logout button and a link to the user's own profile
				if(isset($_SESSION['username']))
				{
					echo "<a href='index.php?content=logout'>Log out</a> | <a href='index.php?content=profile&user_id=".$_SESSION['user_id']."'>" . $_SESSION['username'] . "&nbsp;<img src=\"getavatar.php\" height=\"30px\" width=\"auto\" /></a>&nbsp;";
				}else
				// if the user is not logged in, the header will show a link to the login page or a link to the register page
				{
					echo "<a href='index.php?content=inlog'>Login</a> | <a href='index.php?content=register'>Register</a>&nbsp;";
				}
				?>
			</p>
		</div>
        <!-- This div shows the menu and the links to different pages -->
        <div id="menu">
			<div id="menucontainer">
			    <div id="nav">
				  <ul>
					<li><a href="index.php?content=home" <?php if(in_array($content, $homepages)) echo "class=\"current\"" ?>><span>Home</span></a></li>
					<li><a href="index.php?content=members" <?php if(in_array($content, $memberspages)) echo "class=\"current\"" ?>><span>Members</span></a></li>
					<li><a href="index.php?content=forum" <?php if(in_array($content, $forumpages)) echo "class=\"current\"" ?>><span>Forum</span></a></li>
					<li><a href="index.php?content=faq" <?php if(in_array($content, $faqpages)) echo "class=\"current\"" ?>><span>FAQ</span></a></li>
				  </ul>
			    </div>
			</div>
		</div>
        <div id="content">
            <?php
			// shows given content
			if(file_exists($content . '.php'))
			{
				include $content . '.php';
			}
			else
			// if for some reason the file is not found, the following error message will be shown
			{
				echo "<p>Sorry page not found</p>";
			}
			?>
        </div>
        <!-- showing the footer content including copyright, disclaimer, contact address and w3 buttons -->
        <div id="footer">
        	<table>
        		<tr>
                	<td class="footersmall">Copyright &#169; 2013</td>
                    <td class="footersmall"><a href="index.php?content=disclaimer">Disclaimer</a></td>
                   	<td class="footerwide"><a href="mailto:123@abc.nl">Contact</a></td>
                   	<td class="footerrest"><a href="http://validator.w3.org/check?uri=referer"><img src="http://www.w3.org/Icons/valid-xhtml11" alt="Valid XHTML 1.1" height="15px" width="auto" /></a><a href="http://jigsaw.w3.org/css-validator/check/referer"><img src="http://jigsaw.w3.org/css-validator/images/vcss" alt="Valid CSS!" height="15px" width="auto"/></a>
					</td>
				</tr>
			</table>
        </div>
    
    </body>
</html>

