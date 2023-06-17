<?php
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
            // Retrieve a specific staff member by ID
            $staffId = $_GET['id'];
            $query = "SELECT * FROM staff WHERE id='$staffId'";
            $result = mysqli_query($conn, $query);
            $staff = mysqli_fetch_assoc($result);
            echo json_encode($staff);
        } else {
            // Retrieve all staff members
            $query = "SELECT * FROM staff";
            $result = mysqli_query($conn, $query);
            $staffMembers = mysqli_fetch_all($result, MYSQLI_ASSOC);
            echo json_encode($staffMembers);
        }
        break;

    case 'POST':
        // Retrieve form data from the request body
        $data = json_decode(file_get_contents('php://input'), true);

        // Extract the data
        $firstName = $data['first_name'];
        $lastName = $data['last_name'];
        $icNumber = $data['ic_number'];
        $staffPhone = $data['staff_phone'];
        $staffEmail = $data['staff_email'];
        $userId = $data['user_id'];

        // Insert new staff member into the database
        $query = "INSERT INTO staff (firstName, lastName, icNo, phoneNo, email, userID) VALUES ('$firstName', '$lastName', '$icNumber', '$staffPhone', '$staffEmail', '$userId')";
        $result = mysqli_query($conn, $query);

        if ($result) {
            echo json_encode(array('message' => 'Staff member created successfully'));
        } else {
            echo json_encode(array('message' => 'Failed to create staff member'));
        }
        break;

    case 'PUT':
        // Retrieve staff member ID from the URL
        $staffId = $_GET['id'];

        // Retrieve updated staff member data from the request body
        $data = json_decode(file_get_contents('php://input'), true);

        // Extract the data
        $firstName = $data['first_name'];
        $lastName = $data['last_name'];
        $icNumber = $data['ic_number'];
        $staffPhone = $data['staff_phone'];
        $staffEmail = $data['staff_email'];

        // Update the staff member in the database
        $query = "UPDATE staff SET firstName='$firstName', lastName='$lastName', icNo='$icNumber', phoneNo='$staffPhone', email='$staffEmail' WHERE id='$staffId'";
        $result = mysqli_query($conn, $query);

        if ($result) {
            echo json_encode(array('message' => 'Staff member updated successfully'));
        } else {
            echo json_encode(array('message' => 'Failed to update staff member'));
        }
        break;

    case 'DELETE':
        // Retrieve staff member ID from the URL
        $staffId = $_GET['id'];

        // Delete the staff member from the database
        $query = "DELETE FROM staff WHERE id='$staffId'";
        $result = mysqli_query($conn, $query);

        if ($result) {
            echo json_encode(array('message' => 'Staff member deleted successfully'));
        } else {
            echo json_encode(array('message' => 'Failed to delete staff member'));
        }
        break;

    default:
        // Invalid request method
        http_response_code(405);
        echo json_encode(array('message' => 'Method Not Allowed'));
        break;
}
?>
