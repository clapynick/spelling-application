
<!-- 

	File: index.php
	Author: Ben Tegoni
	Description:
	First page people are greeted by, login system as well.

-->

<?php
// All PHP code in here

// Include Statements to easily call files
include 'mysql-connection.php';

session_start();

/* Function to check username */
function checkDetails($conn) {
	//Get users entered username
	$username = $_POST['username'];
	//Get users entered password
	$password = $_POST['password'];
	//Set $sql to be the query definition
	$sql = "SELECT * FROM userdetails WHERE strUserName='$username'";
	//$conn (Connect to the correct database), then query $conn with the defined query in $sql, store the result in $result.
	$result = $conn->query($sql);
	//loggedIn variable to be false because no one is logged in currently.
	$loggedIn = false;
	$error = false;
	$error_text = "";
	
	if ($result->num_rows > 0) {
		// output data of each row
		//Fetch the associate data with that of the username entered.
		while($row = $result->fetch_assoc()) {
			//Once fetched check to see if the passoword entered is a match in association with the username entered.
			if($password == $row["strPass"]){
				//If successful log the account in and set loggedIn to be equal to true.
				$loggedIn = true;
				echo "Logging in successful.";
				//Set of if statements to check the accountType of the user
				$strUserName = $row['strUserName'];
				$intUserID = $row['intUserID'];
				$_SESSION['intUserID'] = $intUserID;
				$sql = "SELECT * FROM userdetails WHERE strUserName='$username'";
				$result = $conn->query($sql);
				$_SESSION['strUserName'] = $strUserName;
				if ($row['strAccountType'] == 'student'){
					header("Location: /student-login-page.php");
				} else {
					if ($row['strAccountType'] == 'teacher'){
						header("Location: /teacher-login-page.php");
					} else {
						if ($row['strAccountType'] == 'admin'){
							header("Location: /admin-login-page.php");
						} else {
							echo "major error!";
						}
					}
				}
				//Break the while loop.
				break;
			}else{
				//Username was not found in the database but suggest them to sign up.
				//echo "Wrong username or password, please try again or sign up.";
				$error = true;
				$error_text = "Error: Wrong username or password, please try again or sign up.";
			}
		}
	} else {
		//Username was found but password was incorrect.
		//echo "Wrong username or password, please try again or sign up.";
		$error = true;
		$error_text = "Error: Wrong username or password, please try again or sign up.";
	}
	$_SESSION['error'] = $error;
	if ($error == true){
		$_SESSION['error_text'] = $error_text;
	} else {
		$error_text = "";
		$_SESSION['error_text'] = $error_text;
	}
}

//Call the function after submit button has been pressed. Check the users entered details.
if(isset($_POST['submit'])){
	checkDetails($conn);
}



?>

<html>
<!-- Header Section of HTML code -->
<head>

<meta charset="utf-8">
<title>Login Page (index.php)</title>

<!-- USEFUL LINKS. EXPENDABLE -->
<!-- http://www.w3schools.com/cssref/ - CSS Code References -->
<!-- http://www.hongkiat.com/blog/html5-loginpage/ - Login Page -->

<!-- External Links to indexs found here: http://getbootstrap.com/getting-started/#download -->
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css" integrity="sha384-fLW2N01lMqjakBkx3l/M9EahuwpSfeNvV63J5ezn3uZzapT0u7EYsXMjQV+0En5r" crossorigin="anonymous">
<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>


<!-- This is where animations would go using JavaScript and possibly other languages -->
<script language="javascript">
</script>

