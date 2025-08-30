<?php
session_start();
include 'connection.php';
$conn = Connect();

// Check login
if (!isset($_SESSION['login_user2'])) {
    header("Location: customerlogin.php");
    exit();
}

$username = $_SESSION['login_user2'];

// Get user info
$userQuery = "SELECT id, fullname FROM customer WHERE username = '$username' LIMIT 1";
$userResult = mysqli_query($conn, $userQuery);
if (!$userResult || mysqli_num_rows($userResult) == 0) {
    die("User not found.");
}
$user = mysqli_fetch_assoc($userResult);
$userId = $user['id'];
$fullname = $user['fullname'];

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $serviceId = intval($_POST['platform']);
    $quantity  = intval($_POST['quantity']);
    $link      = mysqli_real_escape_string($conn, $_POST['link']);

    // Fetch service price
    $serviceQuery = "SELECT platform, price FROM services WHERE id = $serviceId LIMIT 1";
    $serviceResult = mysqli_query($conn, $serviceQuery);
    if (!$serviceResult || mysqli_num_rows($serviceResult) == 0) {
        die("Invalid service selected.");
    }
    $service = mysqli_fetch_assoc($serviceResult);
    $platform = $service['platform'];
    $unitPrice = $service['price'];

    // Calculate total
    $totalAmount = $unitPrice * $quantity;

    // Fetch wallet balance
    $walletQuery = "SELECT balance FROM wallet WHERE fullname = '$fullname' LIMIT 1";
    $walletResult = mysqli_query($conn, $walletQuery);
    if ($walletResult && mysqli_num_rows($walletResult) > 0) {
        $wallet = mysqli_fetch_assoc($walletResult);
        $walletBalance = $wallet['balance'];
    } else {
        $walletBalance = 0;
    }

    // Check funds
    if ($walletBalance < $totalAmount) {
        echo "<script>
            alert('Insufficient funds. Please recharge your wallet.');
            window.location.href='userdashboard.php';
        </script>";
        exit();
    }

    // Deduct wallet
    $newBalance = $walletBalance - $totalAmount;
    $updateWallet = "UPDATE wallet SET balance = $newBalance WHERE fullname = '$fullname'";
    mysqli_query($conn, $updateWallet);

    // Insert order
    $insertOrder = "INSERT INTO orders (user_id, platform, quantity, link, amount, status, created_at) 
                    VALUES ('$userId', '$platform', '$quantity', '$link', '$totalAmount', 'Processing', NOW())";
    if (mysqli_query($conn, $insertOrder)) {
        echo "<script>
            alert('Order placed successfully!');
            window.location.href='userdashboard.php';
        </script>";
    } else {
        echo "Error: " . mysqli_error($conn);
    }
} else {
    header("Location: userdashboard.php");
    exit();
}
