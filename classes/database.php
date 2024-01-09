<?php

//include the connection file
include('connection.php');

//create an instance of Connection class
$connection = new Connection();

//call the createDatabase methods to create database "chap4Db"
$connection->createDatabase('MUSIC_PHP_PROJ');
$query0 = "
CREATE TABLE Users (
    Users_id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    Users_FullName VARCHAR(100) NOT NULL,
    Users_Email VARCHAR(255) NOT NULL,
    Users_Password VARCHAR(255) NOT NULL
    
    )
";
$query = "
CREATE TABLE Artist(
    Artist_id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    Artist_Name VARCHAR(255) NOT NULL
)

";

$query1 = "
CREATE TABLE PLAYLIST (
playlist_id INT AUTO_INCREMENT PRIMARY KEY,
Users_id INT(6) UNSIGNED,
playlist_name VARCHAR(255) NOT NULL,
FOREIGN KEY (Users_id) REFERENCES users(Users_id)
)
";

$query2 = "
CREATE TABLE Song (
    Song_id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    Song_Name VARCHAR(255) NOT NULL,
    Artist_Id INT(6) UNSIGNED NOT NULL,
    Song_Path VARCHAR(255) NOT NULL,
    CONSTRAINT fk_artist_id FOREIGN KEY (Artist_Id) REFERENCES Artist(Artist_id)
)
";

$query3="CREATE TABLE PLAYLIST_SONGS (
    playlist_id INT,
    song_id INT(6) UNSIGNED,
    PRIMARY KEY (playlist_id, song_id),
    FOREIGN KEY (playlist_id) REFERENCES Playlist(playlist_id),
    FOREIGN KEY (Song_id) REFERENCES Song(Song_id)
)
";


//call the selectDatabase method to select the chap4Db
$connection->selectDatabase('MUSIC_PHP_PROJ');

//call the createTable method to create table with the $query
$connection->createTable($query0);
$connection->createTable($query);
$connection->createTable($query1);
$connection->createTable($query2);
$connection->createTable($query3);



?>
