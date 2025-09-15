<?php
// manager_registered_success.php

require 'connection.php';
$conn = Connect();

// Escape inputs
$fullname = $conn->real_escape_string($_POST['fullname']);
$username = $conn->real_escape_string($_POST['username']);
$email    = $conn->real_escape_string($_POST['email']);
$contact  = $conn->real_escape_string($_POST['contact']);
$password_plain = $_POST['password'];

// Hash the password
$hashed_password = password_hash($password_plain, PASSWORD_DEFAULT);

$query = "INSERT INTO manager (username, fullname, email, contact, password) 
          VALUES ('$username', '$fullname', '$email', '$contact', '$hashed_password')";
$success = $conn->query($query);

if (!$success) {
    die("Couldn’t enter data: " . $conn->error);
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Manager Registered | SMM Website</title>
  <link rel="stylesheet" href="css/bootstrap.min.css">
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
      box-shadow: 0 5px 20px rgba(0,0,0,0.1);
    }
    footer {
      background-color: #2c3e50;
      color: white;
      padding: 30px 0;
      margin-top: 40px;
    }
    footer a {
      color: #ddd;
      text-decoration: none;
    }
    footer a:hover {
      color: #fff;
    }
  </style>
</head>
<body>
  <div class="container">
    <div class="jumbotron text-center">
      <h2>Welcome <?php echo htmlspecialchars($fullname); ?>!</h2>
      <h3>Your account has been created successfully.</h3>
      <p>Login now from <a href="managerlogin.php">HERE</a></p>
    </div>
  </div>

  <footer>
    <div class="container text-center">
      <p>Copyright 2025 &copy; SMM Panel. All rights reserved.</p>
      <p>Developed by <a href="mailto:emmanuelsystems5@gmail.com">emmanuelSystems</a></p>
    </div>
  </footer>
</body>
</html>
