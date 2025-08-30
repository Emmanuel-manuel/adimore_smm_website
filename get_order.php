<?php
session_start();
include 'connection.php';
$conn = Connect();

if (!isset($_SESSION['login_user2'])) {
    echo "Unauthorized";
    exit();
}

$orderId = isset($_POST['id']) ? (int)$_POST['id'] : 0;
$username = $_SESSION['login_user2'];

// Verify order belongs to logged-in user
$sql_user = "SELECT id FROM customer WHERE username = ?";
$stmt_user = $conn->prepare($sql_user);
$stmt_user->bind_param("s", $username);
$stmt_user->execute();
$result_user = $stmt_user->get_result();
if ($result_user->num_rows == 0) {
    echo "User not found.";
    exit();
}
$user = $result_user->fetch_assoc();
$userId = $user['id'];

$sql = "SELECT * FROM orders WHERE id = ? AND user_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ii", $orderId, $userId);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $order = $result->fetch_assoc();
    echo "<p><strong>Order ID:</strong> #{$order['id']}</p>";
    echo "<p><strong>Date:</strong> {$order['created_at']}</p>";
    echo "<p><strong>Service:</strong> {$order['platform']}</p>";
    echo "<p><strong>Link:</strong> <a href='{$order['link']}' target='_blank'>{$order['link']}</a></p>";
    echo "<p><strong>Quantity:</strong> {$order['quantity']}</p>";
    echo "<p><strong>Amount:</strong> Ksh. " . number_format($order['amount'], 2) . "</p>";
    echo "<p><strong>Status:</strong> {$order['status']}</p>";
} else {
    echo "<p class='text-danger'>Order not found or you are not authorized to view it.</p>";
}
