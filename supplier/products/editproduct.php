<?php include "../header/header.php"; ?>

<?php

session_start();
$brandid = $_SESSION['brandId'];

if (isset($_GET['pid'])) {
    $pid = $_GET['pid'];
    $sql = "select p.* from product as p where p.id = '$pid'";
    $result = mysqli_query($connection, $sql);
    if (!$result) {
        echo "<script>alert('product data not found!')</script>";
    } else {
        $row = mysqli_fetch_all($result, MYSQLI_ASSOC);

    }
}

?>

<link rel="stylesheet" href="../products/css/editproduct.css">


<div class="product-form">
    <div>
        <a href="../products/product.php" class="back-button">
            <span class="back-icon">←</span> Back to Products
        </a>
    </div>
    <h2>Edit Product</h2>
    <form method="post" action="../products/editemail.php" enctype="multipart/form-data">
        <label for="productName">Product Name:</label>
        <input type="text" name="name" id="productName" value="<?php echo $row[0]['name'] ?>" required>

        <label for="productDescription">Description:</label>
        <textarea id="productDescription" name="description" required><?php echo htmlspecialchars($row[0]['description']); ?></textarea>

        <label for="productPrice">Price:</label>
        <input type="number" name="price" id="productPrice" value="<?php echo $row[0]['price'] ?>" required>

        <div class="imagecontainer">
            <img src="<?php echo "../" . $row[0]['image'] ?>" width="100px" alt="">
        </div>

        <label for="productImage">Upload Product Image:</label>
        <input type="file" id="productImage" name="file" ><br><br>

        <button type="submit" name="submit" onclick="return confirm('Are you sure you want to update this product?')">Send Message</button>
    </form>
</div>


<?php include "../footer/footer.php"; ?>