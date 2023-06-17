<?php

$conn = mysqli_connect("localhost", "root", "admin", "merit");
session_start();

// Retrieve event ID from URL query parameter
if (!isset($_GET['id'])) {
    // Handle error when event ID is not provided
    // Redirect or display an error message
}

$eventId = $_GET['id'];

// Fetch event details from the database based on the event ID
$query = "SELECT * FROM eventt WHERE id = $eventId";
$result = mysqli_query($conn, $query);
if (!$result || mysqli_num_rows($result) == 0) {
    // Handle error when event is not found
    // Redirect or display an error message
}

$row = mysqli_fetch_assoc($result);
$name = $row['name'];
$startdate = $row['startdate'];
$enddate = $row['enddate'];
$starttime = $row['start-time'];
$endtime = $row['end-time'];
$location = $row['location'];
$state = $row['state'];
$country = $row['country'];
$numberparticipant = $row['no-participant'];



// Fetch list of participants, VIPs, and speakers for the event
// You can modify the queries based on your database schema and table structure
$participantsQuery = "SELECT * FROM participant WHERE eventID = $eventId";
$participantsResult = mysqli_query($conn, $participantsQuery);

$vipsQuery = "SELECT * FROM vip WHERE eventID = $eventId";
$vipsResult = mysqli_query($conn, $vipsQuery);

$speakersOutsideQuery = "SELECT * FROM `speaker-outsider` WHERE eventID = $eventId";
$speakersOutsideResult = mysqli_query($conn, $speakersOutsideQuery);

$speakersStudentQuery = "SELECT * FROM `speaker-student` WHERE eventID = $eventId";
$speakersStudentResult = mysqli_query($conn, $speakersStudentQuery);

// Close the database connection
mysqli_close($conn);
?>

<!DOCTYPE html>
<html>
<head>
    <title><?php echo $name; ?></title>
    <!-- Include CSS and other necessary stylesheets -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <!-- Display event details on the event page -->
    <div class="container">
        <h1><?php echo $name; ?></h1>
        <p>Date: <?php echo $startdate; ?></p>
        <p>Time: <?php echo $starttime; ?></p>
        <p>Place: <?php echo $location; ?></p>
        <!-- Display other event details -->

        <!-- Display list of participants -->
        <?php if (mysqli_num_rows($participantsResult) > 0) { ?>
            <h2>Participants</h2>
            <ul class="list-group">
                <?php while ($participant = mysqli_fetch_assoc($participantsResult)) { ?>
                    <li class="list-group-item"><?php echo $participant['name']; ?></li>
                <?php } ?>
            </ul>
        <?php } ?>

        <!-- Display list of VIPs -->
        <?php if (mysqli_num_rows($vipsResult) > 0) { ?>
            <h2>VIPs</h2>
            <ul class="list-group">
                <?php while ($vip = mysqli_fetch_assoc($vipsResult)) { ?>
                    <li class="list-group-item"><?php echo $vip['name']; ?></li>
                <?php } ?>
            </ul>
        <?php } ?>

        <!-- Display list of speakers -->
        <?php if (mysqli_num_rows($speakersOutsideResult) > 0 || mysqli_num_rows($speakersStudentResult) > 0) { ?>
            <h2>Speakers</h2>
            <ul class="list-group">
                <?php while ($speaker = mysqli_fetch_assoc($speakersOutsideResult)) { ?>
                    <li class="list-group-item"><?php echo $speaker['name']; ?></li>
                <?php } ?>
                <?php while ($speaker = mysqli_fetch_assoc($speakersStudentResult)) { ?>
                    <li class="list-group-item"><?php echo $speaker['name']; ?></li>
                <?php } ?>
            </ul>
        <?php } ?>

        <!-- Add more HTML and styling as needed -->
    </div>

    <!-- Bootstrap JavaScript libraries -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.10.2/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>



<!DOCTYPE html>
<html>
<head>
    <title>Generate QR Code</title>
    <!-- Include Bootstrap CSS and other necessary stylesheets -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <!-- Display QR code and button to generate it -->
        <img id="qrCodeImage" src="#" alt="QR Code" class="img-fluid">
        <br>
        <button id="generateQRButton" class="btn btn-primary" onclick="generateQR(<?php echo $eventId; ?>)">Generate QR</button>
    </div>

    <!-- Include jQuery and Bootstrap JavaScript libraries -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <script>
        function generateQR(eventId) {
            // Redirect to qrcode-generator.php with the event ID as a query parameter
            window.location.href = 'qrcode-generator.php?id=' + eventId;
        }
    </script>
</body>
</html>
