<?php
include "../header/header.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sales</title>
    <link rel="stylesheet" href="sale.css">
</head>
<body>
    <div class="banner">
        <img class="bannerImg1" src="banner/image.png" alt="">
        <img class="bannerImg2" src="banner/bannerImg2.png" alt="">
        <h1>SALES</h1>
        <h3>HOME > SALES</h3>
    </div>
    <div class="sales">
        <?php
        // Pagination setup
        $itemsPerPage = 8;
        $page = isset($_GET['page']) ? intval($_GET['page']) : 1;
        $offset = ($page - 1) * $itemsPerPage;

        // Count total items
        $countSql = "SELECT COUNT(*) as total FROM product JOIN discount ON product.id = discount.product_id";
        $countResult = mysqli_query($connection, $countSql);
        $totalItems = mysqli_fetch_assoc($countResult)['total'];
        $totalPages = ceil($totalItems / $itemsPerPage);

        // Fetch paginated items
        $discountSql = "SELECT discount.product_id, product.image, product.name, product.quantity, product.price, discount.discount 
                        FROM product 
                        JOIN discount ON product.id = discount.product_id 
                        LIMIT $offset, $itemsPerPage";
        $discountResult = mysqli_query($connection, $discountSql);
        $discountFetch = mysqli_fetch_all($discountResult, MYSQLI_ASSOC);
        ?>

        <div class="sales-group">
            <?php foreach ($discountFetch as $discountItem): ?>
                <div class="sale-item">
                    <img src="../<?php echo htmlspecialchars($discountItem['image']); ?>" alt="">
                    <p class="item-name">
                        <a href="../product/product.php?id=<?php echo $discountItem['product_id']; ?>">
                            <?php echo htmlspecialchars($discountItem['name']); ?>
                        </a>
                    </p>
                    <p>LKR. <?php echo number_format($discountItem['price'] - $discountItem['discount'], 2); ?></p>
                    <p class="discount">LKR. <?php echo number_format($discountItem['price'], 2); ?></p>
                    
                    <?php if ($discountItem['quantity'] == 0): ?>
                        <p style='color:red'>Out of Stock</p>
                        <form action='../buyorcart/buyorcart.php' method='post'>
                            <input type='hidden' name='id' value='<?php echo $discountItem['product_id']; ?>'>
                            <div class='itembutton'>
                                <button type='submit' name='cart' disabled style="background-color:gray">
                                    Add to Cart <i class='fas fa-shopping-cart'></i>
                                </button>
                            </div>
                        </form>
                    <?php else: ?>
                        <form action='../buyorcart/buyorcart.php' method='post'>
                            <input type='hidden' name='id' value='<?php echo $discountItem['product_id']; ?>'>
                            <div class='itembutton'>
                                <button type='submit' name='cart'>
                                    Add to Cart <i class='fas fa-shopping-cart'></i>
                                </button>
                            </div>
                        </form>
                    <?php endif; ?>
                </div>
            <?php endforeach; ?>
        </div>

        <!-- Pagination Controls -->
        <div class="pagination">
            <?php if ($page > 1): ?>
                <a href="?page=<?php echo ($page - 1); ?>" class="pagination-button">Previous</a>
            <?php endif; ?>

            <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                <a href="?page=<?php echo $i; ?>" class="pagination-button <?php echo ($i == $page) ? 'active' : ''; ?>">
                    <?php echo $i; ?>
                </a>
            <?php endfor; ?>

            <?php if ($page < $totalPages): ?>
                <a href="?page=<?php echo ($page + 1); ?>" class="pagination-button">Next</a>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>

<?php include "../footer/footer.php"; ?>