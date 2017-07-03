<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
	<title>&lt;Code Snippets/&gt;</title>
	<link href="https://fonts.googleapis.com/css?family=Covered+By+Your+Grace|Permanent+Marker" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet">
	<link href="style.css" rel="stylesheet" type="text/css">
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">


</head>
<body>

<?php
	
	//session_start();
	$message="";
	require_once('config.php'); 

	if(!isset($_SESSION['email']) || !isset($_SESSION['username']) || !isset($_SESSION['password'])){
		$message = "Valid email (or) password not received";
		header("Location: login_signup.php");
		$_SESSION['reg_msg'] = $message;

	}

	$link = mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME);

	// Check connection
	if (mysqli_connect_errno()) {
	  echo "Failed to connect to MySQL: " . mysqli_connect_error();
	}


	$email = $_SESSION['email'];
	$name = $_SESSION['name'];
	$username = $_SESSION['username'];
	$password = $_SESSION['password'];
	$codeid = NULL;

	echo "<div class = 'heading'>
		<h1>&lt;Code Snippets/&gt;
		<span class = 'home'><i title='home - Click to add new code snippets' class='material-icons' onClick='window.location.href =`homepage.php`;'>home</i>&nbsp;&nbsp;</span>
		<span class = 'home'><i title = 'Logout' class='material-icons' onClick='window.location.href =`logout.php`;'>power_settings_new</i>&nbsp;&nbsp;</span>
		</h1>
		</div>";

	echo "<div class = 'greeting'>
		<span class = 'greeting_span'>Hello, ".$name." (".$username.")!</span>
		</div>";
	echo "<form id = 'mycodesform' method='post' action='snippets.php'>
			<input type = 'hidden' name = 'user' value ='".$username."'>
	</form>";
	echo "<form id = 'browsecodesform' method='post' action='snippets.php'>
	</form>";
	echo "<div class = 'greeting'>
			<span><input type='submit' value='View My Codes' form='mycodesform'></span>
			<span><input type='submit' value='Browse Latest Codes' form='browsecodesform'></span>
		</div>";
	echo "<div class = 'View'><p>Add Code</p>";
	echo "<div class='Add'>";
			echo "<form id = 'add' method='post' action = ''>
					<p><input id = 'des' type = 'text' name = 'description' placeholder = 'Description (required)'></p>
					<p><textarea id = 'codearea' name = 'code' placeholder = 'Enter Your Code Here...'></textarea></p>
					<input type = 'hidden' name = 'action' value = 'Add Code'>
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