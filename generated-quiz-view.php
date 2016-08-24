
<!-- 

	File: generated-quiz-view.php
	Author: Ben Tegoni
	Description:
	The page that once wanting to complete a quiz you will be redirected here to make the form.

-->

<?php
// All PHP code in here

// Include Statements to easily call files
include 'mysql-connection.php';

if(isset($_GET['intQuizID'])){
	$intQuizID = $_GET['intQuizID'];
	echo $intQuizID;
}

//Start Session
session_start();

//Check what accountType the user is
$strUserName = $_SESSION['strUserName'];
$sql = "SELECT * FROM userdetails WHERE strUserName='$strUserName'";
$result = $conn->query($sql);

if($strUserName != null){
	while($row = $result->fetch_assoc()){
		if($row["strAccountType"] == 'admin' OR $row["strAccountType"] == 'teacher' OR $row["strAccountType"] == 'student'){
			break;
		} else {
			header("Location: /index.php");
		}
	}
} else {
	header("Location: /index.php");
}

$sql = "SELECT * FROM quizdetails WHERE intQuizID=$intQuizID";
$result = $conn->query($sql);

while($row = $result->fetch_assoc()){
	$strQuizName = $row['strQuizName'];
	$strTeachersName = $row['strTeachersName'];
	
	$strQuestion1_r = $row['strQuestion1_r'];
	$strQuestion1_w1 = $row['strQuestion1_w1'];
	$strQuestion1_w2 = $row['strQuestion1_w2'];
	
	$strQuestion2_r = $row['strQuestion2_r'];
	$strQuestion2_w1 = $row['strQuestion2_w1'];
	$strQuestion2_w2 = $row['strQuestion2_w2'];
	
	$strQuestion3_r = $row['strQuestion3_r'];
	$strQuestion3_w1 = $row['strQuestion3_w1'];
	$strQuestion3_w2 = $row['strQuestion3_w2'];
	
	$strQuestion4_r = $row['strQuestion4_r'];
	$strQuestion4_w1 = $row['strQuestion4_w1'];
	$strQuestion4_w2 = $row['strQuestion4_w2'];
	
	$strQuestion5_r = $row['strQuestion5_r'];
	$strQuestion5_w1 = $row['strQuestion5_w1'];
	$strQuestion5_w2 = $row['strQuestion5_w2'];
	
	$strQuestion6_r = $row['strQuestion6_r'];
	$strQuestion6_w1 = $row['strQuestion6_w1'];
	$strQuestion6_w2 = $row['strQuestion6_w2'];
	
	$strQuestion7_r = $row['strQuestion7_r'];
	$strQuestion7_w1 = $row['strQuestion7_w1'];
	$strQuestion7_w2 = $row['strQuestion7_w2'];
	
	$strQuestion8_r = $row['strQuestion8_r'];
	$strQuestion8_w1 = $row['strQuestion8_w1'];
	$strQuestion8_w2 = $row['strQuestion8_w2'];
	
	$strQuestion9_r = $row['strQuestion9_r'];
	$strQuestion9_w1 = $row['strQuestion9_w1'];
	$strQuestion9_w2 = $row['strQuestion9_w2'];
	
	$strQuestion10_r = $row['strQuestion10_r'];
	$strQuestion10_w1 = $row['strQuestion10_w1'];
	$strQuestion10_w2 = $row['strQuestion10_w2'];
	
	$strQuestion11_r = $row['strQuestion11_r'];
	$strQuestion11_w1 = $row['strQuestion11_w1'];
	$strQuestion11_w2 = $row['strQuestion11_w2'];
	
	$strQuestion12_r = $row['strQuestion12_r'];
	$strQuestion12_w1 = $row['strQuestion12_w1'];
	$strQuestion12_w2 = $row['strQuestion12_w2'];
	
	$strQuestion13_r = $row['strQuestion13_r'];
	$strQuestion13_w1 = $row['strQuestion13_w1'];
	$strQuestion13_w2 = $row['strQuestion13_w2'];
	
	$strQuestion14_r = $row['strQuestion14_r'];
	$strQuestion14_w1 = $row['strQuestion14_w1'];
	$strQuestion14_w2 = $row['strQuestion14_w2'];
	
	$strQuestion15_r = $row['strQuestion15_r'];
	$strQuestion15_w1 = $row['strQuestion15_w1'];
	$strQuestion15_w2 = $row['strQuestion15_w2'];
	
	global $strQuizName, $strTeachersName, 
	$strQuestion1_r, $strQuestion1_w1, $strQuestion1_w2, 
	$strQuestion2_r, $strQuestion2_w1, $strQuestion2_w2,
	$strQuestion3_r, $strQuestion3_w1, $strQuestion3_w2,
	$strQuestion4_r, $strQuestion4_w1, $strQuestion4_w2,
	$strQuestion5_r, $strQuestion5_w1, $strQuestion5_w2,
	$strQuestion6_r, $strQuestion6_w1, $strQuestion6_w2,
	$strQuestion7_r, $strQuestion7_w1, $strQuestion7_w2,
	$strQuestion8_r, $strQuestion8_w1, $strQuestion8_w2,
	$strQuestion9_r, $strQuestion9_w1, $strQuestion9_w2,
	$strQuestion10_r, $strQuestion10_w1, $strQuestion10_w2,
	$strQuestion11_r, $strQuestion11_w1, $strQuestion11_w2,
	$strQuestion12_r, $strQuestion12_w1, $strQuestion12_w2,
	$strQuestion13_r, $strQuestion13_w1, $strQuestion13_w2,
	$strQuestion14_r, $strQuestion14_w1, $strQuestion14_w2,
	$strQuestion15_r, $strQuestion15_w1, $strQuestion15_w2;
}

