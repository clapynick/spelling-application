
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

//If there is a username found enter the if statement
if($strUserName != null){
	//Get the associated data from the row
	while($row = $result->fetch_assoc()){
		//If the row['strAccountType'] is equal to admin do nothing
		if($row["strAccountType"] == 'admin'){
			break;
		//If the row['strAccountType'] is equal to teacher redirect the user to the teacher landing page.
		} else if($row["strAccountType"] == 'teacher'){
			header("Location: /teacher-login-page.php");
			break;
		//If the row['strAccountType'] is equal to student redirect to the student landing page.
		} else if($row["strAccountType"] == 'student'){
			header("Location: /student-login-page.php");
			break;
		//If no account type is found the user doesnt exsist so its not a real login done.
		} else {
			header("Location: /index.php");
		}
	}
//If no username is found therefore someone is not logged in redirect them to the login page.
} else {
	header("Location: /index.php");
}


//Function for creating the code associated with signing up
function generateCode(){
	include 'mysql-connection.php';
	
	//Define Variables
	//A query to select all data from table Code Gen
	$sql = "SELECT * FROM codegen";
	$result = $conn->query($sql);
	$row = mysqli_fetch_assoc($result);
	//A random number between 100000 - 999999
	$numberA = rand(100000, 999999);
	echo("$numberA : Current numberA <br />");
	//Get the intGenCode and assign it to $numberB
	$numberB = $row['intGenCode'];
	echo($numberB);
	echo " : Current numberB <br />";

	//While the $numberA is equal to $numberB 
	while($numberA == $numberB){ //As soon as the number isnt equal it means that its a unique number and can set it to be $numberA
		$numberA = rand(100000, 999999);
		echo("$numberA : New Selected numberA");
	} 
	
	//As soon as the numbers aren't equal this part of the code is executed
	if($numberA != $numberB){
		$sql2 = "DELETE FROM codegen WHERE intGenCode";
		//Query a delete function for MySQL databse
		if ($conn->query($sql2) === TRUE) {
			//if successful display this.
			echo "<br /> Record deleted successfully <br />";
		} else {
			//if unsuccessful display this.
			echo "<br /> Error deleting record <br />";
		}
		//Make the query that inserts the new code into the correct table in the database with the $numberA variable.
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
	//Get the mysql database information by including the mysql file
	include 'mysql-connection.php';
	
	//Get the username from the form 
	$username = $_POST['username'];
	//Get the password from the form
	$pass = $_POST['pass'];
	//The second password part is set to a variable from the form	
	$passConfirm = $_POST['passConfirm'];
	//get the account type that was submitted from the form
	$strAccountType = $_POST['account-type-select'];
	//Completion or success value set to false as it has not been completed
	$success = false;
	//No succession yet so there is the success_text is set to nothing.
	$success_text = "";
	//Globally define these variable to be accessed accross the entire file.
	global $success, $success_text;
	
	//Query the database table codegen for intGenCode
	$sql = "SELECT * FROM codegen WHERE intGenCode";
	$result = $conn->query($sql);
	//Get associated data from that row
	$row = $result->fetch_assoc();
	$error = false;
	
	//if the strAccount type is not equal to select one, continue
	if ($strAccountType != "select-one"){
		//Query userdetails table from the database for the row that the strUserName is equal to the $username variable
		$sql = "SELECT * FROM userdetails WHERE strUserName='$username'";
		$result = $conn->query($sql);
		//Get associated data for that row
		$row = $result->fetch_assoc();
		//If the $username variable is NOT equal to the queried strUserName then continue
		if ($username != $row['strUserName']){
			//Find the length of the $pass variable
			$lengthPass = strlen("$pass");
			//If the length of the password is less than 17 and the length of the password is greater than 5 continue
			if ($lengthPass < 17 && $lengthPass > 5){
				//Get the length of the username and assign it to a variable
				$lengthUser = strlen("$username");
				//if the length of the string is less than 17 and greater than 5 continue
				if ($lengthUser < 17 && $lengthUser > 5){
					//If the password entered is equal to the confirmed password entered, continue
					if($pass == $passConfirm){
						//Define intUserID to a random number between 1000 and 9999
						$intUserID = rand(1000, 9999);
						//Query the database for userdetails where intUserID is equal to the intUserID quesiton
						$sql = "SELECT * FROM userdetails WHERE intUserID='$intUserID'";
						$result = $conn->query($sql);
						//Fetch the associated data of the query
						$row = $result->fetch_assoc();
						//If the intUserID is not equal to the row of the assocated data intUserID
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
							//Find a new intUserID until one is found that doesnt exsist
							while ($intUserID == $row['intUserID']){
								$intUserID = rand(1000, 9999);
							}
							echo "ID Created after another has";
							//Input all details into the database to create a new user since all fields have been checked
							$sql = "INSERT INTO userdetails (strUserName, strPass, intUserID, strAccountType)
							VALUES ('$username', '$pass', '$intUserID', '$strAccountType')";
							if ($conn->query($sql) === TRUE) {
								$success = true;
								//If its successfull set this to success text.
								$success_text = "Congratulations! You have successfully created an account";
							} else {
								$error = true;
								//If its unsuccessful set this to error_text
								$error_text = "Error: Creating an account, please contact a teacher or administrator.";
							}
						}
					} else {
						//Error message displayed on account of incorrect validation of passwords
						$error = true;
						$error_text = "Error: Passwords do not match";
					}
				} else {
					//Error message displayed on account of incorrect validation of usernames
					$error = true;
					$error_text = "Error: Please keep your username within 6-16 characters";
				}
			} else {
				//Error message displayed on account of incorrect validation of usernames
				$error = true;
				$error_text = "Error: Please keep your password within 6-16 characters";
			}
		} else {
			//Error message displayed on account of incorrect validation of usernames
			$error = true;
			$error_text = "Error: The username you entered is taken";
		}
	} else {
		//Error message displayed on account of incorrect validation of account type
		$error = true;
		$error_text = "Error: Please Select an Account Type";
	}
	//Create a session holiding the error values to be accessed further down the file
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
				<!--<li><a onMouseOver="this.style.color='#BDC3C7'" onMouseOut="this.style.color='white'" style="color: white" href="admin-edit-user.php">Edit User</a></li>-->
				<li><a onMouseOver="this.style.color='#BDC3C7'" onMouseOut="this.style.color='white'" style="color: white" href="logOutScript.php">Sign Out</a></li>
			</ul>
		</div>
	</nav>
</div>

<div class="generate-code-button">
	<form>
		<input type="submit" name="gencode" class="btn btn-lg btn-default" value="Generate New Code"/>
		<p><?PHP 
			//Query the database for all the data in codegen table
			$sql = "SELECT * FROM codegen";
			$result = $conn->query($sql);
			//If any data is found go through this if statement
			if ($result->num_rows > 0) {
				// output data of each row
				while($row = $result->fetch_assoc()) {
					echo "Code: " . $row["intGenCode"] . "<br>";
				}
			} else {
				//if there is no data found display nothing
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
			//Error code thats displayed
			if($_POST){
				//Check that submit button has been pressed
				if(isset($_POST['submit'])){
					//Find the session variable error and see if its true
					if ($_SESSION['error'] == true){
						echo "*" . $_SESSION['error_text'] . "*";
					}
				}
			}	
			?><p>
			<p class="success"><?PHP
			//Success code that is displayed
			if($_POST){
				//Check that submit button has been pressed
				if(isset($_POST['submit'])){
					//If the process is successful $cuccess will = true and therefore display success_text.
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