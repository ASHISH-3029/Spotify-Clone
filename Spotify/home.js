// document.addEventListener('DOMContentLoaded', () => {
//     const cards = document.querySelectorAll('.card');
//     cards.forEach(card => {
//         card.addEventListener('click', async () => {
//             const album = card.getAttribute('data-album');
//             const songUrls = await fetchSongs(album);
//             displaySongs(songUrls);
//         });
//     });

//     document.getElementById('play').addEventListener('click', togglePlayPause);
// });

// // Mock Fetch Song URLs based on Album
// async function fetchSongs(album) {
//     const songs = {
//         album1: [
//             'https://www.soundhelix.com/examples/mp3/SoundHelix-Song-1.mp3',
//             'https://www.soundhelix.com/examples/mp3/SoundHelix-Song-2.mp3'
//         ],
//         album2: [
//             'https://www.soundhelix.com/examples/mp3/SoundHelix-Song-3.mp3',
//             'https://www.soundhelix.com/examples/mp3/SoundHelix-Song-4.mp3'
//         ],
//         album3: [
//             'https://www.soundhelix.com/examples/mp3/SoundHelix-Song-5.mp3',
//             'https://www.soundhelix.com/examples/mp3/SoundHelix-Song-6.mp3'
//         ]
//     };
//     return songs[album] || [];
// }

// // Display the song list
// function displaySongs(songUrls) {
//     const songList = document.querySelector('.songlist');
//     songList.innerHTML = '';
//     songUrls.forEach(songUrl => {
//         const songName = decodeURIComponent(songUrl.split('/').pop().replace('.mp3', ''));
//         const li = document.createElement('li');
//         li.innerHTML = songName;
//         li.addEventListener('click', () => playSong(songUrl));
//         songList.appendChild(li);
//     });
// }

// // Play the selected song
// function playSong(songUrl) {
//     const player = document.getElementById('music-player');
//     player.src = songUrl;
//     player.play();
//     document.getElementById('play').textContent = 'Pause';
// }

// // Toggle Play/Pause button
// function togglePlayPause() {
//     const player = document.getElementById('music-player');
//     if (player.paused) {
//         player.play();
//         document.getElementById('play').textContent = 'Pause';
//     } else {
//         player.pause();
//         document.getElementById('play').textContent = 'Play';
//     }
// }



document.addEventListener('DOMContentLoaded', () => {
    const cards = document.querySelectorAll('.card');
    let songs = [];  // Array to store song information
    let currentSongIndex = -1;
    let player = document.getElementById('music-player');
    let playButton = document.getElementById('play');
    let nextButton = document.getElementById('next');
    let prevButton = document.getElementById('prev');
    let volumeControl = document.getElementById('volume');

    // When a song is clicked, load it into the player
    cards.forEach((card, index) => {
        card.addEventListener('click', () => {
            currentSongIndex = index;
            loadSong(card);
            playSong();
        });
    });

    // Play/Pause functionality
    playButton.addEventListener('click', togglePlayPause);
    nextButton.addEventListener('click', nextSong);
    prevButton.addEventListener('click', prevSong);
    volumeControl.addEventListener('input', adjustVolume);

    // Load song into the player
    function loadSong(card) {
        const songFile = card.getAttribute('data-song-file');
        const songName = card.getAttribute('data-song-name');
        
        // Push the song to the array if not already added
        if (!songs.some(song => song.name === songName)) {
            songs.push({ file: songFile, name: songName });
        }

        player.src = songFile;
        player.load();  // Load the new song
        document.title = `Now Playing: ${songName}`;
    }

    // Play the current song
    function playSong() {
        if (currentSongIndex !== -1) {
            player.play();
            playButton.textContent = 'Pause';
        }
    }

    // Toggle play/pause
    function togglePlayPause() {
        if (player.paused) {
            player.play();
            playButton.textContent = 'Pause';
        } else {
            player.pause();
            playButton.textContent = 'Play';
        }
    }

    // Play next song
    function nextSong() {
        currentSongIndex++;
        if (currentSongIndex >= songs.length) {
            currentSongIndex = 0;  // Loop to the first song
        }
        loadSongFromArray();
        playSong();
    }

    // Play previous song
    function prevSong() {
        currentSongIndex--;
        if (currentSongIndex < 0) {
            currentSongIndex = songs.length - 1;  // Loop to the last song
        }
        loadSongFromArray();
        playSong();
    }

    // Load song from array based on current index
    function loadSongFromArray() {
        const song = songs[currentSongIndex];
        player.src = song.file;
        player.load();  // Load the new song
        document.title = `Now Playing: ${song.name}`;
    }

    // Adjust volume
    function adjustVolume() {
        player.volume = volumeControl.value;
    }
});
