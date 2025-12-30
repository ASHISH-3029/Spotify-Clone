<?php
    // Redirect to the login page if the user is not logged in
    session_start();
    if (isset($_SESSION['email'])) {
        header('Location: home.php');
        exit();
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome - Spotify Clone</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="login-container">
        <div class="login-box">
            <h2>Welcome to Spotify Clone</h2>
            <p>Start by logging in or registering to get started!</p>
            <div class="buttons-container">
                <a href="login.php" class="button">Login</a>
                <a href="register.php" class="button">Register</a>
            </div>
        </div>
    </div>
</body>
</html>
