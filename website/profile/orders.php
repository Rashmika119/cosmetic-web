<?php

include "../header/header.php";

session_start();
if (!isset($_SESSION['userId'])) {
    header("Location:../signinup/signin.php");
}

$userid = $_SESSION['userId'];

$sql = "select * from customer where id = '$userid'";
$result = mysqli_query($connection, $sql);
if (!$result) {
    echo "<script> alert('user data not found')</script>";
}
$userdata = mysqli_fetch_all($result, MYSQLI_ASSOC);

$osql = "SELECT * 
FROM orders AS o
WHERE o.customer_id = '$userid' 
  AND o.status != 'Canceled';
";
$oresult = mysqli_query($connection, $osql);
if (!$oresult) {
    echo "<script> alert('order data not found')</script>";
}
$orderdata = mysqli_fetch_all($oresult, MYSQLI_ASSOC);


?>

<link rel="stylesheet" href="styles/profilestyle.css">

<div class="mainImage">
    <img src="images/pic1.png" alt="" class="pic1">
    <h1>Profile</h1>
    <h3>HOME > DASHBOARD</h3>
    <img src="images/pic2.png" alt="" class="pic2">
</div>


<div class="dashboard">

    <div class="linkssection">

        <div class="useremail">
            <div class="icon">
                <i class="fas fa-user"></i>
            </div>
            <div>
                <p>Hellow,</p>
                <p><?PHP echo $userdata[0]['f_name']; ?></p>
            </div>
        </div>

        <div class="links">
            <ul>
                <li><a href="account.php">Account</a></li>
                <li><a href="orders.php">Orders</a></li>

                <li><a href="../cart/cart.php">Cart</a></li>

                <li><a href="logout.php">Log Out</a></li>
            </ul>
        </div>

    </div>

    <div class="details">

        <?php if (!empty($orderdata)):
            foreach ($orderdata as $data):

                $oid = $data['id'];
                $opsql = "select p.*,op.quantity,b.name as bname from order_product as op
                join product as p on op.product_id = p.id 
                join brand_category as b on p.brand_id = b.id
                where op.order_id = '$oid'";
                $opresult = mysqli_query($connection, $opsql);
                if (!$opresult) {
                    echo "<script> alert('order data not found')</script>";
                }
                $orderpdata = mysqli_fetch_all($opresult, MYSQLI_ASSOC);


                ?>

                <div class="order-management">

                    <div class="order">
                        <h2>Order Id - <?php echo $data['id']; ?></h2>
                        <div class="order-details">
                            <h3>Order Details</h3>
                            <ul>
                                <li><strong>Due Date: </strong><?php echo $data['due_date']; ?></li>
                                <li><strong>Status: </strong><?php echo $data['status']; ?></li>
                                <li><strong>Total: LKR</strong><?php $total = 0;
                                foreach ($orderpdata as $quantity) {
                                    $total += $quantity['price'] * $quantity['quantity'];
                                }
                                echo $total;
                                ?></li>
                                <li><strong>Items:</strong> <?php echo count($orderpdata) ?></li>
                            </ul>
                        </div>




                        <div class="order-items">
                            <?php if (!empty($orderpdata)):
                                foreach ($orderpdata as $pdata): ?>

                                    <div>
                                        <ul>
                                            <div class="itempic">
                                                <img src="<?php echo "../" . $pdata['image']; ?>" alt="">
                                            </div>

                                            <div class="itemdetails">
                                                <li><strong><?php echo $pdata['name']." (".$pdata['bname'].")"; ?></strong></li>
                                                <li><strong><?php echo $pdata['price']." * ". $pdata['quantity']; ?></strong></li>
                                            </div>

                                        </ul>
                                    </div>

                                    <?php
                                endforeach;
                            endif; ?>

                        </div>

                    </div>

                    <div class="order-actions">
                        <button class="cancel-btn" ><a style="text-decoration: none;color: white" href="../profile/canselorder.php?oid=<?php echo $data['id']; ?>" onclick="return confirm('Are you sure you want to cancel this order?')">Cancel Order</a></button>
                    </div>



                </div>
                <?php
            endforeach;
        endif; ?>
    </div>

</div>

<?php include "../footer/footer.php"; ?>