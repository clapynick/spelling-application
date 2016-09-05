
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
}

//Start Session
session_start();

//Check what accountType the user is
$intUserID = $_SESSION['intUserID'];
$strUserName = $_SESSION['strUserName'];
$sql = "SELECT * FROM userdetails WHERE strUserName='$strUserName'";
$result = $conn->query($sql);

if($strUserName != null){
	while($row = $result->fetch_assoc()){
		if($row["strAccountType"] == 'admin' OR $row["strAccountType"] == 'teacher'){
			header("Location: /teacher-login-page.php");
		} else if($row["strAccountType"] == 'student'){
			//Do nothing if Account Type is equal to student.
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
	$strQuestions = $row;
	
	global $strQuizName, $strTeachersName, $strQuestions;
}

//Function that checks the results entered for the quiz.
function checkResults(){
	global $conn;
	//echo "function called correctly";
	
	for($i=1; $i < 16; $i++){
		global $intUserID, $intQuizID, $strQuizName;
		$studentAns = $_POST[$i];
		$sql = "SELECT strQuestion" . $i . "_r FROM quizdetails WHERE intQuizID='$intQuizID'";
		$result = $conn->query($sql);
		
		while($row = $result->fetch_assoc()){
			$sql = "INSERT INTO userquizzes (intUserID, intQuizID, strQuizName)
					VALUES ('$intUserID', '$intQuizID', '$strQuizName')";
			if ($conn->query($sql) === TRUE) {
				echo "";
			} else {
				echo "";
			}
			
			$correctAns = $row['strQuestion' . $i . '_r'];
			if($correctAns == $studentAns){
				$intQuestion = "intQuestion$i";
				$strQuestion = "strQuestion$i";
				$yes = "1";
				$sql = "UPDATE userquizzes SET $intQuestion='$yes', $strQuestion='$studentAns' WHERE intQuizID='$intQuizID'";
				if ($conn->query($sql) === TRUE) {
					echo "";
				} else {
					echo "";
				}
			} else {
				$intQuestion = "intQuestion$i";
				$strQuestion = "strQuestion$i";
				$no = "0";
				$sql = "UPDATE userquizzes SET $intQuestion='$no', $strQuestion='$studentAns' WHERE intQuizID='$intQuizID'";
				if ($conn->query($sql) === TRUE) {
					echo "";
				} else {
					echo "";
				}
			}
		}
		//echo "Student for Q $i: $studentAns AND Correct for Q $i: $correctAns <br />";
	}
}

if($_POST){
    if(isset($_POST['submit'])){
        checkResults();
    }
}

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
	.main-class {
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
	
	.submit-button input {
		width: 500px;
		border-radius: 3px;
	}
	
	input[type=radio] {
		border: 0px;
		width: 22px;
		height: 22px;
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

echo "<form class='1' method='post'>";

for($i = 1; $i < 16; $i++){
	$case = rand(1, 3);
	//Randomise the way radio buttons are displayed for word 1
	if ($case == 1) {
		echo "<h3>Question $i - </h3>";
		echo "<input type='radio' value='" . $strQuestions["strQuestion" . $i . "_r"] . "' name='$i' id='$i.1' required>" . $strQuestions['strQuestion' . $i . '_r'] . "</input><br>";
		echo "<input type='radio' value='" . $strQuestions["strQuestion" . $i . "_w1"] . "' name='$i' id='$i.2' required>" . $strQuestions['strQuestion' . $i . '_w1'] . "</input>" . "<br>";
		echo "<input type='radio' value='" . $strQuestions["strQuestion" . $i . "_w2"] . "' name='$i' id='$i.3' required>" . $strQuestions['strQuestion' . $i . '_w2'] . "</input>" . "<br>";
		echo "<br/>";
		echo "<hr style='width:60%'>";
		echo "<br/>";
	} elseif ($case == 2) {
		echo "<h3>Question $i - </h3>";
		echo "<input type='radio' value='" . $strQuestions["strQuestion" . $i . "_w2"] . "' name='$i' id='$i.1' required>" . $strQuestions['strQuestion' . $i . '_w2'] . "</input>" . "<br>";
		echo "<input type='radio' value='" . $strQuestions["strQuestion" . $i . "_r"] . "' name='$i' id='$i.2' required>" . $strQuestions['strQuestion' . $i . '_r'] . "</input>" . "<br>";
		echo "<input type='radio'  value='" . $strQuestions["strQuestion" . $i . "_w1"] . "' name='$i' id='$i.3' required>" . $strQuestions['strQuestion' . $i . '_w1'] . "</input>" . "<br>";
		echo "<br/>";
		echo "<hr style='width:60%'>";
		echo "<br/>";
	} else {
		echo "<h3>Question $i - </h3>";
		echo "<input type='radio' value='" . $strQuestions["strQuestion" . $i . "_w1"] . "' name='$i' id='$i.1' required>" . $strQuestions['strQuestion' . $i . '_w1'] . "</input>" . "<br>";
		echo "<input type='radio' value='" . $strQuestions["strQuestion" . $i . "_w2"] . "' name='$i' id='$i.2' required>" . $strQuestions['strQuestion' . $i . '_w2'] . "</input>" . "<br>";
		echo "<input type='radio' value='" . $strQuestions["strQuestion" . $i . "_r"] . "' name='$i' id='$i.3' required>" . $strQuestions['strQuestion' . $i . '_r'] . "</input>" . "<br>";
		echo "<br/>";
		echo "<hr style='width:60%'>";
		echo "<br/>";
	}
}

?>

	<div class="submit-button">
		<br />
		<input type="submit" name="submit" class="btn btn-lg btn-default" value="Submit Quiz" />
		<br />
	</div>
</form>
			
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