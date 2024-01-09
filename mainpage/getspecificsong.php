<?php
include_once '../classes/connection.php';

$connection = new Connection();
$connection->selectDatabase('MUSIC_PHP_PROJ');

if (isset($_GET['song_id'])) {
    $specificSongId = $_GET['song_id'];

    $query = "SELECT song.song_name, artist.artist_name, song.song_path
              FROM song
              JOIN artist ON song.artist_id = artist.artist_id
              WHERE song.song_id = $specificSongId";

    $result = mysqli_query($connection->conn, $query);

    if ($result) {
        $row = mysqli_fetch_assoc($result);

        if ($row) {
            $specificSong = array(
                'song_name' => $row['song_name'],
                'artist_name' => $row['artist_name'],
                'song_path' => $row['song_path']
            );

            // Send the data as JSON
            header('Content-Type: application/json');
            echo json_encode($specificSong);
        } else {
            // Handle the case where the specific song is not found
            echo json_encode(array('error' => 'Song not found'));
        }
    } else {
        // Handle the query execution error
        echo json_encode(array('error' => 'Error executing the query'));
    }
} else {
    // Handle the case where song_id parameter is not provided
    echo json_encode(array('error' => 'Missing song_id parameter'));
}

$connection->close();
?>