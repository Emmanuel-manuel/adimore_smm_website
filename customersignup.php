<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Guest Signup | SMM Website</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <!-- <link rel="stylesheet" href="css/managersignup.css"> -->
  <script src="js/jquery.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <style>
    body,
    html {
      height: 100%;
    }

    body {
      padding-top: 70px;
      /* better space for fixed navbar */
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
      background-color: green;
      color: white;
      cursor: pointer;
      padding: 12px 16px;
      border-radius: 50%;
      transition: background 0.3s ease;
    }

    #myBtn:hover {
      background-color: darkgreen;
    }

    .edit {
      text-shadow: 2px 2px 5px lightgreen;
      color: green;
    }

    footer {
      background: #2f2f2f;
      color: #fff;
      margin-top: 40px;
      padding: 15px 0;
    }

    .card {
      border-radius: 10px;
    }

    .card-header {
      border-top-left-radius: 10px;
      border-top-right-radius: 10px;
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
      color: #f1f1f1;
    }

    footer ul {
      padding: 0;
      list-style: none;
    }

    footer ul li {
      margin-bottom: 8px;
    }

    footer ul li a {
      color: #ddd;
      text-decoration: none;
      transition: color 0.3s ease;
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
      if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
        document.getElementById("myBtn").style.display = "block";
      } else {
        document.getElementById("myBtn").style.display = "none";
      }
    }
    function topFunction() {
      window.scrollTo({ top: 0, behavior: 'smooth' });
    }
  </script>

  <!-- Navbar -->
  <nav class="navbar navbar-inverse navbar-fixed-top navigation-clean-search">
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
      <h1>Hi Guest, <br> Welcome to <span class="edit">SMM Website</span></h1>
      <p class="lead">Get started by creating your account</p>
    </div>
  </div>

  <!-- Signup Form -->
  <div class="container" style="margin-top: 4%; margin-bottom: 4%;">
    <div class="row justify-content-center">
      <div class="col-md-6 col-sm-12">
        <div class="card border-primary shadow-lg">
          <div class="card-header bg-primary text-white">
            <h4 class="mb-0">Create Account</h4>
          </div>
          <div class="card-body">
            <form action="customer_registered_success.php" method="POST">

              <div class="form-group">
                <label for="fullname">Full Name <span class="text-danger">*</span></label>
                <div class="input-group">
                  <input class="form-control" id="fullname" type="text" name="fullname" placeholder="Your Full Name" required autofocus>
                  <span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>
                </div>
              </div>

              <div class="form-group">
                <label for="username">Username <span class="text-danger">*</span></label>
                <div class="input-group">
                  <input class="form-control" id="username" type="text" name="username" placeholder="Your Username" required>
                  <span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>
                </div>
              </div>

              <div class="form-group">
                <label for="email">Email <span class="text-danger">*</span></label>
                <div class="input-group">
                  <input class="form-control" id="email" type="email" name="email" placeholder="Email" required>
                  <span class="input-group-addon"><span class="glyphicon glyphicon-envelope"></span></span>
                </div>
              </div>

              <div class="form-group">
                <label for="contact">Contact <span class="text-danger">*</span></label>
                <div class="input-group">
                  <input class="form-control" id="contact" type="text" name="contact" placeholder="Contact" required>
                  <span class="input-group-addon"><span class="glyphicon glyphicon-phone"></span></span>
                </div>
              </div>

              <div class="form-group">
                <label for="password">Password <span class="text-danger">*</span></label>
                <div class="input-group">
                  <input class="form-control" id="password" type="password" name="password" placeholder="Password" required>
                  <span class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></span>
                </div>
              </div>

              <button class="btn btn-primary btn-block" type="submit">Submit</button>
              <p class="text-center mt-3">or</p>
              <p class="text-center"><a href="customerlogin.php">Have an account? Login.</a></p>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Footer -->
  <footer>
      <div class="container">
        <div class="row">
          <!-- Quick Access -->
          <div class="col-md-6 col-sm-6">
            <h4>QUICK ACCESS</h4>
            <ul class="list-unstyled">
              <li><a href="customersignup.php">Register</a></li>
              <li><a href="customerlogin.php">Log In</a></li>
              <li><a href="faq.php">FAQ</a></li>
              <li><a href="aboutus.php">Our Story</a></li>
            </ul>
          </div>
          <!-- Legal -->
          <div class="col-md-6 col-sm-6">
            <h4>LEGAL</h4>
            <ul class="list-unstyled">
              <li><a href="terms.php">Terms & Conditions</a></li>
              <li><a href="terms.php#privacy">Privacy Policy</a></li>
              <li><a href="terms.php#refund">Refund Policy</a></li>
              <li><a href="contactus.php">Need Help?</a></li>
            </ul>
          </div>
        </div>
        <hr>
        <p class="text-center">Copyright 2025 &copy; SMM Panel. All rights reserved.</p>
        <p class="text-center">Developed by <a href="mailto:emmanuelsystems5@gmail.com">emmanuelSystems</a></p>
      </div>
    </footer>

    <!-- JavaScript -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@3.4.1/dist/js/bootstrap.min.js"></script>
    
    <script>
      // Character counter for message textarea
      $(document).ready(function(){
        $('#message').keyup(function(){
          var max = 250;
          var len = $(this).val().length;
          var char = max - len;
          $('#characterLeft').text(char + ' characters remaining');
          
          if (char < 0) {
            $('#characterLeft').css('color', 'red');
          } else {
            $('#characterLeft').css('color', 'gray');
          }
        });
      });
    </script>
</body>
</html>
