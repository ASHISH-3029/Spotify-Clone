INSTALLATION AND SETUP GUIDE

This guide explains in detail how to install, configure, and run the Spotify Clone (PHP + MySQL) project on a local system. 
It is intended for students and beginners who are using XAMPP, WAMP, or MAMP.

------------------------------------------------------------

REQUIREMENTS

Before starting the installation, make sure the following software and tools are available on your system.

1. XAMPP / WAMP / MAMP
   These provide Apache server, PHP, and MySQL in one package.

2. PHP version 7.x or higher
   Required to run backend PHP files.

3. MySQL Database
   Used to store user data, songs, and application details.

4. Web Browser
   Google Chrome, Mozilla Firefox, or Microsoft Edge.

5. Git (Optional)
   Used only if you want to clone the repository using command line.

------------------------------------------------------------

STEP 1: DOWNLOAD THE PROJECT

There are two ways to download the project.

OPTION 1: CLONE USING GIT (Optional)

1. Open Command Prompt or Terminal
2. Run the following command:

git clone https://github.com/your-username/spotify-clone.git

3. The project folder will be downloaded to your system.

OPTION 2: DOWNLOAD ZIP FILE (Recommended for Beginners)

1. Open the GitHub repository in your browser
2. Click on the "Code" button
3. Select "Download ZIP"
4. Extract the ZIP file after download is complete

------------------------------------------------------------

STEP 2: MOVE PROJECT TO SERVER DIRECTORY

After extracting the project, move the main project folder to the web server root directory.

For XAMPP (Windows):
C:\xampp\htdocs\Spotify

For WAMP (Windows):
C:\wamp64\www\Spotify

For MAMP (Mac):
/Applications/MAMP/htdocs/Spotify

Make sure the folder name is correct because it will be used in the browser URL.

------------------------------------------------------------

STEP 3: DATABASE SETUP AND CONFIGURATION

1. Start XAMPP / WAMP / MAMP
2. Start the Apache server
3. Start the MySQL server

4. Open your web browser
5. Go to the following URL:
http://localhost/phpmyadmin

6. Click on "New" to create a new database
7. Enter database name:
spotify_clone
8. Click on "Create"

IMPORT DATABASE FILE

1. Select the newly created database
2. Click on the "Import" tab
3. Click on "Choose File"
4. Select the file:
Database/spotify_clone.sql
5. Click on "Go"
6. Wait for the import to complete successfully

------------------------------------------------------------

STEP 4: DATABASE CONNECTION CONFIGURATION

1. Open the project folder
2. Locate the file named "connection.php"
3. Open it using any code editor

Update the database credentials as shown below:

<?php
$host = "localhost";
$user = "root";
$password = "";
$database = "spotify_clone";

$conn = mysqli_connect($host, $user, $password, $database);

if (!$conn) {
    die("Database connection failed");
}
?>

Save the file after making changes.

------------------------------------------------------------

STEP 5: RUN THE PROJECT

1. Make sure Apache and MySQL are running
2. Open your web browser
3. Enter the following URL in the address bar:

http://localhost/Spotify

4. Press Enter
5. You should see the Login or Register page of the Spotify Clone project

------------------------------------------------------------

IMPORTANT PROJECT FOLDERS EXPLANATION

uploads folder
This folder stores uploaded audio files such as MP3 songs.

image folder
This folder contains images used in the user interface.

Database folder
This folder contains the SQL file used for database setup.

PHP files
These files handle backend logic, authentication, database operations, and music playback.

------------------------------------------------------------

COMMON ERRORS AND FIXES

DATABASE CONNECTION ERROR
- Make sure MySQL service is running
- Check database name spelling
- Verify username and password in connection.php

AUDIO NOT PLAYING
- Ensure audio files are present inside the uploads folder
- Check file format (only .mp3 supported)
- Check browser sound settings

PAGE NOT LOADING
- Make sure Apache server is running
- Verify project folder location
- Check URL spelling in browser

------------------------------------------------------------

SUCCESSFUL INSTALLATION CHECKLIST

- Apache server is running
- MySQL server is running
- Database imported without errors
- Project opens in browser
- Login and Register pages are visible
- Music plays correctly

------------------------------------------------------------

LICENSE INFORMATION

This project uses the MIT License.
You are free to use, modify, and distribute this project with proper credit to the author.

------------------------------------------------------------

AUTHOR INFORMATION

Name: Ashish Bind
Degree: BE Computer Engineering

Technical Skills:
PHP
Python
HTML
CSS
JavaScript
MySQL

------------------------------------------------------------

SUPPORT AND HELP

If you face any issues while installing or running the project:
- Create an issue on GitHub
- Or contact the project author

------------------------------------------------------------

Happy Coding and Enjoy Music Streaming!

------------------------------------------------------------

TECHNICAL SKILLS USED IN THIS PROJECT

The following technical skills, tools, and technologies were used to design, develop, and deploy the Spotify Clone project.

------------------------------------------------------------

FRONTEND TECHNOLOGIES

HTML (HyperText Markup Language)
HTML is used to structure all web pages in the project such as the login page, registration page, home page, and music player interface.
It defines forms, buttons, audio elements, navigation menus, and page layout.

CSS (Cascading Style Sheets)
CSS is used to style the application and improve the user interface.
It controls colors, fonts, spacing, layouts, responsiveness, and overall visual appearance of the music streaming platform.

JavaScript
JavaScript is used to add interactivity and dynamic behavior to the application.
It handles user actions such as playing and pausing music, searching songs, and updating the UI without reloading the page.

------------------------------------------------------------

BACKEND TECHNOLOGY

PHP (Hypertext Preprocessor)
PHP is used as the main server-side programming language.
It handles user authentication, session management, database connectivity, song fetching, file handling, and business logic.

------------------------------------------------------------

DATABASE TECHNOLOGY

MySQL
MySQL is used as the relational database management system.
It stores and manages:
- User registration and login details
- Song information
- Uploaded music file paths
- Application-related data

MySQL ensures efficient data storage, retrieval, and management.

------------------------------------------------------------

SERVER AND DEVELOPMENT ENVIRONMENT

Apache Web Server
Apache is used to host and run the PHP application locally.

XAMPP / WAMP / MAMP
These tools are used as local development environments.
They provide Apache server, PHP, and MySQL in a single package.

------------------------------------------------------------

TOOLS AND UTILITIES

phpMyAdmin
Used for managing the MySQL database, creating databases and tables, and importing SQL files.

Git and GitHub
Used for version control and source code management.
Helps in tracking changes, maintaining project versions, and sharing the project online.

Web Browser
Used for testing and running the application.
Examples include Google Chrome and Mozilla Firefox.

------------------------------------------------------------

ADDITIONAL CONCEPTS IMPLEMENTED

CRUD Operations
Create, Read, Update, and Delete operations are used for managing users and music records.

Session Management
Used to maintain user login sessions securely.

File Upload Handling
Used to upload and store music files on the server.

------------------------------------------------------------

TECHNICAL SUMMARY

This project demonstrates full-stack web development using PHP and MySQL.
It showcases practical knowledge of frontend design, backend logic, database management, and server-side programming.
