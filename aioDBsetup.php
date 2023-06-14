<?php

// with XAMPP running (just replace  username and password with your own from myPHPadmin) 
// this file will create the database, table and populate it all at once.

//defining variables for database connection
//replace parameters with your own
$servername = "localhost";
$username = "root";
$password = "";

// Create connection
$conn = new mysqli($servername, $username, $password);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
echo "Connected successfully <br>";

// Create database
$newDB = "CREATE DATABASE c4db";
if($conn->query($newDB) === TRUE) {
    echo "Database created successfully <br>";
} else {
    echo "Error creating database: " . $conn->error;
}

// Database connection updated with newDB variable. 
$database = "c4db";
$conn = new mysqli($servername, $username, $password, $database);

// Create User Table
$sql = "CREATE TABLE players (
userid INT(4) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
username  VARCHAR(30) NOT NULL,
userpass  VARCHAR(30) NOT NULL,
wins INT(4) NOT NULL,
playtime INT(4) NOT NULL,
playcount INT(4) NOT NULL
)";

//Checks if table was created or it failed
if ($conn->query($sql) === TRUE) {
    echo "Table has been created successfully. <br>";
} else {
    echo "Error creating table: " . $conn->error . "<br>";
}

// Insert new users with non null parameters
$sql = "INSERT INTO players (userid, username, userpass, wins, playtime, playcount)
VALUES ('1', 'emmy', 'rocks', '0', '0', '0');";
$sql .= "INSERT INTO players (userid, username, userpass, wins, playtime, playcount)
VALUES ('2', 'romeo', 'panics', '0', '0', '0');";


if ($conn->multi_query($sql) === TRUE) {
    echo "New records created successfully <br>";
  } else {
    echo "Error: " . $sql . "<br>" . $conn->error;
  }

// connection closed
$conn->close();

?>