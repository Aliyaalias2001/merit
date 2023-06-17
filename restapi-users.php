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
            // Retrieve a specific user by ID
            $userId = $_GET['id'];
            $query = "SELECT * FROM users WHERE id='$userId'";
            $result = mysqli_query($conn, $query);
            $user = mysqli_fetch_assoc($result);
            echo json_encode($user);
        } else {
            // Retrieve all users
            $query = "SELECT * FROM users";
            $result = mysqli_query($conn, $query);
            $users = mysqli_fetch_all($result, MYSQLI_ASSOC);
            echo json_encode($users);
        }
        break;

    case 'POST':
        // Retrieve form data from the request body
        $data = json_decode(file_get_contents('php://input'), true) ?? $_POST;

        // Validate the username field
        if (!isset($data['username']) || empty($data['username'])) {
            echo json_encode(array('message' => 'Username field is required'));
            exit;
        }

        // Extract the data
        $username = $data['username'];
        $password = password_hash($data['password'], PASSWORD_DEFAULT);
        $userType = $data['user_type'];

        // Insert new user into the database using prepared statement
        $stmt = $conn->prepare("INSERT INTO users (username, password, user_type) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $username, $password, $userType);
        if ($stmt->execute()) {
            // Get the auto-generated user ID
            $userId = $stmt->insert_id;
    
            // Return the user ID in the response
            $response = array('id' => $userId);
            echo json_encode($response);
        } else {
            // Return an error message in the response
            $response = array('error' => 'Failed to insert user data');
            echo json_encode($response);
        }
        break;

    case 'PUT':
        // Retrieve user ID from the URL
        $userId = $_GET['id'];

        // Retrieve updated user data from the request body
        $data = json_decode(file_get_contents('php://input'), true);

        // Extract the data
        $username = $data['username'];
        $password = password_hash($data['password'], PASSWORD_DEFAULT);
        $userType = $data['user_type'];

        // Update the user in the database using prepared statement
        $stmt = $conn->prepare("UPDATE users SET username=?, password=?, user_type=? WHERE id=?");
        $stmt->bind_param("sssi", $username, $password, $userType, $userId);
        $result = $stmt->execute();

        if ($result) {
            echo json_encode(array('message' => 'User updated successfully'));
        } else {
            echo json_encode(array('message' => 'Failed to update user'));
        }
        break;

    case 'DELETE':
        // Retrieve user ID from the URL
        $userId = $_GET['id'];

        // Delete the user from the database using prepared statement
        $stmt = $conn->prepare("DELETE FROM users WHERE id=?");
        $stmt->bind_param("i", $userId);
        $result = $stmt->execute();

        if ($result) {
            echo json_encode(array('message' => 'User deleted successfully'));
        } else {
            echo json_encode(array('message' => 'Failed to delete user'));
        }
        break;

    default:
        // Invalid method
        http_response_code(405);
        echo json_encode(array('message' => 'Method Not Allowed'));
        break;
}

// Close the database connection
mysqli_close($conn);
?>