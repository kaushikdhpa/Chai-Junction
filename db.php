<?php
// Database connection for Chai Junction
$servername = "localhost";
$username = "root";   // XAMPP default
$password = "";       // XAMPP default
$dbname = "chai_db"; 

$conn = mysqli_connect($servername, $username, $password, $dbname);

if(!$conn){
    die("Database Connection Failed: " . mysqli_connect_error());
}
?>