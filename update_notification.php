<?php
require_once 'connection.php';
$conn = Connect();

if (isset($_POST['id'])) {
    $id = (int)$_POST['id'];
    $sql = "UPDATE contact SET Status='read' WHERE id=$id";
    if ($conn->query($sql) === TRUE) {
        echo "success";
    } else {
        echo "error";
    }
}
$conn->close();
?>
