<?php include "../header/header.php"; ?>

<?php
session_start();

if (isset($_SESSION['supplierID'])) {
    $supplierid = $_SESSION['supplierID'];
    $brandid = $_SESSION['brandId'];

    $sql = "select s.*,b.name as bname from supplier as s join brand_category as b on b.id = s.brand_id   where s. id = '$supplierid'";
    $result = mysqli_query($connection, $sql);
    if (!$result) {
        echo "<script>alert('Cant get supplier data!')</script>";
    } else {
        if (mysqli_num_rows($result) > 0) {
            $supplierdata = mysqli_fetch_all($result, MYSQLI_ASSOC);
        }
    }

    $ordersql = "select op.*,p.price,o.status from order_product as op
join product as p on op.product_id = p.id
join orders as o on op.order_id = o.id
where brand_id = 
'$brandid'";
    $order = mysqli_query($connection, $ordersql);
    if (!$order) {
        echo "<script>alert('Cant get order data!')</script>";
    } else {
        if (mysqli_num_rows($order) > 0) {
            $orderdata = mysqli_fetch_all($order, MYSQLI_ASSOC);
        }
    }

} else {
    header('Location:../signin/signin.php');
}


?>

<?php
include "../navbar/navbar.php";
?>

<link rel="stylesheet" href="../dashboard/css/dashboard.css">

<section class="main-content">
    <h2>Dashboard Overview</h2>

    <div class="profile">
        <form>

            <h3>Brand Name:</h3>
            <input type="text" id="companyName" value="<?php echo $supplierdata[0]['bname']; ?>" readonly>

        </form>
    </div>

    <div class="stats-container">

        <div class="stat-box">
            <h3>Total Orders</h3>
            <p><?php echo count($orderdata); ?></p>
        </div>

        <div class="stat-box">
            <h3>Total Revenue</h3>
            <p>

                <?php
                $totalrev = 0;
                foreach ($orderdata as $order) {
                    $totalrev += $order['price'] * $order['quantity'];
                }
                echo 'LKR ' . $totalrev . '';
                ?>

            </p>
        </div>

        <div class="stat-box">
            <h3>Pending Shipment</h3>
            <p><?php $pending = 1;
            foreach ($orderdata as $order) {
                if ($order['status'] == 'Pending') {
                    $pending++;
                }
            }
            echo $pending;
            ?></p>
        </div>
    </div>


</section>

<?php include "../footer/footer.php"; ?>