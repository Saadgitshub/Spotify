<?php
// GetPlaylist.php

include_once '../classes/connection.php';

$connection = new Connection();
$connection->selectDatabase('MUSIC_PHP_PROJ');

// Récupérer l'ID de la playlist à partir des données postées
$playlistId = $_POST['playlistId']; // Assurez-vous que vous avez un formulaire ou une autre méthode pour envoyer cet ID

// Récupérer les informations de la playlist depuis la base de données
$query = "SELECT * FROM playlist WHERE playlist_id = '$playlistId'";
$result = mysqli_query($connection->conn, $query);

if ($result) {
    $playlist = mysqli_fetch_assoc($result);
    // Envoyer les données en tant que réponse JSON
    header('Content-Type: application/json');
    echo json_encode($playlist);
} else {
    // Gérer l'erreur en conséquence
    $response = array('success' => false, 'message' => 'Error retrieving playlist: ' . mysqli_error($connection->conn));
    header('Content-Type: application/json');
    echo json_encode($response);
}

// Fermez la connexion à la base de données lorsque vous avez fini de l'utiliser
mysqli_close($connection->conn);
?>