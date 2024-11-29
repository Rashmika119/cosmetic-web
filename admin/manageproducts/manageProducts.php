<?php
include "../header/header.php";

$productDetails = "SELECT * FROM product";
$productResult = mysqli_query($connection, $productDetails);
$fetchDetails = mysqli_fetch_all($productResult);

if (isset($_POST['submit'])) {

    $productName = $_POST['product-name'];
    $productDescription = $_POST['product-descript'];
    $productPrice = $_POST['product-price'];
    $brand = $_POST['brand'];
    $bodyType = $_POST['body'];
    $category = $_POST['category'];
    $quantity = $_POST['quantity'];
    $file = $_FILES['image'];
    print_r($file);

    $filename = $_FILES['image']['name'];
    $fileTmpName = $_FILES['image']['tmp_name'];
    $fileError = $_FILES['image']['error'];
    $fileSize = $_FILES['image']['size'];

    $fileExt = explode('.', $filename);
    $fileActualExt = strtolower(end($fileExt));

    $allowed = array('jpg', 'jpeg', 'png', 'pdf');
    $imageLink = '';


    if (in_array($fileActualExt, $allowed)) {
        if ($fileError === 0) {
            if ($fileSize < 1000000) {

                $fileNameNew = uniqid('', true) . "." . $fileActualExt;
                $uploadDir = "../../website/images/" . $brand . "/" . $bodyType . "/" . $category;

                if (!file_exists($uploadDir)) {
                    mkdir($uploadDir, 0777, true);
                }

                $fileDestination = $uploadDir . "/" . $fileNameNew;

                if (move_uploaded_file($fileTmpName, $fileDestination)) {
                    // Set image link if upload is successful
                    $imageLink = "images/" . $brand . "/" . $bodyType . "/" . $category . "/" . $fileNameNew;
                } else {
                    echo "There was an error uploading the image.";
                    exit;
                }
            } else {
                echo "Your file is too big.";
                exit;
            }
        } else {
            echo "There was an error uploading your image.";
            exit;
        }
    } else {
        echo "You cannot upload files of this type!";
        exit;
    }

    $brandIdQuery = "SELECT id FROM brand_category WHERE name='$brand'";
    $brandIdResult = mysqli_query($connection, $brandIdQuery);
    $brandRow = mysqli_fetch_assoc($brandIdResult);
    $brandId = $brandRow['id'];

    $category2IdQuery = "SELECT id FROM product_category2 WHERE name='$bodyType'";
    $category2IdResult = mysqli_query($connection, $category2IdQuery);
    $category2Row = mysqli_fetch_assoc($category2IdResult);
    $category2Id = $category2Row['id'];

    $category1IdQuery = "SELECT id FROM product_category1 WHERE name='$category'";
    $category1IdResult = mysqli_query($connection, $category1IdQuery);
    $category1Row = mysqli_fetch_assoc($category1IdResult);
    $category1Id = $category1Row['id'];

    $addToProductTable = "INSERT INTO product (name, image, description, price, quantity, product_category1_id, brand_id) 
    VALUES ('$productName', '$imageLink', '$productDescription', '$productPrice', '$quantity', '$category1Id', '$brandId')";

    if (mysqli_query($connection, $addToProductTable)) {
       // echo "Product added successfully!";
        header("Location:../manageproducts/manageProductsemail.php?productname=$productName & productdescription=$productDescription & productprice=$productPrice & brand=$brand & bodytype = $bodyType & category=$category & quantity=$quantity & image=$imageLink");
        exit;
    } else {
        echo "Error: " . mysqli_error($connection);
    }
}

$itemsPerPage = 5;
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$offset = ($page - 1) * $itemsPerPage;

$totalItemsQuery = "select count(*) as total from product";
$totalItemsResult = mysqli_query($connection, $totalItemsQuery);
$totalItemsRow = mysqli_fetch_assoc($totalItemsResult);
$totalItems = $totalItemsRow['total'];

$totalPages = ceil($totalItems / $itemsPerPage);

if (isset($_POST['delete'])) {
    $productid = $_POST['productid'];

    $deleteSql = "delete from product where id='$productid'";

    if (mysqli_query($connection, $deleteSql)) {
        echo "<script>alert('product deleted successfully!')
        window.location.href = '../manageproducts/manageProducts.php';</script>";
        exit;
    } else {
        echo "Error:" . mysqli_error($connection);
    }
}

