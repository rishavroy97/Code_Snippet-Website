<!DOCTYPE html>
<html>
<head>
	<title>&lt;Code Snippets/&gt;</title>
	<link href="https://fonts.googleapis.com/css?family=Covered+By+Your+Grace|Permanent+Marker" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet">
	<link href="style.css" rel="stylesheet" type="text/css">

</head>
<body>

<?php
	
	session_start();
	require_once('config.php'); 

	if(!isset($_POST['email']) || !isset($_POST['username']) || !isset($_POST['password'])){
		$_SESSION['reg-msg'] = "Valid email (or) username (or) password not received";
		sleep(1);
		header("Location: login_signup.php");
	}

	$link = mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME);

	// Check connection
	if (mysqli_connect_errno()) {
	  echo "Failed to connect to MySQL: " . mysqli_connect_error();
	}


	$email = $_POST['email'];
	$name = $_POST['name'];
	$username = $_POST['username'];
	$password = $_POST['password'];
	//the user to whom the code belongs
	$user = NULL;
	$id = NULL;
	$codeid = NULL;

	echo "<div class = 'heading'>
		<h1>&lt;Code Snippets/&gt;
		<span title='home - Click to add new code snippets' class = 'home' onClick='document.forms[`homeform`].submit();'>&#9962;</span>
		<form id = 'homeform' method='post' action = 'homepage.php'>
			<input type = 'hidden' name = 'email' value = '". $email ."'>
			<input type = 'hidden' name = 'username' value = '". $username ."'>
			<input type ='hidden' name = 'password' value='".$password."'>
			<input type = 'hidden' name = 'name' value='".$name ."'>
		</form>
		</h1>
		</div>";

	echo "<div class = 'greeting'>
		<span class = 'greeting_span'>Hello, ".$name." (".$username.")!</span>
	</div>";

	echo "<form id = 'mycodesform' method='post' action='snippets.php'>
			<input type = 'hidden' name = 'email' value = '". $email ."'>
			<input type = 'hidden' name = 'username' value = '". $username ."'>
			<input type = 'hidden' name = 'name' value='".$name ."'>
			<input type ='hidden' name = 'password' value='".$password."'>
			<input type = 'hidden' name = 'user' value ='".$username."'>
	</form>";
	echo "<form id = 'browsecodesform' method='post' action='snippets.php'>
			<input type = 'hidden' name = 'email' value = '". $email ."'>
			<input type = 'hidden' name = 'username' value = '". $username ."'>
			<input type ='hidden' name = 'password' value='".$password."'>
			<input type = 'hidden' name = 'name' value='".$name ."'>
	</form>";
	echo "<div class = 'greeting'>
			<span><input type='submit' value='View My Codes' form='mycodesform'></span>
			<span><input type='submit' value='Browse Latest Codes' form='browsecodesform'></span>
		</div>";

	if (!isset($_GET['codeid']) || !isset($_GET['id'])) {
		//display a list of items
		if (!isset($_POST['user'])) {
			//browse codes
			echo "<div class = 'View'><p>Browse Codes</p>";
			$sql = "SELECT * FROM `codes` ORDER BY `codes`.`date` DESC";
			$query = mysqli_query($link,$sql);
			if (!$query) {
				echo "<br> Error :" . mysqli_error($link);
			}
			while ($result = mysqli_fetch_array($query)) {
				echo "<div class='Code_description'>";
				echo "<p>" . $result['description'].
					 "<form method='post' action = 'snippets.php?id=".$result['id']."&codeid=".$result['codeid']."'>";
				echo "<input type = 'hidden' name = 'action' value = 'View Code'>";
				echo "<input type = 'hidden' name = 'email' value = '". $email ."'>
					<input type = 'hidden' name = 'username' value = '". $username ."'>
					<input type ='hidden' name = 'password' value='".$password."'>
					<input type = 'hidden' name = 'name' value='".$name ."'>
					<input type = 'submit' value = 'View This Code'>";
				echo "</form>";
				echo "</p>";
				echo "</div>";
			} 
			echo "</div>";

		}
		else{
			//view my codes
			$user = $_POST['user'];
			echo "<div class = 'View'><p>View My Codes</p>";
			$sql = "SELECT * FROM `codes` WHERE `codes`.`username`= '".$user."' ORDER BY `codes`.`date` DESC";
			$query = mysqli_query($link,$sql);
			if (!$query) {
				echo "<br> Error :" . mysqli_error($link);
			}
			while ($result = mysqli_fetch_array($query)) {
				echo "<div class='Code_description'>";
				echo "<p>" . $result['description'].
					 "<form method='post' action = 'snippets.php?id=".$result['id']."&codeid=".$result['codeid']."'>";
				echo "<input type = 'hidden' name = 'action' value = 'View Code'>";
				echo "<input type = 'hidden' name = 'email' value = '". $email ."'>
					<input type = 'hidden' name = 'username' value = '". $username ."'>
					<input type ='hidden' name = 'password' value='".$password."'>
					<input type = 'hidden' name = 'name' value='".$name ."'>
					<input type = 'submit' value = 'View This Code'>";
				echo "</form>";
				echo "</p>";
				echo "</div>";
			} 
			echo "</div>";
		}		
	}	
	else{
		//display the item with the same id and codeid
		$id = $_GET['id'];
		$codeid = $_GET['codeid'];
		$sql = "SELECT * FROM `codes` WHERE `codes`.`id` = ".$id." AND `codes`.`codeid` = '".$codeid ."'";
		$query = mysqli_query($link,$sql);
		if (!$query) {
			echo "<br> Error :" . mysqli_error($link);
		}
		echo "<div class = 'View'><p>View Code</p>";
		while ($result = mysqli_fetch_array($query)) {
			echo "<div class='Add'>";
			echo "<p>".$result['description']."</p>
				<p><textarea id = 'codearea' name = 'code'>" . $result['code'] . "</textarea></p>";
			echo "</div>";
		}
		echo "</div>";
	}
?>
</body>
</html>