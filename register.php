<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="register.css">
    <script src="user-type-registration-form.js"></script>
</head>

<body>
    <?php
    // Handle registration form submission
    if (!empty($_POST['username']) && !empty($_POST['password']) && !empty($_POST['user_type']) && ($_POST['password'] == $_POST['confirm_password'])) {
        // Get form data
        $username = $_POST['username'];
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
        $userType = $_POST['user_type'];

        // Pass the data to the restapi-users
        $userData = array(
            'username' => $username,
            'password' => $password,
            'user_type' => $userType,
        );

        $userData = json_encode($userData);

        // Use cURL to make a POST request to restapi-users
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, 'http://localhost:8080/merit/restapi-users.php');
        curl_setopt($curl, CURLOPT_POST, 1);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $userData);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true); // Add this line
        $response = curl_exec($curl);
        $responseCode = curl_getinfo($curl, CURLINFO_RESPONSE_CODE); // Get the response code
        curl_close($curl);

        if ($responseCode == 200) {
            $user_id = mysqli_insert_id($conn);

            // Check the user type and send the data to the respective REST API
            if ($userType == 'organizer') {
                $orgName = $_POST['org_name'];
                $orgEmail = $_POST['org_email'];
                $orgPhone = $_POST['org_phone'];

                // Pass the data to the restapi-organizer
                $organizerData = array(
                    'name' => $orgName,
                    'email' => $orgEmail,
                    'phone' => $orgPhone,
                    'user_id' => $user_id
                );

                $organizerData = json_encode($organizerData);

                // Use cURL to make a POST request to restapi-organizer
                $curl = curl_init();
                curl_setopt($curl, CURLOPT_URL, 'http://localhost:8080/merit/restapi-organizer.php');
                curl_setopt($curl, CURLOPT_POST, 1);
                curl_setopt($curl, CURLOPT_POSTFIELDS, $organizerData);
                curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
                curl_setopt($curl, CURLOPT_RETURNTRANSFER, true); // Add this line
                $response = curl_exec($curl);
                $responseCode = curl_getinfo($curl, CURLINFO_RESPONSE_CODE); // Get the response code
                curl_close($curl);

                if ($responseCode == 200) {
                    // Organizer data inserted successfully
                    echo "Organizer registered successfully!";
                    // Redirect to the login page
                    header('Location: login.php');
                    exit();
                } else {
                    // Error inserting organizer data
                    echo "Error inserting organizer data";
                }
            } elseif ($userType == 'staff') {
                $firstName = $_POST['first_name'];
                $lastName = $_POST['last_name'];
                $icNumber = $_POST['ic_number'];
                $staffPhone = $_POST['staff_phone'];
                $staffEmail = $_POST['staff_email'];

                // Pass the data to the restapi-staff
                $staffData = array(
                    'first_name' => $firstName,
                    'last_name' => $lastName,
                    'ic_number' => $icNumber,
                    'phone' => $staffPhone,
                    'email' => $staffEmail,
                    'user_id' => $user_id
                );

                $staffData = json_encode($staffData);

                // Use cURL to make a POST request to restapi-staff
                $curl = curl_init();
                curl_setopt($curl, CURLOPT_URL, 'http://localhost:8080/merit/restapi-staff.php');
                curl_setopt($curl, CURLOPT_POST, 1);
                curl_setopt($curl, CURLOPT_POSTFIELDS, $staffData);
                curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
                curl_setopt($curl, CURLOPT_RETURNTRANSFER, true); // Add this line
                $response = curl_exec($curl);
                $responseCode = curl_getinfo($curl, CURLINFO_RESPONSE_CODE); // Get the response code
                curl_close($curl);

                if ($responseCode == 200) {
                    // Staff data inserted successfully
                    echo "Staff registered successfully!";
                    // Redirect to the login page
                    header('Location: login.php');
                    exit();
                } else {
                    // Error inserting staff data
                    echo "Error inserting staff data";
                }
            }
        } else {
            // Display error message if passwords don't match
            echo "Error: Passwords do not match";
        }
    }
    ?>
    <!-- Registration form -->
    <div class="form-container">
        <h2>Registration Form</h2>
        <hr>
        <br>
        <form id="registration-form" action=" " method="POST">
            <label for="org_name">Username:</label>
            <input type="text" name="username" placeholder="Username">
            <br><br>
            <label for="org_name">Password:</label>
            <input type="password" name="password" placeholder="Password" id="password">
            <br><br>
            <label for="org_name">Confirm Password:</label>
            <input type="password" name="confirm_password" placeholder="Confirm Password" id="confirm_password">
            <br><br>
            <label for="user_type">User Type:</label>
            <select id="user_type" name="user_type" onchange="showFields()">
                <option value="organizer">Organizer</option>
                <option value="staff">Staff</option>
            </select>
            <br><br>
            <div id="organization_fields">
                <label for="org_name">Organization Name:</label>
                <input type="text" id="org_name" name="org_name">
                <br><br>
                <label for="org_email">Organization Email:</label>
                <input type="email" id="org_email" name="org_email">
                <br><br>
                <label for="org_phone">Organization Phone Number:</label>
                <input type="tel" id="org_phone" name="org_phone">
            </div>

            <div id="staff_fields">
                <label for="first_name">First Name:</label>
                <input type="text" id="first_name" name="first_name">
                <br><br>
                <label for="last_name">Last Name:</label>
                <input type="text" id="last_name" name="last_name">
                <br><br>
                <label for="ic_number">IC Number:</label>
                <input type="text" id="ic_number" name="ic_number">
                <br><br>
                <label for="staff_phone">Staff Phone Number:</label>
                <input type="tel" id="staff_phone" name="staff_phone">
                <br><br>
                <label for="staff_email">Staff Email:</label>
                <input type="email" id="staff_email" name="staff_email">
            </div>
            <br><br>
            <button type="submit" name="register">Register</button>
        </form>
        <script src="usertype-restapi.js"></script>
    </div>
</body>

</html>