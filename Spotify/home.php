<?php
session_start();
if (!isset($_SESSION['email'])) {
    header('Location: login.php');
    exit();
}
?>
<?php include('fetch_songs.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home - Spotify Clone</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <!-- Sidebar Menu -->
    <div id="home-page">
        <div class="menu-bar">
            <a href="home.php">Home</a>
            <a href="#">Library</a>
            <a href="search_song.php">Search</a>
            <a href="#">Premium</a>
            <a href="insert_songs.php">Insert Songs</a>
            <a href="logout.php">Logout</a>
        </div>

        <!-- Main Content -->
        <div class="main-content">
            <h1>Welcome, <?php echo $_SESSION['email']; ?>!</h1>

            <!-- Scrollable Songs List -->
            <div class="song-list">
                <?php include('home-container.php'); ?>
            </div>

            <!-- Music Player -->
            <div class="player-controls">
                <button id="prev">Previous</button>
                <button id="play">Play</button>
                <button id="next">Next</button>
                <input type="range" id="volume" min="0" max="1" step="0.01" value="1" />
            </div>
            <audio id="music-player" controls></audio>
        </div>
    </div>

    <script>
        let currentSongIndex = -1;
        let songs = [];
        let player = document.getElementById('music-player');
        let playButton = document.getElementById('play');
        let nextButton = document.getElementById('next');
        let prevButton = document.getElementById('prev');
        let volumeControl = document.getElementById('volume');

        document.addEventListener('DOMContentLoaded', () => {
            const cards = document.querySelectorAll('.card');
            cards.forEach((card, index) => {
                songs.push({
                    file: card.getAttribute('data-song-file'),
                    name: card.getAttribute('data-song-name')
                });
                card.addEventListener('click', () => {
                    currentSongIndex = index;
                    loadSongFromArray();
                    playSong();
                });
            });

            playButton.addEventListener('click', togglePlayPause);
            nextButton.addEventListener('click', nextSong);
            prevButton.addEventListener('click', prevSong);
            volumeControl.addEventListener('input', adjustVolume);
        });

        function loadSongFromArray() {
            const song = songs[currentSongIndex];
            player.src = song.file;
            player.load();
            document.title = `Now Playing: ${song.name}`;
        }

        function playSong() {
            if (currentSongIndex !== -1) {
                player.play();
                playButton.textContent = 'Pause';
            }
        }

        function togglePlayPause() {
            if (player.paused) {
                player.play();
                playButton.textContent = 'Pause';
            } else {
                player.pause();
                playButton.textContent = 'Play';
            }
        }

        function nextSong() {
            currentSongIndex++;
            if (currentSongIndex >= songs.length) currentSongIndex = 0;
            loadSongFromArray();
            playSong();
        }

        function prevSong() {
            currentSongIndex--;
            if (currentSongIndex < 0) currentSongIndex = songs.length - 1;
            loadSongFromArray();
            playSong();
        }

        function adjustVolume() {
            player.volume = volumeControl.value;
        }
    </script>
</body>
</html>
