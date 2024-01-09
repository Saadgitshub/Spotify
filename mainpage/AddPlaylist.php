<?php
include_once '../classes/Client.php';
include_once '../classes/Song.php';
include_once '../classes/Playlist.php';
include_once '../classes/Artist.php';
include_once '../classes/connection.php';  

$connection = new Connection();
$connection->selectDatabase('MUSIC_PHP_PROJ');

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["submit"])) {
    $UserId = intval($_POST["UserId"]);

    $playlistName = $_POST["playlistName"];

    var_dump($_POST);
    $type = gettype($UserId);
    
 
    // Create a new Client instance
    $newPlaylist = new Playlist($UserId,$playlistName);

    // Insert the new client into the database
    $newPlaylist->insertPlaylist('playlist', $connection->conn);

    // Display a success message or redirect the user to another page
    echo "Added successful!";
    if (isset($_POST['addToPlaylist']) && isset($_POST['songId'])) {
        $songIdToAdd = $_POST['songId'];
    
        // Add your logic to add the song to the playlist using $songIdToAdd
        // You may use this ID to perform database operations or any other necessary actions
    
        // Redirect back to the main page after adding to the playlist
        header("Location: mainpage.php");
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Playlist</title>
</head>

<body>
    <h2>Add Playlist</h2>
    <form action="addplaylist.php" method="post">
        <label for="UserId">User ID:</label>    
        <input type="number" id="UserId" name="UserId" min="1" max="1000000" step="1" value="1" required>
        <br>
        <label for="playlistName">Playlist Name:</label>
        <input type="text" name="playlistName" id="playlistName" required>
        <br>
        <!-- You can add more fields as needed -->

        <button type="submit" name="submit">Add Playlist</button>
    </form>
</body>

</html>