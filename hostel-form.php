<!DOCTYPE html>
<html>
<head>
  <title>Hostel Form</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="hostel-form.css">
  <script type="text/javascript" src="hostel-form-application-type.js"></script>
</head>
<body>
<?php include 'staff_navbar.php'; ?>
<br><br>
<div class="container">
  <div class="py-3">
    <h2>Hostel Form</h2>
  </div>
  <hr>

  <form method="post" enctype="multipart/form-data">
    <div class="row">
      <div class="col-md-6">
        <div class="form-group">
          <label for="name">Name:</label>
          <input type="text" name="name" id="name" class="form-control" required>
        </div>

        <div class="form-group">
          <label for="matric-number">Matric Number:</label>
          <input type="text" name="matric_number" id="matric-number" class="form-control" required>
        </div>

        <div class="form-group">
          <label for="ic-number">IC Number:</label>
          <input type="text" name="ic_number" id="ic-number" class="form-control" required>
        </div>
      </div>
      <div class="col-md-6">
        <div class="form-group">
          <label for="tel-no">Tel No:</label>
          <input type="number" name="tel_no" id="tel-no" class="form-control" required>
        </div>

        <div class="form-group">
          <label for="merit-marks">Merit Marks:</label>
          <input type="number" name="merit_marks" id="merit-marks" class="form-control" min="0" required>
        </div>

        <div class="form-group">
          <label for="application-type">Application Type:</label>
          <select name="application_type" id="application-type" class="form-control">
            <option value="health-problem">Health Problem</option>
            <option value="normal-student">Normal Student</option>
            <option value="uniformed-troops">Uniformed Troops</option>
          </select>
        </div>

        <div class="form-group">
          <label for="hospital-letter" id="hospital-letter-label">Hospital letter (only for students with health problem):</label>
          <input type="file" name="hospital_letter" id="hospital-letter" accept="image/*" class="form-control-file" required>
        </div>

        <div class="form-group">
          <label for="uniformed-number" id="uniformed-number-label">Uniformed No (only for Uniformed Troops students):</label>
          <input type="number" name="uniformed_number" id="uniformed-number" class="form-control" required>
        </div>
      </div>
    </div>

    <div class="button-container mt-4">
      <input type="submit" id="next" name="submit" value="Submit" class="btn btn-primary">
      <hr>
    </div>
    <script type="text/javascript" src="hostel-form-application-type.js"></script>
  </form>
</div>
</body>
</html>
