


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="script.js"></script>
    <title>Document</title>
</head>
<body>
<div id="playlist" class="container d-flex justify-content-center my-4 mb-5">
        <!-- Each song container will be added here dynamically -->
    </div>
    <script>
    document.addEventListener("DOMContentLoaded", function () {
        // Fetch songs from the server
        fetch('mainpage/GetSongs.php')
            .then(response => response.json())
            .then(songs => {
                populatePlaylist(songs);
            })
            .catch(error => console.error('Error fetching songs:', error));
    });

    function populatePlaylist(songs) {
        var playlistContainer = document.getElementById('playlist');

        songs.forEach(function (song) {
            var songElement = createSongElement(song);
            playlistContainer.appendChild(songElement);
        });
    }

    function createSongElement(song) {
    var songElement = document.createElement('div');
    songElement.className = 'song';



    var titleElement = document.createElement('p');

    var deleteButton = document.createElement('button');
    deleteButton.textContent = 'Delete'
    deleteButton.addEventListener('click',function(){

    })
    titleElement.textContent = 'Title: ' + song.song_name;

        var artistElement = document.createElement('p');
        artistElement.textContent = 'Artist: ' + song.artist_name;

        songElement.appendChild(titleElement);
        songElement.appendChild(artistElement);
        songElement.appendChild(deleteButton);
        return songElement;
    }
    function deleteSong(songId) {
            
            fetch('DeleteSong.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({
                    songId: songId,
                }),
            })
                .then(response => response.json())
                .then(result => {
                    // Handle the result, maybe update the UI if needed
                    console.log(result);
                })
                .catch(error => console.error('Error deleting song:', error));
        }
</script>
</body>
</html> 