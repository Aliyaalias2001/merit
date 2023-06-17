<?php
$conn = mysqli_connect("localhost", "root", "admin", "merit");
session_start();

// Function to retrieve event ID from event name
function getEventIdFromName($eventName, $conn)
{
  $safeEventName = mysqli_real_escape_string($conn, $eventName);
  $query = "SELECT id FROM eventt WHERE name = '$safeEventName'";
  $result = mysqli_query($conn, $query);
  if ($row = mysqli_fetch_assoc($result)) {
    return $row['id'];
  }
  return null;
}
?>

<!DOCTYPE html>
<html>

<head>
  <title>Past Event</title>

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <link rel="stylesheet" href="staff-past-event.css">
  <?php include 'staff_navbar.php'; ?>
</head>

<body>
  <br>
  <div class="container">
    <h1>Past Event</h1>
    <hr>

    <?php
    // Check for connection errors
    if (mysqli_connect_errno()) {
      echo "Failed to connect to MySQL: " . mysqli_connect_error();
      exit();
    }

    // Query the events table for past events
    $query = "SELECT name, startdate, enddate, location, state, country FROM eventt WHERE enddate < CURDATE() ORDER BY enddate ASC";
    $result = mysqli_query($conn, $query);

    // Display the past events in a table
    echo "<table class='table table-striped'>
                  <thead>
                      <tr>
                          <th>Name</th>
                          <th>Date</th>
                          <th>Location</th>
                      </tr>
                  </thead>
                  <tbody>";
    while ($row = mysqli_fetch_assoc($result)) {
      $eventId = getEventIdFromName($row['name'], $conn);

      echo "<tr>
                        <td><a href='event_page.php?id=$eventId'>" . $row['name'] . "</a></td>
                        <td>" . $row['startdate'] . " to " . $row['enddate'] . "</td>
                        <td>" . $row['location'] . ", " . $row['state'] . ", " . $row['country'] . "</td>
                      </tr>";
    }

    echo "</tbody></table>";

    // Close the database connection
    mysqli_close($conn);
    ?>
  </div>

  <!-- Bootstrap JavaScript libraries -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.10.2/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

  <!-- Dropdown menu script -->
  <script>
    $(document).ready(function() {
      $('.dropdown-toggle').dropdown();
    });
  </script>
</body>

</html>
