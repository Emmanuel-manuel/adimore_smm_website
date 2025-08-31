<?php
require_once 'connection.php';
$conn = Connect();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'];
    $role   = $_POST['role'];

    if ($action == "add") {
        $fullname = $conn->real_escape_string($_POST['fullname']);
        $username = $conn->real_escape_string($_POST['username']);
        $email    = $conn->real_escape_string($_POST['email']);
        $contact  = $conn->real_escape_string($_POST['contact']);
        $address  = $conn->real_escape_string($_POST['address']);
        $password = $conn->real_escape_string($_POST['password']);

        if ($role == "Admin") {
            $sql = "INSERT INTO manager (username, fullname, email, contact, password) 
                    VALUES ('$username', '$fullname', '$email', '$contact', '$password')";
        } else {
            $sql = "INSERT INTO customer (fullname, username, email, contact, password) 
                    VALUES ('$fullname', '$username', '$email', '$contact', '$password')";
        }
        $conn->query($sql);
    }

    if ($action == "delete") {
        if ($role == "Admin") {
            $username = $conn->real_escape_string($_POST['username']);
            $sql = "DELETE FROM manager WHERE username='$username'";
        } else {
            $id = (int)$_POST['id'];
            $sql = "DELETE FROM customer WHERE id=$id";
        }
        $conn->query($sql);
    }
}

$conn->close();
header("Location: manage_users.php");
exit();
?>
