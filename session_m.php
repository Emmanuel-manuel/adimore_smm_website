<?php
require_once 'connection.php';
$conn = Connect();

session_start();

// Check if the session variable exists before accessing it
if (isset($_SESSION['login_user1'])) {
    $user_check = $_SESSION['login_user1'];

    // SQL Query To Fetch Complete Information Of User
    $query = "SELECT username FROM MANAGER WHERE username = '$user_check'";
    $ses_sql = mysqli_query($conn, $query);
    
    if ($ses_sql && mysqli_num_rows($ses_sql) > 0) {
        $row = mysqli_fetch_assoc($ses_sql);
        $login_session = $row['username'];
    } else {
        // Invalid session, redirect to login
        header('Location: managerlogin.php');
        exit();
    }
} else {
    // No session found, redirect to login
    header('Location: managerlogin.php');
    exit();
}
?>