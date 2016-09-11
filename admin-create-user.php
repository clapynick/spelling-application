
<!-- 

	File: admin-create-user.php
	Author: Ben Tegoni
	Description:
	The page an admin goes to to create a user.

-->

<?php
// All PHP code in here

// Include Statements to easily call files
include 'mysql-connection.php';

//Start Session
session_start();
//Check what accountType the user is
$strUserName = $_SESSION['strUserName'];
$sql = "SELECT * FROM userdetails WHERE strUserName='$strUserName'";
$result = $conn->query($sql);

if($strUserName != null){
	while($row = $result->fetch_assoc()){
		if($row["strAccountType"] == 'admin'){
			break;
		} else if($row["strAccountType"] == 'teacher'){
			header("Location: /teacher-login-page.php");
			break;
		} else if($row["strAccountType"] == 'student'){
			header("Location: /student-login-page.php");
			break;
		} else {
			header("Location: /index.php");
		}
	}
} else {
	header("Location: /index.php");
}


//Function for creating the code associated with signing up
function generateCode(){
	include 'mysql-connection.php';
	
	//Define Variables
	$sql = "SELECT * FROM codegen";
	$result = $conn->query($sql);
	$row = mysqli_fetch_assoc($result);
	$numberA = rand(100000, 999999);
	echo("$numberA : Current numberA <br />");
	$numberB = $row['intGenCode'];
	echo($numberB);
	echo " : Current numberB <br />";

	while($numberA == $numberB){
		$numberA = rand(100000, 999999);
		echo("$numberA : New Selected numberA");
	} 
	
	if($numberA != $numberB){
		$sql2 = "DELETE FROM codegen WHERE intGenCode";
		if ($conn->query($sql2) === TRUE) {
			echo "<br /> Record deleted successfully <br />";
		} else {
			echo "<br /> Error deleting record <br />";
		}
		
		$sql3 = "INSERT INTO codegen VALUES ('$numberA')";
		if ($conn->query($sql3) === TRUE) {
			echo "New record created successfully <br />";
		} else {
			echo "Error: Could not put data in the database <br />";
		}
	}
}

