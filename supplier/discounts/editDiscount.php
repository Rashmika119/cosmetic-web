<?php include "../header/header.php"; ?>

<?php
session_start();

if (isset($_SESSION['supplierID'])) {
    $supplierid = $_SESSION['supplierID'];
    $brandid = $_SESSION['brandId'];

    if (isset($_GET['id'])) {
        $pid = $_GET['id'];
        $dsql = "select d.discount,p.name,p.id from discount as d
    join product as p
    on d.product_id = p.id
    where p.brand_id = '$brandid' and p.id = '$pid'";

        $d = mysqli_query($connection, $dsql);
        if (!$d) {
            echo "<script>alert('Cant get order data!')</script>";
        } else {
            if (mysqli_num_rows($d) > 0) {
                $ddata = mysqli_fetch_all($d, MYSQLI_ASSOC);
            }
        }
    }
}
?>

<link rel="stylesheet" href="../discounts/css/editDiscount.css">

<div class="discount-container">
    <!-- Added back button -->
    <a href="../discounts/discounts.php" class="back-button">← Back to Discounts</a>
    
    <div class="discount-form">
    <a href="../discounts/discounts.php" class="back-button">← Back to Discounts</a>
    
        <h2>Edit Discount</h2>
        <form action="../discounts/editdiscountemail.php" method="post">
            <label for="productName">Product Name:</label>
            <input type="text" id="productName" value="<?php echo $ddata[0]['name'];?>" readonly>
            <input type="hidden"  name="product" value="<?php echo $ddata[0]['id'];?>">
            <label for="discountPercentage">Discount:</label>
            <input type="number" id="discountPercentage" name="amount" value="<?php echo $ddata[0]['discount'];?>" required>

            <button type="submit" name="editdiscount" onclick="return confirm('Are you sure you want to edit this discount?')">Save Discount</button>
        </form>
    </div>
</div>

<?php include "../footer/footer.php"; ?>