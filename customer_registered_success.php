<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>User Registered | SMM Website</title>
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

    #myBtn {
      display: none;
      position: fixed;
      bottom: 20px;
      right: 30px;
      z-index: 99;
      border: none;
      outline: none;
      background-color: #4a89dc;
      color: white;
      cursor: pointer;
      padding: 12px 16px;
      border-radius: 50%;
      font-size: 18px;
    }
    #myBtn:hover {
      background-color: #3a79cc;
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
    footer h4 {
      font-weight: bold;
      margin-bottom: 15px;
    }
    footer ul {
      list-style: none;
      padding: 0;
    }
    footer ul li {
      margin-bottom: 8px;
    }
    footer ul li a {
      color: #ddd;
      text-decoration: none;
      transition: color 0.3s;
    }
    footer ul li a:hover {
      color: #fff;
    }
  </style>
</head>
<body>

<!-- Scroll to Top -->
<button onclick="topFunction()" id="myBtn" title="Go to top">
  <span class="glyphicon glyphicon-chevron-up"></span>
</button>
<script>
  window.onscroll = function() {scrollFunction()};
  function scrollFunction(){
    document.getElementById("myBtn").style.display =
      (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20)
      ? "block" : "none";
  }
  function topFunction() {
    window.scrollTo({top: 0, behavior: 'smooth'});
  }
</script>

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
        <li class="active"><a href="index.php">Home</a></li>
        <li><a href="aboutus.php">About</a></li>
        <li><a href="contactus.php">Contact Us</a></li>
      </ul>
    </div>
  </div>
</nav>

<?php
require 'connection.php';
$conn = Connect();

$fullname = $conn->real_escape_string($_POST['fullname']);
$username = $conn->real_escape_string($_POST['username']);
$email    = $conn->real_escape_string($_POST['email']);
$contact  = $conn->real_escape_string($_POST['contact']);

// 🔐 Encrypt password before storing
$password_plain = $_POST['password'];
$password = password_hash($password_plain, PASSWORD_DEFAULT);

$query = "INSERT INTO customer(fullname, username, email, contact, password) 
          VALUES('$fullname', '$username', '$email', '$contact', '$password')";
$success = $conn->query($query);

if (!$success){
    die("Could not enter data: ".$conn->error);
}
$conn->close();
?>

<!-- Success Message -->
<div class="container">
  <div class="jumbotron text-center">
    <h2>Welcome <?php echo $fullname; ?>!</h2>
    <h3>Your account has been created successfully.</h3>
    <p>Login Now from <a href="customerlogin.php">HERE</a></p>
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
