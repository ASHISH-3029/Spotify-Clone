<?php
    session_start();
    include('connection.php');

    if (isset($_POST['email']) && isset($_POST['password'])) {
        $email = $_POST['email'];
        $password = $_POST['password'];

        // Simple SQL query to check if the user exists
        $sql = "SELECT * FROM users WHERE email = '$email' AND password = '$password'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $_SESSION['email'] = $email;
            header('Location: home.php');
        } else {
            echo '<script>alert("Invalid email or password!");</script>';
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Spotify Clone</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div id="login-page" class="login-container">
        <div class="login-box">
            <h2>Login</h2>
            <form method="POST" action="login.php">
                <input type="email" name="email" placeholder="Enter your email" required />
                <input type="password" name="password" placeholder="Enter your password" required />
                <button type="submit">Login</button>
            </form>
            <!-- Add link to register page -->
            <p>Sign Up ? <a href="register.php">Register here</a></p>
        </div>
    </div>
</body>
</html>
