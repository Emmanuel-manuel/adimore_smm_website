<?php
session_start();

// Process form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {
  require 'connection.php';
  $conn = Connect();

  $Name = $conn->real_escape_string($_POST['name']);
  $Email_Id = $conn->real_escape_string($_POST['email']);
  $Mobile_No = $conn->real_escape_string($_POST['mobile']);
  $Subject = $conn->real_escape_string($_POST['subject']);
  $Message = $conn->real_escape_string($_POST['message']);

  $query = "INSERT INTO contact (Name, Email, Mobile, Subject, Message) VALUES ('$Name', '$Email_Id', '$Mobile_No', '$Subject', '$Message')";
  $success = $conn->query($query);

  if ($success) {
      $success_message = "Your message has been sent successfully!";
  } else {
      $error_message = "Error: " . $conn->error;
  }

  $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact | SMM Website</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.4.1/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
      body {
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        background-color: #f8f9fa;
        color: #333;
        padding-top: 70px; /* Adjusted for fixed navbar */
      }
      
      .navbar-brand {
        font-weight: bold;
        color: #4a89dc !important;
      }
      
      .heading {
        text-align: center;
        padding: 40px 0 20px;
        font-size: 28px;
        color: #4a89dc;
        font-weight: bold;
      }
      
      .heading .edit {
        color: #2c3e50;
      }
      
      .line {
        padding: 0;
      }
      
      .form-area {
        background-color: white;
        padding: 30px;
        border-radius: 8px;
        box-shadow: 0 5px 15px rgba(0,0,0,0.05);
        margin-bottom: 30px;
      }
      
      .help-block {
        color: #666;
        font-size: 12px;
      }
      
      #characterLeft {
        color: gray;
      }
      
      .whatsapp-float {
        position: fixed;
        width: 60px;
        height: 60px;
        bottom: 40px;
        left: 40px;
        background-color: #25d366;
        color: #FFF;
        border-radius: 50px;
        text-align: center;
        font-size: 30px;
        box-shadow: 2px 2px 3px #999;
        z-index: 100;
        display: flex;
        align-items: center;
        justify-content: center;
        text-decoration: none;
      }
      
      .whatsapp-text {
        display: none;
      }
      
      footer {
        background-color: #2c3e50;
        color: white;
        padding: 20px 0;
        margin-top: 40px;
        text-align: center;
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
        padding: 12px 15px;
        border-radius: 50%;
        font-size: 18px;
      }
      
      #myBtn:hover {
        background-color: #3a79cc;
      }
      
      /* Responsive adjustments */
      @media (max-width: 767px) {
        body {
          padding-top: 60px;
        }
        
        .heading {
          font-size: 22px;
          padding: 30px 15px 15px;
        }
        
        .form-area {
          padding: 20px;
        }
        
        .whatsapp-float {
          width: 50px;
          height: 50px;
          bottom: 30px;
          left: 30px;
          font-size: 24px;
        }
      }
      
      @media (max-width: 480px) {
        .heading {
          font-size: 20px;
        }
        
        .form-area {
          padding: 15px;
        }
        
        .whatsapp-float {
          width: 45px;
          height: 45px;
          bottom: 20px;
          left: 20px;
          font-size: 20px;
        }
      }
    </style>
  </head>

  <body>
    <!-- Back to Top Button -->
    <button onclick="topFunction()" id="myBtn" title="Go to top">
      <span class="glyphicon glyphicon-chevron-up"></span>
    </button>
  
    <script type="text/javascript">
      window.onscroll = function() { scrollFunction(); };
    
      function scrollFunction(){
        document.getElementById("myBtn").style.display = 
          (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) 
          ? "block" : "none";
      }
    
      function topFunction() {
        document.body.scrollTop = 0;
        document.documentElement.scrollTop = 0;
      }
    </script>

    <!-- Navbar -->
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#myNavbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="index.php">ADIMORE-SMM</a>
        </div>

        <div class="collapse navbar-collapse" id="myNavbar">
          <ul class="nav navbar-nav">
            <li><a href="index.php">Home</a></li>
            <li><a href="aboutus.php">About</a></li>
            <li class="active"><a href="contactus.php">Contact Us</a></li>
          </ul>

          <?php
          if(isset($_SESSION['login_user1'])){
          ?>
          <ul class="nav navbar-nav navbar-right">
            <li><a href="#"><span class="glyphicon glyphicon-user"></span> Welcome <?php echo $_SESSION['login_user1']; ?> </a></li>
            <li><a href="#">MANAGER CONTROL PANEL</a></li>
            <li><a href="logout_m.php"><span class="glyphicon glyphicon-log-out"></span> Log Out </a></li>
          </ul>
          <?php
          }
          else if (isset($_SESSION['login_user2'])) {
          ?>
          <ul class="nav navbar-nav navbar-right">
            <li><a href="#"><span class="glyphicon glyphicon-user"></span> Welcome <?php echo $_SESSION['login_user2']; ?> </a></li>
            <li><a href="userdashboard.php"><span class="glyphicon glyphicon-dashboard"></span> Dashboard </a></li>
            <li class="active" ><a href="notification.php"><span class="glyphicon glyphicon-bell"></span> Notification
            (<?php
                require_once 'connection.php';
                $conn = Connect();

                // Get logged in user's username
                $username = $_SESSION['login_user2'];

                // Fetch their email from the customer table
                $sql_user = "SELECT email FROM customer WHERE username='$username'";
                $result_user = $conn->query($sql_user);

                if ($result_user && $result_user->num_rows > 0) {
                    $row_user = $result_user->fetch_assoc();
                    $user_email = $row_user['email'];

                    // Count responses for this email
                    $sql_count = "SELECT COUNT(*) AS total FROM contact WHERE Email='$user_email' AND Response IS NOT NULL AND Response <> ''";
                    $result_count = $conn->query($sql_count);
                    $row_count = $result_count->fetch_assoc();
                    echo $row_count['total'];
                } else {
                    echo "0";
                }

                $conn->close();
              ?>)
             </a></li>
            <li><a href="logout_u.php"><span class="glyphicon glyphicon-log-out"></span> Log Out </a></li>
          </ul>
          <?php        
          }
          else {
          ?>
          <ul class="nav navbar-nav navbar-right">
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><span class="glyphicon glyphicon-user"></span> Sign Up <span class="caret"></span></a>
              <ul class="dropdown-menu">
                <li><a href="customersignup.php">User Sign-up</a></li>
                <!-- <li><a href="managersignup.php">Admin Sign-up</a></li> -->
              </ul>
            </li>
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><span class="glyphicon glyphicon-log-in"></span> Login <span class="caret"></span></a>
              <ul class="dropdown-menu">
                <li><a href="customerlogin.php">User Login</a></li>
                <li><a href="managerlogin.php">Admin Login</a></li>
              </ul>
            </li>
          </ul>
          <?php
          }
          ?>
        </div>
      </div>
    </nav>

    <div class="heading">
      <strong>Want to contact <span class="edit">SMM</span>?</strong>
      <br>
      Here are a few ways to get in touch with us.
    </div>

    <div class="col-xs-12 line"><hr></div>

    <div class="container">
      <div class="col-md-5 col-sm-8 col-xs-12" style="float: none; margin: 0 auto;">
        <div class="form-area">
          <!-- SUCCESS and ERROR messages -->
          <?php if (isset($success_message)): ?>
            <div class="alert alert-success">
              <i class="fas fa-check-circle"></i> <?php echo $success_message; ?>
            </div>
          <?php endif; ?>
          
          <?php if (isset($error_message)): ?>
            <div class="alert alert-danger">
              <i class="fas fa-exclamation-circle"></i> <?php echo $error_message; ?>
            </div>
          <?php endif; ?>
          <!-- ............................................................ -->

          <form method="post" action="">
            <br style="clear: both">
            <h3 style="margin-bottom: 25px; text-align: center; font-size: 30px;">Contact Form</h3>

            <div class="form-group">
              <input type="text" class="form-control" id="name" name="name" placeholder="Name" required autofocus>
            </div>

            <div class="form-group">
              <input type="email" class="form-control" id="email" name="email" placeholder="Email" required>
            </div>     

            <div class="form-group">
              <input type="number" class="form-control" id="mobile" name="mobile" placeholder="Mobile Number" required>
            </div>

            <div class="form-group">
              <input type="text" class="form-control" id="subject" name="subject" placeholder="Subject" required>
            </div>

            <div class="form-group">
              <textarea class="form-control" type="textarea" id="message" name="message" placeholder="Message" maxlength="255" rows="7"></textarea>
              <span class="help-block"><p id="characterLeft" class="help-block">Max Character length: 250 words</p></span>
            </div> 
            
            <input type="submit" name="submit" id="submit" class="btn btn-primary pull-right" value="Send Message">    
          </form>
        </div>
      </div>
    </div>

    <!-- WhatsApp Floating Button -->
    <a href="https://wa.me/254798814567" target="_blank" class="whatsapp-float">
      <i class="fab fa-whatsapp"></i>
      <span class="whatsapp-text">Contact us via WhatsApp 24/7</span>
    </a>

    <footer>
      <div class="container">
        <div class="row">
          <div class="col-md-6 col-sm-6">
            <h4>QUICK ACCESS</h4>
            <ul class="list-unstyled">
              <li><a href="customersignup.php">Register</a></li>
              <li><a href="customerlogin.php">Log In</a></li>
              <li><a href="faq.php">FAQ</a></li>
              <li><a href="aboutus.php">Our Story</a></li>
            </ul>
          </div>
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