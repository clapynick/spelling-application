
<!-- 

	File: sign-up.php
	Author: Ben Tegoni
	Description:
	Button where people will submit a sign-up form to create an account.

-->

<?php
// All PHP code in here

// Include Statements to easily call files
include 'mysql-connection.php';

/* Sign Up Function */
function signUp(){
	include 'mysql-connection.php';
	
	$username = $_POST['username'];
	$pass = $_POST['pass'];
	$passConfirm = $_POST['passConfirm'];
	$code = $_POST['code'];
	$success = false;
	$success_text = "";
	global $success, $success_text;
	
	session_start();
	$sql = "SELECT * FROM codegen WHERE intGenCode";
	$result = $conn->query($sql);
	$row = $result->fetch_assoc();
	$error = false;
	
	if ($code == $row['intGenCode']){
		//echo "correct sign up code";
		$sql = "SELECT * FROM userdetails WHERE strUserName='$username'";
		$result = $conn->query($sql);
		$row = $result->fetch_assoc();
		if ($username != $row['strUserName']){
			$lengthPass = strlen("$pass");
			if ($lengthPass < 17 && $lengthPass > 5){
				$lengthUser = strlen("$username");
				if ($lengthUser < 17 && $lengthUser > 5){
					//echo "Username is available";
					if($pass == $passConfirm){
						//echo "Password Match";
						$intUserID = rand(1000, 9999);
						$sql = "SELECT * FROM userdetails WHERE intUserID='$intUserID'";
						$result = $conn->query($sql);
						$row = $result->fetch_assoc();
						if ($intUserID != $row['intUserID']){
							//echo "ID Created";
							$strAccountType = "student";
							//Input all details into the database to create a new user since all fields have been checked
							$sql = "INSERT INTO userdetails (strUserName, strPass, intUserID, strAccountType)
							VALUES ('$username', '$pass', '$intUserID', '$strAccountType')";
							if ($conn->query($sql) === TRUE) {
								$success = true;
								$success_text = "Congratulations! You have successfully created an account";
							} else {
								$error = true;
								$error_text = "Error: Creating an account, please contact a teacher or administrator.";
							}
						} else {
							while ($intUserID == $row['intUserID']){
								//echo "Finding another ID...";
								$intUserID = rand(1000, 9999);
							}
							echo "ID Created after another has";
							$strAccountType = "student";
							//Input all details into the database to create a new user since all fields have been checked
							$sql = "INSERT INTO userdetails (strUserName, strPass, intUserID, strAccountType)
							VALUES ('$username', '$pass', '$intUserID', '$strAccountType')";
							if ($conn->query($sql) === TRUE) {
								$success = true;
								$success_text = "Congratulations! You have successfully created an account";
							} else {
								$error = true;
								$error_text = "Error: Creating an account, please contact a teacher or administrator.";
							}
						}
					} else {
						$error = true;
						$error_text = "Error: Passwords do not match";
					}
				} else {
					$error = true;
					$error_text = "Error: Please keep your username within 6-16 characters";
				}
			} else {
				$error = true;
				$error_text = "Error: Please keep your password within 6-16 characters";
			}
		} else {
			$error = true;
			$error_text = "Error: The username you entered is taken";
		}
	} else {
		$error = true;
		$error_text = "Error: Your sign up code was incorrect";
	}
	$_SESSION['error'] = $error;
	if ($error == true){
		$_SESSION['error_text'] = $error_text;
	} else {
		$error_text = "";
		$_SESSION['error_text'] = $error_text;
	}
}

if($_POST){
    if(isset($_POST['submit'])){
        signUp();
    }
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
	
	/* Container Box Area */
	.container {
		border: 0px solid black !important;
		width: 500px;
		height: 350px;
		margin-left: 270px;
		margin-top: -340px;
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
	footer {
		height: 93px;
		position: absolute;
		right: 0;
		bottom: 0;
		left: 0;
	}
	
	footer .bottom-text {
		background-color: rgba(100, 100, 100, 0.5);
		height: 93px;
	}
	
	/* Chrome Button */
	footer .bottom-text .chrome-button {
		text-align: center;
	}
	
	/* All Field Boxes */
	.container .username-text input {
		border: 2px solid rgba(255, 255, 255, 1.0);
		height: 38px;
		width: 300px;
		background-color: transparent;
		border-radius: 3px;
		padding-bottom: 2px;
		padding-left: 10px;
	}
	
	.container .password-text input {
		border: 2px solid rgba(255, 255, 255, 1.0);
		height: 38px;
		width: 300px;
		background-color: transparent;
		border-radius: 3px;
		padding-bottom: 2px;
		padding-left: 10px;
	}
	
	.container .password-text2 input {
		border: 2px solid rgba(255, 255, 255, 1.0);
		height: 38px;
		width: 300px;
		background-color: transparent;
		border-radius: 3px;
		padding-bottom: 2px;
		padding-left: 10px;
	}
	
	.container .sign-up-code input {
		border: 2px solid rgba(255, 255, 255, 1.0);
		height: 38px;
		width: 300px;
		background-color: transparent;
		border-radius: 3px;
		padding-bottom: 2px;
		padding-left: 10px;
	}

	input[type="username"]::-webkit-input-placeholder {
		color: white !important;
		font-weight: bold;
	}
	
	input[type="password"]::-webkit-input-placeholder {
		color: white !important;
		font-weight: bold;
	}
	
	input[type="number"]::-webkit-input-placeholder {
		color: white !important;
		font-weight: bold;
	}
	
	.container .login-area .username-text, .password-text, .password-text2, .sign-up-code {
		margin-left: 90px;
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
	
	/* Success Code Formatting */
	p.success {
		border: 0px solid black;
		color: darkgreen;
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
				}
			}
		}	
		?><p>
		<p class="success"><?PHP
		if($_POST){
			if(isset($_POST['submit'])){
				if ($success == true){
					echo "*" . $success_text . "*";
				}
			}
		}	
		?><p>
	</div>

	
	<div class="login-area">
		<form name="login" method="post" accept-charset="utf-8">

			<div class="username-text">
				<input type="username" name="username" placeholder="Create Username" required>
			</div>

			<div class="password-text">
				<br />
				<br />
				<input pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,16}" title="Must contain at least one number and one uppercase and lowercase letter, and at 6-16 characters long" id="password" name="pass" type="password" placeholder="Create Password" required>
			</div>
			
			<div class="password-text2">
				<br />
				<br />
				<input id="confirm_password" name="passConfirm" type="password" placeholder="Confirm Password" required>
			</div>
			
			<div class="sign-up-code">
				<br />
				<br />
				<input id="code" name="code" type="number" placeholder="Sign Up Code" required>
			</div>
					
			<div class="submit-button">
				<br />
				<br />
				<input type="submit" name="submit" class="btn btn-lg btn-default" value="Submit" />
				<br />
			</div>

			<br />
			
			<div class="questions">		
				<center><a href="forgotten-password.php">Forgotten your password?</a></center>
				<center><a href="unknown-signup-code.php">Don't know the Sign Up Code?</a></center>
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





















