<?php 
include '../header/header.php';

//pagination
$itemsPerPage=5;
$page=isset($_GET['page'])?(int)$_GET['page']:1;
$offset=($page-1) * $itemsPerPage;

$totalItemsQuery="select count(*) as total from payment";
$totalItemsResult=mysqli_query($connection,$totalItemsQuery);
$totalItemsRow=mysqli_fetch_assoc($totalItemsResult);
$totalItems=$totalItemsRow['total'];

$totalPages=ceil($totalItems/$itemsPerPage);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Payments</title>
    <link rel="stylesheet" href="../payments/payments.css">
</head>
<body>
    <div class="content">
        <h2>Payment Records</h2>
        <table class="paymentsTable">
            <thead>
                <tr>
                    <th>Payment ID</th>
                    <th>Amount</th>
                    <th>Account Number</th>
                    <th>Date</th>
                    <th>Provider</th>
                    <th>Customer ID</th>
                    <th>Order ID</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
            <?php

                $query = "SELECT * FROM payment";
                $result = $connection->query($query);

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>
                                <td>{$row['id']}</td>
                                <td>\${$row['amount']}</td>
                                <td>{$row['account_number']}</td>
                                <td>{$row['date']}</td>
                                <td>{$row['provider']}</td>
                                <td>{$row['customer_id']}</td>
                                <td>{$row['order_id']}</td>";

                        // Check the status of the payment
                        if ($row['status'] === 'Refunded') {
                            // Show "Refunded" button if payment is already refunded
                            echo "<td><button class='actionBtn refunded' disabled>Refunded</button></td>";
                        } else {
                            // Show "Refund" button if payment is not refunded yet
                            echo "<td><a href='../paymentRefund/paymentRefund.php?id={$row['id']}'><button class='actionBtn'>Refund</button></a></td>";
                        }

                        echo "</tr>";
                    }
                } else {
                    echo '<tr><td colspan="8" class="no_records_message">No payment records found.</td></tr>';
                }

                $connection->close();
            ?>
            </tbody>
        </table>
        <div class="pagination">
                <?php if ($page > 1): ?>
                    <a href="../payments/payments.php?page=<?php echo $page - 1; ?>">Prev</a>
                <?php endif; ?>

                <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                    <a href="../payments/payments.php?page=<?php echo $i; ?>" class="<?php if ($i == $page) echo 'active'; ?>"><?php echo $i; ?></a>
                <?php endfor; ?>

                <?php if ($page < $totalPages): ?>
                    <a href="../payments/payments.php?page=<?php echo $page + 1; ?>">Next</a>
                <?php endif; ?>
            </div>
    </div>
    <?php include '../footer/footer.php'?>
</body>
</html>
