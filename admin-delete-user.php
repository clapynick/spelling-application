
<!-- 

	File: admin-delete-user.php
	Author: Ben Tegoni
	Description:
	The page an admin will visit to delete users.

-->

<?php
// All PHP code in here

// Include Statements to easily call files
include 'mysql-connection.php';

//Start Session
session_start();
//Check what accountType the user is
$strUserName = $_SESSION['strUserName'];
//Query the database for the username being equal the past username
$sql = "SELECT * FROM userdetails WHERE strUserName='$strUserName'";
$result = $conn->query($sql);

//if the strUserName exsist 
if($strUserName != null){
	//Get the associated data
	while($row = $result->fetch_assoc()){
		//If the strAccount type equals admin, do nothing.
		if($row["strAccountType"] == 'admin'){
			break;
			//If the strAccount type equals teacher redirect to the teacher landing page
		} else if($row["strAccountType"] == 'teacher'){
			header("Location: /teacher-login-page.php");
			break;
			//If the strAccount type equals student redirect to the student landing page
		} else if($row["strAccountType"] == 'student'){
			header("Location: /student-login-page.php");
			break;
		//If the strAccount type equals nothing than redirect to login page
		} else {
			header("Location: /index.php");
		}
	}
	//If the username equals nothing than redirect to the login page
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
	//Assign a new random number to $numberA between 100000 and 999999
	$numberA = rand(100000, 999999);
	echo("$numberA : Current numberA <br />");
	//Set the current code to $numberB
	$numberB = $row['intGenCode'];
	echo($numberB);
	echo " : Current numberB <br />";

	//If the numbers equal eachother find another number until they dont
	while($numberA == $numberB){
		$numberA = rand(100000, 999999);
		echo("$numberA : New Selected numberA");
	} 
	
	//Then delete the current number if the two numbers dont equal eachother
	if($numberA != $numberB){
		$sql2 = "DELETE FROM codegen WHERE intGenCode";
		if ($conn->query($sql2) === TRUE) {
			echo "<br /> Record deleted successfully <br />";
		} else {
			echo "<br /> Error deleting record <br />";
		}
		
		//Insert where the old number was with the new number
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
		//Call the generateCode function
        generateCode();
		header("Location: /admin-delete-user.php");
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
				<li><a onMouseOver="this.style.color='#BDC3C7'" onMouseOut="this.style.color='white'" style="color: white" href="admin-login-page.php">Home</a></li>
				<li><a onMouseOver="this.style.color='#BDC3C7'" onMouseOut="this.style.color='white'" style="color: white" href="create-quiz.php">Create Quiz</a></li>
				<li><a onMouseOver="this.style.color='#BDC3C7'" onMouseOut="this.style.color='white'" style="color: white" href="admin-create-user.php">Create User</a></li>
				<li class="active"><a onMouseOut="this.style.color='white'" style="color: white" href="admin-delete-user.php">Delete User</a></li>
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
//Query the database for all data in the table userdetails
$sql = "SELECT * FROM userdetails";
$result = $conn->query($sql);

//Display the table using html but echoing that html using php
echo "<br />";
echo "<table class='main-table' style='width:65%'>";
	echo "<tr>";
		echo "<th style='color=black'>" . "User Name" . "</th>";
		echo "<th style='color=black'>" . "UserID" . "</th>";
		echo "<th style='color=black'>" . "Account Type". "</th>";
		echo "<th style='color=black background-color=transparent'>" . "Delete User" ."</th>";
	echo "</tr>";
	
//While the data has not all been displayed continue printing more data in a table with the associated buttons and useranames in different table data.
while($row = $result->fetch_assoc()){
	echo "<tr>";
			echo "<td href='generated-quiz-view.php?intUserID=$row[strUserName]'>" . $row['strUserName'] . "</td>";
			echo "<td>" . $row['intUserID'] . "</td>";
			echo "<td class='quiz-results'>" . $row['strAccountType'] . "</td>";
			//Redirect if button is pressed to delete but carry accross the intUserID via the url
			echo "<td class='delete-user'>" . "<a href='delete-user-function.php?intUserID=$row[intUserID]'><img title='Delete Quiz' width='35px' height='35px' src='images/icons/trash-icon.png' class='delete-img'>" . "</img></a>" . "</td>";
	echo "</tr>";
}
echo "</table>";
?>
</center>

</br>
</br>
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