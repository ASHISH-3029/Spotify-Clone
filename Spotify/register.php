<?php
    include('connection.php');

    if (isset($_POST['email']) && isset($_POST['password'])) {
        $email = $_POST['email'];
        $password = $_POST['password'];

        // Check if user already exists
        $check_sql = "SELECT * FROM users WHERE email = '$email'";
        $check_result = $conn->query($check_sql);

        if ($check_result->num_rows > 0) {
            echo '<script>alert("User already exists!");</script>';
        } else {
            $sql = "INSERT INTO users (email, password) VALUES ('$email', '$password')";
            if ($conn->query($sql)) {
                echo '<script>alert("Registration successful! Please login now."); window.location.href = "login.php";</script>';
            } else {
                echo '<script>alert("Error in registration. Please try again!");</script>';
            }
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Spotify Clone</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div id="register-page" class="login-container">
        <div class="login-box">
            <h2>Register</h2>
            <form method="POST" action="register.php">
                <input type="email" name="email" placeholder="Enter your email" required />
                <input type="password" name="password" placeholder="Enter your password" required />
                <button type="submit">Register</button>
            </form>
            <!-- Add link to login page -->
            <p>Sign In ?<a href="login.php">Login here</a></p>
        </div>
    </div>
</body>
</html>