if (isset($_POST['edit'])) {
    header("location:../editItem/editItem.php");
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MangeProducts</title>
    <link rel="stylesheet" href="../manageproducts/manageproduct.css">
</head>
<body>
<div class="content">
    <div class=add-feature>
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data" onsubmit="return validateForm()">
            <div class="add-container">
                <h1>ADD ITEMS</h1>
                <label for="name">product name</label>
                <input type="text" name="product-name" required></br>
                <label for="name">product description</label>
                <input type="text" name="product-descript" required></br>
                <label for="price">product price</label>
                <input type="text" name="product-price" required></br>

                <label for="body">choose brand</label>

                <?php
                $brandQuery = "select name from brand_category";
                $brandResult = mysqli_query($connection, $brandQuery);
                $fetchBrand = mysqli_fetch_all($brandResult, MYSQLI_ASSOC);
                ?>

                <select name="brand" id="brand">
                    <?php foreach ($fetchBrand as $brand): ?>
                        <option value="<?php echo $brand['name'];?>"><?php echo $brand['name']; ?></option>
                    <?php endforeach; ?>
                </select></br>

                <label for="body">choose body type</label>

                <?php
                $bodyTypeQuery = "select name,id from product_category2";
                $bodyResult = mysqli_query($connection, $bodyTypeQuery);
                $fetchBodyType = mysqli_fetch_all($bodyResult, MYSQLI_ASSOC);
                ?>

                <select name="body" id="bodytype">
                    <?php foreach ($fetchBodyType as $body): ?>
                        <option value="<?php echo $body['name']; ?>"><?php echo $body['name'] ?></option>
                    <?php endforeach; ?>
                </select></br>

                <label for="type">choose the type</label>

                <?php
                $typeQuery = "SELECT name FROM product_category1";
                $typeResult = mysqli_query($connection, $typeQuery);
                $fetchType = mysqli_fetch_all($typeResult, MYSQLI_ASSOC);; ?>

                <select name="category" id="itemcategory">
                    <?php foreach ($fetchType as $type): ?>
                        <option value="<?php echo $type['name']; ?>"><?php echo $type['name'] ?></option>
                    <?php endforeach; ?>
                </select></br>

                <label for="quantity">Add quantity</label>
                <input type="text" name="quantity" required>


                <label for="image">Add product image</label>
                <input type="file" name="image">



            </div>
            <button type="submit" name="submit">Submit</button>
        </form>
    </div>

    <div class=feature>
        <h1>Manage Items</h1>

        <table class="detailsTable">
            <tr>
                <th>name</th>
                <th>image</th>
                <th>brand</th>
                <th>category</th>
                <th>quantity</th>
                <th>price</th>
                <th>discount</th>
                <th> delete button</th>
                <th>edit button</th>
            </tr>
            <?php

            $deleteQuery = "select product.id,product.name as productname,product.image,product.price,product.quantity,brand_category.name as brandname,product_category1.name as categoryname,discount.discount from product left join brand_category on product.brand_id=brand_category.id left join product_category1 on product.product_category1_id=product_category1.id left join discount on discount.product_id=product.id LIMIT $itemsPerPage OFFSET $offset";
            $deleteResult = mysqli_query($connection, $deleteQuery);
            $fetchType = mysqli_fetch_all($deleteResult, MYSQLI_ASSOC);

            ?>

            <?php foreach ($fetchType as $item): ?>
                <tr>
                    <form action="../editItem/editItem.php" method="post">
                        <td name="productname"><?php echo $item['productname']; ?></td>
                        <input type="hidden" name="productname" value="<?php echo $item['productname']; ?>">

                        <td name="image"><img src="../../../website/<?php echo $item['image']; ?>" alt=""></td>
                        <input type="hidden" name="image" value="<?php echo $item['image']; ?>">

                        <td name="brandname"><?php echo $item['brandname']; ?></td>
                        <input type="hidden" name="brandname" value="<?php echo $item['brandname']; ?>">

                        <td name="category"><?php echo $item['categoryname']; ?></td>
                        <input type="hidden" name="category" value="<?php echo $item['categoryname']; ?>">

                        <td name="quantity"><?php echo $item['quantity']; ?></td>
                        <input type="hidden" name="quantity" value="<?php echo $item['quantity']; ?>">

                        <td name="price"><?php echo $item['price']; ?></td>
                        <input type="hidden" name="price" value="<?php echo $item['price']; ?>">

                        <td name="discount"><?php echo $item['discount']; ?></td>
                        <input type="hidden" name="discount" value="<?php echo $item['discount']; ?>">

                        <td><button class="edit" type="submit" name="edit">Edit</button></td>
                    </form>

                    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data" onsubmit="return confirmDelete()">

                        <input type="hidden" name="productid" value="<?php echo $item['id']; ?>">
                        <td><button type="submit" name="delete">Delete</button></td>
                    </form>


                </tr>

            <?php endforeach; ?>

        </table>

        <div class="pagination">
            <?php if ($page > 1): ?>
                <a href="?page=<?php echo $page - 1; ?>">Prev</a>
            <?php endif; ?>

            <?php for ($i = 1; $i <= $totalPages; $i++) { ?>
                <a href="?page=<?php echo $i; ?>" class="<?php if ($i == $page) echo 'active'; ?>"><?php echo $i; ?></a>

            <?php } ?>
        </div>

    </div>
</div>

<script src="../manageproducts/manageProducts.js"></script>
    
 <?php include "../footer/footer.php";?>

