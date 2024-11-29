<?php

include "../connection/connection.php";

// Get the Order ID from the URL
if (isset($_GET['oid']) && !empty($_GET['oid'])) {
    $order_id = $_GET['oid'];

    // Update the order status to 'canceled'
    $sql = "UPDATE orders SET status = 'Canceled' WHERE id = '$order_id'";

    if (mysqli_query($connection, $sql)) {
        echo "<script>alert('Order canceled successfully!');</script>";
        // Redirect back to the profile page or a confirmation page
        header("Location: ../profile/orders.php");
        exit();
    } else {
        echo "Error updating record: " . mysqli_error($conn);
    }
} else {
    echo "Invalid Order ID.";
}

// Close the connection
mysqli_close($conn);
?>
