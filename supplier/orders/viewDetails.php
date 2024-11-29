<?php include "../header/header.php" ?>

<?php


if (isset($_GET['oid']) && isset($_GET['pid'])) {
    $pid = $_GET['pid'];
    $oid = $_GET['oid'];

    $ordersql = "select op.order_id,op.quantity,p.id,p.name,c.f_name,o.status,o.due_date
    from order_product as op
    join product as p on op.product_id = p.id
    join orders as o on op.order_id = o.id
    join customer as c on o.customer_id = c.id
    where  op.order_id = '$oid' and p.id = '$pid'";

    $order = mysqli_query($connection, $ordersql);
    if (!$order) {
        echo "<script>alert('Cant get order data!')</script>";
    } else {
        if (mysqli_num_rows($order) > 0) {
           
            $orderdata = mysqli_fetch_all($order, MYSQLI_ASSOC);
        }
    }
}



?>

<link rel="stylesheet" href="../orders/css/viewDetails.css">



<div class="orders-page">
<a href="../orders/order.php" class="back-button">Back to Orders</a>
    <h2>Orders</h2>
    <div class="vertical-table">

        <div class="order-row">
            <h3><?php echo $orderdata[0]['order_id'] ;?></h3>
            <p><strong>Product:</strong><?php echo  $orderdata[0]['name'] ;?></p>
            <p><strong>Quantity:</strong><?php echo  $orderdata[0]['quantity'] ;?></p>
            <p><strong>Customer:</strong><?php echo  $orderdata[0]['f_name'] ;?></p>
            <p><strong>Status:</strong><?php echo  $orderdata[0]['status'] ;?></p>
            <p><strong>Due Date:</strong><?php echo  $orderdata[0]['due_date'] ;?></p>
        </div>

    </div>
</div>

<?php include "../footer/footer.php" ?>