<?php
$host = "localhost";
$user = "root";
$password = "0557078148@Gm";
$database = "zion_hostel_db";
$port = 3306;

$conn = new mysqli($host, $user, $password, $database, $port);

if ($conn->connect_error) {
    die("Database Connection failed: " . $conn->connect_error);
}
?>