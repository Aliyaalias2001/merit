<!DOCTYPE html>
<html>

<head>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <link rel="stylesheet" href="staff_navbar.css">
</head>

<body>
  <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown"
      aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavDropdown">
      <ul class="navbar-nav">
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown1" role="button" data-toggle="dropdown"
            aria-haspopup="true" aria-expanded="false">
            <i class="fa fa-star-o"></i>
          </a>
          <div class="dropdown-menu" aria-labelledby="navbarDropdown1">
            <a class="dropdown-item" href="staff_homepage.php">Home Page</a>
            <a class="dropdown-item" href="staff-past-event.php">Past Event</a>
            <a class="dropdown-item" href="logout.php">Sign Out</a>
          </div>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown2" role="button" data-toggle="dropdown"
            aria-haspopup="true" aria-expanded="false">
            Event
          </a>
          <div class="dropdown-menu" aria-labelledby="navbarDropdown2">
            <a class="dropdown-item" href="event-form.php">Event Form</a>
            <a class="dropdown-item" href="event-request.php">Event Request</a>
          </div>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown3" role="button" data-toggle="dropdown"
            aria-haspopup="true" aria-expanded="false">
            Student Hostel
          </a>
          <div class="dropdown-menu" aria-labelledby="navbarDropdown3">
            <a class="dropdown-item" href="hostel-form.php">Hostel Form</a>
            <a class="dropdown-item" href="student-merit-top250.html">Hostel Request</a>
          </div>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown4" role="button" data-toggle="dropdown"
            aria-haspopup="true" aria-expanded="false">
            Merit
          </a>
          <div class="dropdown-menu" aria-labelledby="navbarDropdown4">
            <a class="dropdown-item" href="student-merit.php">Student Merit</a>
            <a class="dropdown-item" href="student-merit-top250.php">Top 250</a>
            <a class="dropdown-item" href="student-merit-top50-category.php">Top 50 by Category</a>
          </div>
        </li>
      </ul>
      <form class="form-inline ml-auto">
        <div class="search-bar">
          <!-- Wrap the search bar in a container -->
          <input class="form-control mr-sm-2" type="text" placeholder="Search...">
          <button class="btn btn-outline-primary my-2 my-sm-0" type="submit"><i class="fa fa-search"></i></button>
        </div>
      </form>
    </div>
  </nav>

  <!-- Dropdown menu script -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.10.2/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

  <script>
    // Add 'active-link' class to the currently selected menu item
    $(document).ready(function () {
      var url = window.location.pathname;
      var filename = url.substring(url.lastIndexOf("/") + 1);
      $('.nav-link[href="' + filename + '"]').addClass('active-link');
    });
  </script>

</body>

</html>
