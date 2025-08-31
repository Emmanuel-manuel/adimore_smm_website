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
  <link rel="stylesheet" type="text/css" href="css/manageusers.css"> 
  <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
  <script type="text/javascript" src="js/jquery.min.js"></script>
  <script type="text/javascript" src="js/bootstrap.min.js"></script>
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
    document.body.scrollTop = 0;
    document.documentElement.scrollTop = 0;
  }
</script>

<!-- Navbar -->
<nav class="navbar navbar-inverse navbar-fixed-top navigation-clean-search" role="navigation">
  <div class="container">
    <div class="navbar-header">
      <a class="navbar-brand" href="index.php">SMM website</a>
    </div>
    <div class="collapse navbar-collapse " id="myNavbar">
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

<!-- Page Content -->
<div class="container">
  <div class="jumbotron">
    <h1>Hello Admin!</h1>
    <p>Manage your users from here</p>
  </div>
</div>

<div class="container">
  <div class="row">

    <!-- Sidebar -->
    <div class="col-xs-3" style="text-align: center;">
      <div class="list-group">
        <a href="manageservices.php" class="list-group-item">Manage Services</a>
        <a href="manage_users.php" class="list-group-item active">Manage Users</a>
        <a href="post_notifications.php" class="list-group-item">Post Notifications</a>
        <a href="manage_feedback.php" class="list-group-item">Manage Users Feedback</a>
        <a href="manage_orders.php" class="list-group-item">Manage Orders</a>
      </div>
    </div>

    <!-- Main Content -->
    <div class="col-xs-9">
      <div class="form-area" style="padding:20px;">
        <h3 style="margin-bottom:25px; text-align:center; font-size:30px;">Manage Users</h3>

        <!-- Add User Form -->
        <form action="user_action.php" method="POST" class="form-inline" style="margin-bottom:20px;">
          <input type="hidden" name="action" value="add">
          <div class="form-group">
            <input type="text" class="form-control" name="fullname" placeholder="Full Name" required>
          </div>
          <div class="form-group">
            <input type="text" class="form-control" name="username" placeholder="Username" required>
          </div>
          <div class="form-group">
            <input type="email" class="form-control" name="email" placeholder="Email" required>
          </div>
          <div class="form-group">
            <input type="text" class="form-control" name="contact" placeholder="Contact" required>
          </div>
          <div class="form-group">
            <input type="password" class="form-control" name="password" placeholder="Password" required>
          </div>
          <div class="form-group">
            <select class="form-control" name="role" required>
              <option value="User">User</option>
              <option value="Admin">Admin</option>
            </select>
          </div>
          <button type="submit" class="btn btn-success">Add User</button>
        </form>

        <!-- Users Table -->
        <table class="table table-bordered table-striped">
          <thead>
            <tr>
              <th>Role</th>
              <th>Username</th>
              <th>Full Name</th>
              <th>Email</th>
              <th>Contact</th>
              <th>Actions</th>
            </tr>
          </thead>
          <tbody>
          <?php
            // Fetch Admins
            $result_admins = $conn->query("SELECT username, fullname, email, contact FROM manager");
            if ($result_admins && $result_admins->num_rows > 0) {
              while($row = $result_admins->fetch_assoc()) {
                echo "<tr>
                  <td>Admin</td>
                  <td>".$row['username']."</td>
                  <td>".$row['fullname']."</td>
                  <td>".$row['email']."</td>
                  <td>".$row['contact']."</td>
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
            $result_users = $conn->query("SELECT id, username, fullname, email, contact FROM customer");
            if ($result_users && $result_users->num_rows > 0) {
              while($row = $result_users->fetch_assoc()) {
                echo "<tr>
                  <td>User</td>
                  <td>".$row['username']."</td>
                  <td>".$row['fullname']."</td>
                  <td>".$row['email']."</td>
                  <td>".$row['contact']."</td>
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


<footer>
        <div class="container">
            <p>Copyright 2025 &copy; SMM Panel. All rights reserved.</p>
        </div>
    </footer>

</body>
</html>
