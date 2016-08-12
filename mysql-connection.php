<!-- 

	File: mysql-connection.php
	Author: Ben Tegoni
	Description:
	MySQLi Connnection to the database

-->


<?PHP

//Connection Used to connect to MySQLi
$servername = "localhost";
//User Account Username
$db_username = "benkahoots";
//User Account Password
$db_password = "nopass";
//Database Name in phpMyAdmin
$dbName = "spelling";
$conn = new MySQLi($servername, $db_username, $db_password, $dbName);

// Check if connection has been successful 
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
//echo "great success <br />";
echo "";

?>