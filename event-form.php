<?php
$conn = mysqli_connect("localhost", "root", "admin", "merit");
session_start();
?>


<!DOCTYPE html>
<html>
<head>
    <title>Event Registration Form</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    
    <?php include 'staff_navbar.php'; ?>
</head>
<body>
    <br>
    <div class="container">
        <div class="header-container">
            <div class="header">
                <h2>Event Information</h2>
            </div>
            <hr>
            <br>
        </div>

    <form method="post" action="" enctype="multipart/form-data">
            <div class="event-container">
                <div class="event-box">
                    <div class="event-form">
                        <div class="form-group">
                            <label for="event-name">Event Name:</label>
                            <input type="text" class="form-control" name="event_name" id="event-name"><br><br>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="event-startdate">Event Start Date:</label>
                                <input type="date" class="form-control" name="event_startdate" id="event-startdate">
                                <br><br>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="event-enddate">Event End Date:</label>
                                <input type="date" class="form-control" name="event_enddate" id="event-enddate">
                                <br><br>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="event-starttime">Event Start Time:</label>
                                <input type="time" class="form-control" name="event_starttime" id="event-starttime">
                                <br><br>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="event-endtime">Event End Time:</label>
                                <input type="time" class="form-control" name="event_endtime" id="event-endtime">
                                <br><br>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="event-location">Event Location:</label>
                            <input type="text" class="form-control" name="event_location" id="event-location">
                            <br><br>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="event-state">Event State:</label>
                                <input type="text" class="form-control" name="event_state" id="event-state">
                                <br><br>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="event-country">Event Country:</label>
                                <input type="text" class="form-control" name="event_country" id="event-country">
                                <br><br>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="event-poster">Event Poster:</label>
                            <input type="file" class="form-control-file" name="image" id="event-poster" accept="image/*">
                            <br><br>
                        </div>

                        <div class="form-group">
                            <label for="event-numberparticipant">Number of Participant:</label>
                            <input type="number" class="form-control" name="event_numberparticipant" id="event-numberparticipant" min="1">
                            <br><br>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="event-category">Event Category:</label>
                                <select class="form-control" name="event_category" id="event-category">
                                    <option value="leadership">Leadership</option>
                                    <option value="entrepreneurship">Entrepreneurship</option>
                                    <option value="culture">Culture</option>
                                    <option value="volunteering">Volunteering</option>
                                    <option value="sport">Sport</option>
                                    <option value="spiritual">Spiritual</option>
                                </select>
                                <br><br>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="event-level">Event Level:</label>
                                <select class="form-control" name="event_level" id="event-level">
                                    <option value="study-center">Study Center</option>
                                    <option value="club">Club</option>
                                    <option value="university">University</option>
                                    <option value="national">National</option>
                                    <option value="international">International</option>
                                </select>
                                <br><br>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

            <h2>Volunteer Information</h2>
            <hr>
            <br>
            <div class="volunteer-container">
                <button type="button" class="btn btn-primary" id="addVolunteerBtn" onclick="showVolunteerForm()">Add Volunteer</button>

                <div id="volunteerModal" class="modal">
                    <div class="modal-content">
                        <span class="close">&times;</span>
                        <h2>Volunteer Information</h2>
                        <input type="text" class="form-control" id="volunteerFirstName" placeholder="First Name">
                        <br><br>
                        <input type="text" class="form-control" id="volunteerLastName" placeholder="Last Name">
                        <br><br>
                        <input type="text" class="form-control" id="volunteerMatricNumber" placeholder="Matric Number">
                        <br><br>
                        <input type="text" class="form-control" id="volunteerPosition" placeholder="Position">
                        <br><br>
                        <button type="button" class="btn btn-primary" onclick="saveVolunteerForm()">Save</button>
                    </div>
                </div>

                <div id="volunteerList">
                    <script type="text/javascript" src="add-volunteer.js"></script>
                </div>
            </div>
<br>
            <h2>Speaker Information</h2>
            <hr>
            <br>
            <div class="speaker-container">
                <button type="button" class="btn btn-primary" id="addSpeakerBtn" onclick="showSpeakerForm()">Add Speaker</button>

                <div id="speakerModal" class="modal">
                    <div class="modal-content">
                        <span class="close">&times;</span>
                        <h2>Speaker Information</h2>
                        <div class="form-group">
                            <label for="speakerType">Speaker Type:</label>
                            <select class="form-control" id="speakerType" onchange="toggleSpeakerFields()">
                                <option value="student">Student (UMT)</option>
                                <option value="outsider">Outsider</option>
                            </select>
                        </div>
                        <br><br>
                        <input type="text" class="form-control" id="name" placeholder="Name" style="display: none;">
                        <br><br>
                        <input type="text" class="form-control" id="matricNumber" placeholder="Matric Number" style="display: none;">
                        <br><br>
                        <input type="text" class="form-control" id="billingRate" placeholder="Billing Rate" style="display: none;">
                        <br><br>
                        <input type="text" class="form-control" id="icNumber" placeholder="IC Number" style="display: none;">
                        <br><br>
                        <input type="tel" class="form-control" id="phoneNumber" placeholder="Phone Number" style="display: none;">
                        <br><br>
                        <input type="email" class="form-control" id="email" placeholder="Email" style="display: none;">
                        <br><br>
                        <button type="button" class="btn btn-primary" onclick="saveSpeakerForm()">Save</button>
                    </div>
                </div>

                <div id="speakerList"></div>
                <script type="text/javascript" src="add-speaker.js"></script>
            </div>
