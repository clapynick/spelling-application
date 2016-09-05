
<!-- 

	File: teacher-login-page.php
	Author: Ben Tegoni
	Description:
	The first page an teacher account is greeted by.

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
			header("Location: /admin-login-page.php");
			break;
		} else if($row["strAccountType"] == 'teacher'){
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

//Check if the generate code button has been pressed
if($_GET){
    if(isset($_GET['gencode'])){
        generateCode();
		header("Location: /teacher-login-page.php");
		exit();
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
		background-repeat: repeat;
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
		margin-top: 287px;
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
	<a href="teacher-login-page.php" title="Home Page"><img src="images/icons/home-icon.png" alt="Home Icon" height="50" width="50"></a>
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
				<li class="active"><a href="teacher-login-page.php">Home</a></li>
				<li><a onMouseOver="this.style.color='#BDC3C7'" onMouseOut="this.style.color='white'" style="color: white" href="create-quiz.php">Create Quiz</a></li>
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
<?PHP
$sql = "SELECT * FROM quizdetails";
$result = $conn->query($sql);

echo "<br />";
echo "<table class='main-table' style='width:65%'>";
	echo "<tr>";
		echo "<th style='color=black'>" . "Quiz Name" . "</th>";
		echo "<th style='color=black'>" . "Teachers Name" . "</th>";
		echo "<th style='color=black'>" . "Quiz Results". "</th>";
		echo "<th style='color=black background-color=transparent'>" . "Delete Quiz" ."</th>";
	echo "</tr>";
	
while($row = $result->fetch_assoc()){
	echo "<tr>";
			echo "<td>" . "<a href='generated-quiz-view.php?intQuizID=$row[intQuizID]'><button class='quiz-button'>" . $row['strQuizName'] . "</button></a>" . "</td>";
			echo "<td>" . $row['strTeachersName'] . "</td>";
			echo "<td class='quiz-results'>" . "<a href='delete-quiz.php?intQuizID=$row[intQuizID]'><img title='Quiz Results' width='35px' height='35px' src='images/icons/results-icon.png' class='delete-img'>" . "</img></a>" . "</td>";
			echo "<td class='delete-quiz'>" . "<a href='delete-quiz.php?intQuizID=$row[intQuizID]'><img title='Delete Quiz' width='35px' height='35px' src='images/icons/trash-icon.png' class='delete-img'>" . "</img></a>" . "</td>";
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