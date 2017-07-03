<?php
session_start();
if (!isset($_SESSION['email']) || !isset($_SESSION['username']) || !isset($_SESSION['password'])) {
	 header("Location: login_signup.php");
}
else{
	header("Location: homepage.php");	
}

?>