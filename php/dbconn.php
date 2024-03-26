<?php
// Establish a database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "firearcade";

$conn = new mysqli($servername, $username, $password, $dbname);
mysqli_set_charset($conn, "utf8");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if(empty($_SESSION['Naam']) || $_SESSION['Naam'] == ''){
    header("Location: ../php/login.php");
    die();
}