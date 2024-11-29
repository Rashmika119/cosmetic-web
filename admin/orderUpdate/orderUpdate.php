<?php
include "../header/header.php";

// Get order ID from URL
if (isset($_POST['update'])) {
    $Id = $_POST['id'];

    // Fetch the order details for displaying on the page
    $orderDetails = "SELECT * FROM orders WHERE id = '$Id'";
    $orderResult = mysqli_query($connection, $orderDetails);
    $fetchOrder = mysqli_fetch_assoc($orderResult); // Fetch single row as an associative array

    if ($fetchOrder) {
        // Use the fetched data for order ID and customer name
        $orderId = $fetchOrder['id'];
        $customerId = $fetchOrder['customer_id'];
        $currentStatus = $fetchOrder['status'];

        $customerQuery = "SELECT f_name FROM customer WHERE id = $customerId";
        $customerResult = mysqli_query($connection, $customerQuery);
        $fetchCustomerId = mysqli_fetch_assoc($customerResult);

        $customer = $fetchCustomerId['f_name'];

    } else {
        echo "Order not found.";
        exit();
    }
}

// If submit button is clicked to update the order status
if (isset($_POST['submit'])) {
    $orderId = $_POST['order_id']; // Retrieve the order ID from the hidden input field
    $status = $_POST['status'];

    // Update query
    $updateQuery = "UPDATE orders SET status = '$status' WHERE id = '$orderId'";
    $updateResult = mysqli_query($connection, $updateQuery);

    if ($updateResult) {
        echo "Updated successfully";
        header("Location:../vieworders/viewOrders.php"); // Redirect after update
        exit();
    } else {
        echo "Error updating record: " . mysqli_error($connection);
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Order Status</title>
    <link rel="stylesheet" href="orderUpdate.css">
</head>

<body>
    <div class="edit">
        <h2>Update Order Status for Order #<?php echo $orderId; ?></h2>
        <form action="orderUpdate.php" method="post">
            <!-- Hidden field to store order ID -->
            <input type="hidden" name="order_id" value="<?php echo $orderId; ?>">
            <div class="edit-items">
                <label for="order-id">Order ID: <?php echo $orderId; ?></label><br>
                <label for="customer-name">Customer: <?php echo $customer; ?></label><br>
                <label for="current-status">Current Status:</label>
                <select id="current-status" name="status">
                    <option value="Pending" <?php if ($currentStatus == 'Pending')
                        echo 'selected'; ?>>Pending
                    </option>
                    <option value="Shipped" <?php if ($currentStatus == 'Shipped')
                        echo 'selected'; ?>>Shipped</option>
                    <option value="Delivered" <?php if ($currentStatus == 'Delivered')
                        echo 'selected'; ?>>Delivered
                    </option>
                    <option value="Cancelled" <?php if ($currentStatus == 'Cancelled')
                        echo 'selected'; ?>>Cancelled
                    </option>
                </select>
            </div>
            <button name="submit" type="submit">Submit</button>
        </form>
    </div>
</body>

</html>