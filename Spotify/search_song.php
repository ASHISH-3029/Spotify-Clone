<?php
// search_songs.php

// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$database = "spotify_clone";

$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$songs = [];
$search = "";

// Handle search
if (isset($_GET['search'])) {
    $search = trim($_GET['search']);
    if (!empty($search)) {
        $stmt = $conn->prepare("SELECT id, song_name, file_path, album_name, artist_name, duration, image_path FROM songs WHERE song_name LIKE ?");
        $likeSearch = "%$search%";
        $stmt->bind_param("s", $likeSearch);
        $stmt->execute();
        $result = $stmt->get_result();

        while ($row = $result->fetch_assoc()) {
            $songs[] = $row;
        }
        $stmt->close();
    }
}

$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Search Songs</title>
    <link rel="stylesheet" href="style.css"> 
    <style>
        /* Reset and Base Styles */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }
        body {
            background-color: #121212;
            color: #fff;
            font-size: 16px;
        }

        /* Menu Bar */
        .menu-bar {
            height: 100vh;
            width: 14em;
            position: fixed;
            background-color: #1f1f1f;
            padding-top: 2em;
            display: flex;
            flex-direction: column;
            justify-content: flex-start;
            align-items: center;
            border-right: 2px solid #333;
        }
        .menu-bar a {
            color: #fff;
            text-decoration: none;
            margin: 1em 0;
            font-size: 18px;
            font-weight: 600;
            transition: color 0.3s;
        }
        .menu-bar a:hover {
            color: #1db954;
        }

        /* Main Content */
        .main-content {
            margin-left: 16em;
            margin-top: 4.5em;
            padding: 20px;
        }

        /* Search Box */
        .search-box {
            text-align: center;
            margin-bottom: 30px;
        }
        .search-box input[type="text"] {
            padding: 10px;
            width: 300px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        .search-box button {
            padding: 10px 15px;
            background: #1db954;
            color: white;
            border: none;
            border-radius: 5px;
            margin-left: 5px;
            cursor: pointer;
        }
        .search-box button:hover {
            background: #1ed760;
        }

        /* Song List */
        .song-list .card {
            margin: 10px auto;
            padding: 10px;
            border: 1px solid #ddd;
            width: 60%;
            border-radius: 8px;
            cursor: pointer;
            transition: 0.3s;
            background-color: #333;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        .song-list .card:hover {
            background: #444;
        }

        .song-list img {
            width: 80px;
            height: 80px;
            object-fit: cover;
            border-radius: 5px;
        }

        /* Music Player */
        .player {
            text-align: center;
            margin-top: 30px;
        }
        .player button {
            padding: 10px 20px;
            background-color: #1db954;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        .player button:hover {
            background-color: #1ed760;
        }
        .hidden {
            display: none;
        }
    </style>
</head>
<body>

<div class="menu-bar">
    <a href="home.php">Home</a>
    <a href="#">Library</a>
    <a href="search_songs.php">Search</a>
    <a href="#">Premium</a>
    <a href="insert_songs.php">Insert Songs</a>
    <a href="logout.php">Logout</a>
</div>

<div class="main-content">
    <h1>Search Songs</h1>

    <div class="search-box">
        <form method="GET" action="search_songs.php">
            <input type="text" name="search" placeholder="Enter song name..." value="<?php echo htmlspecialchars($search); ?>">
            <button type="submit">Search</button>
        </form>
    </div>

    <div class="song-list" id="songList">
        <?php if (!empty($songs)) : ?>
            <?php foreach ($songs as $index => $song) : ?>
                <div class="card" onclick="playSong(<?php echo htmlspecialchars(json_encode($songs)); ?>, <?php echo $index; ?>)">
                    <img src="<?php echo htmlspecialchars($song['image_path']); ?>" alt="Album Art">
                    <div>
                        <h3><?php echo htmlspecialchars($song['song_name']); ?></h3>
                        <p><strong>Album:</strong> <?php echo htmlspecialchars($song['album_name'] ?? 'Unknown'); ?></p>
                        <p><strong>Artist:</strong> <?php echo htmlspecialchars($song['artist_name'] ?? 'Unknown'); ?></p>
                        <p><strong>Duration:</strong> <?php echo gmdate("i:s", $song['duration']); ?> minutes</p>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else : ?>
            <?php if (!empty($search)) : ?>
                <p>No songs found for "<?php echo htmlspecialchars($search); ?>".</p>
            <?php endif; ?>
        <?php endif; ?>
    </div>

    <div class="player hidden" id="playerBox">
        <h2 id="playingTitle">Now Playing:</h2>
        <audio id="audioPlayer" controls autoplay>
            <source src="" type="audio/mpeg">
            Your browser does not support the audio element.
        </audio>
        <br>
        <button onclick="togglePlayPause()">⏯️ Play / Pause</button>
        <button onclick="nextSong()">⏭️ Next</button>
    </div>

</div>

<script>
let currentSongs = [];
let currentIndex = 0;
let isPlaying = false;

function playSong(songs, index) {
    currentSongs = songs;
    currentIndex = index;
    const playerBox = document.getElementById('playerBox');
    const audioPlayer = document.getElementById('audioPlayer');
    const playingTitle = document.getElementById('playingTitle');

    audioPlayer.src = currentSongs[currentIndex]['file_path'];
    playingTitle.innerText = "Now Playing: " + currentSongs[currentIndex]['song_name'];

    playerBox.classList.remove('hidden');
    audioPlayer.play();
    isPlaying = true;
}

function togglePlayPause() {
    const audioPlayer = document.getElementById('audioPlayer');
    const playButton = document.querySelector('.player button');

    if (isPlaying) {
        audioPlayer.pause();
        playButton.innerText = "▶️ Play";
        isPlaying = false;
    } else {
        audioPlayer.play();
        playButton.innerText = "⏸️ Pause";
        isPlaying = true;
    }
}

function nextSong() {
    if (currentSongs.length > 0) {
        currentIndex = (currentIndex + 1) % currentSongs.length;
        playSong(currentSongs, currentIndex);
    }
}

function previousSong() {
    if (currentSongs.length > 0) {
        currentIndex = (currentIndex - 1 + currentSongs.length) % currentSongs.length;
        playSong(currentSongs, currentIndex);
    }
}
</script>

</body>
</html>
