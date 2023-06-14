<?php

$servername = "localhost";      // default server name
$username = "root";         // user name that you created
$password = "";  // password that you created
$dbname = "c4db";               // Database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

//echo "Connected successfully: <br>";


?>