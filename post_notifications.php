<?php
require_once 'connection.php';
include('session_m.php');

if (!isset($login_session)) {
    header('Location: managerlogin.php'); 
    exit();
}

$conn = Connect();

// Handle announcement submission
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['post_announcement'])) {
    $announcement = $conn->real_escape_string($_POST['announcement']);
    $time_duration = $conn->real_escape_string($_POST['time_duration']);
    
    if (!empty($announcement) && !empty($time_duration)) {
        $sql = "INSERT INTO announcement (announcement, time_duration) VALUES ('$announcement', '$time_duration')";
        if ($conn->query($sql)) {
            $success = "Announcement posted successfully!";
        } else {
            $error = "Error: " . $conn->error;
        }
    } else {
        $error = "Please fill in all fields!";
    }
}

// Fetch recent announcements
$sql = "SELECT * FROM announcement ORDER BY created_at DESC LIMIT 10";
$result = $conn->query($sql);
$announcements = [];
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $announcements[] = $row;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Post Notifications | SMM Panel</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="css/postnotifications.css">

</head>
<body>
  <!-- Navbar -->
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
  <div class="container-fluid">
    <a class="navbar-brand" href="index.php">SMM Panel</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#myNavbar">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="navbar-nav me-auto">
        <li class="nav-item"><a class="nav-link" href="index.php">Home</a></li>
        <li class="nav-item"><a class="nav-link" href="aboutus.php">About</a></li>
        <li class="nav-item"><a class="nav-link" href="contactus.php">Contact Us</a></li>
      </ul>
      
        <ul class="nav navbar-nav navbar-right">
          <li><a href="#"><i class="fas fa-user"></i> Welcome <?php echo $login_session; ?></a></li>
          <li><a href="manageservices.php">Manage Services</a></li>
          <li><a href="manage_feedback.php">Manage Feedback</a></li>
          <li class="active"><a href="post_notifications.php">Post Notifications</a></li>
          <li><a href="logout_m.php" class="logout-btn"><i class="fas fa-sign-out-alt"></i> Log Out</a></li>
        </ul>
      </div>
    </div>
  </nav>

  <div class="container-fluid admin-container">
    <div class="page-header">
      <h1><i class="fas fa-bullhorn"></i> Post Notifications</h1>
      <p>Create and manage announcements for your users</p>
    </div>

    <?php if (isset($success)): ?>
      <div class="alert alert-success">
        <i class="fas fa-check-circle"></i> <?php echo $success; ?>
      </div>
    <?php endif; ?>

    <?php if (isset($error)): ?>
      <div class="alert alert-danger">
        <i class="fas fa-exclamation-circle"></i> <?php echo $error; ?>
      </div>
    <?php endif; ?>

    <div class="row">
      <!-- Sidebar -->
      <div class="col-md-3 sidebar">
        <div class="list-group">
          <a href="manageservices.php" class="list-group-item">Manage Services</a>
          <a href="manage_users.php" class="list-group-item">Manage Users</a>
          <a href="post_notifications.php" class="list-group-item active">Post Notifications</a>
          <a href="manage_feedback.php" class="list-group-item">Manage Users Feedback</a>
          <a href="manage_orders.php" class="list-group-item">Manage Orders</a>
          <a href="logout_m.php" class="list-group-item"><i class="fas fa-sign-out-alt"></i> Log Out</a>
        </div>
      </div>

      <!-- Mobile Dropdown Menu -->
      <div class="col-md-3 d-md-none mobile-menu">
        <select class="form-control" onchange="location = this.value;">
          <option value="">-- Navigate --</option>
          <option value="manageservices.php">Manage Services</option>
          <option value="manage_users.php">Manage Users</option>
          <option value="post_notifications.php" selected>Post Notifications</option>
          <option value="manage_feedback.php">Manage Users Feedback</option>
          <option value="manage_orders.php">Manage Orders</option>
          <option value="logout_m.php">Log Out</option>
        </select>
      </div>

      <!-- Main Content -->
      <div class="col-md-9">
        <div class="card p-3">
          <div class="card-header">
            <i class="fas fa-plus-circle"></i> Create New Announcement
          </div>
          <div class="announcement-form">
            <form method="POST" action="">
              <div class="form-group">
                <label for="announcement"><i class="fas fa-bullhorn"></i> Announcement Message</label>
                <textarea id="announcement" name="announcement" class="form-control" rows="4" maxlength="255" required><?php echo isset($_POST['announcement']) ? htmlspecialchars($_POST['announcement']) : ''; ?></textarea>
                <small class="text-muted">Maximum 255 characters</small>
              </div>
              <div class="form-group mt-3">
                <label for="time_duration"><i class="fas fa-clock"></i> Duration (Days)</label>
                <select id="time_duration" name="time_duration" class="form-select" required>
                  <option value="">Select duration</option>
                  <option value="1">1 Day</option>
                  <option value="3">3 Days</option>
                  <option value="7">7 Days</option>
                  <option value="14">14 Days</option>
                  <option value="30">30 Days</option>
                </select>
              </div>
              <button type="submit" name="post_announcement" class="btn-post mt-3">
                <i class="fas fa-paper-plane"></i> Post Announcement
              </button>
            </form>
          </div>
        </div>

        <!-- Recent Announcements -->
        <div class="announcement-list mt-4">
          <h3><i class="fas fa-history"></i> Recent Announcements</h3>
          <?php if (count($announcements) > 0): ?>
            <?php foreach ($announcements as $announcement): ?>
              <div class="announcement-item">
                <div class="announcement-content">
                  <?php echo nl2br(htmlspecialchars($announcement['announcement'])); ?>
                </div>
                <div class="announcement-meta">
                  <span><i class="fas fa-clock"></i> Duration: <?php echo $announcement['time_duration']; ?> days</span>
                  <span><i class="fas fa-calendar"></i> Posted: <?php echo date('M j, Y g:i A', strtotime($announcement['created_at'])); ?></span>
                </div>
              </div>
            <?php endforeach; ?>
          <?php else: ?>
            <div class="no-announcements">
              <i class="fas fa-bullhorn"></i>
              <h3>No Announcements Yet</h3>
              <p>You haven't posted any announcements yet. Create your first one above!</p>
            </div>
          <?php endif; ?>
        </div>
      </div>
    </div>
  </div>

  <a href="#" class="back-to-top"><i class="fas fa-arrow-up"></i></a>

  <footer>
    <div class="container text-center">
      <p>Copyright 2025 &copy; SMM Panel. All rights reserved.</p>
      <p>Developed by <a href="mailto:emmanuelsystems5@gmail.com">emmanuelSystems</a></p>
    </div>
  </footer>

  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <script>
    $(document).ready(function(){
      $(window).scroll(function(){
        if ($(this).scrollTop() > 100) {
          $('.back-to-top').fadeIn();
        } else {
          $('.back-to-top').fadeOut();
        }
      });
      $('.back-to-top').click(function(){
        $('html, body').animate({scrollTop : 0},800);
        return false;
      });
      $('#announcement').keyup(function(){
        var max = 255;
        var len = $(this).val().length;
        var char = max - len;
        $('.text-muted').text(char + ' characters remaining');
        $('.text-muted').css('color', char < 10 ? 'red' : 'gray');
      });
    });
  </script>
</body>
</html>
<?php $conn->close(); ?>
