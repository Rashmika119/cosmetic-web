<?php 

include "../../../website/connection/connection.php";


$itemsPerPage=5;
$page=isset($_GET['page'])?(int)$_GET['page']:1;
$offset=($page-1) * $itemsPerPage;

$totalItemsQuery="select count(*) as total from product";
$totalItemsResult=mysqli_query($connection,$totalItemsQuery);
$totalItemsRow=mysqli_fetch_assoc($totalItemsResult);
$totalItems=$totalItemsRow['total'];

$totalPages=ceil($totalItems/$itemsPerPage);

$deleteQuery = "select product.id,product.name as productname,product.image,product.price,product.quantity,brand_category.name as brandname,product_category1.name as categoryname,discount.discount from product left join brand_category on product.brand_id=brand_category.id left join product_category1 on product.product_category1_id=product_category1.id left join discount on discount.product_id=product.id LIMIT $itemsPerPage OFFSET $offset";
$deleteResult = mysqli_query($connection, $deleteQuery);
$fetchType = mysqli_fetch_all($deleteResult, MYSQLI_ASSOC);

?>


