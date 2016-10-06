
<!-- 

	File: logOutScript.php
	Author: Ben Tegoni
	Description:
	The script that the login button calls on each account to destory all sessions.

-->

<?php
// All PHP code in here

// Include Statements to easily call files
//include 'mysql-connection.php';

session_start();

//Function to logout.
function signOut(){
	//destroys and unsets all sessions and then redirects to login page.
	session_unset();
	session_destroy();
	header("Location: /index.php");
}

//call the signOut function upon file being called.
signOut();

?>

<html>
<!-- Header Section of HTML code -->
<head>

<meta charset="utf-8">
<title></title>

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
</style>

</head>

<!-- Body Section of HTML Code -->
<body>
</body>

</html>