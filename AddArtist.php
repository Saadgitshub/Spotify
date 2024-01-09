<?php
include_once 'classes/Client.php';
include_once 'classes/Song.php';
include_once 'classes/Playlist.php';
include_once 'classes/Artist.php';
include_once 'classes/connection.php';  // Assuming your connection file is named connection.php

$connection = new Connection();
$connection->selectDatabase('MUSIC_PHP_PROJ');

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["submit"])) {
    $name = $_POST["name"];

    // Create a new Client instance
    $newArtist = new Artist($name);

    // Insert the new client into the database
    $newArtist->insertArtist('artist', $connection->conn);

    // Display a success message or redirect the user to another page
    echo "Added successful!";
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Sign Up Form by Colorlib</title>

    <!-- Font Icon -->
    <link rel="stylesheet" href="fonts/material-icon/css/material-design-iconic-font.min.css">

    <!-- Main css -->
    <link rel="stylesheet" href="css/style.css">
</head>

<body>

    <div class="main">

        <section class="signup">
            <div class="container">
                <div class="signup-content">
                    <form method="POST" action="AddArtist.php" id="signup-form" class="signup-form">
                        <h2 class="form-title">ADD Artist</h2>
                        <div class="form-group">
                            <input type="text" class="form-input" name="name" id="name" placeholder="Name"/>
                        </div>
                        <div class="form-group">
                            <input type="submit" name="submit" id="submit" class="form-submit" value="ADD"/>
                        </div>
                    </form>
                </div>
            </div>
        </section>

    </div>

    <!-- JS -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="js/main.js"></script>
</body>
</html>
