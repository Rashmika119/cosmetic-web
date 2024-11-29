



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Card Payment - LuxeAura Cosmetics</title>
    <link rel="stylesheet" type="text/css" href="../card/styles/card.css">
</head>
<body>
    <div class="form-container">
        <div class="logo-container">
            <img src="../header/images/logo.jpg" alt="Logo" class="logo">
        </div>
        <h1>Enter Your Card Details</h1>
        <form  class = "form" action="process_payment.php" method="post">
            <div class="payment-method">
                <h4>Select Payment Method</h4>
                <label>
                    <input type="radio" name="card_type" value="visa" required>
                    Visa
                </label>
                <label>
                    <input type="radio" name="card_type" value="mastercard" required>
                    MasterCard
                </label>
            </div>

            <div class="form-group">
                <label for="card_number">Card Number:</label>
                <input type="text" id="card_number" name="card_number" placeholder="XXXX XXXX XXXX XXXX" required>
            </div>

            <div class="form-group">
                <label for="cardholder_name">Cardholder Name:</label>
                <input type="text" id="cardholder_name" name="cardholder_name" required>
            </div>

            <div class="form-group">
                <label for="expiry_date">Expiry Date:</label>
                <input type="text" id="expiry_date" name="expiry_date" placeholder="MM/YY" required>
            </div>

            <div class="form-group">
                <label for="cvv">CVV:</label>
                <input type="text" id="cvv" name="cvv" placeholder="XXX" required>
            </div>

            <button type="submit">Submit Payment</button>
        </form>
    </div>

    <script src="scripts/card.js"></script>
</body>
</html>
