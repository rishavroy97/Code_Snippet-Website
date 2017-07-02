<!DOCTYPE html>
<html>
<head>
	<title>&lt;Code Snippets/&gt;</title>
	<link href="https://fonts.googleapis.com/css?family=Covered+By+Your+Grace|Permanent+Marker" rel="stylesheet">
	<link href="style.css" rel="stylesheet" type="text/css">

</head>
<body>
<div class = "heading">
<h1>&lt;Code Snippets/&gt;</h1>
</div>
<?php
	
	session_start();
	require_once('config.php'); 

	if(!isset($_POST['email']) || !isset($_POST['username']) || !isset($_POST['password'])){
		$_SESSION['reg-msg'] = "Valid email (or) password not received";
		sleep(1);
		header("Location: login_signup.php");
	}

	$link = mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME);

	// Check connection
	if (mysqli_connect_errno()) {
	  echo "Failed to connect to MySQL: " . mysqli_connect_error();
	}


	$email = $_POST['email'];
	$password = $_POST['password'];
	$name = $_POST['name'];
	$username = $_POST['username'];
	$codeid = NULL;

	echo "<div class = 'greeting'>
		Hello ".$name." (".$username.")
	</div>";


	echo "<div class = 'View'><p>Add Code</p>";
	/*Add is a noobclass.Add a style element*/		echo "<div class='Add'>";
			echo "<form id = 'add' method='post' action = ''>
					<p><input id = 'des' type = 'text' name = 'description' placeholder = 'Description (required)'></p>
					<p><textarea id = 'codearea' name = 'code' placeholder = 'Enter Your Code Here...'></textarea></p>
					<input type = 'hidden' name = 'action' value = 'Add Code'>
					<input type = 'hidden' name = 'email' value = '". $email ."'>
					<input type = 'hidden' name = 'password' value = '". $password ."'>
					<input type = 'hidden' name = 'username' value = '". $username ."'>
					<input type = 'hidden' name = 'name' value='".$name ."'>
					<input type = 'submit' value = 'Submit Code'>
			</form>";
			if (isset($_POST['action'])) {
				if($_POST['action']=="Add Code")
		        {
		            $description = mysqli_real_escape_string($link,$_POST['description']);
		            $code = mysqli_real_escape_string($link,$_POST['code']);
		            if ($description != '' && $code != '') {
		            	$codeid = uniqid();
		            	$sql = "INSERT into codes (username,codeid,description,code) values ('".$username."','".$codeid."','".$description."','".$code . "')";
			            $query = mysqli_query($link,$sql);
			            if (!$query) {
							echo "<br> Error :" . mysqli_error($link);
						}
        				//after adding the note..you have to display it as well
						//hence refresh the page	
						echo '<script type="text/javascript">
        					document.getElementById("add").submit();
        					alert("Code Submitted Successfully!");
        				</script></div>';
		            }
		        }
			}
			echo "</div></li>";
?>
</body>
</html>