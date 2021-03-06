
<!-- 

	File: student-login-page.php
	Author: Ben Tegoni
	Description:
	The first page a student account is greeted by.

-->

<?php
// All PHP code in here

// Include Statements to easily call files
include 'mysql-connection.php';

//Start Session
session_start();

//Getting Variables associated with a session
$intUserID = $_SESSION['intUserID'];
global $intUserID;

//Check what accountType the user is
$strUserName = $_SESSION['strUserName'];
$sql = "SELECT * FROM userdetails WHERE strUserName='$strUserName'";
$result = $conn->query($sql);
//If the username exsists than continue, if it equals null go into the else statement and redirect to the login page
if($strUserName != null){
	//Fetch the associated data
	while($row = $result->fetch_assoc()){
		//
		if($row["strAccountType"] == 'admin'){
			header("Location: /admin-login-page.php");
		} else if($row["strAccountType"] == 'teacher'){
			header("Location: /teacher-login-page.php");
			break;
		} else if($row["strAccountType"] == 'student'){
			break;
		} else {
			header("Location: /index.php");
		}
	}
} else {
	header("Location: /index.php");
}

?>

<html>
<!-- Header Section of HTML code -->
<head>

<meta charset="utf-8">
<title>Student Login Page (student-login-page.php)</title>

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
	
	/* Home Button Customisation */
	.home-button img {
		border: 0px solid red;
		margin-left: 1435px;
		margin-top: -42px;
	}
	
	.home-button img:hover {
		opacity: 0.7;
	}
	
	/* Main Tabs Config */
	.main-tabs ul {
	}
	
	.tabs-area {
		background-color: rgba(96, 96, 96, 	1.00);
		border-radius: 0px;
	}
	
	/* Main Table For Quizzes */
	table {
		padding: 10%;
		text-align: center;
		width: 100%;
		height 100%;
		padding: 20px;
		background-color: lightgrey;
		padding-cell: 22px;
		font-weight: bold;
	}
	
	th, td, table {
		border: 2px solid white;
		width: 100%;
	}
	
	th, td {
		padding: 15px;
	}
	
	th {
		background-color: #00CCFF;
		text-align: center;
		color: white;
		font-size: 25px;
	}
	
	td {
		font-size: 20px;
	}
	
	button.quiz-button, button.quiz-button:visited {
		/*background-color: transparent;*/
		/*border: 1px solid grey;*/
		/*background-color: white;*/
		/*text-decoration: underline;*/
		height: 60px;
		width: 100%;
		margin: 0%;
		color: black;
		border: 2px solid black;
		border-radius: 15px;
	}
	
	button.quiz-button:hover {
		color: white;
		background-color: lightblue;
		border: 2px dotted white;
	}
	
	a.quiz-result-button:hover {
		color: grey;
	}
	
	a.quiz-result-button {
		color: black;
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
	<a href="student-login-page.php" title="Home Page"><img src="images/icons/home-icon.png" alt="Home Icon" height="50" width="50"></a>
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
				<li class="active"><a href="student-login-page.php">Home</a></li>
				<li><a onMouseOver="this.style.color='#BDC3C7'" onMouseOut="this.style.color='white'" style="color: white" href="logOutScript.php">Sign Out</a></li>
			</ul>
		</div>
	</nav>
</div>

<center>
<?PHP
$sql = "SELECT * FROM quizdetails";
$result = $conn->query($sql);

echo "<br />";
echo "<table class='main-table' style='width:65%'>";
	echo "<tr>";
		echo "<th style='color=black'>" . "Quiz Name" . "</th>";
		echo "<th style='color=black'>" . "Teachers Name" . "</th>";
		echo "<th style='color=black'>" . "Completed". "</th>";
		echo "<th style='color=black background-color=transparent'>" . "Quiz Results" ."</th>";
	echo "</tr>";
	
while($row = $result->fetch_assoc()){
	echo "<tr>";
		echo "<td>" . "<a href='generated-quiz-view.php?intQuizID=$row[intQuizID]'><button class='quiz-button'>" . $row['strQuizName'] . "</button></a>" . "</td>";
		echo "<td>" . $row['strTeachersName'] . "</td>";
		echo "<td class='yes-or-no'>" . "<a href='delete-quiz.php?intQuizID=$row[intQuizID]'>";
		
		//This is the code that shows either a completed or non completed quiz image
		$intQuizID = $row['intQuizID'];
		$sql2 = "SELECT * FROM userquizzes WHERE intQuizID='$intQuizID' AND intUserID='$intUserID'";
		$result2 = $conn->query($sql2);
		$num_rows = mysqli_num_rows($result2);
		if($num_rows > 0){
			echo "<img title='Completed' width='35px' height='35px' src='images/icons/tick-icon.png' class='delete-img'>" . "</img></a>" . "</td>";
		} else if($num_rows < 1){
			echo "<img title='Not Completed' width='39px' height='39px' src='images/icons/delete-icon.png' class='cross-img'>" . "</img></a>" . "</td>";
		} else {
			echo "broken script";
		}
		
		//This will do the scores on the side out of 15 for completed quizzes
		$sql2 = "SELECT * FROM userquizzes WHERE intQuizID='$intQuizID' AND intUserID='$intUserID'";
		$result2 = $conn->query($sql2);
		while($row2 = $result2->fetch_assoc()){
			$j = 0;
			for($i = 1; $i < 16; $i++){
				if($row2['intQuestion' . $i] == "1"){
					$j++;
				}
			}
			echo "<td><a class='quiz-result-button' href='student-quiz-results.php?intQuizID=$row[intQuizID]'>" . $j . "/15" . "</a></td>";
		}
		
		if($num_rows <= 0){
			echo "<td>" . "N/A" . "</td>";
		}
	echo "</tr>";
}
echo "</table>";
?>
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