//Function for creating a user when logged into admin
function createUser(){
	include 'mysql-connection.php';
	
	$username = $_POST['username'];
	$pass = $_POST['pass'];
	$passConfirm = $_POST['passConfirm'];
	$strAccountType = $_POST['account-type-select'];
	$success = false;
	$success_text = "";
	global $success, $success_text;
	
	$sql = "SELECT * FROM codegen WHERE intGenCode";
	$result = $conn->query($sql);
	$row = $result->fetch_assoc();
	$error = false;
	
	if ($strAccountType != "select-one"){
		$sql = "SELECT * FROM userdetails WHERE strUserName='$username'";
		$result = $conn->query($sql);
		$row = $result->fetch_assoc();
		if ($username != $row['strUserName']){
			$lengthPass = strlen("$pass");
			if ($lengthPass < 17 && $lengthPass > 5){
				$lengthUser = strlen("$username");
				if ($lengthUser < 17 && $lengthUser > 5){
					if($pass == $passConfirm){
						$intUserID = rand(1000, 9999);
						$sql = "SELECT * FROM userdetails WHERE intUserID='$intUserID'";
						$result = $conn->query($sql);
						$row = $result->fetch_assoc();
						if ($intUserID != $row['intUserID']){
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
								$intUserID = rand(1000, 9999);
							}
							echo "ID Created after another has";
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
		$error_text = "Error: Please Select an Account Type";
	}
	$_SESSION['error'] = $error;
	if ($error == true){
		$_SESSION['error_text'] = $error_text;
	} else {
		$error_text = "";
		$_SESSION['error_text'] = $error_text;
	}
}

//Check if the generate code button has been pressed
if($_GET){
    if(isset($_GET['gencode'])){
        generateCode();
		header("Location: /admin-create-user.php");
		exit();
    }
}

//Check to see if the submit button was pressed
if($_POST){
    if(isset($_POST['submit'])){
        createUser();
    }
}

?>

<html>
<!-- Header Section of HTML code -->
<head>

<meta charset="utf-8">
<title>Create User for Admin Page (admin-create-user.php)</title>

<!-- USEFUL LINKS. EXPENDABLE -->
<!-- http://www.w3schools.com/cssref/ - CSS Code References -->

<!-- This is basic links for external sources -->
<link href='https://fonts.googleapis.com/css?family=PT+Sans' rel='stylesheet' type='text/css'>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css" />
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>

<!-- This is where animations would go using JavaScript and possibly other languages -->
<script language="javascript">
</script>

<!-- This is where CSS code goes -->
<style>

	/* Body create-user */
	body {
		background-image: url(images/backgrounds/solid-light-blue-hd-wallpaper.jpg);
		background-repeat: no-repeat;
		background-size: cover;
		height: 60%;
		background-attachment: fixed;
		width: 100%;
		margin: auto;
	}
	
	/* Title Text Box Config */
	.main-text {
		border: 0px solid black !important;
		width: 650px;
		height: 200px;
		margin-top: 35px;
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
	
	/* Footer Section */ 
	footer {
		height: 93px;
		position: relative;
		right: 0;
		bottom: 0;
		left: 0;
	}
	
	footer .bottom-text {
		background-color: rgba(100, 100, 100, 0.5);
		height: 93px;
	}
	
	/* Footer Chrome Button */
	footer .bottom-text .chrome-button {
		text-align: center;
	}
	
	/* Main Tabs Config */
	.main-tabs ul {
	}
	
	.tabs-area {
		background-color: rgba(96, 96, 96, 	1.00);
		border-radius: 0px;
	}
	
	/* Home Button Customisation */
	.home-button img {
		border: 0px solid red;
		margin-left: 1435px;
		margin-top: -42px;
	}
	
	.home-button img:hover {
		opacity: 0.7;
	}
	
	/* Generate Code Button and Text Area */
	.generate-code-button > form > input {
		font-size: 15px;
		color: white;
		height: 40px;
		border-top-right-radius: 10px;
		border-bottom-right-radius: 10px;
		border-bottom-left-radius: 0px;
		border-top-left-radius: 0px;
		background-color: rgba(96, 96, 96, 1.00);
		border: 1px solid black;
		margin-top: -10px;
	}
	
	.generate-code-button p {
		border: 1px solid black;
		height: 40px;
		width: 130px;
		border-top-right-radius: 10px;
		border-bottom-right-radius: 10px;
		border-bottom-left-radius: 0px;
		border-top-left-radius: 5px;
		background-color: rgba(100, 206, 206, 1.00);
		color: white;
		font-size: 17px;
		padding-top: 7px;
		margin-left: 170px;
		margin-top: -40px;
		padding-left: 10px;
	}	
	
	/* Form area */
	h1.create-user {
		text-align: center;
		font-weight: bold;
		font-size: 50px;
	}
	
	/* All Field Boxes */
	.create-user-area .username-text input {
		border: 2px solid rgba(255, 255, 255, 1.0);
		height: 40px;
		width: 300px;
		background-color: transparent;
		border-radius: 3px;
		padding-bottom: 2px;
		padding-left: 10px;
		border-radius: 5px;
	}
	
	.create-user-area .password-text input {
		border: 2px solid rgba(255, 255, 255, 1.0);
		height: 40px;
		width: 300px;
		background-color: transparent;
		border-radius: 3px;
		padding-bottom: 2px;
		padding-left: 10px;
		border-radius: 5px;
	}
	
	.create-user-area .password-text2 input {
		border: 2px solid rgba(255, 255, 255, 1.0);
		height: 40px;
		width: 300px;
		background-color: transparent;
		border-radius: 3px;
		padding-bottom: 2px;
		padding-left: 10px;
		border-radius: 5px;
	}
	
	.create-user-area .account-type select {
		border: 2px solid rgba(255, 255, 255, 1.0);
		height: 40px;
		width: 300px;
		background-color: transparent;
		border-radius: 3px;
		padding-bottom: 2px;
		padding-left: 10px;
		border-radius: 5px;
	}
	
	select.account-type-select, option {
		color: white !important;
		font-weight: bold;
		background-color: lightblue;
	}


	input[type="username"]::-webkit-input-placeholder {
		color: white !important;
		font-weight: bold;
	}
	
	input[type="password"]::-webkit-input-placeholder {
		color: white !important;
		font-weight: bold;
	}
	
	input[type="password-text2"]::-webkit-input-placeholder {
		color: white !important;
		font-weight: bold;
	}
	
	/* Submit Button To Finish Form */
	.create-user-area .submit-button input {
		width: 225px;
		border-radius: 10px;
	}
	
	/* Error Code Formatting */
	.create-user-area .error-code {
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

<center>
	<div class="main-text">
		<h1><span style="color:white">Resources</span><span style="color: white">2</span><span style="color: rgba(82, 82, 255, 1.0);">Go</span></h1>
	</div>
</center>

<div class="home-button">
	<a href="admin-login-page.php" title="Home Page"><img src="images/icons/home-icon.png" alt="Home Icon" height="50" width="50"></a>
</div>

<div class="main-class">
<br />
<br />
	<nav class="tabs-area navbar navbar-inverse navbar-justified">
		<div class="container-fluid">
			<div class="navbar-header">
				<a class="navbar-brand" href="admin-login-page.php"><span style="color: white">Resources</span><span style="color: white">2</span><span style="color: rgba(82, 82, 255, 1.0);">Go</span></a>
			</div>
			<ul class="nav navbar-nav pull-right">
				<li><a onMouseOver="this.style.color='#BDC3C7'" onMouseOut="this.style.color='white'" style="color: white"href="admin-login-page.php">Home</a></li>
				<li><a onMouseOver="this.style.color='#BDC3C7'" onMouseOut="this.style.color='white'" style="color: white" href="create-quiz.php">Create Quiz</a></li>
				<li class="active"><a onMouseOut="this.style.color='white'" style="color: white" href="admin-create-user.php">Create User</a></li>
				<li><a onMouseOver="this.style.color='#BDC3C7'" onMouseOut="this.style.color='white'" style="color: white" href="admin-delete-user.php">Delete User</a></li>
				<li><a onMouseOver="this.style.color='#BDC3C7'" onMouseOut="this.style.color='white'" style="color: white" href="admin-edit-user.php">Edit User</a></li>
				<li><a onMouseOver="this.style.color='#BDC3C7'" onMouseOut="this.style.color='white'" style="color: white" href="logOutScript.php">Sign Out</a></li>
			</ul>
		</div>
	</nav>
</div>

<div class="generate-code-button">
	<form>
		<input type="submit" name="gencode" class="btn btn-lg btn-default" value="Generate New Code"/>
		<p><?PHP 
			$sql = "SELECT * FROM codegen";
			$result = $conn->query($sql);
			if ($result->num_rows > 0) {
				// output data of each row
				while($row = $result->fetch_assoc()) {
					echo "Code: " . $row["intGenCode"] . "<br>";
				}
			} else {
				echo "";
			}
			$numberC = $row;
			?></p>
	</form>
</div>

<center>
<div class="create-user-area">
	<form name="login" method="post" accept-charset="utf-8">
		<h1 class="create-user">Create User</h1>
		<hr style='width:80%'>
		<br />
		
		<!-- Display the code by getting the error set in the session of the function -->
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
		
		<div class="account-type">
			<br />
			<br />
			<select id="account-type-select" class="account-type-select" name="account-type-select">
				<option value="select-one" selected="selected">Select An Account Type</option>
				<option value="student">student</option>
				<option value="teacher">teacher</option>
				<option value="admin">admin</option>
			</select>
		</div>
				
		<div class="submit-button">
			<br />
			<br />
			<input type="submit" name="submit" class="btn btn-lg btn-default" value="Submit" />
			<br />
		</div>

		<br />
		
	</form>
</div>
</center>


<footer>
	<div class="bottom-text">
		<center><p>Copyright © Resources2Go 2013</p></center>
		<div class="chrome-button">
			<p><img src="images/icons/chrome-icon.png" alt="Chrome Icon" height="50" width="50"><a style="color: black" href="for-chrome.php">Built for chrome! Click here to learn more.</a></p>
		</div>
	</div>
</footer>

</body>

</html>