<?php
require_once 'connection.php';
include('session_m.php');

if (!isset($login_session)) {
    header('Location: managerlogin.php'); 
    exit();
}

$conn = Connect();
?>
<!DOCTYPE html>
<html>
<head>
  <title>Admin Panel | SMM website</title>
  <link rel="stylesheet" type="text/css" href="css/manageservices.css">
  <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
  <script type="text/javascript" src="js/jquery.min.js"></script>
  <script type="text/javascript" src="js/bootstrap.min.js"></script>
</head>

<body>

<button onclick="topFunction()" id="myBtn" title="Go to top">
  <span class="glyphicon glyphicon-chevron-up"></span>
</button>

<script type="text/javascript">
  window.onscroll = function() { scrollFunction(); };

  function scrollFunction(){
    if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
      document.getElementById("myBtn").style.display = "block";
    } else {
      document.getElementById("myBtn").style.display = "none";
    }
  }

  function topFunction() {
    document.body.scrollTop = 0;
    document.documentElement.scrollTop = 0;
  }
</script>

<nav class="navbar navbar-inverse navbar-fixed-top navigation-clean-search" role="navigation">
  <div class="container">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#myNavbar">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="index.php">SMM website</a>
    </div>

    <div class="collapse navbar-collapse " id="myNavbar">
      <ul class="nav navbar-nav">
        <li><a href="index.php">Home</a></li>
        <li><a href="aboutus.php">About</a></li>
        <li><a href="contactus.php">Contact Us</a></li>
      </ul>

      <ul class="nav navbar-nav navbar-right">
        <li><a href="#"><span class="glyphicon glyphicon-user"></span> Welcome <?php echo $login_session; ?> </a></li>
        <li class="active"> <a href="manageservices.php">MANAGER CONTROL PANEL</a></li>
        <li><a href="logout_m.php"><span class="glyphicon glyphicon-log-out"></span> Log Out </a></li>
      </ul>
    </div>
  </div>
</nav>

<div class="container">
  <div class="jumbotron">
    <h1>Hello Admin!</h1>
    <p>Manage your platform services from here</p>
  </div>
</div>

<div class="container">
  <div class="col-xs-3" style="text-align: center;">
    <div class="list-group">
      <a href="manageservices.php" class="list-group-item active">Manage Services</a>
      <a href="manage_users.php" class="list-group-item">Manage Users</a>
      <a href="post_notifications.php" class="list-group-item">Post Notifications</a>
      <a href="manage_feedback.php" class="list-group-item">Manage Users Feedback</a>
      <a href="manage_orders.php" class="list-group-item">Manage Orders</a>
    </div>
  </div>

  <div class="col-xs-9">
    <div class="form-area" style="padding: 20px;">
      <h3 style="margin-bottom: 25px; text-align: center; font-size: 30px;">Manage Services</h3>

      <!-- Add Service Form -->
      <form action="service_action.php" method="POST" class="form-inline" style="margin-bottom:20px;">
        <input type="hidden" name="action" value="add">
        <div class="form-group">
          <input type="text" class="form-control" name="platform" placeholder="Social Media Platform" required>
        </div>
        <div class="form-group">
          <input type="number" class="form-control" name="price" placeholder="Price per view/subscription" required>
        </div>
        <button type="submit" class="btn btn-success">Add Service</button>
      </form>

      <!-- Services Table -->
      <table class="table table-bordered table-striped">
        <thead>
          <tr>
            <th>ID</th>
            <th>Platform</th>
            <th>Price per View/Subscription</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
          <?php
          $sql = "SELECT * FROM services ORDER BY id DESC";
          $result = $conn->query($sql);

          if ($result && $result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
              echo "<tr>
                <td>".$row['id']."</td>
                <td>".$row['platform']."</td>
                <td>".$row['price']."</td>
                <td>
                  <form action='service_action.php' method='POST' style='display:inline;'>
                    <input type='hidden' name='id' value='".$row['id']."'>
                    <input type='hidden' name='action' value='delete'>
                    <button type='submit' class='btn btn-danger btn-sm'>Delete</button>
                  </form>
                  <form action='service_action.php' method='POST' style='display:inline; margin-left:5px;'>
                    <input type='hidden' name='id' value='".$row['id']."'>
                    <input type='hidden' name='action' value='edit'>
                    <input type='text' name='platform' value='".$row['platform']."' required>
                    <input type='number' name='price' value='".$row['price']."' required>
                    <button type='submit' class='btn btn-primary btn-sm'>Update</button>
                  </form>
                </td>
              </tr>";
            }
          } else {
            echo "<tr><td colspan='4' style='text-align:center;'>No services found</td></tr>";
          }

          $conn->close();
          ?>
        </tbody>
      </table>
    </div>
  </div>
</div>

<footer>
        <div class="container">
            <p>Copyright 2025 &copy; SMM Panel. All rights reserved.</p>
        </div>
    </footer>
    
</body>
</html>
