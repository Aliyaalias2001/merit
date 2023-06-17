<!DOCTYPE html>
<html>

<head>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <link rel="stylesheet" href="organizer_navbar.css">
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
            <a class="dropdown-item" href="organizer_homepage.php">Home Page</a>
            <a class="dropdown-item" href="logout.php">Sign Out</a>
          </div>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="event-form.php">Event Form</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="hostel-form.php">My Account</a>
        </li>
      </ul>
      <form class="form-inline ml-auto">
        <div class="input-group">
          <input class="form-control" type="text" placeholder="Search...">
          <div class="input-group-append">
            <button class="btn btn-primary" type="submit"><i class="fa fa-search"></i></button>
          </div>
        </div>
      </form>
    </div>
  </nav>

  <!-- Dropdown menu script -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.10.2/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
