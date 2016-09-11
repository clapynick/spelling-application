
<!-- 

	File: create-quiz.php
	Author: Ben Tegoni
	Description:
	The form that is submitted when a teacher wants to create a new quiz.

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
		header("Location: /create-quiz.php");
		exit();
    }
}

//Form Code
function createQuiz($conn){
	//Connect to database inside the function
	include 'mysql-connection.php';
	//Set all variables to equal that of what was enterd in the form, post the data across to php
	//$success = false;
	//$success_text = "";
	$success = false;
	$success_text = "";
	global $success, $success_text;
	
	$intQuizID = rand(10000, 99999);
	$strQuizName = $_POST['strQuizName'];
	$strTeachersName = $_POST['strTeachersName'];
	
	$strQuestion1_r = $_POST['strQuestion1_r'];
	$strQuestion1_w1 = $_POST['strQuestion1_w1'];
	$strQuestion1_w2 = $_POST['strQuestion1_w2'];
	
	$strQuestion2_r = $_POST['strQuestion2_r'];
	$strQuestion2_w1 = $_POST['strQuestion2_w1'];
	$strQuestion2_w2 = $_POST['strQuestion2_w2'];
	
	$strQuestion3_r = $_POST['strQuestion3_r'];
	$strQuestion3_w1 = $_POST['strQuestion3_w1'];
	$strQuestion3_w2 = $_POST['strQuestion3_w2'];
	
	$strQuestion4_r = $_POST['strQuestion4_r'];
	$strQuestion4_w1 = $_POST['strQuestion4_w1'];
	$strQuestion4_w2 = $_POST['strQuestion4_w2'];
	
	$strQuestion5_r = $_POST['strQuestion5_r'];
	$strQuestion5_w1 = $_POST['strQuestion5_w1'];
	$strQuestion5_w2 = $_POST['strQuestion5_w2'];
	
	$strQuestion6_r = $_POST['strQuestion6_r'];
	$strQuestion6_w1 = $_POST['strQuestion6_w1'];
	$strQuestion6_w2 = $_POST['strQuestion6_w2'];
	
	$strQuestion7_r = $_POST['strQuestion7_r'];
	$strQuestion7_w1 = $_POST['strQuestion7_w1'];
	$strQuestion7_w2 = $_POST['strQuestion7_w2'];
	
	$strQuestion8_r = $_POST['strQuestion8_r'];
	$strQuestion8_w1 = $_POST['strQuestion8_w1'];
	$strQuestion8_w2 = $_POST['strQuestion8_w2'];
	
	$strQuestion9_r = $_POST['strQuestion9_r'];
	$strQuestion9_w1 = $_POST['strQuestion9_w1'];
	$strQuestion9_w2 = $_POST['strQuestion9_w2'];
	
	$strQuestion10_r = $_POST['strQuestion10_r'];
	$strQuestion10_w1 = $_POST['strQuestion10_w1'];
	$strQuestion10_w2 = $_POST['strQuestion10_w2'];
	
	$strQuestion11_r = $_POST['strQuestion11_r'];
	$strQuestion11_w1 = $_POST['strQuestion11_w1'];
	$strQuestion11_w2 = $_POST['strQuestion11_w2'];
	
	$strQuestion12_r = $_POST['strQuestion12_r'];
	$strQuestion12_w1 = $_POST['strQuestion12_w1'];
	$strQuestion12_w2 = $_POST['strQuestion12_w2'];
	
	$strQuestion13_r = $_POST['strQuestion13_r'];
	$strQuestion13_w1 = $_POST['strQuestion13_w1'];
	$strQuestion13_w2 = $_POST['strQuestion13_w2'];
	
	$strQuestion14_r = $_POST['strQuestion14_r'];
	$strQuestion14_w1 = $_POST['strQuestion14_w1'];
	$strQuestion14_w2 = $_POST['strQuestion14_w2'];
	
	$strQuestion15_r = $_POST['strQuestion15_r'];
	$strQuestion15_w1 = $_POST['strQuestion15_w1'];
	$strQuestion15_w2 = $_POST['strQuestion15_w2'];
	
	$sql = "INSERT INTO quizdetails (intQuizID, strQuizName, strTeachersName, strQuestion1_r, strQuestion1_w1, strQuestion1_w2, strQuestion2_r, strQuestion2_w1, strQuestion2_w2, strQuestion3_r, strQuestion3_w1, strQuestion3_w2, strQuestion4_r, strQuestion4_w1, strQuestion4_w2, strQuestion5_r, strQuestion5_w1, strQuestion5_w2, strQuestion6_r, strQuestion6_w1, strQuestion6_w2, strQuestion7_r, strQuestion7_w1, strQuestion7_w2, strQuestion8_r, strQuestion8_w1, strQuestion8_w2, strQuestion9_r, strQuestion9_w1, strQuestion9_w2, strQuestion10_r, strQuestion10_w1, strQuestion10_w2, strQuestion11_r, strQuestion11_w1, strQuestion11_w2, strQuestion12_r, strQuestion12_w1, strQuestion12_w2, strQuestion13_r, strQuestion13_w1, strQuestion13_w2, strQuestion14_r, strQuestion14_w1, strQuestion14_w2, strQuestion15_r, strQuestion15_w1, strQuestion15_w2)
	VALUES ('$intQuizID', '$strQuizName', '$strTeachersName', '$strQuestion1_r', '$strQuestion1_w1', '$strQuestion1_w2', '$strQuestion2_r', '$strQuestion2_w1', '$strQuestion2_w2', '$strQuestion3_r', '$strQuestion3_w1', '$strQuestion3_w2', '$strQuestion4_r', '$strQuestion4_w1', '$strQuestion4_w2', '$strQuestion5_r', '$strQuestion5_w1', '$strQuestion5_w2', '$strQuestion6_r', '$strQuestion6_w1', '$strQuestion6_w2', '$strQuestion7_r', '$strQuestion7_w1', '$strQuestion7_w2', '$strQuestion8_r', '$strQuestion8_w1', '$strQuestion8_w2', '$strQuestion9_r', '$strQuestion9_w1', '$strQuestion9_w2', '$strQuestion10_r', '$strQuestion10_w1', '$strQuestion10_w2', '$strQuestion11_r', '$strQuestion11_w1', '$strQuestion11_w2', '$strQuestion12_r', '$strQuestion12_w1', '$strQuestion12_w2', '$strQuestion13_r', '$strQuestion13_w1', '$strQuestion13_w2', '$strQuestion14_r', '$strQuestion14_w1', '$strQuestion14_w2', '$strQuestion15_r', '$strQuestion15_w1', '$strQuestion15_w2')";
	
	if ($conn->query($sql) === TRUE) {
		$success = true;
		$success_text = "New quiz created successfully";
	} else {
		echo "<br />" . "Error: " . $sql . "<br>" . mysqli_error($conn);
	}
}

