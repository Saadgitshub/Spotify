<?php
include_once '../classes/Client.php';
include_once '../classes/Song.php';
include_once '../classes/Playlist.php';
include_once '../classes/Artist.php';
include_once '../classes/connection.php';  

if (isset($_POST["submit"])) {
    $connection = new Connection();
    $connection->selectDatabase('MUSIC_PHP_PROJ');
    $uploadDir = "songs/";

    $audioFile = $_FILES["audioFile"];
    $fileName = $audioFile["name"];
    $tempFilePath = $audioFile["tmp_name"];
    $targetFilePath = $uploadDir . $fileName;
    $artistId = isset($_POST["ArtistId"]) ? $_POST["ArtistId"] : '';

    // Validate that the artist with the given ID exists
    $artistExists = Artist::artistExists($connection->conn, $artistId);

    if (!$artistExists) {
        echo "L'artiste avec l'ID $artistId n'existe pas.";
    } else {

        $artistExists = Artist::artistExists($connection->conn, $artistId);

if (!$artistExists) {
    echo "L'artiste avec l'ID $artistId n'existe pas.";
} else {
    $newSong = new Song($fileName, $targetFilePath, $artistId);
    // ... le reste du code pour l'insertion de la chanson ...
}
        $newSong = new Song($fileName, $targetFilePath, $artistId);

        if (move_uploaded_file($tempFilePath, $targetFilePath)) {
            echo "Le fichier $fileName a été téléchargé avec succès.";
        } else {
            echo "Erreur lors du téléchargement du fichier.";
        }

        $newSong->insertSong('song', $connection->conn);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload Audio File</title>
</head>
<body>
    <h2>Upload Audio File</h2>
    <form action="AddSong.php" method="post" enctype="multipart/form-data">
        <label for="audioFile">Select Audio File:</label>
        <input type="file" name="audioFile" id="audioFile" accept=".mp3, .wav, .ogg" required>
        <br>
        <div>
            <input type="number" id="ArtistId" name="ArtistId" min="1" max="1000000" step="1" value="1" required>
        </div>
        <button type="submit" name="submit">Upload</button>
    </form>
</body>
</html>
