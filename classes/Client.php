<?php

class Client{

public $id;
public $username;
public $email;
public $password;
public $unhshpassword;




public static $errorMsg = "";

public static $successMsg="";


public function __construct($username,$email,$password){

    //initialize the attributs of the class with the parameters, and hash the password
    $this->username = $username;
    $this->email = $email;
    $this->password = password_hash($password,PASSWORD_DEFAULT);
    $this->unhshpassword = $password;
  
}

public function insertClient($tableName,$conn){

//insert a client in the database, and give a message to $successMsg and $errorMsg
$sql = "INSERT INTO $tableName (Users_FullName,Users_Email,Users_Password)
VALUES ('$this->username', '$this->email','$this->password')";
if (mysqli_query($conn, $sql)) {
self::$successMsg= "New record created successfully";

} else {
    self::$errorMsg ="Error: " . $sql . "<br>" . mysqli_error($conn);
}

}
public function getClientName($conn) {
    $query = "SELECT Users_FullName FROM users WHERE Users_Email = '$this->email'";
    $result = mysqli_query($conn, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        return $row['Users_FullName'];
    }

    return null;
}


public static function  selectAllClients($tableName,$conn){

//select all the client from database, and inset the rows results in an array $data[]
$sql = "SELECT id,username,emailFROM $tableName ";
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) > 0) {
        // output data of each row
        $data=[];
        while($row = mysqli_fetch_assoc($result)) {
        
            $data[]=$row;
        }
        return $data;
    }

}

static function selectClientById($tableName,$conn,$id){
    //select a client by id, and return the row result
    $sql = "SELECT username,email FROM $tableName  WHERE id='$id'";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
    // output data of each row
    $row = mysqli_fetch_assoc($result);
    
    }
    return $row;
}

public function verifyClientCreds($conn)
{
    $sql = "SELECT Users_Email, Users_Password FROM Users";
    $resultToCheck = mysqli_query($conn, $sql);
    if (mysqli_num_rows($resultToCheck) > 0) {
        // output data of each row
        
        while($row = mysqli_fetch_assoc($resultToCheck))
        {
            if($row['Users_Email'] == $this->email && password_verify($this->unhshpassword,$row['Users_Password']))
            {
                return true;
            }
        }
        return false;
    }

}

static function updateClient($client,$tableName,$conn,$id){
    //update a client of $id, with the values of $client in parameter
    //and send the user to read.php
    $sql = "UPDATE $tableName SET Users_FullName='$client->username',Users_Email='$client->email' WHERE Users_Id='$id'";
        if (mysqli_query($conn, $sql)) {
        self::$successMsg= "New record updated successfully";
header("Location:read.php");
        } else {
            self::$errorMsg= "Error updating record: " . mysqli_error($conn);
        }


}

static function deleteClient($tableName,$conn,$id){
    //delet a client by his id, and send the user to read.php
    $sql = "DELETE FROM $tableName WHERE id='$id'";

if (mysqli_query($conn, $sql)) {
    self::$successMsg= "Record deleted successfully";
    header("Location:read.php");
} else {
    self::$errorMsg= "Error deleting record: " . mysqli_error($conn);
}

  
    }


    
}

?>