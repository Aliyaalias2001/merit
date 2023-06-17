<?php
// Connect to the database
$dbHost = 'localhost';
$dbUsername = 'root';
$dbPassword = 'admin';
$dbName = 'merit';
$conn = mysqli_connect($dbHost, $dbUsername, $dbPassword, $dbName);

// Set the response header to return JSON
header('Content-Type: application/json');

// GET all speakers or a specific speaker
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    if (isset($_GET['id'])) {
        // Get a specific speaker by ID
        $speaker_id = $_GET['id'];
        $query = "SELECT * FROM `speakers` WHERE `id` = $speaker_id";
        $result = mysqli_query($conn, $query);

        if (mysqli_num_rows($result) > 0) {
            $speaker = mysqli_fetch_assoc($result);
            header('Content-Type: application/json');
            echo json_encode($speaker);
            exit();
        } else {
            $response = array('error' => 'Speaker not found.');
            header('Content-Type: application/json');
            echo json_encode($response);
            exit();
        }
    } else {
        // Get all speakers
        $query = "SELECT * FROM `speakers`";
        $result = mysqli_query($conn, $query);

        $speakers = array();
        while ($row = mysqli_fetch_assoc($result)) {
            $speakers[] = $row;
        }

        header('Content-Type: application/json');
        echo json_encode($speakers);
        exit();
    }
}

// POST a new speaker
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the request data
    $name = $_POST['name'];
    $topic = $_POST['topic'];

    // Insert the new speaker into the database
    $query = "INSERT INTO `speakers` (`name`, `topic`) VALUES ('$name', '$topic')";
    $result = mysqli_query($conn, $query);

    if ($result) {
        $response = array('success' => 'Speaker added successfully.');
    } else {
        $response = array('error' => 'Failed to add speaker.');
    }

    header('Content-Type: application/json');
    echo json_encode($response);
    exit();
}

// PUT update an existing speaker
if ($_SERVER['REQUEST_METHOD'] === 'PUT') {
    // Get the request data
    parse_str(file_get_contents("php://input"), $putData);
    $speaker_id = $putData['id'];
    $name = $putData['name'];
    $topic = $putData['topic'];

    // Update the speaker in the database
    $query = "UPDATE `speakers` SET `name` = '$name', `topic` = '$topic' WHERE `id` = $speaker_id";
    $result = mysqli_query($conn, $query);

    if ($result) {
        $response = array('success' => 'Speaker updated successfully.');
    } else {
        $response = array('error' => 'Failed to update speaker.');
    }

    header('Content-Type: application/json');
    echo json_encode($response);
    exit();
}

// DELETE a speaker
if ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
    // Get the request data
    parse_str(file_get_contents("php://input"), $deleteData);
    $speaker_id = $deleteData['id'];

    // Delete the speaker from the database
    $query = "DELETE FROM `speakers` WHERE `id` = $speaker_id";
    $result = mysqli_query($conn, $query);

    if ($result) {
        $response = array('success' => 'Speaker deleted successfully.');
    } else {
        $response = array('error' => 'Failed to delete speaker.');
    }

    header('Content-Type: application/json');
    echo json_encode($response);
    exit();
}

// Handle unsupported HTTP methods
$response = array('error' => 'Unsupported request method.');
header('Content-Type: application/json');
echo json_encode($response);
exit();

// Close the database connection
mysqli_close($conn);
?>
