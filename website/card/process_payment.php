<?php


session_start();
$userid = $_SESSION['userId'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
 
    $cardType = htmlspecialchars($_POST['card_type']);
    $cardNumber = htmlspecialchars($_POST['card_number']);
    $cardholderName = htmlspecialchars($_POST['cardholder_name']);
    $expiryDate = htmlspecialchars($_POST['expiry_date']);
    $cvv = htmlspecialchars($_POST['cvv']);

   
    if (empty($cardType) || empty($cardNumber) || empty($cardholderName) || empty($expiryDate) || empty($cvv)) {
        echo "Please fill in all required fields.";
        exit();
    }

    $_SESSION['cardType'] = $cardType;
    $_SESSION['cardNumber'] = $cardNumber;

    
    $payment_success = true; 

    
    if ($payment_success) {
        
        header("Location: ../confirm/confirm.php?type=card");
        exit();
    } else {
    
        echo "Payment failed. Please try again.";
        exit();
    }
} else {
    
    header("Location: ../card/card.php");
    exit();
}
?>