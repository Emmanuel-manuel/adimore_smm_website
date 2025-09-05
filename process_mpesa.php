<?php
session_start();
include 'connection.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    die("Invalid request method");
}

// Get form data
$amount = $_POST['amount'];
$phone = $_POST['mobileNumber'];
$user_id = $_SESSION['login_user2'];

// Validate inputs
if (empty($amount) || empty($phone)) {
    echo json_encode(['success' => false, 'message' => 'Amount and phone number are required']);
    exit;
}

// Format phone number (ensure it's in 2547XXXXXXXX format)
if (substr($phone, 0, 1) === '0') {
    $phone = '254' . substr($phone, 1);
} elseif (substr($phone, 0, 1) === '+') {
    $phone = substr($phone, 1);
}

// Generate unique transaction reference
$transaction_ref = 'SMM' . time() . rand(100, 999);

// Store transaction in database with pending status
$query = "INSERT INTO mpesa_transactions (user_id, amount, phone, transaction_ref, status, created_at) 
          VALUES ('$user_id', '$amount', '$phone', '$transaction_ref', 'pending', NOW())";
if (!mysqli_query($conn, $query)) {
    echo json_encode(['success' => false, 'message' => 'Failed to initiate transaction']);
    exit;
}

// M-Pesa API credentials
$consumer_key = "A9g9M73ioGIkg3kgAxVdTX7WGAt5A6ilRYJ9Y518cziFdr5Z";
$consumer_secret = "EaCV8pGFYkY87smIuIAbAGQOKaOAkGFAuGbfkICZagVAZsACB43YHg53Z7FIBkg0";
$shortcode = "174379"; // Sandbox test code
$passkey = "798814567@Num"; // You'll need to get this from your Daraja account

// Generate access token
$credentials = base64_encode($consumer_key . ':' . $consumer_secret);
$auth_url = 'https://sandbox.safaricom.co.ke/oauth/v1/generate?grant_type=client_credentials';

$ch = curl_init($auth_url);
curl_setopt($ch, CURLOPT_HTTPHEADER, ['Authorization: Basic ' . $credentials]);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
$response = curl_exec($ch);
curl_close($ch);

$result = json_decode($response);
if (!isset($result->access_token)) {
    echo json_encode(['success' => false, 'message' => 'Failed to get access token']);
    exit;
}

$access_token = $result->access_token;

// Initiate STK push
$stk_url = 'https://sandbox.safaricom.co.ke/mpesa/stkpush/v1/processrequest';
$timestamp = date('YmdHis');
$password = base64_encode($shortcode . $passkey . $timestamp);

$stk_header = [
    'Authorization: Bearer ' . $access_token,
    'Content-Type: application/json'
];

$stk_payload = [
    'BusinessShortCode' => $shortcode,
    'Password' => $password,
    'Timestamp' => $timestamp,
    'TransactionType' => 'CustomerPayBillOnline',
    'Amount' => $amount,
    'PartyA' => $phone,
    'PartyB' => $shortcode,
    'PhoneNumber' => $phone,
    'CallBackURL' => 'http://127.0.0.1/smm_website/mpesa_callback.php', 
    'AccountReference' => 'SMMWallet',
    'TransactionDesc' => 'Wallet recharge',
    'Remark' => 'Wallet recharge'
];

$ch = curl_init($stk_url);
curl_setopt($ch, CURLOPT_HTTPHEADER, $stk_header);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($stk_payload));
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
$response = curl_exec($ch);
curl_close($ch);

$result = json_decode($response);
if (isset($result->ResponseCode) && $result->ResponseCode == "0") {
    echo json_encode(['success' => true, 'message' => 'Payment request sent to your phone. Please enter your M-Pesa PIN to complete the transaction.']);
} else {
    echo json_encode(['success' => false, 'message' => 'Failed to initiate payment: ' . ($result->errorMessage ?? 'Unknown error')]);
}
?>