//Collect all stuff from ID of quiz and store to variables
//Randomise what order they are displayed with radio buttons
//Make a completed quiz function that checks which one is correct

?>

<html>
<!-- Header Section of HTML code -->
<head>

<meta charset="utf-8">
<title>Generated Quiz View (generated-quiz-view.php)</title>

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
		margin-top: 287px;
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
	
	/* Radio Buttons Styling */
	form {
		font-size: 22px;
	}
	
	h3 {
		font-weight: bold;
		font-size: 30;
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
<?php

echo "<br/>";
echo "<hr style='width:80%'>";
echo "<p class='strQuizName'>" . $strQuizName . "</p>" . "<p class='strTeachersName'>" . $strTeachersName . "</p>";
echo "<hr style='width:80%'>";
echo "<br/>";

$case = rand(1, 3);
//Randomise the way radio buttons are displayed for word 1
if ($case == 1) {
	echo "<h3>Question 1 - </h3>";
	echo "<form class='1' method='post'>";
	echo "<input type='radio' name='1' id='1'>$strQuestion1_r</input>" . "<br>";
	echo "<input type='radio' name='1' id='2'>$strQuestion1_w1</input>" . "<br>";
	echo "<input type='radio' name='1' id='3'>$strQuestion1_w2</input>" . "<br>";
	echo "</form>";
	echo "<br/>";
	echo "<hr style='width:60%'>";
	echo "<br/>";
} elseif ($case == 2) {
	echo "<h3>Question 1 - </h3>";
	echo "<form class='1' method='post'>";
	echo "<input type='radio' name='1' id='1'>$strQuestion1_w2</input>" . "<br>";
	echo "<input type='radio' name='1' id='2'>$strQuestion1_r</input>" . "<br>";
	echo "<input type='radio' name='1' id='3'>$strQuestion1_w1</input>" . "<br>";
	echo "</form>";
	echo "<br/>";
	echo "<hr style='width:60%'>";
	echo "<br/>";
} else {
	echo "<h3>Question 1 - </h3>";
	echo "<form class='1' method='post'>";
	echo "<input type='radio' name='1' id='1'>$strQuestion1_w1</input>" . "<br>";
	echo "<input type='radio' name='1' id='2'>$strQuestion1_w2</input>" . "<br>";
	echo "<input type='radio' name='1' id='3'>$strQuestion1_r</input>" . "<br>";
	echo "</form>";
	echo "<br/>";
	echo "<hr style='width:60%'>";
	echo "<br/>";
}

$case = rand(1, 3);
//Randomise the way radio buttons are displayed for word 2
if ($case == 1) {
	echo "<h3>Question 2 - </h3>";
	echo "<form class='2' method='post'>";
	echo "<input type='radio' name='1' id='1'>$strQuestion2_r</input>" . "<br>";
	echo "<input type='radio' name='1' id='2'>$strQuestion2_w1</input>" . "<br>";
	echo "<input type='radio' name='1' id='3'>$strQuestion2_w2</input>" . "<br>";
	echo "</form>";
	echo "<br/>";
	echo "<hr style='width:60%'>";
	echo "<br/>";
} elseif ($case == 2) {
	echo "<h3>Question 2 - </h3>";
	echo "<form class='2' method='post'>";
	echo "<input type='radio' name='1' id='1'>$strQuestion2_w2</input>" . "<br>";
	echo "<input type='radio' name='1' id='2'>$strQuestion2_r</input>" . "<br>";
	echo "<input type='radio' name='1' id='3'>$strQuestion2_w1</input>" . "<br>";
	echo "</form>";
	echo "<br/>";
	echo "<hr style='width:60%'>";
	echo "<br/>";
} else {
	echo "<h3>Question 2 - </h3>";
	echo "<form class='2' method='post'>";
	echo "<input type='radio' name='1' id='1'>$strQuestion2_w1</input>" . "<br>";
	echo "<input type='radio' name='1' id='2'>$strQuestion2_w2</input>" . "<br>";
	echo "<input type='radio' name='1' id='3'>$strQuestion2_r</input>" . "<br>";
	echo "</form>";
	echo "<br/>";
	echo "<hr style='width:60%'>";
	echo "<br/>";
}

$case = rand(1, 3);
//Randomise the way radio buttons are displayed for word 3
if ($case == 1) {
	echo "<h3>Question 3 - </h3>";
	echo "<form class='3' method='post'>";
	echo "<input type='radio' name='1' id='1'>$strQuestion3_r</input>" . "<br>";
	echo "<input type='radio' name='1' id='2'>$strQuestion3_w1</input>" . "<br>";
	echo "<input type='radio' name='1' id='3'>$strQuestion3_w2</input>" . "<br>";
	echo "</form>";
	echo "<br/>";
	echo "<hr style='width:60%'>";
	echo "<br/>";
} elseif ($case == 2) {
	echo "<h3>Question 3 - </h3>";
	echo "<form class='3' method='post'>";
	echo "<input type='radio' name='1' id='1'>$strQuestion3_w2</input>" . "<br>";
	echo "<input type='radio' name='1' id='2'>$strQuestion3_r</input>" . "<br>";
	echo "<input type='radio' name='1' id='3'>$strQuestion3_w1</input>" . "<br>";
	echo "</form>";
	echo "<br/>";
	echo "<hr style='width:60%'>";
	echo "<br/>";
} else {
	echo "<h3>Question 3 - </h3>";
	echo "<form class='3' method='post'>";
	echo "<input type='radio' name='1' id='1'>$strQuestion3_w1</input>" . "<br>";
	echo "<input type='radio' name='1' id='2'>$strQuestion3_w2</input>" . "<br>";
	echo "<input type='radio' name='1' id='3'>$strQuestion3_r</input>" . "<br>";
	echo "</form>";
	echo "<br/>";
	echo "<hr style='width:60%'>";
	echo "<br/>";
}

$case = rand(1, 3);
//Randomise the way radio buttons are displayed for word 4
if ($case == 1) {
	echo "<h3>Question 4 - </h3>";
	echo "<form class='4' method='post'>";
	echo "<input type='radio' name='1' id='1'>$strQuestion4_r</input>" . "<br>";
	echo "<input type='radio' name='1' id='2'>$strQuestion4_w1</input>" . "<br>";
	echo "<input type='radio' name='1' id='3'>$strQuestion4_w2</input>" . "<br>";
	echo "</form>";
	echo "<br/>";
	echo "<hr style='width:60%'>";
	echo "<br/>";
} elseif ($case == 2) {
	echo "<h3>Question 4 - </h3>";
	echo "<form class='4' method='post'>";
	echo "<input type='radio' name='1' id='1'>$strQuestion4_w2</input>" . "<br>";
	echo "<input type='radio' name='1' id='2'>$strQuestion4_r</input>" . "<br>";
	echo "<input type='radio' name='1' id='3'>$strQuestion4_w1</input>" . "<br>";
	echo "</form>";
	echo "<br/>";
	echo "<hr style='width:60%'>";
	echo "<br/>";
} else {
	echo "<h3>Question 4 - </h3>";
	echo "<form class='4' method='post'>";
	echo "<input type='radio' name='1' id='1'>$strQuestion4_w1</input>" . "<br>";
	echo "<input type='radio' name='1' id='2'>$strQuestion4_w2</input>" . "<br>";
	echo "<input type='radio' name='1' id='3'>$strQuestion4_r</input>" . "<br>";
	echo "</form>";
	echo "<br/>";
	echo "<hr style='width:60%'>";
	echo "<br/>";
}

$case = rand(1, 3);
//Randomise the way radio buttons are displayed for word 5
if ($case == 1) {
	echo "<h3>Question 5 - </h3>";
	echo "<form class='5' method='post'>";
	echo "<input type='radio' name='1' id='1'>$strQuestion5_r</input>" . "<br>";
	echo "<input type='radio' name='1' id='2'>$strQuestion5_w1</input>" . "<br>";
	echo "<input type='radio' name='1' id='3'>$strQuestion5_w2</input>" . "<br>";
	echo "</form>";
	echo "<br/>";
	echo "<hr style='width:60%'>";
	echo "<br/>";
} elseif ($case == 2) {
	echo "<h3>Question 5 - </h3>";
	echo "<form class='5' method='post'>";
	echo "<input type='radio' name='1' id='1'>$strQuestion5_w2</input>" . "<br>";
	echo "<input type='radio' name='1' id='2'>$strQuestion5_r</input>" . "<br>";
	echo "<input type='radio' name='1' id='3'>$strQuestion5_w1</input>" . "<br>";
	echo "</form>";
	echo "<br/>";
	echo "<hr style='width:60%'>";
	echo "<br/>";
} else {
	echo "<h3>Question 5 - </h3>";
	echo "<form class='5' method='post'>";
	echo "<input type='radio' name='1' id='1'>$strQuestion5_w1</input>" . "<br>";
	echo "<input type='radio' name='1' id='2'>$strQuestion5_w2</input>" . "<br>";
	echo "<input type='radio' name='1' id='3'>$strQuestion5_r</input>" . "<br>";
	echo "</form>";
	echo "<br/>";
	echo "<hr style='width:60%'>";
	echo "<br/>";
}

$case = rand(1, 3);
//Randomise the way radio buttons are displayed for word 6
if ($case == 1) {
	echo "<h3>Question 6 - </h3>";
	echo "<form class='6' method='post'>";
	echo "<input type='radio' name='1' id='1'>$strQuestion6_r</input>" . "<br>";
	echo "<input type='radio' name='1' id='2'>$strQuestion6_w1</input>" . "<br>";
	echo "<input type='radio' name='1' id='3'>$strQuestion6_w2</input>" . "<br>";
	echo "</form>";
	echo "<br/>";
	echo "<hr style='width:60%'>";
	echo "<br/>";
} elseif ($case == 2) {
	echo "<h3>Question 6 - </h3>";
	echo "<form class='6' method='post'>";
	echo "<input type='radio' name='1' id='1'>$strQuestion6_w2</input>" . "<br>";
	echo "<input type='radio' name='1' id='2'>$strQuestion6_r</input>" . "<br>";
	echo "<input type='radio' name='1' id='3'>$strQuestion6_w1</input>" . "<br>";
	echo "</form>";
	echo "<br/>";
	echo "<hr style='width:60%'>";
	echo "<br/>";
} else {
	echo "<h3>Question 6 - </h3>";
	echo "<form class='6' method='post'>";
	echo "<input type='radio' name='1' id='1'>$strQuestion6_w1</input>" . "<br>";
	echo "<input type='radio' name='1' id='2'>$strQuestion6_w2</input>" . "<br>";
	echo "<input type='radio' name='1' id='3'>$strQuestion6_r</input>" . "<br>";
	echo "</form>";
	echo "<br/>";
	echo "<hr style='width:60%'>";
	echo "<br/>";
}

$case = rand(1, 3);
//Randomise the way radio buttons are displayed for word 7
if ($case == 1) {
	echo "<h3>Question 7 - </h3>";
	echo "<form class='7' method='post'>";
	echo "<input type='radio' name='1' id='1'>$strQuestion7_r</input>" . "<br>";
	echo "<input type='radio' name='1' id='2'>$strQuestion7_w1</input>" . "<br>";
	echo "<input type='radio' name='1' id='3'>$strQuestion7_w2</input>" . "<br>";
	echo "</form>";
	echo "<br/>";
	echo "<hr style='width:60%'>";
	echo "<br/>";
} elseif ($case == 2) {
	echo "<h3>Question 7 - </h3>";
	echo "<form class='7' method='post'>";
	echo "<input type='radio' name='1' id='1'>$strQuestion7_w2</input>" . "<br>";
	echo "<input type='radio' name='1' id='2'>$strQuestion7_r</input>" . "<br>";
	echo "<input type='radio' name='1' id='3'>$strQuestion7_w1</input>" . "<br>";
	echo "</form>";
	echo "<br/>";
	echo "<hr style='width:60%'>";
	echo "<br/>";
} else {
	echo "<h3>Question 7 - </h3>";
	echo "<form class='7' method='post'>";
	echo "<input type='radio' name='1' id='1'>$strQuestion7_w1</input>" . "<br>";
	echo "<input type='radio' name='1' id='2'>$strQuestion7_w2</input>" . "<br>";
	echo "<input type='radio' name='1' id='3'>$strQuestion7_r</input>" . "<br>";
	echo "</form>";
	echo "<br/>";
	echo "<hr style='width:60%'>";
	echo "<br/>";
}

$case = rand(1, 3);
//Randomise the way radio buttons are displayed for word 8
if ($case == 1) {
	echo "<h3>Question 8 - </h3>";
	echo "<form class='8' method='post'>";
	echo "<input type='radio' name='1' id='1'>$strQuestion8_r</input>" . "<br>";
	echo "<input type='radio' name='1' id='2'>$strQuestion8_w1</input>" . "<br>";
	echo "<input type='radio' name='1' id='3'>$strQuestion8_w2</input>" . "<br>";
	echo "</form>";
	echo "<br/>";
	echo "<hr style='width:60%'>";
	echo "<br/>";
} elseif ($case == 2) {
	echo "<h3>Question 8 - </h3>";
	echo "<form class='8' method='post'>";
	echo "<input type='radio' name='1' id='1'>$strQuestion8_w2</input>" . "<br>";
	echo "<input type='radio' name='1' id='2'>$strQuestion8_r</input>" . "<br>";
	echo "<input type='radio' name='1' id='3'>$strQuestion8_w1</input>" . "<br>";
	echo "</form>";
	echo "<br/>";
	echo "<hr style='width:60%'>";
	echo "<br/>";
} else {
	echo "<h3>Question 8 - </h3>";
	echo "<form class='8' method='post'>";
	echo "<input type='radio' name='1' id='1'>$strQuestion8_w1</input>" . "<br>";
	echo "<input type='radio' name='1' id='2'>$strQuestion8_w2</input>" . "<br>";
	echo "<input type='radio' name='1' id='3'>$strQuestion8_r</input>" . "<br>";
	echo "</form>";
	echo "<br/>";
	echo "<hr style='width:60%'>";
	echo "<br/>";
}

$case = rand(1, 3);
//Randomise the way radio buttons are displayed for word 9
if ($case == 1) {
	echo "<h3>Question 9 - </h3>";
	echo "<form class='9' method='post'>";
	echo "<input type='radio' name='1' id='1'>$strQuestion9_r</input>" . "<br>";
	echo "<input type='radio' name='1' id='2'>$strQuestion9_w1</input>" . "<br>";
	echo "<input type='radio' name='1' id='3'>$strQuestion9_w2</input>" . "<br>";
	echo "</form>";
	echo "<br/>";
	echo "<hr style='width:60%'>";
	echo "<br/>";
} elseif ($case == 2) {
	echo "<h3>Question 9 - </h3>";
	echo "<form class='9' method='post'>";
	echo "<input type='radio' name='1' id='1'>$strQuestion9_w2</input>" . "<br>";
	echo "<input type='radio' name='1' id='2'>$strQuestion9_r</input>" . "<br>";
	echo "<input type='radio' name='1' id='3'>$strQuestion9_w1</input>" . "<br>";
	echo "</form>";
	echo "<br/>";
	echo "<hr style='width:60%'>";
	echo "<br/>";
} else {
	echo "<h3>Question 9 - </h3>";
	echo "<form class='9' method='post'>";
	echo "<input type='radio' name='1' id='1'>$strQuestion9_w1</input>" . "<br>";
	echo "<input type='radio' name='1' id='2'>$strQuestion9_w2</input>" . "<br>";
	echo "<input type='radio' name='1' id='3'>$strQuestion9_r</input>" . "<br>";
	echo "</form>";
	echo "<br/>";
	echo "<hr style='width:60%'>";
	echo "<br/>";
}

$case = rand(1, 3);
//Randomise the way radio buttons are displayed for word 10
if ($case == 1) {
	echo "<h3>Question 10 - </h3>";
	echo "<form class='10' method='post'>";
	echo "<input type='radio' name='1' id='1'>$strQuestion10_r</input>" . "<br>";
	echo "<input type='radio' name='1' id='2'>$strQuestion10_w1</input>" . "<br>";
	echo "<input type='radio' name='1' id='3'>$strQuestion10_w2</input>" . "<br>";
	echo "</form>";
	echo "<br/>";
	echo "<hr style='width:60%'>";
	echo "<br/>";
} elseif ($case == 2) {
	echo "<h3>Question 10 - </h3>";
	echo "<form class='10' method='post'>";
	echo "<input type='radio' name='1' id='1'>$strQuestion10_w2</input>" . "<br>";
	echo "<input type='radio' name='1' id='2'>$strQuestion10_r</input>" . "<br>";
	echo "<input type='radio' name='1' id='3'>$strQuestion10_w1</input>" . "<br>";
	echo "</form>";
	echo "<br/>";
	echo "<hr style='width:60%'>";
	echo "<br/>";
} else {
	echo "<h3>Question 10 - </h3>";
	echo "<form class='10' method='post'>";
	echo "<input type='radio' name='1' id='1'>$strQuestion10_w1</input>" . "<br>";
	echo "<input type='radio' name='1' id='2'>$strQuestion10_w2</input>" . "<br>";
	echo "<input type='radio' name='1' id='3'>$strQuestion10_r</input>" . "<br>";
	echo "</form>";
	echo "<br/>";
	echo "<hr style='width:60%'>";
	echo "<br/>";
}

$case = rand(1, 3);
//Randomise the way radio buttons are displayed for word 11
if ($case == 1) {
	echo "<h3>Question 11 - </h3>";
	echo "<form class='11' method='post'>";
	echo "<input type='radio' name='1' id='1'>$strQuestion11_r</input>" . "<br>";
	echo "<input type='radio' name='1' id='2'>$strQuestion11_w1</input>" . "<br>";
	echo "<input type='radio' name='1' id='3'>$strQuestion11_w2</input>" . "<br>";
	echo "</form>";
	echo "<br/>";
	echo "<hr style='width:60%'>";
	echo "<br/>";
} elseif ($case == 2) {
	echo "<h3>Question 11 - </h3>";
	echo "<form class='11' method='post'>";
	echo "<input type='radio' name='1' id='1'>$strQuestion11_w2</input>" . "<br>";
	echo "<input type='radio' name='1' id='2'>$strQuestion11_r</input>" . "<br>";
	echo "<input type='radio' name='1' id='3'>$strQuestion11_w1</input>" . "<br>";
	echo "</form>";
	echo "<br/>";
	echo "<hr style='width:60%'>";
	echo "<br/>";
} else {
	echo "<h3>Question 11 - </h3>";
	echo "<form class='11' method='post'>";
	echo "<input type='radio' name='1' id='1'>$strQuestion11_w1</input>" . "<br>";
	echo "<input type='radio' name='1' id='2'>$strQuestion11_w2</input>" . "<br>";
	echo "<input type='radio' name='1' id='3'>$strQuestion11_r</input>" . "<br>";
	echo "</form>";
	echo "<br/>";
	echo "<hr style='width:60%'>";
	echo "<br/>";
}

$case = rand(1, 3);
//Randomise the way radio buttons are displayed for word 12
if ($case == 1) {
	echo "<h3>Question 12 - </h3>";
	echo "<form class='12' method='post'>";
	echo "<input type='radio' name='1' id='1'>$strQuestion12_r</input>" . "<br>";
	echo "<input type='radio' name='1' id='2'>$strQuestion12_w1</input>" . "<br>";
	echo "<input type='radio' name='1' id='3'>$strQuestion12_w2</input>" . "<br>";
	echo "</form>";
	echo "<br/>";
	echo "<hr style='width:60%'>";
	echo "<br/>";
} elseif ($case == 2) {
	echo "<h3>Question 12 - </h3>";
	echo "<form class='12' method='post'>";
	echo "<input type='radio' name='1' id='1'>$strQuestion12_w2</input>" . "<br>";
	echo "<input type='radio' name='1' id='2'>$strQuestion12_r</input>" . "<br>";
	echo "<input type='radio' name='1' id='3'>$strQuestion12_w1</input>" . "<br>";
	echo "</form>";
	echo "<br/>";
	echo "<hr style='width:60%'>";
	echo "<br/>";
} else {
	echo "<h3>Question 12 - </h3>";
	echo "<form class='12' method='post'>";
	echo "<input type='radio' name='1' id='1'>$strQuestion12_w1</input>" . "<br>";
	echo "<input type='radio' name='1' id='2'>$strQuestion12_w2</input>" . "<br>";
	echo "<input type='radio' name='1' id='3'>$strQuestion12_r</input>" . "<br>";
	echo "</form>";
	echo "<br/>";
	echo "<hr style='width:60%'>";
	echo "<br/>";
}

$case = rand(1, 3);
//Randomise the way radio buttons are displayed for word 13
if ($case == 1) {
	echo "<h3>Question 13 - </h3>";
	echo "<form class='13' method='post'>";
	echo "<input type='radio' name='1' id='1'>$strQuestion13_r</input>" . "<br>";
	echo "<input type='radio' name='1' id='2'>$strQuestion13_w1</input>" . "<br>";
	echo "<input type='radio' name='1' id='3'>$strQuestion13_w2</input>" . "<br>";
	echo "</form>";
	echo "<br/>";
	echo "<hr style='width:60%'>";
	echo "<br/>";
} elseif ($case == 2) {
	echo "<h3>Question 13 - </h3>";
	echo "<form class='13' method='post'>";
	echo "<input type='radio' name='1' id='1'>$strQuestion13_w2</input>" . "<br>";
	echo "<input type='radio' name='1' id='2'>$strQuestion13_r</input>" . "<br>";
	echo "<input type='radio' name='1' id='3'>$strQuestion13_w1</input>" . "<br>";
	echo "</form>";
	echo "<br/>";
	echo "<hr style='width:60%'>";
	echo "<br/>";
} else {
	echo "<h3>Question 13 - </h3>";
	echo "<form class='13' method='post'>";
	echo "<input type='radio' name='1' id='1'>$strQuestion13_w1</input>" . "<br>";
	echo "<input type='radio' name='1' id='2'>$strQuestion13_w2</input>" . "<br>";
	echo "<input type='radio' name='1' id='3'>$strQuestion13_r</input>" . "<br>";
	echo "</form>";
	echo "<br/>";
	echo "<hr style='width:60%'>";
	echo "<br/>";
}

$case = rand(1, 3);
//Randomise the way radio buttons are displayed for word 14
if ($case == 1) {
	echo "<h3>Question 14 - </h3>";
	echo "<form class='14' method='post'>";
	echo "<input type='radio' name='1' id='1'>$strQuestion14_r</input>" . "<br>";
	echo "<input type='radio' name='1' id='2'>$strQuestion14_w1</input>" . "<br>";
	echo "<input type='radio' name='1' id='3'>$strQuestion14_w2</input>" . "<br>";
	echo "</form>";
	echo "<br/>";
	echo "<hr style='width:60%'>";
	echo "<br/>";
} elseif ($case == 2) {
	echo "<h3>Question 14 - </h3>";
	echo "<form class='14' method='post'>";
	echo "<input type='radio' name='1' id='1'>$strQuestion14_w2</input>" . "<br>";
	echo "<input type='radio' name='1' id='2'>$strQuestion14_r</input>" . "<br>";
	echo "<input type='radio' name='1' id='3'>$strQuestion14_w1</input>" . "<br>";
	echo "</form>";
	echo "<br/>";
	echo "<hr style='width:60%'>";
	echo "<br/>";
} else {
	echo "<h3>Question 14 - </h3>";
	echo "<form class='14' method='post'>";
	echo "<input type='radio' name='1' id='1'>$strQuestion14_w1</input>" . "<br>";
	echo "<input type='radio' name='1' id='2'>$strQuestion14_w2</input>" . "<br>";
	echo "<input type='radio' name='1' id='3'>$strQuestion14_r</input>" . "<br>";
	echo "</form>";
	echo "<br/>";
	echo "<hr style='width:60%'>";
	echo "<br/>";
}

$case = rand(1, 3);
//Randomise the way radio buttons are displayed for word 15
if ($case == 1) {
	echo "<h3>Question 15 - </h3>";
	echo "<form class='15' method='post'>";
	echo "<input type='radio' name='1' id='1'>$strQuestion15_r</input>" . "<br>";
	echo "<input type='radio' name='1' id='2'>$strQuestion15_w1</input>" . "<br>";
	echo "<input type='radio' name='1' id='3'>$strQuestion15_w2</input>" . "<br>";
	echo "</form>";
	echo "<br/>";
	echo "<hr style='width:60%'>";
	echo "<br/>";
} elseif ($case == 2) {
	echo "<h3>Question 15 - </h3>";
	echo "<form class='15' method='post'>";
	echo "<input type='radio' name='1' id='1'>$strQuestion15_w2</input>" . "<br>";
	echo "<input type='radio' name='1' id='2'>$strQuestion15_r</input>" . "<br>";
	echo "<input type='radio' name='1' id='3'>$strQuestion15_w1</input>" . "<br>";
	echo "</form>";
	echo "<br/>";
	echo "<hr style='width:60%'>";
	echo "<br/>";
} else {
	echo "<h3>Question 15 - </h3>";
	echo "<form class='15' method='post'>";
	echo "<input type='radio' name='1' id='1'>$strQuestion15_w1</input>" . "<br>";
	echo "<input type='radio' name='1' id='2'>$strQuestion15_w2</input>" . "<br>";
	echo "<input type='radio' name='1' id='3'>$strQuestion15_r</input>" . "<br>";
	echo "</form>";
	echo "<br/>";
	echo "<hr style='width:60%'>";
	echo "<br/>";
}

?>
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