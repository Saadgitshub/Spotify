<?php
// Include the connection file
include_once 'classes/connection.php';

// Check if the request method is POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the JSON data from the request body
    $data = json_decode(file_get_contents("php://input"));

    // Check if the songId is set
    if (isset($data->songId)) {
        // Create an instance of the Connection class
        $connection = new Connection();

        // Get the song ID from the request
        $songId = $data->songId;

        // Define the delete query
        $query = "DELETE FROM Song WHERE Song_id = ?";

        // Prepare and execute the query
        $statement = $connection->conn->prepare($query);
        $statement->bind_param("i", $songId);

        if ($statement->execute()) {
            // If the deletion is successful, send a success response
            $response = array("success" => true, "message" => "Song deleted successfully");
            echo json_encode($response);
        } else {
            // If there's an error, send an error response
            $response = array("success" => false, "message" => "Error deleting song");
            echo json_encode($response);
        }

    } else {
        // If songId is not set, send an error response
        $response = array("success" => false, "message" => "Invalid request");
        echo json_encode($response);
    }
} else {
    // If the request method is not POST, send an error response
    $response = array("success" => false, "message" => "Invalid request method");
    echo json_encode($response);
}
?>
