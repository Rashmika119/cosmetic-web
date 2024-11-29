<?php
include "../header/header.php";
session_start();

$customer_id = $_SESSION['userId'];


$customerQuery = "SELECT c.f_name, c.l_name, c.phone_number, c.email
                  FROM customer c
                  WHERE c.id = $customer_id";
$customerResult = mysqli_query($connection, $customerQuery);
$customer = mysqli_fetch_assoc($customerResult);


if (!$customer) {
    echo "<script>alert('Customer not found. Please sign up.'); window.location.href = '../signinup/signI.php';</script>";
    exit();
}

$addressQuery = "SELECT CONCAT(a.street_1, ', ', a.street_2, ', ', a.district, ' ', a.postal_code) AS address
                 FROM address AS a
                 JOIN customer AS c ON a.id = c.address_id 
                 WHERE c.id = $customer_id";
$addressResult = mysqli_query($connection, $addressQuery);

$address = ($addressResult && mysqli_num_rows($addressResult) > 0)
    ? mysqli_fetch_assoc($addressResult)['address']
    : '';


$customer_name = htmlspecialchars($customer['f_name'] . " " . $customer['l_name'] ?? ''); 
$phone = htmlspecialchars($customer['phone_number'] ?? '');
$email = htmlspecialchars($customer['email'] ?? '');

if (isset($_SESSION['cartId'])) {
    $cart_id = $_SESSION['cartId'];
    $cartQuery = "SELECT cp.quantity, p.name, p.price
                  FROM cart_product cp
                  JOIN product p ON cp.product_id = p.id
                  WHERE cp.cart_id = $cart_id";
    $cartItems = mysqli_query($connection, $cartQuery);
} else {
    $cartItems = null;
    $cart_empty = true;
}



if (isset($_POST["confirmdetails"])) {

    $address = $_POST["address"];

    $_SESSION['orderaddress'] = $address;

}


?>


<link rel="stylesheet" type="text/css" href="styles/checkout.css">

<div class="topic_header">
    <img id="header-img1" src="images/img1.png">
    <div id="topic">
        <h1 id="CHECKOUT">CHECKOUT</h1>
        <h5 id="header-direction"><a class="home-hidden-link" href="">HOME</a> > CHECKOUT</h5>
    </div>
    <img id="header-img2" src="images/img2.png">
</div>

<div class="form">

    <div class="checkout-container">
        <div class="left">
            <h4 id="billing">BILLING DETAILS</h4>

            <form id="confirmForm" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                <label for="name">Name:</label>
                <input type="text" id="name" name="name" value="<?= htmlspecialchars($customer_name) ?>" readonly>

                <label for="phone">Phone Number:</label>
                <input type="text" id="phone" name="phone" value="<?= htmlspecialchars($phone) ?>" readonly>

                <label for="email">Email:</label>
                <input type="email" id="email" name="email" value="<?= htmlspecialchars($email) ?>" readonly>

                <label for="address">Address:</label>
                <input type="text" id="address" name="address" value="<?= htmlspecialchars($address) ?>">


                <button type="submit" name="confirmdetails" id="confirmdetails">Confirm Details</button>

                <p class="message" id="billing-message"></p>
            </form>
        </div>

        <div class="right">
            <h4 id="YourOrder">Your Order</h4>

            <?php if (isset($cart_empty)): ?>
                <p id="empty_msg">Your cart is empty.</p>
            <?php else: ?>
                <div class="product-list">
                    <?php
                    $totalOrderCost = 100;

                    while ($item = mysqli_fetch_assoc($cartItems)) {
                        $q = $item['quantity'];
                        $price = floatval($item['price']);
                        $quantity = intval($q); 
                
                        $productTotal = $price * $quantity;

                
                        $totalOrderCost += $productTotal;

                        echo "<div class='product-item'>";
                        echo "<span>" . htmlspecialchars($item['name']) . " × " . htmlspecialchars($q) . "</span>";
                        echo "<span>LKR " . number_format($productTotal, 2) . "</span>";
                        echo "</div><hr>";
                    }
                    ?>
                </div>

                <div class="subtotal">
                    <span>Subtotal</span>
                    <span id="subtotal-amount">
                        LKR
                        <?php
                        echo number_format($totalOrderCost, 2);
                        $_SESSION['totalOrderCost'] = $totalOrderCost;
                        ?>
                    </span>
                </div>
            <?php endif; ?>

            <div class="payment-method">
                <h4>Payment Method</h4><br>
                <label id="Cash">
                    <input id="cash" type="radio" name="payment" value="cash">
                    Cash on Delivery
                </label>
                <label>
                    <input id="payHere" type="radio" name="payment" value="payhere">
                    Pay Here
                </label>
                <p id="message">Pay by Visa, MasterCard <img class="img" src="../checkout/images/visa.png"> <img
                        class="img" src="../checkout/images/mastercard.svg"></p>
            </div>

            <button class="place-order-button">
                <h4>PLACE ORDER</h4>
            </button>

        </div>
    </div>

</div>

<script>

    document.getElementById('confirmForm').onsubmit = function () {
        return checkAddress();
    };


    function checkAddress() {

        const addressField = document.getElementById('address');
        const message = document.getElementById('billing-message');

        if (!addressField.value.trim()) {
            message.textContent = "Address is required to proceed.";
            message.style.color = "red";
            return false;
        }
        return true;
    }
</script>

<script src="scripts/checkout.js"></script>

<?php
include "../footer/footer.php";
?>