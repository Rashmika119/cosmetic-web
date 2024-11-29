<?php include "../header/header.php"; ?>

<?php
session_start();

if (isset($_SESSION['supplierID'])) {
    $supplierid = $_SESSION['supplierID'];
    $brandid = $_SESSION['brandId'];

    if (isset($_POST['status'])) {
        $status = $_POST['status'];
        $ordersql = "select op.order_id,p.id,p.name,c.f_name,o.status,o.due_date
    from order_product as op
    join product as p on op.product_id = p.id
    join orders as o on op.order_id = o.id
    join customer as c on o.customer_id = c.id
    where p.brand_id = '$brandid' and o.status = '$status'";

        $order = mysqli_query($connection, $ordersql);
        if (!$order) {
            echo "<script>alert('Cant get order data!')</script>";
        } else {
            if (mysqli_num_rows($order) > 0) {
                $orderdata = mysqli_fetch_all($order, MYSQLI_ASSOC);
            }
        }
    } else {
        $ordersql = "select op.order_id,p.id,p.name,c.f_name,o.status,o.due_date
        from order_product as op
        join product as p on op.product_id = p.id
        join orders as o on op.order_id = o.id
        join customer as c on o.customer_id = c.id
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

<link rel="stylesheet" href="../orders/css/order.css">

<?php
include "../navbar/navbar.php";
?>


<div class="orders-page">
    <h2>View Orders</h2>

    <div class="filter-navbar">
        <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
            <button type="submit" class="nav-btn active">All</button>
            <button type="submit" class="nav-btn" name="status" value="pending">Pending</button>
            <button type="submit" class="nav-btn" name="status" value="shipped">Shipped</button>
            <button type="submit" class="nav-btn" name="status" value="delivered">Delivered</button>
            <button type="submit" class="nav-btn" name="status" value="Canceled">Cancled</button>
        </form>

    </div>


    <table class="orders-table">
        <thead>
            <tr>
                <th>Order ID</th>
                <th>Product</th>
                <th>Customer</th>
                <th>Status</th>
                <th>Date</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>

            <?php
            if (!empty(($orderdata))):
                foreach ($orderdata as $data): ?>
                    <tr>
                        <td><?php echo $data['order_id']; ?></td>
                        <td><?php echo $data['name']; ?></td>
                        <td><?php echo $data['f_name']; ?></td>
                        <td><button class="action-btn"><?php echo $data['status']; ?></button></td>
                        <td><?php echo $data['due_date']; ?></td>
                        <td>
                            <a href="../orders/viewDetails.php?oid=<?php echo $data['order_id']; ?>&pid=<?php echo $data['id']; ?>"
                                class="view-details-btn">View Details</a>

                        </td>
                    </tr>

                <?php endforeach;
            endif; ?>

        </tbody>
    </table>
</div>


<?php include "../footer/footer.php";
