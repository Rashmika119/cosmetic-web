<?php
// paymentRefund.php

include '../header/header.php';

// Get Payment ID from URL
$paymentId = isset($_GET['id']) ? $_GET['id'] : null;

// Initialize variables
$amount = '';
$accountNumber = '';
$provider = '';
$customerId = '';
$orderId = '';
$maskedAccount = '';

// Check if the payment ID is provided
if ($paymentId) {
    // Fetch payment details from the database
    $query = "SELECT * FROM payment WHERE id = ?";
    $stmt = $connection->prepare($query);
    $stmt->bind_param("i", $paymentId);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $amount = $row['amount'];
        $accountNumber = $row['account_number'];
        $provider = $row['provider'];
        $customerId = $row['customer_id'];
        $orderId = $row['order_id'];
        
        // Masking account number except for the last 4 digits
        $maskedAccount = str_repeat('*', strlen($accountNumber) - 4) . substr($accountNumber, -4);
    } else {
        echo "<p>Payment record not found.</p>";
        exit;
    }
    $stmt->close();
} else {
    echo "<p>No Payment ID provided.</p>";
    exit;
}

// Check if the form is submitted for a refund
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Fetch the refund details from the form
    $refundAmount = $_POST['refund_amount'];
    $refundReason = $_POST['reason'];

    // Validate refund amount and reason
    if (empty($refundAmount) || empty($refundReason)) {
        echo "<p>All fields are required for the refund!</p>";
    } else {
        // Update the payment status to 'Refunded'
        $updatePaymentQuery = "UPDATE payment SET status = 'Refunded' WHERE id = ?";
        $stmt = $connection->prepare($updatePaymentQuery);
        $stmt->bind_param("i", $paymentId);
        $stmt->execute();

        // Check if update was successful
        if ($stmt->affected_rows > 0) {
            echo "<p>Refund processed successfully!</p>";
        } else {
            echo "<p>Error processing refund: " . $stmt->error . "</p>";
        }
        
        $stmt->close();

        // Redirect back to the payments page
        echo "<script>
                setTimeout(function() { 
                    window.location.href = '../payments/payments.php'; 
                }, 2000);
              </script>";
    }
}

$connection->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Refund Payment</title>
    <link rel="stylesheet" href="../paymentRefund/paymentRefund.css">
</head>
<body>
    <div class="refund">
        <h2>Refund Payment for Order #<?php echo htmlspecialchars($orderId); ?></h2>
        <div class="refund-details">
            <label>Payment ID: <?php echo htmlspecialchars($paymentId); ?></label></br>
            <label>Amount: $<?php echo htmlspecialchars(number_format($amount, 2)); ?></label></br>
            <label>Account Number: <?php echo htmlspecialchars($maskedAccount); ?></label></br>
            <label>Provider: <?php echo htmlspecialchars($provider); ?></label></br>
            <label>Customer ID: <?php echo htmlspecialchars($customerId); ?></label></br>
            <label>Order ID: <?php echo htmlspecialchars($orderId); ?></label></br>
            
            <!-- Refund Form -->
            <form method="POST">
                <label for="reason">Refund Reason:</label>
                <input type="text" name="reason" id="reason" placeholder="Enter reason for refund" required></br>
                
                <label for="refund-amount">Refund Amount:</label>
                <input type="text" name="refund_amount" id="refund-amount" value="<?php echo htmlspecialchars(number_format($amount, 2)); ?>" required></br>
                
                <button type="submit">Confirm Refund</button>
            </form>
        </div>
    </div>
</body>
</html>
