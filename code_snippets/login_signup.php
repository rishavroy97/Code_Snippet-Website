<!DOCTYPE html>
<html>
<head>
	<title>&lt;Code Snippets/&gt;</title>
	<link href="style.css" rel="stylesheet" type="text/css">
	<link href="https://fonts.googleapis.com/css?family=Covered+By+Your+Grace|Permanent+Marker" rel="stylesheet">
</head>
<body>
<div class = "heading">
<h1>&lt;Code Snippets/&gt;</h1>
</div>
	<!-- Login and Signup forms -->


	<div id="tabs">
	  <ul class = "registrationList">
	    <li id="login" onclick="ToggleDisplay('tabs-1','tabs-2','login','signup')" class="active">Login</li>
	    <li id="signup" onclick="ToggleDisplay('tabs-2','tabs-1','signup','login')">Sign Up</li>
	  </ul>
	  <div id="forms">                 
		  <div id="tabs-1">
		  <form action="reg_process.php" method="post">
		    <p><input id="email" name="email" type="text" placeholder="Email"></p>
		    <p><input id="password" name="password" type="password" placeholder="Password">
		    <input name="action" type="hidden" value="login" /></p>
		    <p><input type="submit" value="Login" /></p>
		  </form>
		  </div>
		  <div id="tabs-2">
		    <form action="reg_process.php" method="post">
		    <p><input id="name" name="name" type="text" placeholder="Name"></p>
		    <p><input id="email" name="email" type="text" placeholder="Email"></p>
		    <p><input id="username" name="username" type="text" placeholder="Username"></p>
		    <p><input id="password" name="password" type="password" placeholder="Password">
		    <input name="action" type="hidden" value="signup" /></p>
		    <p><input type="submit" value="Sign Up" /></p>
		  </form>
		  </div>
	   </div>
		<?php
		session_start();
		require_once('config.php'); 
		if (isset($_SESSION['reg_msg'])) {

			$message = $_SESSION['reg_msg'];
			echo $message;
		}  
		?>   
	</div>

<script src="script.js"></script>
</body>
</html>
