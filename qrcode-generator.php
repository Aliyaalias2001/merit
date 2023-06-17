<?php
require_once "phpqrcode/qrlib.php";

// Retrieve event ID from URL query parameter
if (!isset($_GET['id'])) {
    // Handle error when event ID is not provided
    // Redirect or display an error message
    echo "Event ID not provided";
    exit;
}

$eventId = $_GET['id'];
echo "Event ID: " . $eventId;

// Fetch event details from the database based on the event ID
$conn = mysqli_connect("localhost", "root", "admin", "merit");

$query = "SELECT * FROM eventt WHERE id = $eventId";
$result = mysqli_query($conn, $query);

if (!$result || mysqli_num_rows($result) == 0) {
    // Event not found, return an error message
    echo "Event not found";
    exit;
}

$row = mysqli_fetch_assoc($result);
$startDate = $row['startdate'];
$endDate = $row['enddate'];
$startTime = $row['start-time'];
$endTime = $row['end-time'];

// Convert event dates and times to Unix timestamps
$startTimestamp = strtotime("$startDate $startTime");
$endTimestamp = strtotime("$endDate $endTime");
$currentTimestamp = time();

// Check if the current date and time are within the event's date and time range
if ($currentTimestamp < $startTimestamp || $currentTimestamp > $endTimestamp) {
    // Current date and time are outside the event's range, return an error message
    echo "Event is not currently active";
    exit;
}

// Generate a unique filename for the QR code image
$qrFilename = "qrcodes/event_$eventId.png";

// Generate the QR code image
$attendanceFormUrl = "http://localhost:8080/merit/attendance-form.php?id=$eventId";
QRcode::png($attendanceFormUrl, $qrFilename, QR_ECLEVEL_L, 10);

// Return the filename of the generated QR code image
echo $qrFilename;
exit;
?>
