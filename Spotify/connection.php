<?php
// Database connection details
$servername = "localhost";
$username = "root";
$password = "";
$database = "spotify_clone";

// Create a database connection
$conn = new mysqli($servername, $username, $password, $database);

// Check the connection
if ($conn->connect_error) {
    die('Connection Failed: ' . $conn->connect_error);
}
?>
