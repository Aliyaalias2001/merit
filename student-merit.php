<?php
$conn = mysqli_connect("localhost", "root", "admin", "merit");
session_start();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Student Merit</title>
    
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="student-merit.css">
    <?php include 'staff_navbar.php'; ?>
</head>


<body>
    <div class="container">
        <form class="d-flex" method="POST" action="">
            <input type="text" name="matricNumber" class="form-control" placeholder="Enter Student Matric Number">
            <button type="submit" name="search" class="btn btn-primary"><i class="fa fa-search"></i></button>
        </form>
    </div>

    <table class="table">
        <thead>
            <tr>
                <th>Event Name</th>
                <th>Organizer Name</th>
                <th>Event Category</th>
                <th>Event Level</th>
                <th>Role</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if (isset($_POST['search'])) {
                $matricNumber = $_POST['matricNumber'];

                // Assuming you have a MySQL database connection
                $conn = mysqli_connect("localhost", "root", "admin", "merit");

                // Retrieve student ID based on matric number
                $studentQuery = "SELECT id FROM student WHERE matric_number = '$matricNumber'";
                $studentResult = mysqli_query($conn, $studentQuery);
                $studentRow = mysqli_fetch_assoc($studentResult);
                $studentID = $studentRow['id'];

                // Retrieve event information, organizer information, and role
                $eventQuery = "SELECT e.event_name, o.organizer_name, ec.category, ec.level, 
                                CASE
                                    WHEN p.role IS NOT NULL THEN p.role
                                    WHEN v.role IS NOT NULL THEN v.role
                                    WHEN s.role IS NOT NULL THEN s.role
                                    ELSE 'N/A'
                                END AS role
                            FROM event AS e
                            INNER JOIN organizer AS o ON e.id = o.event_id
                            INNER JOIN event_classification AS ec ON e.classification_id = ec.id
                            LEFT JOIN participant AS p ON e.id = p.event_id AND p.student_id = $studentID
                            LEFT JOIN volunteer AS v ON e.id = v.event_id AND v.student_id = $studentID
                            LEFT JOIN speaker_student AS s ON e.id = s.event_id AND s.student_id = $studentID";
                $eventResult = mysqli_query($conn, $eventQuery);

                while ($row = mysqli_fetch_assoc($eventResult)) {
                    echo "<tr>";
                    echo "<td>" . $row['event_name'] . "</td>";
                    echo "<td>" . $row['organizer_name'] . "</td>";
                    echo "<td>" . $row['category'] . "</td>";
                    echo "<td>" . $row['level'] . "</td>";
                    echo "<td>" . $row['role'] . "</td>";
                    echo "</tr>";
                }

                mysqli_close($conn);
            }
            ?>
        </tbody>
    </table>

    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
</body>
</html>
