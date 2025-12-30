<?php
    session_start();  // Start the session

    // Destroy all session data
    session_unset(); 

    // Destroy the session
    session_destroy(); 

    // Redirect to login page
    header('Location: login.php');
    exit();
?>
<a href="logout.php">Logout</a>
