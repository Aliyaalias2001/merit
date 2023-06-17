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
    <title>Organizer Homepage</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="staff-homepage.css">
   
</head>

<body>
    <?php include 'organizer_navbar.php'; ?>

    <br>

    <div class="slideshow-container">
        <?php
        $sql = "SELECT * FROM `images`";
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) == 0) {
            die("File does not exist.");
        }
        $count = 1;
        while ($row = mysqli_fetch_object($result)) {
            $imageData = $row->image;
            $imageType = $row->type;
        ?>
            <div class="mySlides fade">
                <img src="data:<?php echo $imageType; ?>;base64,<?php echo base64_encode($imageData); ?>" alt="Slideshow Image">
            </div>
        <?php
            $count++;
        }
        ?>
    </div>

    <br>

    <div style="text-align:center">
        <?php
        for ($i = 1; $i <= mysqli_num_rows($result); $i++) {
        ?>
            <span class="dot" onclick="currentSlide(<?php echo $i; ?>)"></span>
        <?php
        }
        ?>
    </div>

    <script type="text/javascript" src="staff-homepage-slideshow.js"></script>

    <br><br>

    <div class="container">
        <div class="mt-4">
            <h1 class="text-center">Upcoming Event</h1>
            <hr class="my-4">
        </div>

        <?php
        // Check for connection errors
        if (mysqli_connect_errno()) {
            echo "Failed to connect to MySQL: " . mysqli_connect_error();
            exit();
        }

        // Query the events table for upcoming events
        $query = "SELECT name, startdate, enddate, location, state, country FROM eventt WHERE enddate >= CURDATE() ORDER BY enddate ASC";
        $result = mysqli_query($conn, $query);

        // Display the upcoming events in a table
        echo "<div class='table-responsive'>
                <table id='upcoming-event' class='table table-striped table-bordered'>
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

        echo "</tbody></table>
            </div>";

        // Close the result set
        mysqli_free_result($result);
        ?>

        <h1>Past Event</h1>
        <hr>

        <?php
        // Query the events table for past events
        $query = "SELECT name, startdate, enddate, location, state, country FROM eventt WHERE enddate < CURDATE() ORDER BY enddate ASC";
        $result = mysqli_query($conn, $query);

        // Display the past events in a table
        echo "<div class='table-responsive'>
                  <table class='table table-striped'>
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

        echo "</tbody></table>
            </div>";

        // Close the result set
        mysqli_free_result($result);
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
