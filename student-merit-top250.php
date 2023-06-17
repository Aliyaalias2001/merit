<!DOCTYPE html>
<html>
<head>
    <title>Top 250 Highest Merit</title>
    
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="student-merit-top250.css">
    <?php include 'staff_navbar.php'; ?>
</head>
<body>
    <div class="container">
        <h1 class="mt-5">Top 250 Highest Merit</h1>
        <hr>
        <table id="my-event" class="table table-striped table-bordered">
            <thead class="thead-dark">
                <tr>
                    <th>No.</th>
                    <th>Matric Number</th>
                    <th>Name</th>
                    <th>Course</th>
                    <th>Marks</th>
                    <th>Star</th>
                </tr>
            </thead>
            <tbody>
            <?php
            // Assuming you have a MySQL database connection
            $conn = mysqli_connect("localhost", "root", "admin", "merit");

            // Retrieve event information, organizer information, and role
            $top250Query = "SELECT s.student_name, s.matric_number, s.course, SUM(ec.level * CASE
                WHEN p.role IS NOT NULL THEN p.role
                WHEN v.role IS NOT NULL THEN v.role
                WHEN ss.role IS NOT NULL THEN ss.role
                ELSE 0
            END) AS total_merit_marks
            FROM student AS s
            LEFT JOIN participant AS p ON s.student_id = p.student_id
            LEFT JOIN volunteer AS v ON s.student_id = v.student_id
            LEFT JOIN `speaker-student` AS ss ON s.student_id = ss.student_id
            LEFT JOIN eventt AS e ON p.event_id = e.event_id OR v.event_id = e.event_id OR ss.event_id = e.event_id
            LEFT JOIN `event-classification` AS ec ON e.classification_id = ec.classification_id
            GROUP BY s.firstname, s.matric_number, s.course
            ORDER BY total_merit_marks DESC
            LIMIT 250";

            $eventResult = mysqli_query($conn, $top250Query);
            $counter = 1;

            while ($row = mysqli_fetch_assoc($eventResult)) {
                echo "<tr>";
                echo "<td>" . $counter . "</td>";
                echo "<td>" . $row['matric_number'] . "</td>";
                echo "<td>" . $row['firstname'] . "</td>";
                echo "<td>" . $row['course'] . "</td>";
                echo "<td>" . $row['total_merit_marks'] . "</td>";
                echo "<td><i class='fa fa-star text-warning'></i></td>";
                echo "</tr>";
                $counter++;
            }

            mysqli_close($conn);
            ?>
            </tbody>
        </table>
    </div>

    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
</body>
</html>
