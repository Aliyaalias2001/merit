<?php
// Include config file
$conn = mysqli_connect("localhost", "root", "admin", "merit");

if (isset($_POST['submit'])) {
  $attendance_fname = $_POST['attendance_fname'];
  $attendance_lname = $_POST['attendance_lname'];
  $attendance_matricnumber = $_POST['attendance_matricnumber'];

  // Check if the student exists in the 'student' table
  $student_query = "SELECT id FROM student WHERE first_name = '$attendance_fname' AND last_name = '$attendance_lname' AND matric_number = '$attendance_matricnumber'";
  $student_result = mysqli_query($conn, $student_query);

  if ($student_result && mysqli_num_rows($student_result) > 0) {
    $student_row = mysqli_fetch_assoc($student_result);
    $student_id = $student_row['id'];

    // Check if the student ID exists in the 'participant' table
    $participant_query = "SELECT id FROM participant WHERE studentID = '$student_id'";
    $participant_result = mysqli_query($conn, $participant_query);

    if ($participant_result && mysqli_num_rows($participant_result) > 0) {
      // Update the 'attendance_status' column to 'filled'
      $update_query = "UPDATE participant SET attendance_status = 'filled' WHERE studentID = '$student_id'";
      mysqli_query($conn, $update_query);

      echo "Attendance recorded successfully.";
    } else {
      echo "Student ID not found in participant table.";
    }
  } else {
    echo "Student not found in the database.";
  }
}

// Close the database connection
mysqli_close($conn);
?>
<!DOCTYPE html>
<html>
<head>
  <title>Attendance Form</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
  <link rel="stylesheet" href="attendance-form.css">
</head>
<body>
  <div class="container">
    <form method="post" action="">
      <div class="form-group">
        <label for="attendance_fname">First Name:</label>
        <input type="text" class="form-control" id="attendance_fname" name="attendance_fname">
      </div>
      <div class="form-group">
        <label for="attendance_lname">Last Name:</label>
        <input type="text" class="form-control" id="attendance_lname" name="attendance_lname">
      </div>
      <div class="form-group">
        <label for="attendance_matricnumber">Matric Number:</label>
        <input type="text" class="form-control" id="attendance_matricnumber" name="attendance_matricnumber">
      </div>
      <input type="submit" class="btn btn-primary" name="submit" value="Submit">
    </form>
  </div>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
</body>
</html>
