<?php
// Connect to the database
$dbHost = 'localhost';
$dbUsername = 'root';
$dbPassword = 'admin';
$dbName = 'merit';
$conn = mysqli_connect($dbHost, $dbUsername, $dbPassword, $dbName);

// Set the response header to return JSON
header('Content-Type: application/json');

// GET all volunteers or a specific volunteer
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    if (isset($_GET['id'])) {
        // Get a specific volunteer by ID
        $volunteer_id = $_GET['id'];
        $query = "SELECT * FROM `volunteer` WHERE `id` = $volunteer_id";
        $result = mysqli_query($conn, $query);

        if (mysqli_num_rows($result) > 0) {
            $volunteer = mysqli_fetch_assoc($result);
            header('Content-Type: application/json');
            echo json_encode($volunteer);
            exit();
        } else {
            $response = array('error' => 'Volunteer not found.');
            header('Content-Type: application/json');
            echo json_encode($response);
            exit();
        }
    } else {
        // Get all volunteers
        $query = "SELECT * FROM `volunteer`";
        $result = mysqli_query($conn, $query);

        $volunteers = array();
        while ($row = mysqli_fetch_assoc($result)) {
            $volunteers[] = $row;
        }

        header('Content-Type: application/json');
        echo json_encode($volunteers);
        exit();
    }
}

// POST a new volunteer
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Validate and sanitize input data
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $phone = mysqli_real_escape_string($conn, $_POST['phone']);

    // Create a new volunteer
    $query = "INSERT INTO `volunteer` (`name`, `email`, `phone`) VALUES ('$name', '$email', '$phone')";
    if (mysqli_query($conn, $query)) {
        $response = array('success' => 'Volunteer created successfully.');
        header('Content-Type: application/json');
        echo json_encode($response);
        exit();
    } else {
        $response = array('error' => 'Error creating volunteer.');
        header('Content-Type: application/json');
        echo json_encode($response);
        exit();
    }
}

// PUT update an existing volunteer
if ($_SERVER['REQUEST_METHOD'] === 'PUT') {
    // Validate and sanitize input data
    $volunteer_id = $_GET['id'];
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $phone = mysqli_real_escape_string($conn, $_POST['phone']);

    // Update the volunteer
    $query = "UPDATE `volunteer` SET `name` = '$name', `email` = '$email', `phone` = '$phone' WHERE `id` = $volunteer_id";
    if (mysqli_query($conn, $query)) {
        $response = array('success' => 'Volunteer updated successfully.');
        header('Content-Type: application/json');
        echo json_encode($response);
        exit();
    } else {
        $response = array('error' => 'Error updating volunteer.');
        header('Content-Type: application/json');
        echo json_encode($response);
        exit();
    }
}

// DELETE a volunteer
if ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
    // Get the volunteer ID from the request
    $volunteer_id = $_GET['id'];

    // Delete the volunteer
    $query = "DELETE FROM `volunteer` WHERE `id` = $volunteer_id";
    if (mysqli_query($conn, $query)) {
        $response = array('success' => 'Volunteer deleted successfully.');
        header('Content-Type: application/json');
        echo json_encode($response);
        exit();
    } else {
        $response = array('error' => 'Error deleting volunteer.');
        header('Content-Type: application/json');
        echo json_encode($response);
        exit();
    }
}

// Handle unsupported HTTP methods
$response = array('error' => 'Unsupported request method.');
header('Content-Type: application/json');
echo json_encode($response);
exit();

// Close the database connection
mysqli_close($conn);
?>