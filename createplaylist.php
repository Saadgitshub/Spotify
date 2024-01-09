<?php
include_once 'classes/Client.php';
include_once 'classes/Playlist.php';
include_once 'classes/Song.php';
include_once 'classes/Artist.php';
include_once 'classes/connection.php';

$connection = new Connection();
$connection->selectDatabase('MUSIC_PHP_PROJ');



if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Process form data
    $userId = intval($_POST['user_id']);
    $playlistName = $_POST['playlist_name'];
    // Create a new playlist
    $playlist = new Playlist($userId, $playlistName);
    echo $userId; 
    $playlist->insertPlaylist("playlist",$connection->conn);
    
    
  
   
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Playlist</title>
</head>
<body>
    <h1>Create Playlist</h1>
    <form action="createplaylist.php" method="POST">
        <label for="user_id">User ID:</label>
        <input type="number" id="user_id" name="user_id" required>
        <br>
        <label for="playlist_name">Playlist Name:</label>
        <input type="text" id="playlist_name" name="playlist_name" required>
        <br>
        <button type="submit">Create Playlist</button>
    </form>
</body>
</html>