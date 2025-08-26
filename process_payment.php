<?php
session_start();
require 'connection.php';
$conn = Connect();

// Ensure user is logged in
if (!isset($_SESSION['login_user2'])) {
    header("location: customerlogin.php");
    exit();
}

// Get current logged-in user details
$username = $_SESSION['login_user2'];
$query = "SELECT * FROM customer WHERE username = '$username'";
$result = mysqli_query($conn, $query);

if (!$result || mysqli_num_rows($result) == 0) {
    die("User not found");
}
$user = mysqli_fetch_assoc($result);
$fullname = $user['fullname'];

// Get form data
$amount = isset($_POST['amount']) ? intval($_POST['amount']) : 0;
$method = $_POST['method'] ?? '';

// Default values
$mobileNumber = '';
$cardNumber = '';
$cardExpiryMonth = 0;
$cardExpiryYear = 0;
$ccv = 0;
$cardName = "";

// Handle payment methods
if ($method === 'mpesa') {
    $mobileNumber = mysqli_real_escape_string($conn, $_POST['mobileNumber']);
} elseif ($method === 'card') {
    // If cardNumber is split into 4 fields, concatenate them
    if (isset($_POST['cardNumber']) && is_array($_POST['cardNumber'])) {
        $cardNumber = implode('', $_POST['cardNumber']);
    } else {
        $cardNumber = mysqli_real_escape_string($conn, $_POST['cardNumber']);
    }
    $cardExpiryMonth = intval($_POST['cardExpiryMonth']);
    $cardExpiryYear = intval($_POST['cardExpiryYear']);
    $ccv = intval($_POST['ccv']);
    $cardName = mysqli_real_escape_string($conn, $_POST['cardName']);
} else {
    die("Invalid payment method selected.");
}

// Check if wallet record exists for this user
$check = mysqli_query($conn, "SELECT * FROM wallet WHERE fullname = '$fullname'");
if (mysqli_num_rows($check) > 0) {
    $row = mysqli_fetch_assoc($check);
    $newBalance = $row['balance'] + $amount;

    // Update existing wallet entry
    $update = "UPDATE wallet SET 
        balance = '$newBalance',
        mobileNumber = '$mobileNumber',
        cardNumber = '$cardNumber',
        cardExpiryMonth = '$cardExpiryMonth',
        cardExpiryYear = '$cardExpiryYear',
        ccv = '$ccv',
        cardName = '$cardName'
        WHERE fullname = '$fullname'";
    mysqli_query($conn, $update);

} else {
    // Insert new record
    $insert = "INSERT INTO wallet(fullname, mobileNumber, cardNumber, cardExpiryMonth, cardExpiryYear, ccv, cardName, balance)
        VALUES('$fullname', '$mobileNumber', '$cardNumber', '$cardExpiryMonth', '$cardExpiryYear', '$ccv', '$cardName', '$amount')";
    mysqli_query($conn, $insert);
}

// Redirect back to dashboard
header("Location: userdashboard.php?payment=success");
exit();
?>
