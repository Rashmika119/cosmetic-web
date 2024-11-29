<?php include "../connection/connection.php"; ?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LUXEAURA COSMETICS</title>
    <link rel="stylesheet" href="../header/styles/headerStyles.css">
    <link rel="icon" href="../header/images/logo.jpg">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>

<body>

    <div class="headSection" id="headSection">

        <div class="firstNavBar" id="firstNavBar">
            <nav>
                <ul>
                    <li><a href="../AboutUs/about_us.php">ABOUT US</a></li>
                    <li><a href="../contactus/contact.php">CONTACT US</a></li>
                    <li><a href="../news/news.php">NEWS</a></li>
                    <li><a href="../privacyPolicy/privacy_policy.php">PRIVACY POLICY</a></li>
                </ul>
            </nav>
        </div>

        <div class="secondNavBar" id="secondNavBar">
            <img src="../header/images/logo.jpg" alt="this is the image of the website logo">

            <nav class="main-nav">
                <ul>
                    <li><a href="../home/home.php">HOME</a></li>
                    <li><a href="../shopByConsern/shopByConsernHair.php">SHOP BY CONCERN</a></li>
                    <li><a href="../shopByBrand/shopByBrandGarnier.php">SHOP BY BRAND</a></li>
                    <li><a href="../sale/sale.php">SALES</a></li>
                </ul>
            </nav>

            <div class="iconBar">
                <a href="#" class="searchIcon"><i class="fas fa-search"></i></a>
                <a href="../cart/cart.php"><i class="fas fa-shopping-cart"></i></a>
                <a href="../profile/profile.php"><i class="fas fa-user"></i></a>
            </div>


            <button class="togglebutton"><i class="fas fa-bars"></i></button>

            <div class="togglemenu">

                <button class="toggleCloseButton"><i class="fas fa-times"></i></button>

                <div class="toggleIconBar">
                    <a href="#" class="searchIcon"><i class="fas fa-search"></i></a>
                    <a href="../cart/cart.php"><i class="fas fa-shopping-cart"></i></a>
                    <a href="../profile/profile.php"><i class="fas fa-user"></i></a>
                </div>

                <div class="toggleList">
                    <nav>
                        <ul>
                            <li><a href="../home/home.php">HOME</a></li>
                            <li><a href="../shopByConsern/shopByConsernHair.php">SHOP BY CONCERN</a></li>
                            <li><a href="../shopByBrand/shopByBrandGarnier.php">SHOP BY BRAND</a></li>
                            <li><a href="../sale/sale.php">SALES</a></li>
                            <li><a href="../AboutUs/about_us.php">ABOUT US</a></li>
                            <li><a href="../contactus/contact.php">CONTACT US</a></li>
                            <li><a href="../news/news.php">NEWS</a></li>
                            <li><a href="../privacyPolicy/privacy_policy.php">PRIVACY POLICY</a></li>

                        </ul>
                    </nav>
                </div>


            </div>
        </div>
    </div>

    <div class="searchOverlay">
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
            <input type="text" name="search">
            <button type="submit">Search</button>
        </form>
        <button class="searchOverlayClose">&times;</button>
    </div>




    <script src="../header/scripts/toggleMenu.js"></script>