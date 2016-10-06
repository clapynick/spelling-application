<!-- 

	File: completed-quiz.php
	Author: Ben Tegoni
	Description:
	The page when a person completes a quiz.

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
//If the username exsists than continue, if it equals null go into the else statement and redirect to the login page
if($strUserName != null){
	//Fetch the associated data
	while($row = $result->fetch_assoc()){
		//If the account type equals admin or teacher then redirect to teacher landing page.
		if($row["strAccountType"] == 'admin' OR $row["strAccountType"] == 'teacher'){
			header("Location: /teacher-login-page.php");
			break;
		//If the account type equals student do nothing
		} else if($row["strAccountType"] == 'student'){
			break;
		//If no account type exsists than redirect to home page
		} else {
			header("Location: /index.php");
		}
	}
} else {
	header("Location: /index.php");
}

//If the home button is pressed redirect to the student landing page
if(isset($_POST['home'])){
	header("Location: /student-login-page.php");
}

?>

<html>
<!-- Header Section of HTML code -->
<head>

<meta charset="utf-8">
<title>Once Completed Quiz Has Been Successful, redirect here (completed-quiz.php)</title>

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
	
	/* Footer Chrome Button */
	footer .bottom-text .chrome-button {
		text-align: center;
	}
	
	/* Confirm Box Area */
	.confirm-delete-box {
		width: 1000px;
		height: 250px;
		border-radius: 15px;
		background-color: rgba(255, 255, 255, 0.3);
		padding-left: 10%;
		padding-right: 10%;
	}
	
	p.delete-confirm {
		font-size: 19px;
	}
	
	input {
		width: 150px;
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
		<p class="delete-confirm">Congratulations on completing your quiz. Please return home to view your results or complete more quizzes.</p>
		<br>
		<form method="post">
			<input type="submit" value="Return Home" name="home" class="btn btn-success"></input>
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