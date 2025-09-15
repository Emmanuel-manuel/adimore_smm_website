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
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Admin Panel | SMM website</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <link rel="stylesheet" href="css/bootstrap.min.css">
  <!-- <link rel="stylesheet" href="css/manageservices.css"> -->
  <script src="js/jquery.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <style>
    footer {
      background-color: #2c3e50;
      color: white;
      padding: 20px 0;
      margin-top: 40px;
    }
    footer a {
      color: #ddd;
      text-decoration: none;
    }
    footer a:hover {
      color: #fff;
    }

    /* Sidebar as card for desktops */
    .sidebar {
      margin-bottom: 20px;
    }

    @media (max-width: 767px) {
      /* On mobile, hide sidebar card */
      .sidebar {
        display: none;
      }
      /* Show top menu instead */
      .top-menu {
        display: block;
        margin-bottom: 15px;
      }
    }

    @media (min-width: 768px) {
      .top-menu {
        display: none;
      }
    }
  </style>
</head>

<body>

<!-- Scroll to Top -->
<button onclick="topFunction()" id="myBtn" title="Go to top">
  <span class="glyphicon glyphicon-chevron-up"></span>
</button>

<script>
  window.onscroll = function() { scrollFunction(); };

  function scrollFunction(){
    document.getElementById("myBtn").style.display =
      (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20)
      ? "block" : "none";
  }

  function topFunction() {
    window.scrollTo({ top: 0, behavior: 'smooth' });
  }
</script>

<!-- Navbar -->
<nav class="navbar navbar-inverse navbar-fixed-top navigation-clean-search" role="navigation">
  <div class="container-fluid">
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
        <li><a href="#"><span class="glyphicon glyphicon-user"></span> Welcome <?php echo $login_session; ?></a></li>
        <li class="active"><a href="manageservices.php">MANAGER CONTROL PANEL</a></li>
        <li><a href="logout_m.php"><span class="glyphicon glyphicon-log-out"></span> Log Out</a></li>
      </ul>
    </div>
  </div>
</nav>

<!-- Hero -->
<div class="container">
  <div class="jumbotron text-center">
    <h1>Hello Admin!</h1>
    <p>Manage your platform services from here</p>
  </div>
</div>

<div class="container-fluid">
  <div class="row">

    <!-- Sidebar for desktops -->
    <div class="col-md-3 col-sm-4 sidebar">
      <div class="list-group text-center">
        <a href="manageservices.php" class="list-group-item active">Manage Services</a>
        <a href="manage_users.php" class="list-group-item">Manage Users</a>
        <a href="post_notifications.php" class="list-group-item">Post Notifications</a>
        <a href="manage_feedback.php" class="list-group-item">Manage Users Feedback</a>
        <a href="manage_orders.php" class="list-group-item">Manage Orders</a>
      </div>
    </div>

    <!-- Collapsible top menu for mobiles -->
    <div class="col-xs-12 top-menu">
      <div class="dropdown text-center">
        <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">
          Admin Menu <span class="caret"></span>
        </button>
        <ul class="dropdown-menu">
          <li><a href="manageservices.php">Manage Services</a></li>
          <li><a href="manage_users.php">Manage Users</a></li>
          <li><a href="post_notifications.php">Post Notifications</a></li>
          <li><a href="manage_feedback.php">Manage Users Feedback</a></li>
          <li><a href="manage_orders.php">Manage Orders</a></li>
        </ul>
      </div>
    </div>

    <!-- Main Content -->
    <div class="col-md-9 col-sm-8 col-xs-12">
      <div class="form-area panel panel-default">
        <div class="panel-heading text-center">
          <h3 class="panel-title">Manage Services</h3>
        </div>
        <div class="panel-body">

          <!-- Add Service Form -->
          <form action="service_action.php" method="POST" class="form-inline text-center" style="margin-bottom:20px; flex-wrap: wrap;">
            <input type="hidden" name="action" value="add">
            <div class="form-group" style="margin:5px;">
              <input type="text" class="form-control" name="platform" placeholder="Social Media Platform" required>
            </div>
            <div class="form-group" style="margin:5px;">
              <input type="number" class="form-control" name="price" placeholder="Price per 1000 views/subscriptions" required>
            </div>
            <button type="submit" class="btn btn-success" style="margin:5px;">Add Service</button>
          </form>

          <!-- Services Table -->
          <div class="table-responsive">
            <table class="table table-bordered table-hover">
              <thead class="bg-primary text-white">
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
                          <input type='text' name='platform' value='".$row['platform']."' class='form-control input-sm' required>
                          <input type='number' name='price' value='".$row['price']."' class='form-control input-sm' required>
                          <button type='submit' class='btn btn-primary btn-sm'>Update</button>
                        </form>
                      </td>
                    </tr>";
                  }
                } else {
                  echo "<tr><td colspan='4' class='text-center'>No services found</td></tr>";
                }

                $conn->close();
                ?>
              </tbody>
            </table>
          </div>

        </div>
      </div>
    </div>
  </div>
</div>

<!-- Footer -->
<footer>
  <div class="container text-center">
    <p>Copyright 2025 &copy; SMM Panel. All rights reserved.</p>
    <p>Developed by <a href="mailto:emmanuelsystems5@gmail.com">emmanuelSystems</a></p>
  </div>
</footer>

</body>
</html>
