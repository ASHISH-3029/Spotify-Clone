<?php
// Database connection
$conn = new mysqli('localhost', 'root', '', 'spotify_clone');

// Check the connection
if ($conn->connect_error) {
    die('Connection failed: ' . $conn->connect_error);
}

// Handle form submission to insert song data
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get data from POST request
    $song_name = $_POST['song_name'];
    $album_name = $_POST['album_name'];
    $artist_name = $_POST['artist_name'];
    $duration = $_POST['duration'];
    
    // File upload handling for audio
    if (isset($_FILES['song_file'])) {
        $file_name = $_FILES['song_file']['name'];
        $file_tmp = $_FILES['song_file']['tmp_name'];
        $file_size = $_FILES['song_file']['size'];
        $file_error = $_FILES['song_file']['error'];

        // Define allowed file types and size limit for audio
        $allowed_types = ['audio/mp3', 'audio/mpeg', 'audio/wav'];
        $max_size = 10 * 1024 * 1024; // 10 MB

        // Check for errors in the audio file upload
        if ($file_error === 0) {
            // Validate file type
            $file_type = mime_content_type($file_tmp);
            if (!in_array($file_type, $allowed_types)) {
                echo "Invalid file type. Only MP3 and WAV files are allowed.";
                exit;
            }
            
            // Validate file size
            if ($file_size > $max_size) {
                echo "File is too large. Maximum size is 10MB.";
                exit;
            }

            // Define upload directory for audio
            $upload_dir = 'uploads/';
            if (!is_dir($upload_dir)) {
                mkdir($upload_dir, 0777, true);
            }

            // Generate unique file name for audio to avoid conflicts
            $file_new_name = uniqid('', true) . '.' . pathinfo($file_name, PATHINFO_EXTENSION);
            $file_destination = $upload_dir . $file_new_name;

            // Move the uploaded file to the server directory
            if (move_uploaded_file($file_tmp, $file_destination)) {
                // Handle image upload
                $image_path = '';
                if (isset($_FILES['image_file']) && $_FILES['image_file']['error'] === 0) {
                    $image_name = $_FILES['image_file']['name'];
                    $image_tmp = $_FILES['image_file']['tmp_name'];
                    $image_size = $_FILES['image_file']['size'];
                    $image_error = $_FILES['image_file']['error'];

                    // Validate image file
                    $allowed_image_types = ['image/jpeg', 'image/png', 'image/jpg'];
                    $image_max_size = 5 * 1024 * 1024; // 5 MB

                    if ($image_error === 0) {
                        $image_type = mime_content_type($image_tmp);
                        if (!in_array($image_type, $allowed_image_types)) {
                            echo "Invalid image type. Only JPG, JPEG, and PNG are allowed.";
                            exit;
                        }

                        if ($image_size > $image_max_size) {
                            echo "Image file is too large. Maximum size is 5MB.";
                            exit;
                        }

                        // Define upload directory for images
                        $image_upload_dir = 'uploads/images/';
                        if (!is_dir($image_upload_dir)) {
                            mkdir($image_upload_dir, 0777, true);
                        }

                        // Generate unique file name for the image
                        $image_new_name = uniqid('', true) . '.' . pathinfo($image_name, PATHINFO_EXTENSION);
                        $image_destination = $image_upload_dir . $image_new_name;

                        // Move the uploaded image to the server directory
                        if (move_uploaded_file($image_tmp, $image_destination)) {
                            $image_path = $image_destination; // Save the image path
                        } else {
                            echo "Failed to upload image.";
                            exit;
                        }
                    }
                }

                // Prepare the SQL query to insert data into the database
                $sql = "INSERT INTO songs (song_name, file_path, album_name, artist_name, duration, image_path) 
                        VALUES ('$song_name', '$file_destination', '$album_name', '$artist_name', '$duration', '$image_path')";

                // Execute the query
                if ($conn->query($sql) === TRUE) {
                    echo '<script>
                    window.location.href = "home.php";
                    alert("New song inserted successfully!");
                </script>';
                } else {
                    echo "Error: " . $conn->error;
                }
            } else {
                echo "Failed to upload the audio file.";
            }
        } else {
            echo "Error uploading audio file.";
        }
    }

    // Close the connection
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Insert Song</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #121212;
            color: #fff;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .form-container {
            background-color: #333;
            padding: 20px;
            border-radius: 8px;
            width: 300px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.6);
        }
        .form-container h2 {
            text-align: center;
            margin-bottom: 20px;
        }
        .form-container input,
        .form-container button {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #555;
            border-radius: 5px;
            background-color: #222;
            color: #fff;
        }
        .form-container button {
            background-color: #1DB954;
            cursor: pointer;
        }
        .form-container button:hover {
            background-color: #1ed760;
        }
    </style>
</head>
<body>

<div class="form-container">
    <h2>Insert Song</h2>
    <form method="POST" action="insert_songs.php" enctype="multipart/form-data">
        <!-- Song Name Input -->
        <input type="text" name="song_name" placeholder="Song Name" required><br>

        <!-- Album Name Input -->
        <input type="text" name="album_name" placeholder="Album Name"><br>

        <!-- Artist Name Input -->
        <input type="text" name="artist_name" placeholder="Artist Name"><br>

        <!-- Duration (in seconds) -->
        <input type="number" name="duration" placeholder="Duration (seconds)" required><br>

        <!-- Audio File Upload (Where audio files will be uploaded to 'uploads/' directory) -->
        <input type="file" name="song_file" accept="audio/*" required><br>

        <!-- Image File Upload (Where album cover images will be uploaded to 'uploads/images/' directory) -->
        <input type="file" name="image_file" accept="image/*"><br>

        <button type="submit">Insert Song</button>
    </form>
</div>


</body>
</html>
