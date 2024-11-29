<?php

include "../header/header.php";



if (isset($_POST['add'])) {
    $name = $_POST['brand'];

    $brandQuery = "insert into brand_category (name) values ('$name')";
    if (mysqli_query($connection, $brandQuery)) {
        echo "Brand added successfully";
        header("location: ../manageBrands/manageBrands.php");
        exit;
    } else {
        echo "Error: " . mysqli_error($connection);
    }
}

$barndnamesSql = "select * from brand_category";
$brandNamesResult = mysqli_query($connection, $barndnamesSql);
$brandNamesFetch = mysqli_fetch_all($brandNamesResult, MYSQLI_ASSOC);

//pagination
$itemsPerPage=5;
$page=isset($_GET['page'])?(int)$_GET['page']:1;
$offset=($page-1) * $itemsPerPage;

$totalItemsQuery="select count(*) as total from product";
$totalItemsResult=mysqli_query($connection,$totalItemsQuery);
$totalItemsRow=mysqli_fetch_assoc($totalItemsResult);
$totalItems=$totalItemsRow['total'];

$totalPages=ceil($totalItems/$itemsPerPage);

if (isset($_POST['delete'])) {
    $brandDelete = $_POST['brandName'];

    $deleteSql = "delete from brand_category where name='$brandDelete'";

    if (mysqli_query($connection, $deleteSql)) {
        echo "Brand deleted successfully!";
        header("location: ../manageBrands/manageBrands.php");
        exit;
    } else {
        echo "Error:" . mysqli_error($connection);
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>manage brands</title>
    <link rel="stylesheet" href="../manageBrands/manageBrands.css">
</head>

<body>

    <div class="content">


            <div class="add-features">
                <div class="add-brands">
                    <h1>Add Brands</h1>
                    <form action="../manageBrands/manageBrands.php" method="post" onsubmit="return validateForm()">
                        <label for="brand-name">Brand Name</label>
                        <div class="input-button-container">
                            <input type="text" id="brand-name" placeholder="Enter brand name" name="brand" required>
                            <button type="submit" name="add">Add</button>
                        </div>
                    </form>
                </div>
            </div>


            <div class="add-features">
                <h1>Delete brands</h1>
                <table class="brands">
                    <tr>
                        <th>Brands</th>
                        <th>Button</th>
                    </tr>

                    <?php foreach ($brandNamesFetch as $brand): ?>
                        <tr>
                            <form action="../manageBrands/manageBrands.php" method="post" enctype="multipart/form-data" onsubmit="return confirmDelete()">
                                <td name="brandName"><?php echo $brand['name']; ?></td>
                                <td>
                                    <button type="submit" name="delete">Delete</button>
                                    <input type="hidden" name="brandName" value="<?php echo $brand['name']; ?>">
                                </td>
                            </form>
                        </tr>
                    <?php endforeach; ?>
                </table>
            </div>
       

            <div class="brands">
                <h1>View Products with Brands</h1>
                <table class="detailsTable">
                    <tr>
                        <th>Brand</th>
                        <th>product name</th>
                        <th>price</th>
                        <th>product image</th>
                    </tr>
                    <?php 
                    $deleteQuery = "select product.id,product.name as productname,product.image,product.price,product.quantity,brand_category.name as brandname,product_category1.name as categoryname,discount.discount from product left join brand_category on product.brand_id=brand_category.id left join product_category1 on product.product_category1_id=product_category1.id left join discount on discount.product_id=product.id LIMIT $itemsPerPage OFFSET $offset";
                    $deleteResult = mysqli_query($connection, $deleteQuery);
                    $fetchType = mysqli_fetch_all($deleteResult, MYSQLI_ASSOC); ?>
                    <?php foreach ($fetchType as $item): ?>
                        <tr>
                            <td><?php echo $item['brandname']; ?></td>
                            <td><?php echo $item['productname']; ?></td>
                            <td><?php echo $item['price']; ?></td>
                            <td><img src="../../../website/<?php echo $item['image']; ?>"></td>
                        <tr>
                        <?php endforeach; ?>

                        </tr>


                </table>
                <div class="pagination">
                    <?php if ($page > 1): ?>
                        <a href="../manageBrands/manageBrands.php?page=<?php echo $page - 1; ?>">Prev</a>
                    <?php endif; ?>

                    <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                        <a href="../manageBrands/manageBrands.php?page=<?php echo $i; ?>" class="<?php if ($i == $page) echo 'active'; ?>"><?php echo $i; ?></a>
                    <?php endfor; ?>

                    <?php if ($page < $totalPages): ?>
                        <a href="../manageBrands/manageBrands.php?page=<?php echo $page + 1; ?>">Next</a>
                    <?php endif; ?>
                </div>

            </div>


    </div>
    <script src="../manageBrands/manageBrands.js"></script>
    <?php include "../footer/footer.php";?>
</body>

</html>