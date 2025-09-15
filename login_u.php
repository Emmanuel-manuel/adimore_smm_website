<?php 
session_start(); 
$error=''; 

if (isset($_POST['submit'])) {
    if (empty($_POST['username']) || empty($_POST['password'])) {
        $error = "Username or Password is invalid";
    } else {
        // Get submitted data
        $username = $_POST['username'];
        $password_entered = $_POST['password'];

        require 'connection.php';
        $conn = Connect();

        // ✅ Only fetch the stored hashed password for this username
        $query = "SELECT username, password FROM customer WHERE username=? LIMIT 1";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows == 1) {
            $stmt->bind_result($db_username, $db_password_hash);
            $stmt->fetch();

            // 🔑 Verify password using password_verify()
            if (password_verify($password_entered, $db_password_hash)) {
                $_SESSION['login_user2'] = $db_username; // Initialize Session
                header("location: userdashboard.php");
                exit();
            } else {
                $error = "Invalid username or password!";
            }
        } else {
            $error = "Invalid username or password!";
        }

        $stmt->close();
        $conn->close();
    }
}
?>
