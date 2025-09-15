<?php
// login_m.php — Manager login logic

session_start(); 
$error = '';

if (isset($_POST['submit'])) {
    if (empty($_POST['username']) || empty($_POST['password'])) {
        $error = "Username or Password is invalid";
    } else {
        $username_entered = $_POST['username'];
        $password_entered = $_POST['password'];

        require_once 'connection.php';
        $conn = Connect();

        // Only select username & hashed password by username
        $query = "SELECT username, password FROM manager WHERE username = ? LIMIT 1";
        $stmt = $conn->prepare($query);
        if (!$stmt) {
            // for debugging
            die("Prepare failed: " . $conn->error);
        }
        $stmt->bind_param("s", $username_entered);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows == 1) {
            $stmt->bind_result($db_username, $db_password_hash);
            $stmt->fetch();

            // ✅ Verify entered password against hashed password
            if (password_verify($password_entered, $db_password_hash)) {
                $_SESSION['login_user1'] = $db_username;
                header("Location: manageservices.php");
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
