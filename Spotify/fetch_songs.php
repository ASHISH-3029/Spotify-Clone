<?php
// Database connection
$conn = new mysqli('localhost', 'root', '', 'spotify_clone');

if ($conn->connect_error) {
    die('Connection failed: ' . $conn->connect_error);
}

// Fetch all songs from the database
$sql = "SELECT * FROM songs";
$result = $conn->query($sql);

// Initialize an empty array to store songs
$songs = [];

if ($result->num_rows > 0) {
    // Fetch the songs and store them in the $songs array
    while ($row = $result->fetch_assoc()) {
        $songs[] = $row;
    }
} else {
    echo "No songs found.";
}

$conn->close();
?>
