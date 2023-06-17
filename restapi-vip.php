<?php
// Connect to the database
$dbHost = 'localhost';
$dbUsername = 'root';
$dbPassword = 'admin';
$dbName = 'merit';
$conn = mysqli_connect($dbHost, $dbUsername, $dbPassword, $dbName);

// Set the response header to return JSON
header('Content-Type: application/json');

// GET all VIPs or a specific VIP
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    if (isset($_GET['id'])) {
        // Get a specific VIP by ID
        $vip_id = $_GET['id'];
        $query = "SELECT * FROM `vip` WHERE `id` = $vip_id";
        $result = mysqli_query($conn, $query);

        if (mysqli_num_rows($result) > 0) {
            $vip = mysqli_fetch_assoc($result);
            header('Content-Type: application/json');
            echo json_encode($vip);
            exit();
        } else {
            $response = array('error' => 'VIP not found.');
            header('Content-Type: application/json');
            echo json_encode($response);
            exit();
        }
    } else {
        // Get all VIPs
        $query = "SELECT * FROM `vip`";
        $result = mysqli_query($conn, $query);

        $vips = array();
        while ($row = mysqli_fetch_assoc($result)) {
            $vips[] = $row;
        }

        header('Content-Type: application/json');
        echo json_encode($vips);
        exit();
    }
}

// POST a new VIP
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];

    // Validate input
    if (empty($name) || empty($email) || empty($phone)) {
        $response = array('error' => 'Missing required fields.');
        header('Content-Type: application/json');
        echo json_encode($response);
        exit();
    }

    // Insert the new VIP into the database
    $query = "INSERT INTO `vip` (`name`, `email`, `phone`) VALUES ('$name', '$email', '$phone')";
    $result = mysqli_query($conn, $query);

    if ($result) {
        $response = array('message' => 'VIP created successfully.');
        header('Content-Type: application/json');
        echo json_encode($response);
        exit();
    } else {
        $response = array('error' => 'Failed to create VIP.');
        header('Content-Type: application/json');
        echo json_encode($response);
        exit();
    }
}

// PUT update an existing VIP
if ($_SERVER['REQUEST_METHOD'] === 'PUT') {
    parse_str(file_get_contents("php://input"), $put_vars);
    $vip_id = $put_vars['id'];
    $name = $put_vars['name'];
    $email = $put_vars['email'];
    $phone = $put_vars['phone'];

    // Update the VIP in the database
    $query = "UPDATE `vip` SET `name`='$name', `email`='$email', `phone`='$phone' WHERE `id`='$vip_id'";
    $result = mysqli_query($conn, $query);

    if ($result) {
        $response = array('message' => 'VIP updated successfully.');
        header('Content-Type: application/json');
        echo json_encode($response);
        exit();
    } else {
        $response = array('error' => 'Failed to update VIP.');
        header('Content-Type: application/json');
        echo json_encode($response);
        exit();
    }
}

// DELETE a VIP
if ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
    parse_str(file_get_contents("php://input"), $delete_vars);
    $vip_id = $delete_vars['id'];

    // Delete the VIP from the database
    $query = "DELETE FROM `vip` WHERE `id`='$vip_id'";
    $result = mysqli_query($conn, $query);

    if ($result) {
        $response = array('message' => 'VIP deleted successfully.');
        header('Content-Type: application/json');
        echo json_encode($response);
        exit();
    } else {
        $response = array('error' => 'Failed to delete VIP.');
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
