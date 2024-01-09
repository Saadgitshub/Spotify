<?php
include_once '../classes/Client.php';
include_once '../classes/Song.php';
include_once '../classes/Playlist.php';
include_once '../classes/Artist.php';
include_once '../classes/connection.php';  

$connection = new Connection();
$connection->selectDatabase('MUSIC_PHP_PROJ');

$query = "SELECT song.song_name, artist.artist_name, song.song_path
FROM song
JOIN artist ON song.artist_id = artist.artist_id";
$result = mysqli_query($connection->conn, $query);

$songs = array();

while ($row = mysqli_fetch_assoc($result)) {
    $songs[] = $row;
}

// Send the data as JSON
header('Content-Type: application/json');
echo json_encode($songs);
?>
