<!-- 

	File: 
	Author: Ben Tegoni
	Description:
	

-->

<?php
// All PHP code in here

// Include Statements to easily call files
include 'mysql-connection.php';

session_start();
//Check what accountType the user is
$strUserName = $_SESSION['strUserName'];
$sql = "SELECT * FROM userdetails WHERE strUserName='$strUserName'";
$result = $conn->query($sql);

if($strUserName != null){
	while($row = $result->fetch_assoc()){
		if($row["strAccountType"] == 'admin' OR $row["strAccountType"] == 'teacher'){
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

//Function to confirm the deletion of the quiz
function deleteQuizConfirm($conn){
	deleteQuiz($conn);
}

//Function thats called to delete an entire quiz
function deleteQuiz($conn){
	global $intQuizID;
	include 'mysql-connection.php';
	
	$sql = "DELETE FROM quizdetails WHERE intQuizID='$intQuizID'";
	
	if ($conn->query($sql) === TRUE) {
		echo "Record deleted successfully";
		header ('Location: /teacher-login-page.php');
	} else {
		echo "Error deleting record: " . $conn->error;
	}
}

//Check to see if the correct data will be present to perform the action
if(isset($_GET['intQuizID'])){
	$intQuizID = $_GET['intQuizID'];
} else {
	header ('Location: /teacher-login-page.php');
}

//Check to see if the cofirm box has been used
if(isset($_POST['yes'])){
	$intQuizID = $_GET['intQuizID'];
	deleteQuizConfirm($conn);
} else if(isset($_POST['no'])){
	header ('Location: /teacher-login-page.php');
}

?>

<html>
<!-- Header Section of HTML code -->
<head>

<meta charset="utf-8">
<title>Delete Quiz Function (delete-quiz.php)</title>

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

	/* Body Container */
	body {
		background-image: url(images/backgrounds/solid-light-blue-hd-wallpaper.jpg);
		background-repeat: repeat;
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
	footer .bottom-text {
		background-color: rgba(100, 100, 100, 0.5);
		margin-top: 294px;
		height: 93px;
	}
	
	/* Footer Chrome Button */
	footer .bottom-text .chrome-button {
		text-align: center;
	}
	
	/* Confirm Box Area */
	.confirm-delete-box {
		width: 600px;
		height: 250px;
		border-radius: 15px;
		background-color: rgba(255, 255, 255, 0.3);
	}
	
	p.delete-confirm {
		font-size: 22px;
	}
	
	input {
		width: 110px;
		height: 50px;
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

<br>
<br>
<hr style='width:60%'></hr>

<center>
	<div class="confirm-delete-box">
		<br>
		<br>
		<br>
		<br>
		<p class="delete-confirm">Are you sure you would like to delete quiz <?PHP echo " $intQuizID";?>?</p>
		<br>
		<form method="post">
			<input type="submit" value="Yes" name="yes" class="btn btn-success"></input>
			<input type="submit" value="No" name="no" class="btn btn-danger"></input>
		</form>
	</div>
<center>

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