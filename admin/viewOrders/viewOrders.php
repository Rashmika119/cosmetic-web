<?php
include "../header/header.php"; // Include your database connection file


$dateFilter = '';
$statusFilter = 'all';


if (isset($_POST['filter'])) {
    $dateFilter = $_POST['date'];
    $statusFilter = $_POST['status'];


    $query = "SELECT * FROM orders WHERE 1=1";

    if (!empty($dateFilter)) {
        $query .= " AND due_date = '$dateFilter'";
    }

    if ($statusFilter !== 'all') {
        $query .= " AND status = '$statusFilter'";
    }


} else {

    $query = "SELECT * FROM orders";
}


$result = mysqli_query($connection, $query);
$fetch = mysqli_fetch_all($result, MYSQLI_ASSOC);

if (isset($_POST['update'])) {
    header("location:../orderUpdate/orderUpdate.php");
}
?>



<title>View Orders</title>
<link rel="stylesheet" href="../viewOrders/vieworders.css">

<body>
    <div class="content">
        <h1>View Orders</h1>

        <form action="../viewOrders/viewOrders.php" method="POST" class="filter-nav">
            <div class="filter-option">
                <label for="date">Filter by Date:</label>
                <input type="date" id="date" name="date" placeholder="mm/dd/yyyy">
            </div>
            <div class="filter-option">
                <label for="status">Filter by Status:</label>
                <select id="status" name="status">
                    <option value="all" <?php if ($statusFilter == 'all')
                        echo 'selected'; ?>>All</option>
                    <option value="Pending" <?php if ($statusFilter == 'Pending')
                        echo 'selected'; ?>>Pending
                    </option>
                    <option value="shipped" <?php if ($statusFilter == 'Shipped')
                        echo 'selected'; ?>>Shipped</option>
                    <option value="delivered" <?php if ($statusFilter == 'Delivered')
                        echo 'selected'; ?>>Delivered
                    </option>
                </select>
            </div>

            <button type="submit" class="apply-filters-btn" name="filter">Apply Filters</button>
        </form>

        <div class="view-orders">
            <table class="ordersTable">
                <tr>
                    <th>Order ID</th>
                    <th>Date</th>
                    <th>Customer</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>

                <?php if (!empty($fetch)): ?>
                    <?php foreach ($fetch as $detail): ?>
                        <?php
                        $customerQuery = "SELECT f_name FROM customer WHERE id='" . $detail['customer_id'] . "'";
                        $customerResult = mysqli_query($connection, $customerQuery);
                        $fetchCustomer = mysqli_fetch_assoc($customerResult);
                        $customerName = !empty($fetchCustomer) ? $fetchCustomer['f_name'] : 'Unknown';
                        ?>

                        <tr>
                            <td name="id">#<?php echo $detail['id']; ?></td>
                            <td nmae="date"><?php echo $detail['due_date']; ?></td>
                            <td name="customername"><?php echo $customerName; ?></td>
                            <td><?php echo $detail['status']; ?></td>

                            <form action="../orderUpdate/orderUpdate.php" method="post">
                                <input type="hidden" value="<?php echo $detail['id']; ?>" name="id">
                                <input type="hidden" value="<?php echo $customerName; ?>" name="customername">
                                <input type="hidden" value="<?php $detail['status']; ?>" name="status">
                                <td><button class="action-btn" type="submit" name="update">Update Status</button></td>
                            </form>


                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="5">No orders found.</td>
                    </tr>
                <?php endif; ?>
            </table>
          


        </div>
    </div>
    <?php include '../footer/footer.php' ?>
</body>

</html>