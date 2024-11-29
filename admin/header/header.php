<?php
include "../connection/connection.php";

session_start();
if (isset($_SESSION["adminId"]) && $_SESSION["email"]){

}else{
    header("Location:../signInUp/signIn.php");
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="../header/header.css">
    <link rel="icon" href="../header/images/logo.jpg">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>

<body>
    <header>
        <img src="../header/images/logo.jpg" alt="this is the image of the website logo">
        <button class="toggle-btn">
            <i class="fas fa-bars"></i>
        </button>
        <nav class="navbar">
            <ul>
                <li><a href="../manageproducts/manageProducts.php">Manage Products</a></li>
                <li><a href="../managecategories/manageCategories.php">Manage Categories</a></li>
                <li><a href="../manageBrands/manageBrands.php">Manage Brands</a></li>
                <li><a href="../viewOrders/viewOrders.php">View Orders</a></li>
                <li><a href="../payments/payments.php">View Payments</a></li>
                <li><a href="../ViewUserData/ViewUserData.php">View User Data</a></li>
            </ul>
        </nav>
        <div class="header-right">
                <a href="../logout/logout.php" class="header-link-logout">LogOut</a>
        </div>

    </header>

    <script src="../header/header.js"></script>