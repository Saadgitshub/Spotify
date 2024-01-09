<?php
include_once 'classes/User.php';
include_once 'classes/Playlist.php';
include_once 'classes/Song.php';

// Create a sample user and playlist (assuming they exist, you might want to fetch from a database)
$user = new User(uniqid(), 'DummyUser');
$playlist = new Playlist(uniqid(), 'Sample Playlist', $user);

// Add some sample songs to the playlist
$song1 = new Song(uniqid(), 'Song1', 'Artist1', 200);
$song2 = new Song(uniqid(), 'Song2', 'Artist2', 180);
$playlist->addSong($song1);
$playlist->addSong($song2);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrjcc7bKbXJb5Un5dd2nkeMfN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-eN5S/wxUdApgnjwuTmTEzgfZ5g9nHkr+60L6bhBpl2DCE6hCj49l6J4xGJ2ltaT5" crossorigin="anonymous"></script>
    <title>View Playlist</title>
</head>
<body>
    <h1>View Playlist</h1>
    <h2><?php echo $playlist->getName(); ?></h2>
    <p>Owner: <?php echo $playlist->getOwner()->getUsername(); ?></p>
    <p>Songs:</p>
    <ul>
        <?php foreach ($playlist->getSongs() as $song): ?>
            <li><?php echo "{$song->getTitle()} by {$song->getArtist()}"; ?></li>
        <?php endforeach; ?>
    </ul>
</body>
</html>
