<?php include "../header/header.php"; ?>

<?php

session_start();
$brandid = $_SESSION['brandId'];

$sql = "select p.* from product as p where p.brand_id = $brandid";
$result = mysqli_query($connection, $sql);
if (!$result) {
    echo "<script>alert('product data not found!')</script>";
} else {
    $row = mysqli_fetch_all($result, MYSQLI_ASSOC);

}

?>

<link rel="stylesheet" href="../products/css/product.css">

<?php
include "../navbar/navbar.php";
?>


<div class="products-page">
    <h2>Manage Products</h2>
    <table class="product-table">
        <thead>
            <tr>
                <th>Image</th>
                <th>Name</th>
                <th>Stock</th>
                <th>Price</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if (!empty($row)):
                foreach ($row as $data): ?>
                    <tr>
                        <td data-label="Image"><img src="<?php echo "../" . $data['image']; ?>" alt="Product 1"
                                class="product-image"></td>
                        <td data-label="Name"><?php echo $data['name']; ?></td>
                        <td data-label="Stock"><?php if ($data['quantity'] === 0) {
                            echo "Out of stock";
                        } else {
                            echo "In stock";
                        }
                        ; ?></td>
                        <td data-label="Price">LKR <?php echo $data['price']; ?></td>
                        <td data-label="Actions">
                            <a href="../products/editproduct.php?pid=<?php echo $data['id'] ?>" class="edit-btn" onclick="return confirm('Are you sure you want to edit this product?')">Edit</a>
                            <a href="../products/deleteproduct.php?pid=<?php echo $data['id'] ?>" class="delete-btn" onclick="return confirm('Are you sure you want to delete this product?')">Delete</a>
                        </td>
                    </tr>

                <?php endforeach;
            endif; ?>

        </tbody>
    </table>
</div>


<?php include "../footer/footer.php"; ?>