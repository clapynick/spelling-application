
<!-- 

	File: for-chrome.php
	Author: Ben Tegoni
	Description:
	The page in which a user goes to find help about the website.
	This is a suggestions for chrome.

-->

<?php
// All PHP code in here

// Include Statements to easily call files
include 'mysql-connection.php';
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
	
	/* Main Chrome Button */
	.main-content .chrome-icon img {
		padding-top: 0px;
		padding-bottom: 0px;
		padding-right: 0px;
		padding-left: 0px;
		height: 300px;
		width: 300px;
		margin-top: 100px;
		margin-left: 270px;
	}
	
	/* Main Text Box */
	.main-content .main-text-box {
		border: 10px solid rgba(255, 255, 255, 1.0);
		background-color: rgba(239, 239, 239, 0.3);
		box-shadow: 2px 2px 5px rgba(0, 0, 0, 0.2);
		height: 200px;
		width: 1000px;
		margin-left: 500px;
		margin-top: -250px;
		border-radius: 50px;
		padding-top: 35px;
		padding-left: 50px;
		padding-right: 50px;
		padding-bottom: 50px;
	}
	
	/* Text In Main Box */
	
	/* Home Button Customisation */
	.home-button img {
		border: 0px solid red;
		margin-left: 1435px;
		margin-top: -42px;
	}
	
	.home-button img:hover {
		opacity: 0.7;
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
	<a href="index.php" title="Home Page"><img src="images/icons/home-icon.png" alt="Home Icon" height="50" width="50"></a>
</div>

<div class="main-content">
	<div class="chrome-icon">
		<img src="images/icons/chrome-icon.png" alt="Chrome Icon" height="250" width="250">
	</div>
	<div class="main-text-box">
		<center>
			<p>Welcome to Resources2Go Spelling Application</p>
			<p>If you are experiencing difficulties please open this website in the Google Chrome Browser.</p>
			<p>You can find Google Chrome at his address if not installed already --></p>
			<a target="_blank" href="https://www.google.com/chrome/"> Google Chrome Link</a>
		</center>
	</div>
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