<?php include "../header/header.php"; ?>

<?php
session_start();

if (isset($_SESSION['supplierID'])) {
    $supplierid = $_SESSION['supplierID'];
    $brandid = $_SESSION['brandId'];

    if (isset($_POST['status'])) {
        $status = $_POST['status'];
        $ordersql = "select p.*,pr.id as id,pr.name as name,pr.price as price,op.quantity
        from payment as p
        join order_product as op on p.order_id = op.order_id
        join product as pr on op.product_id = pr.id
        join orders as o on op.order_id = o.id
        where brand_id = '$brandid' and p.status = '$status'";

        $order = mysqli_query($connection, $ordersql);
        if (!$order) {
            echo "<script>alert('Cant get order data!')</script>";
        } else {
            if (mysqli_num_rows($order) > 0) {
                $orderdata = mysqli_fetch_all($order, MYSQLI_ASSOC);
            }
        }
    } else {
        $ordersql = "select p.*,pr.id as id,pr.name as name,pr.price as price,op.quantity
        from payment as p
        join order_product as op on p.order_id = op.order_id
        join product as pr on op.product_id = pr.id
        join orders as o on op.order_id = o.id
        where brand_id = '$brandid'";

        $order = mysqli_query($connection, $ordersql);
        if (!$order) {
            echo "<script>alert('Cant get order data!')</script>";
        } else {
            if (mysqli_num_rows($order) > 0) {
                $orderdata = mysqli_fetch_all($order, MYSQLI_ASSOC);
            }
        }
    }


}

?>


<link rel="stylesheet" href="../payment/css/payment.css">

<?php
include "../navbar/navbar.php";
?>





<div class="payments-page">
    <h2>Payment Overview</h2>


    <div class="filter-navbar">
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
            <button class="nav-btn active">All</button>
            <button class="nav-btn" name="status" value="paid">Paid</button>
            <button class="nav-btn" name="status" value="pending">Pending</button>
            <button class="nav-btn" name="status" value="Refunded">Refunded</button>
        </form>

    </div>


    <table class="payment-table">
        <thead>
            <tr>
                <th>Order ID</th>
                <th>Date & Time</th>
                <th>Product Id</th>
                <th>Product Name</th>
                <th>Amount</th>
                <th>Status</th>


            </tr>
        </thead>
        <tbody>

            <?php
            if (!empty(($orderdata))):
                foreach ($orderdata as $data): ?>
                    <tr>
                        <td><?php echo $data['order_id']; ?></td>
                        <td><?php echo $data['date']; ?></td>
                        <td><?php echo $data['id']; ?></td>
                        <td><?php echo $data['name']; ?></td>
                        <td><?php echo $data['price']*$data['quantity']; ?></td>
                        <td><span class="status paid"><?php echo $data['status']; ?></span></td>


                    </tr>

                <?php endforeach;
            endif; ?>
        </tbody>
    </table>

</div>

<?php include "../footer/footer.php"; ?>