<br>
            <h2>VIP Information</h2>
            <hr>
            <br>
            <div class="vip-container">
                <button type="button" class="btn btn-primary" id="addVIPBtn" onclick="showVIPForm()">Add VIP</button>

                <div id="vipModal" class="modal">
                    <div class="modal-content">
                        <span class="close">&times;</span>
                        <h2>VIP Information</h2>
                        <input type="text" class="form-control" id="vipName" placeholder="Name">
                        <br><br>
                        <input type="email" class="form-control" id="vipEmail" placeholder="Email">
                        <br><br>
                        <input type="text" class="form-control" id="vipPhone" placeholder="Phone">
                        <br><br>
                        <button type="button" class="btn btn-primary" onclick="saveVIPForm()">Save</button>
                    </div>
                </div>

                <div id="vipList">
                    <script type="text/javascript" src="add-vip.js"></script>
                </div>
            </div>
<br>
            <div class="button-container">
                <div class="button">
                    <input type="submit" class="btn btn-primary" id="next" name="submit" value="Submit">
                </div>
                <hr>
            </div>
        </form>
    </div>
</div>

<?php
// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the input values from the form
    $event_name = $_POST['event_name'];
    $event_startdate = $_POST['event_startdate'];
    $event_enddate = $_POST['event_enddate'];
    $event_starttime = $_POST['event_starttime'];
    $event_endtime = $_POST['event_endtime'];
    $event_location = $_POST['event_location'];
    $event_state = $_POST['event_state'];
    $event_country = $_POST['event_country'];
    $event_numberparticipant = $_POST['event_numberparticipant'];
    $event_level = $_POST['event_level'];
    $event_category = $_POST['event_category'];

    // Sanitize the input values
    $event_name = mysqli_real_escape_string($conn, $event_name);
    $event_startdate = mysqli_real_escape_string($conn, $event_startdate);
    $event_enddate = mysqli_real_escape_string($conn, $event_enddate);
    $event_starttime = mysqli_real_escape_string($conn, $event_starttime);
    $event_endtime = mysqli_real_escape_string($conn, $event_endtime);
    $event_location = mysqli_real_escape_string($conn, $event_location);
    $event_state = mysqli_real_escape_string($conn, $event_state);
    $event_country = mysqli_real_escape_string($conn, $event_country);
    $event_numberparticipant = (int) $event_numberparticipant;
    $event_level = mysqli_real_escape_string($conn, $event_level);
    $event_category = mysqli_real_escape_string($conn, $event_category);

    // Insert into event_classification table
    $classificationSql = "INSERT INTO `event-classification` (`level`, category) VALUES ('$event_level', '$event_category')";
    if (mysqli_query($conn, $classificationSql)) {
        $classificationId = mysqli_insert_id($conn);

        // Insert into event table
        $eventSql = "INSERT INTO `event` (`name`, startdate, enddate, `start-time`, `end-time`, `location`, `state`, country, `no-participant`, `event-classificationID`) VALUES ('$event_name', '$event_startdate', '$event_enddate', '$event_starttime', '$event_endtime', '$event_location', '$event_state', '$event_country', $event_numberparticipant, $classificationId)";
        if (mysqli_query($conn, $eventId)) {
            $eventId = mysqli_insert_id($conn);
             // Insert into volunteer table
            $volunteerSql = "INSERT INTO `volunteer` (`position`, studentID) VALUES ('$position', '$event_category')";

            // Insert into speaker table
            $speakeroutsiderSql = "INSERT INTO `speaker-outsider` (`first_name`, `last_name`,`ic_No`, phone_No, email, details, `billing-rate`, eventID) VALUES ('$event_level', '$event_category')";

            // Insert into speaker student table
            $studentSql = "INSERT INTO `student` ( `first_name`, `last_name`, matricnumber, `ic_number`, phoneNo, email) VALUES ('$event_level', '$event_category')";
            $studentId = mysqli_insert_id($conn);
            $speakerstudentSql = "INSERT INTO `speaker-outsider` ( `billing-rate`, studentID, eventID) VALUES ('$event_level', '$event_category')";

            // Insert into vip table
            $vipSql = "INSERT INTO `vip` (`first_name`, `last_name`,`ic_No`, phone_No, email, details, eventID) VALUES ('$event_level', '$event_category')";

            echo "Data inserted successfully!";
        } else {
            echo "Error: " . mysqli_error($conn);
        }
    } else {
        echo "Error: " . mysqli_error($conn);
    }

    // Close the database connection
    mysqli_close($conn);
}
?>

</div>

<?php
    
    // Insert into volunteer table
    $volunteerSql = "INSERT INTO `volunteer` (`position`, studentID) VALUES ('$position', '$event_category')";

    // Insert into speaker table
    $speakerSql = "INSERT INTO `speaker` (`level`, category) VALUES ('$event_level', '$event_category')";

    // Insert into vip table
    $vipSql = "INSERT INTO `vip` (`level`, category) VALUES ('$event_level', '$event_category')";



// Insert into event_classification table
$classificationSql = "INSERT INTO `event-classification` (`level`, category) VALUES ('$event_level', '$event_category')";
if (mysqli_query($conn, $classificationSql)) {
    $classificationId = mysqli_insert_id($conn);

    // Insert into event table
    $eventSql = "INSERT INTO `eventt (`name`, startdate, enddate, `start-time`, `end-time`, `location`, `state`, country, `no-participant`, `event-classificationID`) VALUES ('$event_name', '$event_startdate', '$event_enddate', '$event_starttime', '$event_endtime', '$event_location', '$event_state', '$event_country', $event_numberparticipant, $classificationId)";
    if (mysqli_query($conn, $eventSql)) {
        echo "Data inserted successfully!";
    } else {
        echo "Error: " . mysqli_error($conn);
    }
} else {
    echo "Error: " . mysqli_error($conn);
}

// Close the database connection
mysqli_close($conn);
?>
</div>
