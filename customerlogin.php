<?php
include('login_u.php'); 

if(isset($_SESSION['login_user2'])){
  header("location: userdashboard.php");
  exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Guest Login | SMM Website</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <script src="js/jquery.min.js"></script>
  <script src="js/bootstrap.min.js"></script>

  <style>
    body {
      padding-top: 70px;
      background-color: #f8f9fa;
      font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
    }
    .jumbotron {
      background: white;
      padding: 40px;
      border-radius: 10px;
      box-shadow: 0px 5px 20px rgba(0,0,0,0.1);
    }
    footer {
      background-color: #2c3e50;
      color: white;
      padding: 30px 0;
      margin-top: 40px;
    }
    footer h4 { font-weight: bold; margin-bottom: 15px; }
    footer ul { list-style: none; padding: 0; }
    footer ul li { margin-bottom: 8px; }
    footer ul li a { color: #ddd; text-decoration: none; transition: color 0.3s; }
    footer ul li a:hover { color: #fff; }
  </style>
</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-inverse navbar-fixed-top">
  <div class="container">
    <div class="navbar-header">
      <button type="button" 
              class="navbar-toggle collapsed" 
              data-toggle="collapse" 
              data-target="#myNavbar">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="index.php">SMM Website</a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav">
        <li><a href="index.php">Home</a></li>
        <li><a href="aboutus.php">About</a></li>
        <li><a href="contactus.php">Contact Us</a></li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <li class="dropdown">
          <a href="#" class="dropdown-toggle active" data-toggle="dropdown">
            <span class="glyphicon glyphicon-user"></span> Sign Up <span class="caret"></span>
          </a>
          <ul class="dropdown-menu">
            <li><a href="customersignup.php">User Sign-up</a></li>
          </ul>
        </li>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle active" data-toggle="dropdown">
            <span class="glyphicon glyphicon-log-in"></span> Login <span class="caret"></span>
          </a>
          <ul class="dropdown-menu">
            <li><a href="customerlogin.php">User Login</a></li>
            <li><a href="managerlogin.php">Admin Login</a></li>
          </ul>
        </li>
      </ul>
    </div>
  </div>
</nav>

<!-- Hero -->
<div class="container">
  <div class="jumbotron text-center">
    <h1>Hi Guest,<br> Welcome to <span class="edit">SMM Website</span></h1>
    <p class="lead">Kindly LOGIN to continue.</p>
  </div>
</div>

<!-- Login Form -->
<div class="container" style="margin-top: 4%; margin-bottom: 4%;">
  <div class="row justify-content-center">
    <div class="col-md-6 col-sm-12">
      <div class="panel panel-primary">
        <div class="panel-heading">Login</div>
        <div class="panel-body">
          <form action="" method="POST">
            <div class="form-group">
              <label for="username">Username <span class="text-danger">*</span></label>
              <div class="input-group">
                <input class="form-control" id="username" type="text" name="username" placeholder="Username" required autofocus>
                <span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>
              </div>
            </div>
            <div class="form-group">
              <label for="password">Password <span class="text-danger">*</span></label>
              <div class="input-group">
                <input class="form-control" id="password" type="password" name="password" placeholder="Password" required>
                <span class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></span>
              </div>
            </div>
            <button class="btn btn-primary btn-block" name="submit" type="submit">Login</button>
            <p class="text-center mt-3">or</p>
            <p class="text-center"><a href="customersignup.php">Create a new account</a></p>
          </form>
          <p class="text-danger text-center"><?php echo $error; ?></p>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Footer -->
<footer>
  <div class="container">
    <div class="row">
      <div class="col-md-6 col-sm-6">
        <h4>QUICK ACCESS</h4>
        <ul>
          <li><a href="customersignup.php">Register</a></li>
          <li><a href="customerlogin.php">Log In</a></li>
          <li><a href="faq.php">FAQ</a></li>
          <li><a href="aboutus.php">Our Story</a></li>
        </ul>
      </div>
      <div class="col-md-6 col-sm-6">
        <h4>LEGAL</h4>
        <ul>
          <li><a href="terms.php">Terms & Conditions</a></li>
          <li><a href="terms.php#privacy">Privacy Policy</a></li>
          <li><a href="terms.php#refund">Refund Policy</a></li>
          <li><a href="contactus.php">Need Help?</a></li>
        </ul>
      </div>
    </div>
    <hr>
    <p class="text-center">Copyright 2025 &copy; SMM Panel. All rights reserved.</p>
    <p class="text-center">Developed by 
      <a href="mailto:emmanuelsystems5@gmail.com">emmanuelSystems</a>
    </p>
  </div>
</footer>

</body>
</html>
