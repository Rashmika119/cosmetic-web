<?php include "../header/header.php"; ?>

<?php

session_start();

if (isset($_SESSION['supplierID'])) {
    $supplierid = $_SESSION['supplierID'];
    $brandid = $_SESSION['brandId'];

    $dsql = "select d.discount,p.name,p.id from discount as d
    join product as p
    on d.product_id = p.id
    where p.brand_id = '$brandid'";

    $d = mysqli_query($connection, $dsql);
    if (!$d) {
        echo "<script>alert('Cant get order data!')</script>";
    } else {
        if (mysqli_num_rows($d) > 0) {
            $ddata = mysqli_fetch_all($d, MYSQLI_ASSOC);
        }
    }

    $psql = "select product.brand_id,product.id,product.name as pname,brand_category.name as bname,product_category1.name as p1name from product
join brand_category on product.brand_id = brand_category.id
join product_category1 on product.product_category1_id = product_category1.id
where product.brand_id = '$brandid'";
    $presult = mysqli_query($connection, $psql);
    if ($presult) {
        $pdata = mysqli_fetch_all($presult, MYSQLI_ASSOC);
    }

}

?>

<link rel="stylesheet" href="../discounts/css/discounts.css">

<?php
include "../navbar/navbar.php";
?>



<div class="discounts-page">
    <h2>Manage Discounts</h2>


    <div class="discount-form">
        <h3>Add New Discount</h3>
        <form action="../discounts/adddiscountemail.php" method="post">
            <label for="product">Product:</label>
            <select name="product" id="product" required>
                <?php foreach ($pdata as $data): ?>

                    <option value="<?php echo $data['id']; ?>"><?php echo $data['pname']." - ".$data['bname']." - ".$data['p1name']; ?></option>

                <?php endforeach; ?>
            </select>

            <label for="discountPercentage">Discount Value:</label>
            <input type="number" id="discountPercentage" min="100" name="amount" required>

            <button type="submit" name="adddiscount" onclick="return confirm('Are you sure you want to add this discount?')">Add Discount</button>
        </form>
    </div>


    <div class="discount-table">
        <h3>Active Discounts</h3>
        <table>
            <thead>
                <tr>
                    <th>Product</th>
                    <th>Discount</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <?php
                    if (!empty(($ddata))):
                        foreach ($ddata as $data): ?>
                        <tr>
                            <td><?php echo $data['name']; ?></td>
                            <td><?php echo $data['discount']; ?></td>
                            <td>
                                <a href="../discounts/editDiscount.php?id=<?php echo $data['id']; ?>"><button class="edit-btn">Edit</button></a>
                                <a href="../discounts/deleteDiscount.php?id=<?php echo $data['id']; ?>&amount=<?php echo $data['discount']; ?>"><button class="delete-btn" onclick="return confirm('Are you sure you want to delete this discount?')">Delete</button></a>
                            </td>
                        </tr>
                    <?php endforeach;
                    endif; ?>
            </tbody>
        </table>
    </div>
</div>

<?php include "../footer/footer.php"; ?> 