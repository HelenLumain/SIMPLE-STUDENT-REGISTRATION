<?php
$servername = "localhost"; // XAMPP default
$username = "root"; // Default user in XAMPP
$password = ""; // Leave blank if no password is set
$database = "srs"; // Your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
