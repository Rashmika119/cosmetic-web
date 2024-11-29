<?php include "../header/header.php" ?>

<?php

session_start();
if (isset($_SESSION['userId'])) {
    $userid = mysqli_real_escape_string($connection, $_SESSION['userId']);
    $usersql = "SELECT * FROM customer WHERE id = '$userid'";
    $result = mysqli_query($connection, $usersql);
    if ($result) {
        $userdata = mysqli_fetch_all($result, MYSQLI_ASSOC);
    }
}

if (isset($_GET['id'])) {
    $productid = mysqli_real_escape_string($connection, $_GET['id']);

    $sql = "SELECT * FROM product WHERE id ='$productid'";
    $result = mysqli_query($connection, $sql);

    if (!$result) {
        $error = mysqli_error($connection);
        echo "<script>alert('Product data not found! $error')</script>";
        header("Location:../shopByConsern/shopByConsernHair.php");
        exit;
    } else {
        $resultdata = mysqli_fetch_all($result, MYSQLI_ASSOC);
    }
}

if (isset($_POST['reviewsubmit'])) {
    $userid = mysqli_real_escape_string($connection, $_POST['userid']);
    $productid = mysqli_real_escape_string($connection, $_POST['productid']);
    $rating = mysqli_real_escape_string($connection, $_POST['rating']);
    $description = mysqli_real_escape_string($connection, $_POST['description']);

    $sql = "INSERT INTO review (rating, description, customer_id, product_id) VALUES ('$rating', '$description', '$userid', '$productid')";
    $result = mysqli_query($connection, $sql);

    if (!$result) {
        $error = mysqli_error($connection);
        echo "<script>alert('Data can't be added! $error')</script>";
        header("Location:../product/product.php?id=$productid");
        exit;
    } else {
        header("Location:../product/product.php?id=$productid");
        exit;
    }
}
?>

<link rel="stylesheet" href="styles/product.css">
<div class="mainImage">
    <img src="images/pic1.png" alt="" class="pic1">
    <h1>SHOP</h1>
    <h3>Shop by Concern > Nail</h3>
    <img src="images/pic2.png" alt="" class="pic2">
</div>

<div class="product-details">
    <div class="imagediv">
        <?php echo "<img src='../" . $resultdata[0]['image'] . "'>"; ?>
    </div>

    <div class="flex1">
        <p id="name"><?php echo $resultdata[0]['name']; ?></p>
        <p id="desc"><?php echo $resultdata[0]['description']; ?></p>
        <p id="price">LKR<?php echo $resultdata[0]['price']; ?></p>

        <div class="checkout">

            <div>

                <?php if ($resultdata[0]['quantity'] == 0): ?>

                    <form action="" method="post">

                        <p style='color:red'>Out of Stock</p>

                        <button type="button" class="btn" id="plus" disabled><i class="fas fa-plus" "></i></button>

                                <input type=" number" name="quantity" id="amount" value="1" min="1">

                                <button type="button" class="btn" id="minus" disabled><i class="fas fa-minus"></i></button>

                                <div>
                                   
                                    <button type='submit' name='cart' disabled style="background-color:gray">Add to Cart<i
                                            class='fas fa-shopping-cart'></i></button>
                                </div>
                    </form>

                <?php else: ?>

                    <form action="../buyorcart/buyorcart.php" method="post">

                        <button type="button" class="btn" id="plus"><i class="fas fa-plus"></i></button>

                        <input type="number" name="quantity" id="amount" value="1" min="1">

                        <input type="hidden" name="id" value="<?php echo $productid; ?>">

                        <button type="button" class="btn" id="minus"><i class="fas fa-minus"></i></button>

                        <div>

                            <button type='submit' name='cart'>Add to Cart <i class='fas fa-shopping-cart'></i></button>
                        </div>
                    </form>

                <?php endif; ?>

            </div>

        </div>
    </div>
</div>

<div class="reviews">
    <div class="showreviews" style="margin-bottom: 20px;">
        <?php
        $sql = "SELECT * FROM review JOIN customer ON review.customer_id = customer.id WHERE product_id = '$productid'";
        $result = mysqli_query($connection, $sql);
        $reviewresultdata = mysqli_fetch_all($result, MYSQLI_ASSOC);

        if (empty($reviewresultdata)) {
            echo "<h3>Reviews<span>count 0</span></h3>";
            echo "<p>No reviews found for this product.</p>";
        } else {
            echo "<h3>Reviews<span>" . count($reviewresultdata) . "</span></h3>";
            foreach ($reviewresultdata as $data) {
                echo "<div class='reviewitem'>
                    <i class='fas fa-user'></i> 
                    <div>
                        <p>" . $data['f_name'] . "</p>
                        <p>" . $data['description'] . "</p>
                        <p>" . $data['rating'] . "</p>
                        <p>" . $data['date'] . "</p>
                    </div>
                </div>";
            }
        }
        ?>
    </div>

    <div class="addreviews">
        <?php if (!empty($userdata)): ?>
            <h3>ADD A REVIEW</h3>

            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                <p><?php echo $userdata[0]['f_name'] . " " . $userdata[0]['l_name']; ?></p>
                <p><?php echo $userdata[0]['email']; ?></p>

                <input type="hidden" name="userid" value="<?php echo $userid; ?>">
                <input type="hidden" name="productid" value="<?php echo $productid; ?>">

                <!-- Rating field with min and max values set between 1 and 10 -->
                <input type="number" name="rating" placeholder="Rating (1-10)" min="1" max="10" id="rating" required>

                <!-- Comment field, set to required -->
                <textarea name="description" rows="5" cols="40" placeholder="Write your comment here..." id="description"
                    required></textarea>

                <div>
                    <button type="submit" name="reviewsubmit">Submit</button>
                </div>
            </form>
        <?php endif; ?>
    </div>
</div>

<div class="related-products">
    <h3>RELATED PRODUCT</h3>
    <?php
    $cat1 = $resultdata[0]['product_category1_id'];

    $plainsql = "SELECT p.*, b.name AS bname FROM product AS p JOIN brand_category AS b ON p.brand_id = b.id WHERE p.product_category1_id = '$cat1' LIMIT 10";
    $plainsqlresult = mysqli_query($connection, $plainsql);
    if ($plainsqlresult) {
        $plainsqlresultdata = mysqli_fetch_all($plainsqlresult, MYSQLI_ASSOC);
        ?>
        <div class="productcontainer">
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
                                <button type='submit' name='buy' disabled style="background-color:gray">Buy</button>
                                <button type='submit' name='cart' disabled style="background-color:gray"><i
                                        class='fas fa-shopping-cart'></i></button>
                            </div>
                        </form>

                    <?php else: ?>


                        <form action='../buyorcart/buyorcart.php' method='post'>
                            <input type='hidden' name='id' value='<?php echo $data['id']; ?>'>
                            <div class='itembutton'>
                                <button type='submit' name='buy'>Buy</button>
                                <button type='submit' name='cart'><i class='fas fa-shopping-cart'></i></button>
                            </div>
                        </form>

                    <?php endif; ?>

                </div>

            <?php endforeach; ?>
        </div>
        <?php
    } else {
        echo "No result found";
    }
    ?>
</div>

<script src="scripts/product.js"></script>

<?php include "../footer/footer.php"; ?>