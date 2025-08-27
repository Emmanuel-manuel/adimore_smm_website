<?php
require_once 'connection.php';
$conn = Connect();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'];

    if ($action == "add") {
        $platform = $conn->real_escape_string($_POST['platform']);
        $price = $conn->real_escape_string($_POST['price']);
        $sql = "INSERT INTO services (platform, price) VALUES ('$platform', '$price')";
        $conn->query($sql);
    }

    if ($action == "delete") {
        $id = (int)$_POST['id'];
        $sql = "DELETE FROM services WHERE id=$id";
        $conn->query($sql);
    }

    if ($action == "edit") {
        $id = (int)$_POST['id'];
        $platform = $conn->real_escape_string($_POST['platform']);
        $price = $conn->real_escape_string($_POST['price']);
        $sql = "UPDATE services SET platform='$platform', price='$price' WHERE id=$id";
        $conn->query($sql);
    }
}

$conn->close();
header("Location: manageservices.php");
exit();
