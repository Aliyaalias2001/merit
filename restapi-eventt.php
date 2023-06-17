<?php
// Connect to the database
$dbHost = 'localhost';
$dbUsername = 'root';
$dbPassword = 'admin';
$dbName = 'merit';
$conn = mysqli_connect($dbHost, $dbUsername, $dbPassword, $dbName);

// Set the response header to return JSON
header('Content-Type: application/json');

// GET all events or a specific event
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    if (isset($_GET['id'])) {
        // Get a specific event by ID
        $event_id = $_GET['id'];
        $query = "SELECT * FROM `eventt` WHERE `id` = $event_id";
        $result = mysqli_query($conn, $query);

        if (mysqli_num_rows($result) > 0) {
            $event = mysqli_fetch_assoc($result);
            header('Content-Type: application/json');
            echo json_encode($event);
            exit();
        } else {
            $response = array('error' => 'Event not found.');
            header('Content-Type: application/json');
            echo json_encode($response);
            exit();
        }
    } else {
        // Get all events
        $query = "SELECT * FROM `eventt`";
        $result = mysqli_query($conn, $query);

        $events = array();
        while ($row = mysqli_fetch_assoc($result)) {
            $events[] = $row;
        }

        header('Content-Type: application/json');
        echo json_encode($events);
        exit();
    }
}

// POST a new event
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // ... (code for creating a new event)
}

// PUT update an existing event
if ($_SERVER['REQUEST_METHOD'] === 'PUT') {
    // ... (code for updating an event)
}

// DELETE an event
if ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
    // ... (code for deleting an event)
}

// Handle unsupported HTTP methods
$response = array('error' => 'Unsupported request method.');
header('Content-Type: application/json');
echo json_encode($response);
exit();

// Close the database connection
mysqli_close($conn);
?>