<?php
$conn = new mysqli('localhost', 'root', '', 'spotify_clone');

if ($conn->connect_error) {
    die('Connection failed: ' . $conn->connect_error);
}

$sql = "SELECT * FROM songs";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        // Get the image path from the database (assuming 'image_path' is the column storing image file path)
        $imagePath = $row['image_path'] ? $row['image_path'] : 'uploads/default_image.jpg'; // fallback to a default image if no image exists
        
        // Display song details including the album image as background
        echo '<div class="card" data-song-file="' . $row['file_path'] . '" data-song-name="' . $row['song_name'] . '" style="background-image: url(\'' . $imagePath . '\');">';
        echo '<div class="card-overlay">';
        echo '<h3>' . $row['song_name'] . '</h3>';
        echo '<p>' . $row['artist_name'] . ' - ' . $row['album_name'] . '</p>';
        echo '</div>';
        echo '</div>';
    }
} else {
    echo 'No songs available.';
}

$conn->close();
?>
