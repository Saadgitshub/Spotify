<?php

class Song {

    public $id;
    public $name;
    public $artistName;
    public $artistId;
    public $songPath;

    public static $errorMsg = "";
    public static $successMsg = "";

    public function __construct($name, $songPath, $artistId) {
        // Initialize class attributes with parameters
        $this->name = $name;
        $this->songPath = $songPath;
        $this->artistId = $artistId;
    }

    public function insertSong($tableName, $conn) {
        // Insert a song into the database
        $sql = "INSERT INTO $tableName (Song_Name, Artist_id, Song_path)
                VALUES ('$this->name', '$this->artistId', '$this->songPath')";

        if (mysqli_query($conn, $sql)) {
            self::$successMsg = "New record created successfully";
        } else {
            self::$errorMsg = "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
    }

    // ... rest of the class remains the same




    public static function selectAllSongs($tableName, $conn) {
        // Sélectionnez toutes les chansons de la base de données et retournez le résultat sous forme de tableau
        $sql = "SELECT id, name, artist_name, artist_id, song_path FROM $tableName";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) > 0) {
            // Récupérez les données de chaque ligne
            $data = [];
            while ($row = mysqli_fetch_assoc($result)) {
                $data[] = $row;
            }
            return $data;
        }
    }

    static function selectSongById($tableName, $conn, $id) {
        // Sélectionnez une chanson par ID et retournez le résultat de la ligne
        $sql = "SELECT name, artist_name, artist_id, song_path FROM $tableName WHERE id='$id'";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) > 0) {
            // Récupérez les données de chaque ligne
            $row = mysqli_fetch_assoc($result);
        }
        return $row;
    }

    static function updateSong($song, $tableName, $conn, $id) {
        // Mettez à jour une chanson par ID avec les valeurs de $song en paramètre
        $sql = "UPDATE $tableName
                SET name='$song->name', artist_name='$song->artistName', artist_id='$song->artistId', song_path='$song->songPath'
                WHERE id='$id'";

        if (mysqli_query($conn, $sql)) {
            self::$successMsg = "Record updated successfully";
            header("Location: read.php");
        } else {
            self::$errorMsg = "Error updating record: " . mysqli_error($conn);
        }
    }

    static function deleteSong($tableName, $conn, $id) {
        // Supprimez une chanson par ID
        $sql = "DELETE FROM $tableName WHERE id='$id'";

        if (mysqli_query($conn, $sql)) {
            self::$successMsg = "Record deleted successfully";
            header("Location: read.php");
        } else {
            self::$errorMsg = "Error deleting record: " . mysqli_error($conn);
        }
    }
    public static function getAllSongs($conn) {
        $songs = [];
        $tableName = 'song'; // Change this if your table name is different

        $sql = "SELECT * FROM $tableName";
        $result = mysqli_query($conn, $sql);

        if ($result && mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $songs[] = $row;
            }
        }

        return $songs;
} 

}

?>
