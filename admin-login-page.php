
<!-- 

	File: admin-login-page.php
	Author: Ben Tegoni
	Description:
	The first page an admin account is greeted by.

-->

<?php
// All PHP code in here

// Include Statements to easily call files
include 'mysql-connection.php';

session_start();

$sql = "SELECT * FROM userdetails WHERE strUserName='$username'";
$result = $conn->query($sql);
$row = $result->fetch_assoc()
$intUserID = $_SESSION["intUserID"];

if ()

//Get intUserID
//Get the strAccountType of the intUserID
//if it equals 'admin' -- do nothing
//else
//redirect to correct page using code from index.php

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

if($_GET){
    if(isset($_GET['gencode'])){
        generateCode();
		//MAKE SURE TO CHANGE THE PAGE IN REGARDS TO THE ACCOUNT YOU ARE USING !!!!!!!!
		header("Location: /admin-login-page.php");
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
		height: 60%;
		width: 100%;
		background-attachment: fixed;
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
	
	
	
</style>

</head>

<!-- Body Section of HTML Code -->
<body>

<center>
	<div class="main-text">
		<h1><span style="color:white">Resources</span><span style="color: white">2</span><span style="color: rgba(82, 82, 255, 1.0);">Go</span></h1>
	</div>
</center>

<div class="main-class">
<br />
<br />
	<nav class="tabs-area navbar navbar-inverse navbar-justified">
		<div class="container-fluid">
			<div class="navbar-header">
				<a class="navbar-brand" href="admin-login-page.php"><span style="color: white">Resources</span><span style="color: white">2</span><span style="color: rgba(82, 82, 255, 1.0);">Go</span></a>
			</div>
			<ul class="nav navbar-nav pull-right">
				<li class="active"><a href="#">Home</a></li>
				<li><a href="#">Create Quiz</a></li>
				<li><a href="#">Create User</a></li>
				<li><a href="#">Delete User</a></li>
				<li><a href="#">Edit User</a></li>
				<li><a href="#">Sign Out</a></li>
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

<br />
<br />
<br />
<br />
<br />
<br />
<br />
<br />
<br />
<br />
<br />
<br />
<br />
<br />
<br />
<br />
<br />
<br />
<br />
<br />
<br />
<br />
<br />
<br />
<br />
<br />
<br />
<br />
<br />
<br />
<br />
<br />
<br />
<br />
<br />

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