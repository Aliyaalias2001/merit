<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Connect to the database
$dbHost = 'localhost';
$dbUsername = 'root';
$dbPassword = 'admin';
$dbName = 'merit';
$conn = mysqli_connect($dbHost, $dbUsername, $dbPassword, $dbName);

// Set the response header to return JSON
header('Content-Type: application/json');

// Check the request method
$method = $_SERVER['REQUEST_METHOD'];

// Handle the request based on the method
switch ($method) {
    case 'GET':
        // Check if an 'id' parameter is provided
        if (isset($_GET['id'])) {
            // Retrieve a specific organizer by ID
            $organizerId = $_GET['id'];
            $query = "SELECT * FROM organizer WHERE id='$organizerId'";
            $result = mysqli_query($conn, $query);
            $organizer = mysqli_fetch_assoc($result);
            echo json_encode($organizer);
        } else {
            // Retrieve all organizers
            $query = "SELECT * FROM organizer";
            $result = mysqli_query($conn, $query);
            $organizers = mysqli_fetch_all($result, MYSQLI_ASSOC);
            echo json_encode($organizers);
        }
        break;

    case 'POST':
        // Retrieve form data from the request body
        $data = json_decode(file_get_contents('php://input'), true) ?? $_POST;

        // Validate the required fields
        $requiredFields = ['org_name', 'org_phone', 'org_email', 'user_id'];
        foreach ($requiredFields as $field) {
            if (!isset($data[$field]) || empty($data[$field])) {
                echo json_encode(array('message' => ucfirst($field) . ' field is required'));
                exit;
            }
        }

        // Extract the data
        $orgName = $data['org_name'];
        $orgPhone = $data['org_phone'];
        $orgEmail = $data['org_email'];
        $userId = $data['user_id'];

        // Check if the user ID exists in the users table
        $query = "SELECT * FROM users WHERE id='$userId'";
        $result = mysqli_query($conn, $query);
        if (mysqli_num_rows($result) === 0) {
            echo json_encode(array('message' => 'Invalid user ID'));
            exit;
        }

        // Insert new organizer into the database using prepared statement
        $query = "INSERT INTO organizer (name, email, phoneNumber, usersID) VALUES (?, ?, ?, ?)";
        $stmt = mysqli_prepare($conn, $query);
        mysqli_stmt_bind_param($stmt, "sssi", $orgName, $orgEmail, $orgPhone, $userId);
        $result = mysqli_stmt_execute($stmt);

        if ($result) {
            echo json_encode(array('message' => 'Organizer created successfully'));
        } else {
            echo json_encode(array('message' => 'Failed to create organizer'));
        }
        break;

    case 'PUT':
        // Retrieve organizer ID from the URL
        $organizerId = $_GET['id'];

        // Retrieve updated organizer data from the request body
        $data = json_decode(file_get_contents('php://input'), true);

        // Extract the data
        $orgName = $data['org_name'];
        $orgPhone = $data['org_phone'];
        $orgEmail = $data['org_email'];

        // Update the organizer in the database
        $query = "UPDATE organizer SET name='$orgName', phoneNumber='$orgPhone', email='$orgEmail' WHERE id='$organizerId'";
        $result = mysqli_query($conn, $query);

        if ($result) {
            echo json_encode(array('message' => 'Organizer updated successfully'));
        } else {
            echo json_encode(array('message' => 'Failed to update organizer'));
        }
        break;

    case 'DELETE':
        // Retrieve organizer ID from the URL
        $organizerId = $_GET['id'];

        // Delete the organizer from the database
        $query = "DELETE FROM organizer WHERE id='$organizerId'";
        $result = mysqli_query($conn, $query);

        if ($result) {
            echo json_encode(array('message' => 'Organizer deleted successfully'));
        } else {
            echo json_encode(array('message' => 'Failed to delete organizer'));
        }
        break;

    default:
        // Invalid method
        http_response_code(405);
        echo json_encode(array('message' => 'Method Not Allowed'));
        break;
}
?>