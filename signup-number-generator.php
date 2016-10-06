
<!-- 

	File: 
	Author: Ben Tegoni
	Description:
	Generates a random number for people signing up.

-->

<?php
// All PHP code in here

// Include Statements to easily call files
include 'mysql-connection.php';

//Function for creating the code associated with signing up
function generateCode(){
	include 'mysql-connection.php';
	
	//Define Variables
	//A query to select all data from table Code Gen
	$sql = "SELECT * FROM codegen";
	$result = $conn->query($sql);
	$row = mysqli_fetch_assoc($result);
	//A random number between 100000 - 999999
	$numberA = rand(100000, 999999);
	echo("$numberA : Current numberA <br />");
	//Get the intGenCode and assign it to $numberB
	$numberB = $row['intGenCode'];
	echo($numberB);
	echo " : Current numberB <br />";

	//While the $numberA is equal to $numberB 
	while($numberA == $numberB){ //As soon as the number isnt equal it means that its a unique number and can set it to be $numberA
		$numberA = rand(100000, 999999);
		echo("$numberA : New Selected numberA");
	} 
	
	//As soon as the numbers aren't equal this part of the code is executed
	if($numberA != $numberB){
		$sql2 = "DELETE FROM codegen WHERE intGenCode";
		//Query a delete function for MySQL databse
		if ($conn->query($sql2) === TRUE) {
			//if successful display this.
			echo "<br /> Record deleted successfully <br />";
		} else {
			//if unsuccessful display this.
			echo "<br /> Error deleting record <br />";
		}
		//Make the query that inserts the new code into the correct table in the database with the $numberA variable.
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
		exit;
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
</style>

</head>

<!-- Body Section of HTML Code -->
<body>


<form>
	<input type="submit" name="gencode" value="Generate Code"/>
</form>

</body>

</html>