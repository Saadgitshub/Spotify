<?php

class Artist {

    public $id;
    public $name;

    public static $errorMsg = "";
    public static $successMsg = "";

    public function __construct($name) {
        // initialize the attributes of the class with the parameters
        $this->name = $name;
    }

    public function insertArtist($tableName, $conn) {
        // insert an artist into the database
        $sql = "INSERT INTO $tableName (Artist_Name) VALUES ('$this->name')";
        if (mysqli_query($conn, $sql)) {
            self::$successMsg = "New record created successfully";
        } else {
            self::$errorMsg = "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
    }

    
}

?>
