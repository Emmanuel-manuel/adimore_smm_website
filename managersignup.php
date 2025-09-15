<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Manager Signup | SMM website</title>
  <link rel="stylesheet" href="css/managersignup.css">
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <script src="js/jquery.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
</head>
<body>
  <!-- Scroll to top -->
  <button onclick="topFunction()" id="myBtn" title="Go to top">
    <span class="glyphicon glyphicon-chevron-up"></span>
  </button>
  <script>
    window.onscroll = function() {scrollFunction()};
    function scrollFunction(){
      document.getElementById("myBtn").style.display =
        (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) ? "block" : "none";
    }
    function topFunction(){
      document.body.scrollTop = 0;
      document.documentElement.scrollTop = 0;
    }
  </script>

  <!-- Navbar -->
  <nav class="navbar navbar-inverse navbar-fixed-top">
    <div class="container">
      <div class="navbar-header">
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#myNavbar">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="index.php">SMM website</a>
      </div>
      <div class="collapse navbar-collapse" id="myNavbar">
        <ul class="nav navbar-nav">
          <li><a href="index.php">Home</a></li>
          <li><a href="aboutus.php">About</a></li>
          <li><a href="contactus.php">Contact Us</a></li>
        </ul>
        <ul class="nav navbar-nav navbar-right">
          <li class="dropdown active">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-user"></span> Sign Up <span class="caret"></span></a>
            <ul class="dropdown-menu">
              <li><a href="customersignup.php">User Sign-up</a></li>
              <li><a href="managersignup.php">Admin Sign-up</a></li>
            </ul>
          </li>
          <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-log-in"></span> Login <span class="caret"></span></a>
            <ul class="dropdown-menu">
              <li><a href="customerlogin.php">User Login</a></li>
              <li><a href="managerlogin.php">Admin Login</a></li>
            </ul>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <!-- Content -->
  <div class="container">
    <div class="jumbotron text-center">
      <h1>Hi Admin,<br> Welcome to <span class="edit">SMM website</span></h1>
      <p>Create your account below</p>
    </div>

    <div class="col-md-6 col-md-offset-3">
      <div class="panel panel-primary">
        <div class="panel-heading">Create Account</div>
        <div class="panel-body">
          <form role="form" action="manager_registered_success.php" method="POST">
            <div class="form-group">
              <label for="fullname">* Full Name</label>
              <input type="text" class="form-control" id="fullname" name="fullname" placeholder="Your Full Name" required>
            </div>
            <div class="form-group">
              <label for="username">* Username</label>
              <input type="text" class="form-control" id="username" name="username" placeholder="Your Username" required>
            </div>
            <div class="form-group">
              <label for="email">* Email</label>
              <input type="email" class="form-control" id="email" name="email" placeholder="Email" required>
            </div>
            <div class="form-group">
              <label for="contact">* Contact</label>
              <input type="text" class="form-control" id="contact" name="contact" placeholder="Contact" required>
            </div>
            <div class="form-group">
              <label for="password">* Password</label>
              <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
            <p class="mt-2">Already have an account? <a href="managerlogin.php">Login</a></p>
          </form>
        </div>
      </div>
    </div>
  </div>

  <!-- Footer -->
  <footer class="text-center" style="margin-top:20px;">
    <div class="container">
      <p>Copyright 2025 &copy; SMM Panel. All rights reserved.</p>
      <p>Developed by <a href="mailto:emmanuelsystems5@gmail.com">emmanuelSystems</a></p>
    </div>
  </footer>
</body>
</html>
