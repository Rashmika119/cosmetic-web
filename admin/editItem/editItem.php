<?php
include "../header/header.php";

$productName = "";
$image = "";
$brand = "";
$category = "";
$quantity = "";
$price = "";
$discount = "";

if (isset($_POST['edit'])) {
    $productName = $_POST['productname'];
    $image = $_POST['image'];
    $brand = $_POST['brandname'];
    $category = $_POST['category'];
    $quantity = $_POST['quantity'];
    $price = $_POST['price'];
    $discount = $_POST['discount'];
}

if (isset($_POST['submit'])) {

    $name = mysqli_real_escape_string($connection, $_POST['productname']);
    $productquantity = mysqli_real_escape_string($connection, $_POST['quantity']);
    $productprice = mysqli_real_escape_string($connection, $_POST['price']);
    $productdiscount = mysqli_real_escape_string($connection, $_POST['discount']);

    $getIdQuery = "SELECT id FROM product WHERE name='$name'";
    $getresult = mysqli_query($connection, $getIdQuery);
    
    if ($getresult && mysqli_num_rows($getresult) > 0) {
        $fetchId = mysqli_fetch_assoc($getresult);
        $productId = $fetchId['id'];

       
        $updateQuery = "UPDATE product SET price='$productprice', quantity='$productquantity' WHERE name='$name'";
        $updateResult = mysqli_query($connection, $updateQuery);

        
        $checkDiscountQuery = "SELECT * FROM discount WHERE product_id='$productId'";
        $checkDiscountResult = mysqli_query($connection, $checkDiscountQuery);

        if (mysqli_num_rows($checkDiscountResult) > 0) {
            
            $updateDiscountQuery = "UPDATE discount SET discount='$productdiscount' WHERE product_id='$productId'";
            $updateDiscountResult = mysqli_query($connection, $updateDiscountQuery);
        } else {
           
            $insertDiscountQuery = "INSERT INTO discount (product_id, discount) VALUES ('$productId', '$productdiscount')";
            $updateDiscountResult = mysqli_query($connection, $insertDiscountQuery);
        }

        if ($updateResult && $updateDiscountResult) {
            
            header("Location: ../manageproducts/manageProducts.php");
            exit;
        } else {
            $error = "Error updating database: " . mysqli_error($connection);
            echo $error;
        }
    } else {
        echo "Product not found";
    }
}
?>

<link rel="stylesheet" href="editItem.css">

<div class="edit">
    <h2>Edit <?php echo htmlspecialchars($brand); ?> <?php echo htmlspecialchars($productName); ?> Details</h2>
    <form action="editItem.php" method="post">
        <div class="edit-items">
            <label for="image"></label><br>
            <img src="../../<?php echo htmlspecialchars($image); ?>" alt="">

            <label for="name">Name: <?php echo htmlspecialchars($productName); ?></label><br>
            <input type="hidden" value="<?php echo htmlspecialchars($productName); ?>" name="productname">

            <label for="brand">Brand: <?php echo htmlspecialchars($brand); ?></label><br>

            <label for="category">Category: <?php echo htmlspecialchars($category); ?></label><br>

            <label for="quantity">Quantity: </label>
            <input type="text" value="<?php echo htmlspecialchars($quantity); ?>" name="quantity"><br>

            <label for="price">Price: </label>
            <input type="text" value="<?php echo htmlspecialchars($price); ?>" name="price"><br>

            <label for="discount">Discount: </label>
            <input type="text" value="<?php echo htmlspecialchars($discount); ?>" name="discount"><br>
        </div>
        <div class="btn">
            <button type="submit" name="submit">Submit</button>
        </div>
    </form>
</div>
<?php include '../footer/footer.php'?>
</body>
</html>