<?php include "../header/header.php"; ?>

<?php
session_start();
if (isset($_SESSION['brandId'])) {
    $brandid = $_SESSION['brandId'];

    $sql = "
SELECT r.date,r.description,r.rating,c.f_name,p.name FROM review as r
LEFT JOIN product as p ON r.product_id = p.id
LEFT JOIN customer as c ON r.customer_id = c.id
where p.brand_id = '$brandid'";

    $result = mysqli_query($connection, $sql);
    if (!$result) {
        echo "<script>alert('cant get review data')</script>";
    } else {
        $reviewdata = mysqli_fetch_all($result, MYSQLI_ASSOC);
    }




}

?>

<?php include "../navbar/navbar.php"; ?>

<link rel="stylesheet" href="../analytics/css/analytics.css">

<div class="analytics-page">
    <h2>Product Performance Analytics</h2>


    <div class="charts">
        <div class="chart-summary">

            <?php
            // Get the first and last day of the current month
            $first_day_of_month = date('Y-m-01');
            $last_day_of_month = date('Y-m-t');

            $sql3 = "SELECT SUM(p.price * op.quantity) AS total_revenue
FROM order_product AS op
JOIN product AS p ON op.product_id = p.id
JOIN orders AS o ON op.order_id = o.id
WHERE p.brand_id = '$brandid'
AND o.created_at BETWEEN '$first_day_of_month' AND '$last_day_of_month'";

            $result3 = mysqli_query($connection, $sql3);

            if ($result3) {
                $row = mysqli_fetch_assoc($result3);
                $total_revenue = $row['total_revenue'];
            }
            ?>

            <p style="margin-bottom: 20px;"><strong>Revenue This Month:</strong> LKR <?php echo number_format($total_revenue, 2); ?></p>

            

            <?php

            $sql2 = "SELECT p.name, SUM(op.quantity) as total_quantity
FROM order_product as op
JOIN product as p ON op.product_id = p.id
WHERE p.brand_id = '$brandid'
GROUP BY p.name
ORDER BY total_quantity DESC
LIMIT 1;
";

            $result2 = mysqli_query($connection, $sql2);

            if ($result2) {
                $bestsellingdata = mysqli_fetch_all($result2, MYSQLI_ASSOC);
            }
            ?>

            <p><strong>Best-Selling Product:</strong> <?php echo $bestsellingdata[0]['name']; ?></p>
        </div>
    </div>


    <div class="reviews-section">
        <h3>Product Ratings & Reviews</h3>

        <?php

        if (!empty($reviewdata)):
            foreach ($reviewdata as $data): ?>
                <div class="review">
                    <p><strong>Product:</strong><?php echo $data['name']; ?></p>
                    <p><strong>Rating:</strong><?php echo $data['rating']; ?> </p>
                    <p><strong>Description:</strong><?php echo $data['description']; ?></p>
                    <p><strong>Customer:</strong><?php echo $data['f_name']; ?></p>
                    <p><strong>Date:</strong><?php echo $data['date']; ?></p>
                </div>
            <?php endforeach;
        endif; ?>

    </div>
</div>

<?php include "../footer/footer.php"; ?>