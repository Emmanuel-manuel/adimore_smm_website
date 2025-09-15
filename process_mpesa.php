<?php
session_start();
include 'connection.php';

// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Log the request for debugging
file_put_contents('debug.log', "MPESA Request: " . print_r($_POST, true) . "\n", FILE_APPEND);

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(['success' => false, 'message' => 'Invalid request method']);
    exit;
}

// Check if user is logged in
if(!isset($_SESSION['login_user2'])){
    echo json_encode(['success' => false, 'message' => 'User not logged in']);
    exit;
}

// Get form data
$amount = isset($_POST['amount']) ? $_POST['amount'] : '';
$phone = isset($_POST['mobileNumber']) ? $_POST['mobileNumber'] : '';
$user_id = $_SESSION['login_user2'];

// Validate inputs
if (empty($amount) || empty($phone)) {
    echo json_encode(['success' => false, 'message' => 'Amount and phone number are required']);
    exit;
}

// Validate amount
if ($amount < 5 || $amount > 100000) {
    echo json_encode(['success' => false, 'message' => 'Amount must be between Ksh. 5 and Ksh. 100,000']);
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

mysqli_query($conn, $query);

// After STK push request
$result = json_decode($response);

if (isset($result->ResponseCode) && $result->ResponseCode == "0") {
    $checkoutRequestID = $result->CheckoutRequestID;

    // Save CheckoutRequestID
    $updateQuery = "UPDATE mpesa_transactions 
                    SET checkout_request_id = '$checkoutRequestID' 
                    WHERE transaction_ref = '$transaction_ref'";
    mysqli_query($conn, $updateQuery);

    echo json_encode(['success' => true, 'message' => 'Payment request sent to your phone. Please enter your M-Pesa PIN to complete the transaction.']);
} 
// if (!mysqli_query($conn, $query)) {
//     $error = mysqli_error($conn);
//     file_put_contents('debug.log', "Database Error: $error\n", FILE_APPEND);
//     echo json_encode(['success' => false, 'message' => 'Failed to initiate transaction: ' . $error]);
//     exit;
// }

// M-Pesa API credentials
$consumer_key = "A9g9M73ioGIkg3kgAxVdTX7WGAt5A6ilRYJ9Y518cziFdr5Z";
$consumer_secret = "EaCV8pGFYkY87smIuIAbAGQOKaOAkGFAuGbfkICZagVAZsACB43YHg53Z7FIBkg0";
$shortcode = "174379"; // Sandbox test code
$passkey = "bfb279f9aa9bdbcf158e97dd71a467cd2e0c893059b10f78e6b72ada1ed2c919"; // Sandbox passkey

// Generate access token
$credentials = base64_encode($consumer_key . ':' . $consumer_secret);
$auth_url = 'https://sandbox.safaricom.co.ke/oauth/v1/generate?grant_type=client_credentials';

$ch = curl_init($auth_url);
curl_setopt($ch, CURLOPT_HTTPHEADER, ['Authorization: Basic ' . $credentials]);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
$response = curl_exec($ch);

if (curl_errno($ch)) {
    $error_msg = curl_error($ch);
    file_put_contents('debug.log', "CURL Error: $error_msg\n", FILE_APPEND);
    echo json_encode(['success' => false, 'message' => 'CURL Error: ' . $error_msg]);
    curl_close($ch);
    exit;
}

curl_close($ch);

$result = json_decode($response);
if (!isset($result->access_token)) {
    file_put_contents('debug.log', "Access Token Error: $response\n", FILE_APPEND);
    echo json_encode(['success' => false, 'message' => 'Failed to get access token: ' . $response]);
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

file_put_contents('debug.log', "STK Payload: " . json_encode($stk_payload) . "\n", FILE_APPEND);

$ch = curl_init($stk_url);
curl_setopt($ch, CURLOPT_HTTPHEADER, $stk_header);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($stk_payload));
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
$response = curl_exec($ch);

if (curl_errno($ch)) {
    $error_msg = curl_error($ch);
    file_put_contents('debug.log', "STK CURL Error: $error_msg\n", FILE_APPEND);
    echo json_encode(['success' => false, 'message' => 'STK CURL Error: ' . $error_msg]);
    curl_close($ch);
    exit;
}

curl_close($ch);

file_put_contents('debug.log', "STK Response: $response\n", FILE_APPEND);

$result = json_decode($response);
if (isset($result->ResponseCode) && $result->ResponseCode == "0") {
    echo json_encode(['success' => true, 'message' => 'Payment request sent to your phone. Please enter your M-Pesa PIN to complete the transaction.']);
} else {
    $error_msg = isset($result->errorMessage) ? $result->errorMessage : 'Unknown error';
    echo json_encode(['success' => false, 'message' => 'Failed to initiate payment: ' . $error_msg]);
}
?>