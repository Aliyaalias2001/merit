<?php
session_start();

// Set the API URL for user authentication
$apiUrl = 'http://localhost:8080/merit/restapi-users.php';

// Check if the username, password, and user type are provided
if (isset($_POST['username']) && isset($_POST['password']) && isset($_POST['user_type'])) {
    // Create a new cURL resource
    $ch = curl_init($apiUrl);

    // Set the request method to GET
    curl_setopt($ch, CURLOPT_HTTPGET, true);

    // Set the query parameters for the GET request
    $queryParams = http_build_query(array(
        'username' => $_POST['username'],
        'password' => $_POST['password'],
        'user_type' => $_POST['user_type']
    ));
    curl_setopt($ch, CURLOPT_URL, $apiUrl . '?' . $queryParams);

    // Set the content type header
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));

    // Return the response instead of outputting it
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    // Execute the request
    $response = curl_exec($ch);

    // Check for cURL errors
    if ($response === false) {
        $error_message = curl_error($ch);
    } else {
        // Close cURL resource
        curl_close($ch);

        // Check the response data
        $responseData = json_decode($response, true);

        // Debugging: Output the response and response data
        

        // Check if the response data is not empty
        if (!empty($responseData)) {
            // User type is set for at least one user in the response data
            foreach ($responseData as $user) {
                if (
                    isset($user['username']) && $user['username'] === $_POST['username'] &&
                    isset($user['password']) && password_verify($_POST['password'], $user['password']) &&
                    isset($user['user_type']) && $user['user_type'] === $_POST['user_type']
                ) {
                    // User found, set the session and redirect
                    $_SESSION['user_type'] = $user['user_type'];
                    switch ($_SESSION['user_type']) {
                        case 'staff':
                            header('Location: staff_homepage.php');
                            exit;
                        case 'organizer':
                            header('Location: organizer_homepage.php');
                            exit;
                        
                    }
                }
            }
        }

        // If the loop finishes without finding a matching user or if the response data is empty, display an error message
        $error_message = 'Invalid username, password or user type';
    }
}
?>
<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="login.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>
    <!-- Login form -->
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card mt-5">
                    <div class="card-body">
                        <h2 class="card-title">Login</h2>
                        <hr>

                        <form action="" method="POST">
                            <div class="form-group">
                                <label for="username">Username:</label>
                                <input type="text" class="form-control" name="username" placeholder="Username">
                            </div>
                            <div class="form-group">
                                <label for="password">Password:</label>
                                <input type="password" class="form-control" name="password" placeholder="Password" id="password">
                            </div>
                            <div class="form-group">
                                <label for="user_type">User Type:</label>
                                <select class="form-control" id="user_type" name="user_type">
                                    <option value="organizer" selected>Organizer</option>
                                    <option value="staff">Staff</option>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary custom-button">Log In</button>
                        </form>

                        <?php if (isset($error_message)) { ?>
                            <p class="error"><?php echo $error_message; ?></p>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>