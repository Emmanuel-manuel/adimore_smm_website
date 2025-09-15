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
  <link rel="stylesheet" href="css/manageusers.css">
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
    .sidebar {
      margin-bottom: 20px;
    }
    @media (max-width: 767px) {
      .sidebar { display: none; }
      .top-menu { display: block; margin-bottom: 15px; }
    }
    @media (min-width: 768px) {
      .top-menu { display: none; }
    }
  </style>
</head>

<body>

<!-- Back to Top -->
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
<nav class="navbar navbar-inverse navbar-fixed-top navigation-clean-search">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#myNavbar">
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
        <li><a href="manageservices.php">Manage Services</a></li>
        <li class="active"><a href="manage_users.php">Manage Users</a></li>
        <li><a href="logout_m.php"><span class="glyphicon glyphicon-log-out"></span> Log Out</a></li>
      </ul>
    </div>
  </div>
</nav>

<!-- Page Header -->
<div class="container">
  <div class="jumbotron text-center">
    <h1>Hello Admin!</h1>
    <p>Manage your users from here</p>
  </div>
</div>

<div class="container-fluid">
  <div class="row">

    <!-- Sidebar for desktops -->
    <div class="col-md-3 col-sm-4 sidebar">
      <div class="list-group text-center">
        <a href="manageservices.php" class="list-group-item">Manage Services</a>
        <a href="manage_users.php" class="list-group-item active">Manage Users</a>
        <a href="post_notifications.php" class="list-group-item">Post Notifications</a>
        <a href="manage_feedback.php" class="list-group-item">Manage Users Feedback</a>
        <a href="manage_orders.php" class="list-group-item">Manage Orders</a>
      </div>
    </div>

    <!-- Collapsible top menu for mobiles -->
    <div class="col-xs-12 top-menu text-center">
      <div class="dropdown">
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
          <h3 class="panel-title">Manage Users</h3>
        </div>
        <div class="panel-body">

          <!-- Add User Form -->
          <form action="user_action.php" method="POST" class="form-inline text-center" style="margin-bottom:20px; flex-wrap: wrap;">
            <input type="hidden" name="action" value="add">
            <div class="form-group" style="margin:5px;">
              <input type="text" class="form-control" name="fullname" placeholder="Full Name" required>
            </div>
            <div class="form-group" style="margin:5px;">
              <input type="text" class="form-control" name="username" placeholder="Username" required>
            </div>
            <div class="form-group" style="margin:5px;">
              <input type="email" class="form-control" name="email" placeholder="Email" required>
            </div>
            <div class="form-group" style="margin:5px;">
              <input type="text" class="form-control" name="contact" placeholder="Contact" required>
            </div>
            <div class="form-group" style="margin:5px;">
              <input type="password" class="form-control" name="password" placeholder="Password" required>
            </div>
            <div class="form-group" style="margin:5px;">
              <select class="form-control" name="role" required>
                <option value="User">User</option>
                <option value="Admin">Admin</option>
              </select>
            </div>
            <button type="submit" class="btn btn-success" style="margin:5px;">Add User</button>
          </form>

          <!-- Users Table -->
          <div class="table-responsive">
            <table class="table table-bordered table-hover">
              <thead class="bg-primary text-white">
                <tr>
                  <th>Role</th>
                  <th>Username</th>
                  <th>Full Name</th>
                  <th>Email</th>
                  <th>Contact</th>
                  <th>Date Created</th>
                  <th>Actions</th>
                </tr>
              </thead>
              <tbody>
              <?php
                // Fetch Admins
                $result_admins = $conn->query("SELECT username, fullname, email, contact, created_at FROM manager");
                if ($result_admins && $result_admins->num_rows > 0) {
                  while($row = $result_admins->fetch_assoc()) {
                    echo "<tr>
                      <td>Admin</td>
                      <td>".$row['username']."</td>
                      <td>".$row['fullname']."</td>
                      <td>".$row['email']."</td>
                      <td>".$row['contact']."</td>
                      <td>".$row['created_at']."</td>
                      <td>
                        <form action='user_action.php' method='POST' style='display:inline;'>
                          <input type='hidden' name='role' value='Admin'>
                          <input type='hidden' name='username' value='".$row['username']."'>
                          <input type='hidden' name='action' value='delete'>
                          <button type='submit' class='btn btn-danger btn-sm'>Delete</button>
                        </form>
                      </td>
                    </tr>";
                  }
                }

                // Fetch Users
                $result_users = $conn->query("SELECT id, username, fullname, email, contact, created_at FROM customer");
                if ($result_users && $result_users->num_rows > 0) {
                  while($row = $result_users->fetch_assoc()) {
                    echo "<tr>
                      <td>User</td>
                      <td>".$row['username']."</td>
                      <td>".$row['fullname']."</td>
                      <td>".$row['email']."</td>
                      <td>".$row['contact']."</td>
                      <td>".$row['created_at']."</td>
                      <td>
                        <form action='user_action.php' method='POST' style='display:inline;'>
                          <input type='hidden' name='role' value='User'>
                          <input type='hidden' name='id' value='".$row['id']."'>
                          <input type='hidden' name='action' value='delete'>
                          <button type='submit' class='btn btn-danger btn-sm'>Delete</button>
                        </form>
                      </td>
                    </tr>";
                  }
                }
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
