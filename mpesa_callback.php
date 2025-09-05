<?php
// This file will receive the payment confirmation from Safaricom
include 'connection.php';

$response = file_get_contents('php://input');
$data = json_decode($response);

if (isset($data->Body->stkCallback)) {
    $callback = $data->Body->stkCallback;
    $result_code = $callback->ResultCode;
    $result_desc = $callback->ResultDesc;
    $merchant_request_id = $callback->MerchantRequestID;
    $checkout_request_id = $callback->CheckoutRequestID;
    
    if ($result_code == 0) {
        // Transaction was successful
        $metadata = $callback->CallbackMetadata->Item;
        $amount = $metadata[0]->Value;
        $mpesa_receipt = $metadata[1]->Value;
        $phone = $metadata[4]->Value;
        
        // Update transaction status in database
        $query = "UPDATE mpesa_transactions 
                  SET status = 'completed', mpesa_receipt = '$mpesa_receipt', updated_at = NOW() 
                  WHERE checkout_request_id = '$checkout_request_id'";
        mysqli_query($conn, $query);
        
        // Get user ID from transaction
        $user_query = "SELECT user_id, amount FROM mpesa_transactions WHERE checkout_request_id = '$checkout_request_id'";
        $user_result = mysqli_query($conn, $user_query);
        $transaction = mysqli_fetch_assoc($user_result);
        
        // Update user wallet
        $user_id = $transaction['user_id'];
        $amount = $transaction['amount'];
        
        $wallet_query = "UPDATE wallet SET balance = balance + $amount WHERE user_id = '$user_id'";
        mysqli_query($conn, $wallet_query);
        
        // Log the response
        file_put_contents('mpesa_log.txt', "SUCCESS: " . $response . PHP_EOL, FILE_APPEND);
    } else {
        // Transaction failed
        $query = "UPDATE mpesa_transactions 
                  SET status = 'failed', updated_at = NOW() 
                  WHERE checkout_request_id = '$checkout_request_id'";
        mysqli_query($conn, $query);
        
        // Log the response
        file_put_contents('mpesa_log.txt', "FAILED: " . $response . PHP_EOL, FILE_APPEND);
    }
}

// Always respond to Safaricom callback
header('Content-Type: application/json');
echo json_encode(['ResultCode' => 0, 'ResultDesc' => 'Accepted']);
?>