<!-- This is where CSS code goes -->
<style>	

	/* Body Container */
	body {
		background-image: url(images/backgrounds/solid-light-blue-hd-wallpaper.jpg);
		background-repeat: no-repeat;
		background-size: cover;
		height: 60%;
		width: 100%;
		background-attachment: fixed;
		margin: auto;
	}
	
	/* Title Text Box Config */
	.main-text {
		border: 0px solid black !important;
		width: 650px;
		height: 200px;
		margin-top: 365px;
		margin-left: 950px;
		text-align: center;
		padding-top: 52.5px;
		background-color: rgba(239, 239, 239, 0.3);
		border-radius: 15px;
		box-shadow: 2px 2px 5px rgba(0, 0, 0, 0.2);
	}
	
	/* Title Text Config */
	.main-text h1 {
		font-size: 45px;
		font-family: Verdana, Geneva, sans-serif;
		font-weight: 700px;
	}
	
	/* Container Box Area*/
	.container {
		border: 0px solid red !important;
		width: 500px;
		height: 350px;
		margin-left: 270px;
		margin-top: -260px;
		padding-left: 0px;
	}
	
	/* Login Box Area */
	.container .login-box {
		height: 60px;
		width: 245px;
		text-align: center;
		padding-top: 17px;
		border-radius: 3px;
	}
	
	/* Sign Up Box Area */
	.container .signup-box {
		height: 60px;
		width: 245px;
		margin-left: 253px;
		margin-top: -60px;
		text-align: center;
		border-radius: 3px;
		padding-top: 17px;
	}
	
	/* Footer Section */ 
	footer .bottom-text {
		background-color: rgba(100, 100, 100, 0.5);
		margin-top: 225px;
		height: 93px;
	}
	
	/* Chrome Button */
	footer .bottom-text .chrome-button {
		text-align: center;
	}
	
	/* All Field Boxes */
	.container .username-text input {
		border: 2px solid rgba(255, 255, 255, 1.0);
		height: 40px;
		width: 300px;
		background-color: transparent;
		border-radius: 3px;
		padding-bottom: 2px;
		padding-left: 10px;
	}
	
	.container .password-text input {
		border: 2px solid rgba(255, 255, 255, 1.0);
		height: 40px;
		width: 300px;
		background-color: transparent;
		border-radius: 3px;
		padding-bottom: 2px;
		padding-left: 10px;
	}
	
	.container .username-text img {
		border: 2px solid rgba(255, 255, 255, 1.0);
		padding-top: 1px;
		padding-bottom: 1px;
		padding-left: 1px;
		padding-right: 1px;
		border-radius: 5px;
		margin-right: -6px;
	}
	
	.container .password-text img {
		border: 2px solid rgba(255, 255, 255, 1.0);
		padding-top: 2px;
		padding-bottom: 2px;
		padding-left: 2px;
		padding-right: 2px;
		border-radius: 5px;
		margin-right: -6px;
	}
	
	input[type="username"]::-webkit-input-placeholder {
		color: white !important;
		font-weight: bold;
	}
	
	input[type="password"]::-webkit-input-placeholder {
		color: white !important;
		font-weight: bold;
	}
	
	.container .login-area .username-text, .password-text {
		margin-left: 70px;
	}
	
	/* Login Button To Finish Form */
	.container .login-area .submit-button input {
		width: 500px;
		border-radius: 3px;
	}
	
	/* Questions Area */
	.container .login-area .questions {
		width: 500px;
	}
	
	.container .login-area .questions a {
		color: black;
		font-size: 14px;
	}
	
	/* Error Code Formatting */
	.container .error-code {
		border: 0px solid black;
		color: darkred;
		font-size: 18px;
		font-weight: bold;
		text-align: center;
	}
	
	
</style>

</head>

<!-- Body Section of HTML Code -->
<body>

<div class="main-text">
	<h1><span style="color:white">Resources</span><span style="color: white">2</span><span style="color: rgba(82, 82, 255, 1.0);">Go</span></h1>
</div>

<div class="container">

	<a href="index.php" class="login-box btn btn-lg btn-default">Login</a>
	
	<a href="sign-up.php" class="signup-box btn btn-lg btn-default">Sign Up</a>
	
	<div class="error-code">
		<p><?PHP
		if($_POST){
			if(isset($_POST['submit'])){
				if ($_SESSION['error'] == true){
					echo "*" . $_SESSION['error_text'] . "*";
					session_unset();
					session_destroy();
				}
			}
		}	
		?><p>
	</div>
	
	<div class="login-area">
		<form name="login" method="post" accept-charset="utf-8">

			<div class="username-text">
				<br />
				<img src="images/icons/username-icon.png" alt="Chrome Icon" height="40" width="40">
				<!-- A Break for my eyes -->
				<input type="username" name="username" placeholder="Enter Username" required>
			</div>

			<div class="password-text">
				<br />
				<br />
				<img src="images/icons/password-icon.png" alt="Chrome Icon" height="40" width="40">
				<!-- A Break for my eyes -->
				<input type="password" name="password" placeholder="Enter Password" required>
			</div>
					
			<div class="submit-button">
				<br />
				<br />
				<input type="submit" name="submit" class="btn btn-lg btn-default" value="Submit">
				<br />
			</div>

			<br />
			
			<div class="questions">		
				<center><a href="sign-up.php">Don't have an account? Sign up here!</a></center>
				<center><a href="forgotten-password.php">Forgotten your password?</a></center>
			</div>
		</form>
	</div>
</div>

<footer>
	<div class="bottom-text">
		<center><p>Copyright © Resources2Go 2013</p></center>
		<div class="chrome-button">
			<p><img src="images/icons/chrome-icon.png" alt="Chrome Icon" height="50" width="50"><a style="color: black" href="for-chrome.php">Built for chrome! Click here to learn more.</a></p>
		</div>
	</div>
</footer>


<!-- Body Section Ends -->
</body>

</html>





















