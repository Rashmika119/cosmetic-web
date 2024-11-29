<?php include "../header/header.php"?>

<?php



$formp1sql = "select p.* from product_category1 as p where p.product_category2_id = (select id from Product_category2 where name ='Body') "; 
$result = mysqli_query($connection,$formp1sql);

if($result){
$formp1sqldata = mysqli_fetch_all($result,MYSQLI_ASSOC);
}

$formbrandsql = "select * from brand_category"; 
$result = mysqli_query($connection,$formbrandsql);

if($result){
$formbrandsqldata = mysqli_fetch_all($result,MYSQLI_ASSOC);
}


if (isset($_POST['submit'])) {
    
    $haircare = isset($_POST['haircare']) ? $_POST['haircare'] : [];
    $brand = isset($_POST['brand']) ? $_POST['brand'] : [];

    $haircareIds = implode(',', array_map('intval', $haircare));
    $brandIds = implode(',', array_map('intval', $brand));

    $filteredSql = "SELECT p.*, p1.name AS pname, b.name AS bname 
                    FROM product AS p 
                    JOIN product_category1 AS p1 ON p.product_category1_id = p1.id 
                    JOIN brand_category AS b ON p.brand_id = b.id 
                    WHERE p1.product_category2_id = (select id from product_category2 where name = 'Body')"; 

    if (!empty($haircareIds)) {
        $filteredSql .= " AND p1.id IN ($haircareIds)";
      
    }

    if (!empty($brandIds)) {
        $filteredSql .= " AND b.id IN ($brandIds)";
       
    }

    $filteredResult = mysqli_query($connection, $filteredSql);
    
    if ($filteredResult) {
        $plainsqlresultdata = mysqli_fetch_all($filteredResult, MYSQLI_ASSOC);
    } else {
        echo "No results found.";
    }
}


else{

$plainsql = "select p.*,p1.name as pname,b.name as bname from 
product as p join product_category1 as p1 on p.product_category1_id = p1.id 
join brand_category as b on p.brand_id = b.id where p1.product_category2_id = 
(select id from product_category2 where name = 'Body')";

$plainsqlresult = mysqli_query($connection,$plainsql);
if($plainsqlresult){
$plainsqlresultdata = mysqli_fetch_all($plainsqlresult,MYSQLI_ASSOC);

}else{
    echo "no result found";
}

}
?>

<link rel="stylesheet" href="styles/shopByConsern.css">
<div class="mainImage">
        <img src="images/pic1.png" alt="">
        <h1>SHOP</h1>
        <h3>Shop by Consern > Body</h3>
        <img src="images/pic2.png" alt="" class="pic">
    </div>

    <div class="itemsSection">
        <ul>
            <li><a href="shopByConsernHair.php">Hair</a></li>
            <li><a href="shopByConsernEye.php">Eye</a></li>
            <li><a href="shopByConsernFace.php">Face</a></li>
            <li><a href="shopByConsernLips.php">Lips</a></li>
            <li><a href="shopByConsernNail.php">Nail</a></li>
            <li><a href="shopByConsernBody.php" class="navactive">Body</a></li>
        </ul>
    </div>


    <div class="mainBody">
        <div class="filterSection">

        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" class="hairCare">
    <div> 
        <p>Body Care</p>
        <?php foreach ($formp1sqldata as $data): ?>
            <span>
                <input type="checkbox" value="<?php echo $data['id']; ?>" name="haircare[]" 
                    <?php echo (isset($haircare) && in_array($data['id'], $haircare)) ? 'checked' : ''; ?>>
                <label for="haircare[]"><?php echo $data['name']; ?></label>
            </span>
        <?php endforeach; ?>
    </div>

    <div>
        <p>Brand</p>
        <?php foreach ($formbrandsqldata as $data): ?>
            <span>
                <input type="checkbox" value="<?php echo $data['id']; ?>" name="brand[]" 
                    <?php echo (isset($brand) && in_array($data['id'], $brand)) ? 'checked' : ''; ?>>
                <label for="brand[]"><?php echo $data['name']; ?></label>
            </span>
        <?php endforeach; ?>
    </div>

    <button type="submit" name="submit" class="submitbutton">Submit</button>
</form>

    
        </div> 

        <div class="itemSection">
            <?php $results = count($plainsqlresultdata) ;?>
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
        
        <button type='submit' name='cart' disabled style="background-color:gray">Add to Cart <i class='fas fa-shopping-cart'></i></button>
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
   

    <script src="scripts/shopByConsern.js"></script>
    <script src="scripts/pagination.js"></script>

    <?php include "../footer/footer.php";?>

 