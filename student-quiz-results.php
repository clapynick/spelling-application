
<!-- 

	File: teacher-quiz-results.php
	Author: Ben Tegoni
	Description:
	Displays the teachers view of the results that students have submitted.

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

//Find the intUserID
while($row = $result->fetch_assoc()){
	$intUserID = $row['intUserID'];
	global $intUserID;
}

if($strUserName != null){
	while($row = $result->fetch_assoc()){
		if($row["strAccountType"] == 'admin' OR $row["strAccountType"] == 'teacher'){
			//Redirct an admin or teacher to there homepage
			header("Location: /teacher-login-page.php");
			break;
		} else if($row["strAccountType"] == 'student'){
			//Do nothing if a student is on this page.
			break;
		} else {
			//If a user isn't logged in they will be redirected home
			header("Location: /index.php");
		}
	}
} else {
	header("Location: /index.php");
}

if(isset($_GET['intQuizID'])){
	$intQuizID = $_GET['intQuizID'];
	global $intQuizID;
}

$sql = "SELECT * FROM quizdetails WHERE intQuizID=$intQuizID";
$result = $conn->query($sql);

while($row = $result->fetch_assoc()){
	$strQuizName = $row['strQuizName'];
	$strTeachersName = $row['strTeachersName'];
	global $strQuizName, $strTeachersName;
}


?>

<html>
<!-- Header Section of HTML code -->
<head>

<meta charset="utf-8">
<title>Teacher Quiz Results (teacher-quiz-results.php)</title>

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
	
	p.strQuizName {
		font-weight: bold;
		font-size: 50px;
		text-decoration: underline;
	}
	
	p.strTeachersName {
		font-weight: bold;
		font-size: 35px;
		text-decoration: underline;
	}
	
	table.main-table {
		border: 0px solid;
		font-size: 20px;
	}
	
	th, td {
		padding: 8px;
		width: 170px;
	}
	
	tr:nth-child(even){
		background-color: white;
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
				<li class="active"><a href="student-login-page.php">Home</a></li>
				<li><a onMouseOver="this.style.color='#BDC3C7'" onMouseOut="this.style.color='white'" style="color: white" href="logOutScript.php">Sign Out</a></li>
			</ul>
		</div>
	</nav>
</div>

<center>
<?php
include 'mysql-connection.php';

echo "<br/>";
echo "<hr style='width:80%'>";
echo "<p class='strQuizName'>" . "Results For: " . $strQuizName . "</p>" . "<p class='strTeachersName'>" . $strTeachersName . "</p>";
echo "<hr style='width:80%'>";
echo "<br/>";

echo "<table class='main-table'>";
	echo "<tr>";
		echo "<th style='color=black'>" . "Question" . "</th>";
		echo "<th style='color=black'>" . "Your Answer" . "</th>";
		echo "<th style='color=black'>" . "Correct Answer" . "</th>";
	echo "</tr>";

	
$sql = "SELECT * FROM userquizzes WHERE intQuizID='$intQuizID' AND intUserID='$intUserID'";
$result = $conn->query($sql);
while($row = $result->fetch_assoc()){
	for($i = 1; $i < 16; $i++){
		$yourAnswer = $row['strQuestion' . $i];
		echo "<tr>";		
			echo "<td>" . "Question$i" . "</td>";
			echo "<td>" . $yourAnswer . "</td>";

			$sql2 = "SELECT * FROM quizdetails WHERE intQuizID='$intQuizID'";
			$result2 = $conn->query($sql2);
			while($row_2 = $result2->fetch_assoc()){
				$correctAnswer = $row_2['strQuestion' . $i . '_r'];
				echo "<td>" . $correctAnswer . "</td>";
			}
		echo "</tr>";
	}
}


echo "</table>";
echo "<br />";
echo "<br />";
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