//Call the create quiz function if the submit button is clicked
if($_POST){
    if(isset($_POST['submit'])){
        createQuiz($conn);
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
	
	
	/* Create Quiz Form */
	p.correct-word {
		color: black;
		font-size: 19px;
		font-weight: bold;
	}
	
	p.variation-word {
		color: black;
		font-size: 19px;
		font-weight: bold;
	}
	
	input.form-input {
		border: 3px solid white;
		border-top-right-radius: 5px;
		border-bottom-right-radius: 5px;
	}
	
	.create-quiz-form h1 {
		font-weight: bold;
	}
	
	p.teacher-stuff {
		color: black;
		font-size: 19px;
		font-weight: bold;
	}
	
	span.easter {
		opacity: 0.0;
	}
	
	/* Form Submit Button */
	.create-quiz-form .submit-button input {
		width: 500px;
		border-radius: 3px;
	}
	
	/* Success Code Formatting */
	p.success {
		border: 0px solid black;
		color: darkgreen;
		font-size: 22px;
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
				<li><a onMouseOver="this.style.color='#BDC3C7'" onMouseOut="this.style.color='white'" style="color: white" href="teacher-login-page.php">Home</a></li>
				<li class="active"><a style="color: white" href="create-quiz.php">Create Quiz</a></li>
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

<div class="create-quiz-form">
	<center>
		<br /><br/>
		<h1>Create a Quiz</h1>
		<br />
		<p class="success"><?PHP
		if($_POST){
			if(isset($_POST['submit'])){
				if ($success == true){
					echo "*" . $success_text . "*";
				}
			}
		}	
		?><p>
		<hr  width="50%"/>
		<form name="create-quiz" method="post" accept-charset="utf-8">
			<!-- break for my eyes 0 -->
			<br /><br />
			<p class="teacher-stuff">Quiz Name: <input pattern="[a-zA-Z\s]+{1,80}" title="No numbers or symbols. 80 characters maximum." class="form-input" type="text" name="strQuizName" value="" required />
			<span class="easter">easter</span>
			Teacher Name: <input pattern="[a-zA-Z\s]+{1,100}" title="No numbers or symbols. 100 characters maximum." class="form-input" type="text" name="strTeachersName" value="" required /></p>
			<br /><br />
			<hr width="50%"/>
		
			<!-- break for my eyes 1 -->
			<br /><br />
			<p class="correct-word">Correct Word - 1: <input pattern="[a-zA-Z]{1,28}" title="No numbers, symbols or spaces. 28 characters maximum." class="form-input" type="text" name="strQuestion1_r" value="" required /></p>
			<br /><br />
			<p class="variation-word">Variation - 1, 1: <input pattern="[a-zA-Z]{1,50}" title="No numbers, symbols or spaces. 50 characters maximum." class="form-input" type="text" name="strQuestion1_w1" value="" required /></p>
			<br /><br />
			<p class="variation-word">Variation - 1, 2: <input pattern="[a-zA-Z]{1,50}" title="No numbers, symbols or spaces. 50 characters maximum." class="form-input" type="text" name="strQuestion1_w2" value="" required /></p>
			<br /><br />
			<hr width="50%"/>
			
			<!-- break for my eyes 2 -->
			<br /><br />
			<p class="correct-word">Correct Word - 2: <input pattern="[a-zA-Z]{1,28}" title="No numbers, symbols or spaces. 28 characters maximum." class="form-input" type="text" name="strQuestion2_r" value="" required /></p>
			<br /><br />
			<p class="variation-word">Variation - 2, 1: <input pattern="[a-zA-Z]{1,50}" title="No numbers, symbols or spaces. 50 characters maximum." class="form-input" type="text" name="strQuestion2_w1" value="" required /></p>
			<br /><br />
			<p class="variation-word">Variation - 2, 2: <input pattern="[a-zA-Z]{1,50}" title="No numbers, symbols or spaces. 50 characters maximum." class="form-input" type="text" name="strQuestion2_w2" value="" required /></p>
			<br /><br />
			<hr width="50%"/>
			
			<!-- break for my eyes 3 -->
			<br /><br />
			<p class="correct-word">Correct Word - 3: <input pattern="[a-zA-Z]{1,28}" title="No numbers, symbols or spaces. 28 characters maximum." class="form-input" type="text" name="strQuestion3_r" value="" required /></p>
			<br /><br />
			<p class="variation-word">Variation - 3, 1: <input pattern="[a-zA-Z]{1,50}" title="No numbers, symbols or spaces. 50 characters maximum." class="form-input" type="text" name="strQuestion3_w1" value="" required /></p>
			<br /><br />
			<p class="variation-word">Variation - 3, 2: <input pattern="[a-zA-Z]{1,50}" title="No numbers, symbols or spaces. 50 characters maximum." class="form-input" type="text" name="strQuestion3_w2" value="" required /></p>
			<br /><br />
			<hr width="50%"/>
			
			<!-- break for my eyes 4 -->
			<br /><br />
			<p class="correct-word">Correct Word - 4: <input pattern="[a-zA-Z]{1,28}" title="No numbers, symbols or spaces. 28 characters maximum." class="form-input" type="text" name="strQuestion4_r" value="" required /></p>
			<br /><br />
			<p class="variation-word">Variation - 4, 1: <input pattern="[a-zA-Z]{1,50}" title="No numbers, symbols or spaces. 50 characters maximum." class="form-input" type="text" name="strQuestion4_w1" value="" required /></p>
			<br /><br />
			<p class="variation-word">Variation - 4, 2: <input pattern="[a-zA-Z]{1,50}" title="No numbers, symbols or spaces. 50 characters maximum." class="form-input" type="text" name="strQuestion4_w2" value="" required /></p>
			<br /><br />
			<hr width="50%"/>
			
			<!-- break for my eyes 5 -->
			<br /><br />
			<p class="correct-word">Correct Word - 5: <input pattern="[a-zA-Z]{1,28}" title="No numbers, symbols or spaces. 28 characters maximum." class="form-input" type="text" name="strQuestion5_r" value="" required /></p>
			<br /><br />
			<p class="variation-word">Variation - 5, 1: <input pattern="[a-zA-Z]{1,50}" title="No numbers, symbols or spaces. 50 characters maximum." class="form-input" type="text" name="strQuestion5_w1" value="" required /></p>
			<br /><br />
			<p class="variation-word">Variation - 5, 2: <input pattern="[a-zA-Z]{1,50}" title="No numbers, symbols or spaces. 50 characters maximum." class="form-input" type="text" name="strQuestion5_w2" value="" required /></p>
			<br /><br />
			<hr width="50%"/>
			
			<!-- break for my eyes 6 -->
			<br /><br />
			<p class="correct-word">Correct Word - 6: <input pattern="[a-zA-Z]{1,28}" title="No numbers, symbols or spaces. 28 characters maximum." class="form-input" type="text" name="strQuestion6_r" value="" required /></p>
			<br /><br />
			<p class="variation-word">Variation - 6, 1: <input pattern="[a-zA-Z]{1,50}" title="No numbers, symbols or spaces. 50 characters maximum." class="form-input" type="text" name="strQuestion6_w1" value="" required /></p>
			<br /><br />
			<p class="variation-word">Variation - 6, 2: <input pattern="[a-zA-Z]{1,50}" title="No numbers, symbols or spaces. 50 characters maximum." class="form-input" type="text" name="strQuestion6_w2" value="" required /></p>
			<br /><br />
			<hr width="50%"/>
			
			<!-- break for my eyes 7 -->
			<br /><br />
			<p class="correct-word">Correct Word - 7: <input pattern="[a-zA-Z]{1,28}" title="No numbers, symbols or spaces. 28 characters maximum." class="form-input" type="text" name="strQuestion7_r" value="" required /></p>
			<br /><br />
			<p class="variation-word">Variation - 7, 1: <input pattern="[a-zA-Z]{1,50}" title="No numbers, symbols or spaces. 50 characters maximum." class="form-input" type="text" name="strQuestion7_w1" value="" required /></p>
			<br /><br />
			<p class="variation-word">Variation - 7, 2: <input pattern="[a-zA-Z]{1,50}" title="No numbers, symbols or spaces. 50 characters maximum." class="form-input" type="text" name="strQuestion7_w2" value="" required /></p>
			<br /><br />
			<hr width="50%"/>
			
			<!-- break for my eyes 8 -->
			<br /><br />
			<p class="correct-word">Correct Word - 8: <input pattern="[a-zA-Z]{1,28}" title="No numbers, symbols or spaces. 28 characters maximum." class="form-input" type="text" name="strQuestion8_r" value="" required /></p>
			<br /><br />
			<p class="variation-word">Variation - 8, 1: <input pattern="[a-zA-Z]{1,50}" title="No numbers, symbols or spaces. 50 characters maximum." class="form-input" type="text" name="strQuestion8_w1" value="" required /></p>
			<br /><br />
			<p class="variation-word">Variation - 8, 2: <input pattern="[a-zA-Z]{1,50}" title="No numbers, symbols or spaces. 50 characters maximum." class="form-input" type="text" name="strQuestion8_w2" value="" required /></p>
			<br /><br />
			<hr width="50%"/>
			
			<!-- break for my eyes 9 -->
			<br /><br />
			<p class="correct-word">Correct Word - 9: <input pattern="[a-zA-Z]{1,28}" title="No numbers, symbols or spaces. 28 characters maximum." class="form-input" type="text" name="strQuestion9_r" value="" required /></p>
			<br /><br />
			<p class="variation-word">Variation - 9, 1: <input pattern="[a-zA-Z]{1,50}" title="No numbers, symbols or spaces. 50 characters maximum." class="form-input" type="text" name="strQuestion9_w1" value="" required /></p>
			<br /><br />
			<p class="variation-word">Variation - 9, 2: <input pattern="[a-zA-Z]{1,50}" title="No numbers, symbols or spaces. 50 characters maximum." class="form-input" type="text" name="strQuestion9_w2" value="" required /></p>
			<br /><br />
			<hr width="50%"/>
			
			<!-- break for my eyes 10 -->
			<br />
			<p class="correct-word">Correct Word - 10: <input pattern="[a-zA-Z]{1,28}" title="No numbers, symbols or spaces. 28 characters maximum." class="form-input" type="text" name="strQuestion10_r" value="" required /></p>
			<br /><br />
			<p class="variation-word">Variation - 10, 1: <input pattern="[a-zA-Z]{1,50}" title="No numbers, symbols or spaces. 50 characters maximum." class="form-input" type="text" name="strQuestion10_w1" value="" required /></p>
			<br /><br />
			<p class="variation-word">Variation - 10, 2: <input pattern="[a-zA-Z]{1,50}" title="No numbers, symbols or spaces. 50 characters maximum." class="form-input" type="text" name="strQuestion10_w2" value="" required /></p>
			<br /><br />
			<hr width="50%"/>
			
			<!-- break for my eyes 11 -->
			<br /><br />
			<p class="correct-word">Correct Word - 11: <input pattern="[a-zA-Z]{1,28}" title="No numbers, symbols or spaces. 28 characters maximum." class="form-input" type="text" name="strQuestion11_r" value="" required /></p>
			<br /><br />
			<p class="variation-word">Variation - 11, 1: <input pattern="[a-zA-Z]{1,50}" title="No numbers, symbols or spaces. 50 characters maximum." class="form-input" type="text" name="strQuestion11_w1" value="" required /></p>
			<br /><br />
			<p class="variation-word">Variation - 11, 2: <input pattern="[a-zA-Z]{1,50}" title="No numbers, symbols or spaces. 50 characters maximum." class="form-input" type="text" name="strQuestion11_w2" value="" required /></p>
			<br /><br />
			<hr width="50%"/>
			
			<!-- break for my eyes 12 -->
			<br /><br />
			<p class="correct-word">Correct Word - 12: <input pattern="[a-zA-Z]{1,28}" title="No numbers, symbols or spaces. 28 characters maximum." class="form-input" type="text" name="strQuestion12_r" value="" required /></p>
			<br /><br />
			<p class="variation-word">Variation - 12, 1: <input pattern="[a-zA-Z]{1,50}" title="No numbers, symbols or spaces. 50 characters maximum." class="form-input" type="text" name="strQuestion12_w1" value="" required /></p>
			<br /><br />
			<p class="variation-word">Variation - 12, 2: <input pattern="[a-zA-Z]{1,50}" title="No numbers, symbols or spaces. 50 characters maximum." class="form-input" type="text" name="strQuestion12_w2" value="" required /></p>
			<br /><br />
			<hr width="50%"/>

			
			<!-- break for my eyes 13 -->
			<br /><br />
			<p class="correct-word">Correct Word - 13: <input pattern="[a-zA-Z]{1,28}" title="No numbers, symbols or spaces. 28 characters maximum." class="form-input" type="text" name="strQuestion13_r" value="" required /></p>
			<br /><br />
			<p class="variation-word">Variation - 13, 1: <input pattern="[a-zA-Z]{1,50}" title="No numbers, symbols or spaces. 50 characters maximum." class="form-input" type="text" name="strQuestion13_w1" value="" required /></p>
			<br /><br />
			<p class="variation-word">Variation - 13, 2: <input pattern="[a-zA-Z]{1,50}" title="No numbers, symbols or spaces. 50 characters maximum." class="form-input" type="text" name="strQuestion13_w2" value="" required /></p>
			<br /><br />
			<hr width="50%"/>
			
			<!-- break for my eyes 14 -->
			<br /><br />
			<p class="correct-word">Correct Word - 14: <input pattern="[a-zA-Z]{1,28}" title="No numbers, symbols or spaces. 28 characters maximum." class="form-input" type="text" name="strQuestion14_r" value="" required /></p>
			<br /><br />
			<p class="variation-word">Variation - 14, 1: <input pattern="[a-zA-Z]{1,50}" title="No numbers, symbols or spaces. 50 characters maximum." class="form-input" type="text" name="strQuestion14_w1" value="" required /></p>
			<br /><br />
			<p class="variation-word">Variation - 14, 2: <input pattern="[a-zA-Z]{1,50}" title="No numbers, symbols or spaces. 50 characters maximum." class="form-input" type="text" name="strQuestion14_w2" value="" required /></p>
			<br /><br />
			<hr width="50%"/>
			
			<!-- break for my eyes 15 -->
			<br /><br />
			<p class="correct-word">Correct Word - 15: <input pattern="[a-zA-Z]{1,28}" title="No numbers, symbols or spaces. 28 characters maximum." class="form-input" type="text" name="strQuestion15_r" value="" required /></p>
			<br /><br />
			<p class="variation-word">Variation - 15, 1: <input pattern="[a-zA-Z]{1,50}" title="No numbers, symbols or spaces. 50 characters maximum." class="form-input" type="text" name="strQuestion15_w1" value="" required /></p>
			<br /><br />
			<p class="variation-word">Variation - 15, 2: <input pattern="[a-zA-Z]{1,50}" title="No numbers, symbols or spaces. 50 characters maximum." class="form-input" type="text" name="strQuestion15_w2" value="" required /></p>
			<br /><br />
			<hr width="50%"/>
			
			<p class="success"><?PHP
			if($_POST){
				if(isset($_POST['submit'])){
					if ($success == true){
						echo "*" . $success_text . "*";
					}
				}
			}	
			?><p>
			
			<div class="submit-button">
				<br />
				<br />
				<input type="submit" name="submit" class="btn btn-lg btn-default" value="Submit Quiz" />
				<br />
			</div>
		</form>
	</center>
</div>

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