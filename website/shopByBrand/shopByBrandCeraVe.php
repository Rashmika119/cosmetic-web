<?php include "../header/header.php" ?>

<?php


$formbrandsql = "select * from product_category2";
$result = mysqli_query($connection, $formbrandsql);

if ($result) {
    $formp2sqldata = mysqli_fetch_all($result, MYSQLI_ASSOC);
}


if (isset($_POST['submit'])) {

    $p2 = isset($_POST['p2']) ? $_POST['p2'] : [];

    $p2imp = implode(',', array_map('intval', $p2));

    $filteredSql = "SELECT p.*, b.name AS bname 
FROM product AS p 
JOIN brand_category AS b 
ON p.brand_id = b.id 
WHERE p.brand_id = (SELECT id FROM brand_category WHERE name = 'CeraVe')";


    if (!empty($p2imp)) {
        $filteredSql .= "AND p.product_category1_id IN (SELECT id FROM product_category1 WHERE product_category2_id IN ($p2imp))";


    }

    $filteredResult = mysqli_query($connection, $filteredSql);

    if ($filteredResult) {
        $plainsqlresultdata = mysqli_fetch_all($filteredResult, MYSQLI_ASSOC);
    } else {
        echo "No results found.";
    }
} else {

    $plainsql = "SELECT p.*, b.name AS bname 
FROM product AS p 
JOIN brand_category AS b 
ON p.brand_id = b.id 
WHERE p.brand_id = (SELECT id FROM brand_category WHERE name = 'CeraVe')
";
    $plainsqlresult = mysqli_query($connection, $plainsql);
    if ($plainsqlresult) {
        $plainsqlresultdata = mysqli_fetch_all($plainsqlresult, MYSQLI_ASSOC);
    } else {
        echo "no result found";
    }
}
?>

<link rel="stylesheet" href="styles/shopByBrand.css">
<div class="mainImage">
    <img src="images/pic1.png" alt="">
    <h1>SHOP</h1>
    <h3>Shop by Brand > CeraVe</h3>
    <img src="images/pic2.png" alt="" class="pic">
</div>

<div class="itemsSection">
    <ul>
        <li><a href="shopByBrandGarnier.php">Garnier</a></li>
        <li><a href="shopByBrandLorealParis.php">Loreal Paris</a></li>
        <li><a href="shopByBrandNeutrogena.php">Neutrogena</a></li>
        <li><a href="shopByBrandCeraVe.php" class="navactive">Cerave</a></li>
    </ul>
</div>

<div class="mainBody">
    <div class="filterSection">

        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" class="hairCare">
            <div>
                <p>Product Category</p>
                <?php foreach ($formp2sqldata as $data): ?>
                    <span>
                        <input type="checkbox" value="<?php echo $data['id']; ?>" name="p2[]" <?php if (isset($p2) && in_array($data['id'], $p2)) {
                               echo 'checked';
                           } ?>>
                        <label for="p2[]"><?php echo $data['name']; ?></label>
                    </span>
                <?php endforeach; ?>

            </div>

            <button type="submit" name="submit" class="submitbutton">Sumbit</button>
        </form>

    </div>

    <div class="itemSection">
        <?php $results = count($plainsqlresultdata); ?>
        <p id="resultAmount"></p>
        <div class="itemGroup">
            <?php foreach ($plainsqlresultdata as $data): ?>

                <div class='item'>

                    <div class='imagediv'>
                        <img src="<?php echo "../" . htmlspecialchars($data['image']); ?>"
                            alt="<?php echo htmlspecialchars($data['name']); ?>">
                    </div>

                    <a href='../product/product.php?id=<?php echo $data['id']; ?>'>
                        <p><?php echo htmlspecialchars($data['name']); ?></p>
                    </a>
                    <p><?php echo htmlspecialchars($data['price']); ?></p>
                    <p id='brandName'><?php echo htmlspecialchars($data['bname']); ?></p>

                    <?php if ($data['quantity'] == 0): ?>

                        <p style='color:red'>Out of Stock</p>

                        <form action='../buyorcart/buyorcart.php' method='post'>
                            <input type='hidden' name='id' value='<?php echo $data['id']; ?>'>
                            <div class='itembutton'>

                                <button type='submit' name='cart' disabled style="background-color:gray">Add to Cart <i
                                        class='fas fa-shopping-cart'></i></button>
                            </div>
                        </form>

                    <?php else: ?>


                        <form action='../buyorcart/buyorcart.php' method='post'>
                            <input type='hidden' name='id' value='<?php echo $data['id']; ?>'>
                            <div class='itembutton'>

                                <button type='submit' name='cart'>Add to Cart <i class='fas fa-shopping-cart'></i></button>
                            </div>
                        </form>

                    <?php endif; ?>

                </div>

            <?php endforeach; ?>

        </div>
    </div>
</div>
<div class="paginationdiv">

</div>

<script src="scripts/shopByBrand.js"></script>
<script src="scripts/pagination.js"></script>

<?php include "../footer/footer.php"; ?>