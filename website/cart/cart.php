<?php
include "../header/header.php";
session_start();
if (!isset($_SESSION['userId'])) {
    header("Location: ../signinup/signIn.php");
    exit();
}

$userid = $_SESSION['userId'];


$sql = "SELECT p.*,cp.quantity FROM cart AS c 
        JOIN cart_product AS cp ON c.id = cp.cart_id 
        JOIN product AS p ON cp.product_id = p.id 
        WHERE c.customer_id = '$userid'";

$result = mysqli_query($connection, $sql);

if (!$result) {
    echo "<script>alert('Cart connection error!')</script>";
} else {
    $cartdata = mysqli_fetch_all($result, MYSQLI_ASSOC);
    $cartid = (int) $_SESSION['cartId'];
}

if (isset($_POST['deleteitem'])) {
    $cartid = (int) $_SESSION['cartId']; 
    $productid = (int) $_POST['productid'];
    $quantity = $_POST['quantity']; 

    $sql = "DELETE FROM cart_product WHERE cart_id = '$cartid' AND product_id = '$productid'";
    $result = mysqli_query($connection, $sql);

    if (!$result) {
        echo "<script>alert('Cart delete error!')</script>";
    } else {
        $sql3 = "UPDATE product SET quantity = quantity + '$quantity' WHERE id = '$productid' AND quantity > 0";
        mysqli_query($connection, $sql3);

        header("Location: ../cart/cart.php");
        exit();
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['updateitem'])) {
    
    $cart_id = (int) $_SESSION['cartId'];
    $product_id = $_POST['productid'];
    $quantity = $_POST['quantity'];

    
    $sql = "UPDATE cart_product SET quantity = '$quantity' WHERE cart_id = '$cart_id' AND product_id = '$product_id'";

    if (mysqli_query($connection, $sql)) {
        $sql3 = "UPDATE product SET quantity = quantity - '$quantity' WHERE id = '$product_id' AND quantity > 0";
        mysqli_query($connection, $sql3);
        echo "Cart updated successfully.";
        header("Location: ../cart/cart.php");
    } else {
        echo "Error updating cart: " . mysqli_error($conn);
    }
}
?>

<link rel="stylesheet" href="styles/cart.css">

<div class="mainImage">
    <img src="images/pic1.png" alt="" class="pic1">
    <h1>Profile</h1>
    <h3>Shop > Cart</h3>
    <img src="images/pic2.png" alt="" class="pic2">
</div>

<div class="main">
    <?php if (empty($cartdata)): ?>
        <p style="color: red;">There are no cart items!</p>
    <?php else: ?>
        <h3>Products</h3>
        <div class="product">

            <?php foreach ($cartdata as $data): ?>
                <div class="item" style="position:relative;">
                    <img src="../<?php echo htmlspecialchars($data['image']); ?>" alt="">
                    <div class="details">
                        <h4><?php echo htmlspecialchars($data['name']); ?></h4>
                        <p>LKR <?php echo htmlspecialchars($data['price']); ?></p>
                    </div>
                    <div class="amount">
                        <div class="plus">
                            <i class="fas fa-plus"></i>
                        </div>
                        <p id="quantityDisplay"><?php echo $data['quantity']; ?></p>
                        <div class="minus">
                            <i class="fas fa-minus"></i>
                        </div>
                    </div>
                    <div class="subtotal">
                        <p></p>
                    </div>

                    <div class="update">
                        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
                            <input type="hidden" name="cartid" value="<?php echo $cartid; ?>">
                            <input type="hidden" name="productid" value="<?php echo $data['id']; ?>">
                            
                            <input type="hidden" class="quantityInput" name="quantity" value="<?php echo $data['quantity']; ?>">
                            <button
                                style="padding:5px 10px;border-radius:5px;outline:none;border:none;margin-left:50px;color:#d90032;"
                                type="submit" name="updateitem">
                                UPDATE <i class="fas fa-sync-alt"></i>
                            </button>
                        </form>
                    </div>

                    <div class="delete">
                        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
                            <input type="hidden" name="cartid" value="<?php echo $cartid; ?>">
                            <input type="hidden" class="quantityInputdel" name="quantity" value="<?php echo $data['quantity']; ?>">
                            <input type="hidden" name="productid" value="<?php echo $data['id']; ?>">
                            <button class="plus" style="color:#d90032; position:absolute;top:2px;right:2px" type="submit"
                                name="deleteitem"><i class="fas fa-close"></i></button>
                        </form>
                    </div>

                </div>
            <?php endforeach; ?>

        </div>

        <div class="checkout">
            <div>
                <p>SUBTOTAL</p>
                <p class="spa">LKR 11000</p> 
            </div>
            <div class="methodfee">
                <p>CASH ON DELIVERY FEE</p>
                <p class="spa">LKR 100</p>
            </div>
            <div>
                <p>TOTAL</p>
                <p class="spa total">LKR 11100</p>
            </div>
            <a href="../checkout/checkout.php"><button>Checkout</button></a>
        </div>
    <?php endif; ?>
</div>


<script src="scripts/cart.js"></script>

<?php include "../footer/footer.php"; ?>