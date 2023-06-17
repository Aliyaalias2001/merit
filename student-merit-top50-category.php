<!DOCTYPE html>
<html>
<head>
    <title>Top 50 by Category</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="student-merit-top50-category.css">
    <?php include 'staff_navbar.php'; ?>
    
</head>
<body>
    <div class="container">
        <h1 class="mt-5">Top 50 by Category</h1>
        <br>

        <?php
        // Establish database connection (Replace host, username, password, and dbname with your database details)
        $conn = mysqli_connect('localhost', 'root', 'admin', 'merit');
        
        // Check connection
        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }

        // Array to store the category titles
        $categories = ['Culture', 'Leadership', 'Sports', 'Entrepreneurship', 'Volunteering', 'Spiritually', 'Profession'];

        // Loop through each category
        foreach ($categories as $category) {
            echo '<h2 class="category-title">' . $category . '</h2>';
            echo '<hr>';
            echo '<table class="table table-striped table-bordered">';
            echo '<thead class="thead-dark">';
            echo '<tr>';
            echo '<th>No.</th>';
            echo '<th>Matric Number</th>';
            echo '<th>Name</th>';
            echo '<th>Course</th>';
            echo '<th>Marks</th>';
            echo '<th>Star</th>';
            echo '</tr>';
            echo '</thead>';
            echo '<tbody>';

            // Retrieve top 50 students with the highest merit marks for the current category
            $query = "SELECT s.matric_number, s.name, s.course, m.marks
                      FROM students AS s
                      INNER JOIN merit_marks AS m ON s.student_id = m.student_id
                      WHERE m.category = '$category'
                      ORDER BY m.marks DESC
                      LIMIT 50";
            $result = mysqli_query($conn, $query);

            // Counter variable for numbering the rows
            $counter = 1;

            // Loop through the result set and generate dynamic rows
            while ($row = mysqli_fetch_assoc($result)) {
                echo '<tr>';
                echo '<td>' . $counter . '</td>';
                echo '<td>' . $row['matric_number'] . '</td>';
                echo '<td>' . $row['name'] . '</td>';
                echo '<td>' . $row['course'] . '</td>';
                echo '<td>' . $row['marks'] . '</td>';
                echo '<td><i class="fa fa-star"></i></td>';
                echo '</tr>';
                $counter++;
            }

            echo '</tbody>';
            echo '</table>';
        }

        // Close the database connection
        mysqli_close($conn);
        ?>

    </div>

    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
</body>
</html>
