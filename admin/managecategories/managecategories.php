<?php
include "../header/header.php";

if (isset($_POST['add'])) {
    $body = $_POST['body'];
    $category = $_POST['category'];

    
    $duplicateCheckQuery = "SELECT * FROM product_category1 WHERE name='$category' AND product_category2_id=(SELECT id FROM product_category2 WHERE name='$body')";
    $duplicateCheckResult = mysqli_query($connection, $duplicateCheckQuery);

    if (mysqli_num_rows($duplicateCheckResult) == 0) {
        
        $bodyQuery = "SELECT id FROM product_category2 WHERE name='$body'";
        $bodyResult = mysqli_query($connection, $bodyQuery);
        $fetchResult = mysqli_fetch_assoc($bodyResult);
        $bodyId = $fetchResult['id'];

        $enterCategoryQuery = "INSERT INTO product_category1(name, product_category2_id) VALUES('$category', '$bodyId')";
        $categoryResult = mysqli_query($connection, $enterCategoryQuery);
        if ($categoryResult) {
            echo "Inserted data successfully";
        } else {
            echo "Error occurred";
        }
    } else {
        echo "Category already exists!";
    }
}


if (isset($_POST['delete'])) {
    $bodyType = $_POST['bodyType'];
    $deleteBodyQuery = "DELETE FROM product_category2 WHERE name='$bodyType'";
    mysqli_query($connection, $deleteBodyQuery);
}


if (isset($_POST['deleteCategory'])) {
    $category = $_POST['category'];
    $deleteCategoryQuery = "DELETE FROM product_category1 WHERE name='$category'";
    mysqli_query($connection, $deleteCategoryQuery);
}


$bodyQuery = "SELECT name FROM product_category2";
$bodyOutput = mysqli_query($connection, $bodyQuery);
$fetchBody = mysqli_fetch_all($bodyOutput, MYSQLI_ASSOC);

$categoryQuery = "SELECT name FROM product_category1";
$categoryOutput = mysqli_query($connection, $categoryQuery);
$fetchCategory = mysqli_fetch_all($categoryOutput, MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Manage Categories</title>
    <link rel="stylesheet" href="../managecategories/managecategories.css">
</head>
<body>
    <div class="content">
        <div class="add-features">
            <h1>Add Product Categories</h1>
            <form action="../managecategories/managecategories.php" method="post" onsubmit="return validateForm()">
                <label for="body">Choose Body Category</label>
                <select name="body" id="body">
                    <option value="hair">Hair</option>
                    <option value="eye">Eye</option>
                    <option value="nail">Nail</option>
                    <option value="body">Body</option>
                    <option value="face">Face</option>
                    <option value="lips">Lips</option>
                </select>
                <br>
                <label for="category">Add New Product Category</label>
                <input type="text" id="category" name="category" placeholder="Enter new category" required>
                <button type="submit" name="add" class="but">Add</button>
            </form>
        </div>

        <div class="delete-categories">
            <h1>Delete Categories</h1>
            <table class="type">
                <tr>
                    <th>Body Type</th>
                    <th>Action</th>
                </tr>
                <?php foreach ($fetchBody as $body): ?>
                    <tr>
                        <form action="../managecategories/managecategories.php" method="post"  enctype="multipart/form-data" onsubmit="return confirmDelete()">
                            <td><?php echo $body['name']; ?></td>
                            <input type="hidden" name="bodyType" value="<?php echo $body['name']; ?>">
                            <td><button class="but" type="submit" name="delete">Delete</button></td>
                        </form>
                    </tr>
                <?php endforeach; ?>
            </table>

            <table class="type">
                <tr>
                    <th>Category Type</th>
                    <th>Action</th>
                </tr>
                <?php foreach ($fetchCategory as $category): ?>
                    <tr>
                        <form action="../managecategories/managecategories.php" method="post" enctype="multipart/form-data" onsubmit="return confirmDelete()">
                            <td><?php echo $category['name']; ?></td>
                            <input type = "hidden" name="category" value="<?php echo $category['name']; ?>">
                            <td><button class="but" type="submit" name="deleteCategory">Delete</button></td>
                        </form>
                    </tr>
                <?php endforeach; ?>
            </table>
        </div>


<div class="brands">
    <h1>View Products' Main Categories with Subcategories</h1>
    <table class="detailsTable">
        <tr>
            <th>Main Category</th>
            <th>Sub Categories</th>
        </tr>
        <?php foreach ($fetchBody as $body): ?>
            <?php
            
            $relevantIdQuery = "SELECT id FROM product_category2 WHERE name='" . $body['name'] . "'";
            $IdResult = mysqli_query($connection, $relevantIdQuery);
            $fetchId = mysqli_fetch_assoc($IdResult);
            $bodyId = $fetchId['id'];

            
            $subCategoryQuery = "SELECT name FROM product_category1 WHERE product_category2_id='$bodyId'";
            $subCategoryResult = mysqli_query($connection, $subCategoryQuery);
            $fetchSubCategories = mysqli_fetch_all($subCategoryResult, MYSQLI_ASSOC);
            $subCategoryCount = count($fetchSubCategories);
            ?>

            <?php if ($subCategoryCount > 0): ?>
                <tr>
                    <td rowspan="<?php echo $subCategoryCount; ?>"><?php echo $body['name']; ?></td>
                    <td><?php echo $fetchSubCategories[0]['name']; ?></td>
                </tr>
                <?php for ($i = 1; $i < $subCategoryCount; $i++): ?>
                    <tr>
                        <td><?php echo $fetchSubCategories[$i]['name']; ?></td>
                    </tr>
                <?php endfor; ?>
            <?php else: ?>
                <tr>
                    <td><?php echo $body['name']; ?></td>
                    <td>No subcategories</td>
                </tr>
            <?php endif; ?>
        <?php endforeach; ?>
    </table>
</div>


    </div>
    <script src="../managecategories/managecategories.js"></script>
    <?php include "../footer/footer.php";?>
</body>
</html>