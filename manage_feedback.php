<?php
require_once 'connection.php';
include('session_m.php');

if (!isset($login_session)) {
    header('Location: managerlogin.php'); 
    exit();
}

$conn = Connect();

// Handle response submission
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['respond'])) {
    $email = $conn->real_escape_string($_POST['email']);
    $response = $conn->real_escape_string($_POST['response']);
    $sql = "UPDATE contact SET Response='$response' WHERE Email='$email'";
    $conn->query($sql);
    header("Location: manage_feedback.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Admin Panel | SMM website</title>
  <link rel="stylesheet" type="text/css" href="css/managefeedback.css"> 
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
      <ul class="nav navbar-nav navbar-right">
        <li><a href="index.php">Home</a></li>
        <li><a href="aboutus.php">About</a></li>
        <li><a href="contactus.php">Contact Us</a></li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <li><a href="#"><span class="glyphicon glyphicon-user"></span> Welcome <?php echo $login_session; ?></a></li>
        <li><a href="manageservices.php">Manage Services</a></li>
        <li class="active"><a href="manage_feedback.php">Manage Feedback</a></li>
        <li><a href="logout_m.php"><span class="glyphicon glyphicon-log-out"></span> Log Out</a></li>
      </ul>
    </div>
  </div>
</nav>

<!-- Page Content -->
<div class="container" style="margin-top:70px;">
  <div class="jumbotron">
    <h1>Hello Admin! Manage Feedback</h1>
    <p>View and respond to user feedback</p>
  </div>
</div>

<div class="container">
  <div class="row">

    <!-- Sidebar -->
    <div class="col-xs-3" style="text-align: center;">
      <div class="list-group">
        <a href="manageservices.php" class="list-group-item">Manage Services</a>
        <a href="manage_users.php" class="list-group-item">Manage Users</a>
        <a href="post_notifications.php" class="list-group-item">Post Notifications</a>
        <a href="manage_feedback.php" class="list-group-item active">Manage Users Feedback</a>
        <a href="manage_orders.php" class="list-group-item">Manage Orders</a>
      </div>
    </div>

    <table class="table table-bordered table-striped">
    <thead>
      <tr>
        <th>Name</th>
        <th>Email</th>
        <th>Mobile</th>
        <th>Subject</th>
        <th>Message</th>
        <th>Response</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>
      <?php
      $sql = "SELECT * FROM contact ORDER BY Name ASC";
      $result = $conn->query($sql);

      if ($result->num_rows > 0) {
          while($row = $result->fetch_assoc()) {
              echo "<tr>
                <td>".$row['Name']."</td>
                <td>".$row['Email']."</td>
                <td>".$row['Mobile']."</td>
                <td>".$row['Subject']."</td>
                <td>".$row['Message']."</td>
                <td>".($row['Response'] ?? 'No response yet')."</td>
                <td>
                  <form method='POST' action=''>
                    <input type='hidden' name='email' value='".$row['Email']."'>
                    <textarea name='response' class='form-control' placeholder='Write response here'>".($row['Response'] ?? '')."</textarea>
                    <button type='submit' name='respond' class='btn btn-primary btn-sm' style='margin-top:5px;'>Respond</button>
                  </form>
                </td>
              </tr>";
          }
      } else {
          echo "<tr><td colspan='7' style='text-align:center;'>No feedback found</td></tr>";
      }
      $conn->close();
      ?>
    </tbody>
  </table>



</div>

<footer>
        <div class="container">
            <p>Copyright 2025 &copy; SMM Panel. All rights reserved.</p>
        </div>
    </footer>
    
</body>
</html>