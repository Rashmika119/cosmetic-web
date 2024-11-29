<?php

include "../header/header.php";

$sqlItems = "SELECT id, name, image, description,quantity,price, brand_id 
FROM product 
ORDER BY RAND() 
LIMIT 8;
";
$resultItems = mysqli_query($connection, $sqlItems);
$fetchItems = mysqli_fetch_all($resultItems, MYSQLI_ASSOC);

$sqlBrands = "SELECT name,id FROM brand_category";

$resultBrands = mysqli_query($connection, $sqlBrands);
$fetchBrands = mysqli_fetch_all($resultBrands, MYSQLI_ASSOC);

if (isset($_POST['discountSubmit'])) {
    header("location:../sale/sale.php");
}



?>
<link rel="stylesheet" href="homestyle.css">

<div class="home-images">
    <figure>
        <img src="webImages/homepic3.jpeg" alt="home page image">
        <img src="webImages/image.png" alt="home page image">
        <img src="webImages/homepic10.jpg" alt="home page image">
        <img src="webImages/homepic3.jpeg" alt="home page image">
    </figure>
</div>
<div class="categories">
    <div class="item-category">
        <img src="webImages/hair.png" alt="hair icon">
        <a href="../shopByConsern/shopByConsernHair.php">HAIR</a>
    </div>
    <div class="item-category">
        <img src="webImages/eyeliner.png" alt="eye icon">
        <a href="../shopByConsern/shopByConsernEye.php">EYE</a>
    </div>
    <div class="item-category">
        <img src="webImages/beauty.png" alt="lips icon">
        <a href="../shopByConsern/shopByConsernLips.php">LIP</a>
    </div>
    <div class="item-category">
        <img src="webImages/facial-massage.png" alt="face icon">
        <a href="../shopByConsern/shopByConsernFace.php">FACE</a>
    </div>
    <div class="item-category">
        <img src="webImages/nail-polish.png" alt="naol polish icon">
        <a href="../shopByConsern/shopByConsernNail.php">NAIL</a>
    </div>
    <div class="item-category">
        <img src="webImages/slim-body.png" alt="body icon">
        <a href="../shopByConsern/shopByConsernBody.php">BODY</a>
    </div>
    <div class="item-category">
        <img src="webImages/gift.png" alt="offer icon">
        <a href="../sale/sale.php">OFFER</a>
    </div>
</div>
<div class="discount-product">
    <h1>DISCOUNT PRODUCTS</h1>
    <div class="discount-group">

        <?php
        $discountSql = "SELECT product.id,product.quantity,product.image,product.name,product.price,discount.discount FROM product JOIN discount ON product.id=discount.product_id WHERE product.id=discount.product_id LIMIT 8";
        $dicountResult = mysqli_query($connection, $discountSql);
        $discountFetch = mysqli_fetch_all($dicountResult, MYSQLI_ASSOC);
        ; ?>

        <?php foreach ($discountFetch as $discountItem):
            ; ?>

            <div class="discount-item">
                <img src="<?php echo $discountItem['image']; ?>" alt="">
                <a href="../product/product.php?id=<?php echo $discountItem['id']; ?>"
                    style="color:black;text-decoration:none;">
                    <p class="item-name"><?php echo $discountItem['name']; ?></p>
                </a>
                <p><?php echo $discountItem['price'] - $discountItem['discount']; ?></p>
                <p class="discount"><?php echo $discountItem['price']; ?></p>
                <?php if ($discountItem['quantity'] == 0): ?>

                    <p style='color:red'>Out of Stock</p>

                    <form action='../buyorcart/buyorcart.php' method='post'>
                        <input type='hidden' name='id' value='<?php echo $discountItem['id']; ?>'>
                        <div class='itembutton'>

                            <button type='submit' name='cart' disabled style="background-color:gray">Add to Cart<i
                                    class='fas fa-shopping-cart'></i></button>
                        </div>
                    </form>

                <?php else: ?>

                    <form action='../buyorcart/buyorcart.php' method='post'>
                        <input type='hidden' name='id' value='<?php echo $discountItem['id']; ?>'>
                        <div class='itembutton'>

                            <button type='submit' name='cart'>Add to Cart <i class='fas fa-shopping-cart'></i></button>
                        </div>
                    </form>

                <?php endif; ?>
            </div>

        <?php endforeach; ?>
    </div>
    <form action="home.php" method="POST">
        <button class="view-more" name="discountSubmit"><a href="../sale/sale.php"
                style="color:white;text-decoration:none;">View More</a></button>
    </form>


</div>
<div class="featured-products">
    <h1>FEATURED PRODUCTS</h1>
    <div class="brand-category">
        <a href="#" class="brand-link active" data-brand="all">ALL</a>
        <a href="#" class="brand-link" data-brand="garnier">Garnier</a>
        <a href="#" class="brand-link" data-brand="nutrogena">Nutrogena</a>
        <a href="#" class="brand-link" data-brand="cerave">CeraVe</a>
        <a href="#" class="brand-link" data-brand="loreal">Loreal Paris</a>
    </div>
</div>

<div class="product-display">

    <div class="product-list all ">
        <div class="product-list-grid"> <?php foreach ($fetchItems as $item): ?>
                <div class="brand-item">
                    <img src="<?php echo $item['image']; ?>" alt="">
                    <a href="../product/product.php?id=<?php echo $item['id']; ?>"
                        style="color:black;text-decoration:none;">
                        <p class="item-name"><?php echo $item['name']; ?></p>
                    </a>
                    <p><?php echo $item['price']; ?></p>
                    <?php if ($item['quantity'] == 0): ?>

                        <p style='color:red'>Out of Stock</p>

                        <form action='../buyorcart/buyorcart.php' method='post'>
                            <input type='hidden' name='id' value='<?php echo $item['id']; ?>'>
                            <div class='itembutton'>

                                <button type='submit' name='cart' disabled style="background-color:gray">Add to Cart <i
                                        class='fas fa-shopping-cart'></i></button>
                            </div>
                        </form>

                    <?php else: ?>

                        <form action='../buyorcart/buyorcart.php' method='post'>
                            <input type='hidden' name='id' value='<?php echo $item['id']; ?>'>
                            <div class='itembutton'>

                                <button type='submit' name='cart'>Add to Cart <i class='fas fa-shopping-cart'></i></button>
                            </div>
                        </form>

                    <?php endif; ?>

                </div>
            <?php endforeach; ?>
            <button class="view-more" onclick="window.location.href='../shopByConsern/shopByConsernHair.php'">view
                more</button>
        </div>

    </div>

    <div class="product-list garnier">
        <div class="product-list-grid">
            <?php $sqlBrandDetailsGarnier = "SELECT product.id,product.quantity,product.name,product.image,product.description,product.price,product.brand_id  FROM product JOIN brand_category ON product.brand_id=brand_category.id WHERE product.brand_id=1 LIMIT 8 ";
            $resultBrandDetailsGarnier = mysqli_query($connection, $sqlBrandDetailsGarnier);
            $fetchBrandDetailsGarnier = mysqli_fetch_all($resultBrandDetailsGarnier, MYSQLI_ASSOC); ?>
            <?php

            foreach ($fetchBrandDetailsGarnier as $brand): ?>
                <div class="brand-item">
                    <img src="<?php echo $brand['image']; ?>" alt="">
                    <a href="../product/product.php?id=<?php echo $brand['id']; ?>"
                        style="color:black;text-decoration:none;">
                        <p class="item-name"><?php echo $brand['name']; ?></p>
                    </a>
                    <p><?php echo $brand['price']; ?></p>
                    <?php if ($brand['quantity'] == 0): ?>

                        <p style='color:red'>Out of Stock</p>

                        <form action='../buyorcart/buyorcart.php' method='post'>
                            <input type='hidden' name='id' value='<?php echo $brand['id']; ?>'>
                            <div class='itembutton'>

                                <button type='submit' name='cart' disabled style="background-color:gray">Add to Cart <i
                                        class='fas fa-shopping-cart'></i></button>
                            </div>
                        </form>

                    <?php else: ?>

                        <form action='../buyorcart/buyorcart.php' method='post'>
                            <input type='hidden' name='id' value='<?php echo $brand['id']; ?>'>
                            <div class='itembutton'>

                                <button type='submit' name='cart'>Add to Cart <i class='fas fa-shopping-cart'></i></button>
                            </div>
                        </form>

                    <?php endif; ?>

                </div>
            <?php endforeach; ?>
            <button class="view-more" onclick="window.location.href='../shopByBrand/shopByBrandGarnier.php'">view
                more</button>
        </div>

    </div>

    <div class="product-list nutrogena">
        <div class="product-list-grid">
            <?php $sqlBrandDetailsNutrogena = "SELECT product.quantity,product.id,product.name,product.image,product.description,product.price,product.brand_id  FROM product JOIN brand_category ON product.brand_id=brand_category.id WHERE product.brand_id=3 LIMIT 8 ";
            $resultBrandDetailsNutrogena = mysqli_query($connection, $sqlBrandDetailsNutrogena);
            $fetchBrandDetailsNutrogena = mysqli_fetch_all($resultBrandDetailsNutrogena, MYSQLI_ASSOC); ?>
            <?php
            foreach ($fetchBrandDetailsNutrogena as $brand): ?>
                <div class="brand-item">
                    <img src="<?php echo $brand['image']; ?>" alt="">
                    <a href="../product/product.php?id=<?php echo $brand['id']; ?>"
                        style="color:black;text-decoration:none;">
                        <p class="item-name"><?php echo $brand['name']; ?></p>
                    </a>
                    <p><?php echo $brand['price']; ?></p>
                    <?php if ($brand['quantity'] == 0): ?>

                        <p style='color:red'>Out of Stock</p>

                        <form action='../buyorcart/buyorcart.php' method='post'>
                            <input type='hidden' name='id' value='<?php echo $brand['id']; ?>'>
                            <div class='itembutton'>

                                <button type='submit' name='cart' disabled style="background-color:gray">Add to Cart <i
                                        class='fas fa-shopping-cart'></i></button>
                            </div>
                        </form>

                    <?php else: ?>

                        <form action='../buyorcart/buyorcart.php' method='post'>
                            <input type='hidden' name='id' value='<?php echo $brand['id']; ?>'>
                            <div class='itembutton'>

                                <button type='submit' name='cart'>Add to Cart <i class='fas fa-shopping-cart'></i></button>
                            </div>
                        </form>

                    <?php endif; ?>

                </div>
            <?php endforeach; ?>
            <button class="view-more" onclick="window.location.href='../shopByBrand/shopByBrandNeutrogena.php'">view
                more</button>
        </div>

    </div>

    <div class="product-list cerave">
        <div class="product-list-grid">
            <?php $sqlBrandDetailsCerave = "SELECT product.quantity,product.id,product.name,product.image,product.description,product.price,product.brand_id  FROM product JOIN brand_category ON product.brand_id=brand_category.id WHERE product.brand_id=4 LIMIT 8 ";
            $resultBrandDetailsCerave = mysqli_query($connection, $sqlBrandDetailsCerave);
            $fetchBrandDetailsCerave = mysqli_fetch_all($resultBrandDetailsCerave, MYSQLI_ASSOC);
            ; ?>

            <?php
            foreach ($fetchBrandDetailsCerave as $brand): ?>
                <div class="brand-item">
                    <img src="<?php echo $brand['image']; ?>" alt="">
                    <a href="../product/product.php?id=<?php echo $brand['id']; ?>"
                        style="color:black;text-decoration:none;">
                        <p class="item-name"><?php echo $brand['name']; ?></p>
                    </a>
                    <p><?php echo $brand['price']; ?></p>
                    <?php if ($brand['quantity'] == 0): ?>

                        <p style='color:red'>Out of Stock</p>

                        <form action='../buyorcart/buyorcart.php' method='post'>
                            <input type='hidden' name='id' value='<?php echo $brand['id']; ?>'>
                            <div class='itembutton'>

                                <button type='submit' name='cart' disabled style="background-color:gray">Add to Cart <i
                                        class='fas fa-shopping-cart'></i></button>
                            </div>
                        </form>

                    <?php else: ?>

                        <form action='../buyorcart/buyorcart.php' method='post'>
                            <input type='hidden' name='id' value='<?php echo $brand['id']; ?>'>
                            <div class='itembutton'>

                                <button type='submit' name='cart'>Add to Cart <i class='fas fa-shopping-cart'></i></button>
                            </div>
                        </form>

                    <?php endif; ?>

                </div>
            <?php endforeach; ?>
            <button class="view-more" onclick="window.location.href='../shopByBrand/shopByBrandCeraVe.php'">view
                more</button>
        </div>

    </div>

    <div class="product-list loreal">
        <div class="product-list-grid">
            <?php $sqlBrandDetailsloreal = "SELECT product.quantity,product.id,product.name,product.image,product.description,product.price,product.brand_id  FROM product JOIN brand_category ON product.brand_id=brand_category.id WHERE product.brand_id=2 LIMIT 8 ";
            $resultBrandDetailsLoreal = mysqli_query($connection, $sqlBrandDetailsloreal);
            $fetchBrandDetailsloreal = mysqli_fetch_all($resultBrandDetailsLoreal, MYSQLI_ASSOC);
            ; ?>

            <?php
            foreach ($fetchBrandDetailsloreal as $brand): ?>
                <div class="brand-item">
                    <img src="<?php echo $brand['image']; ?>" alt="">
                    <a href="../product/product.php?id=<?php echo $brand['id']; ?>"
                        style="color:black;text-decoration:none;">
                        <p class="item-name"><?php echo $brand['name']; ?></p>
                    </a>
                    <p><?php echo $brand['price']; ?></p>
                    <?php if ($brand['quantity'] == 0): ?>

                        <p style='color:red'>Out of Stock</p>

                        <form action='../buyorcart/buyorcart.php' method='post'>
                            <input type='hidden' name='id' value='<?php echo $brand['id']; ?>'>
                            <div class='itembutton'>

                                <button type='submit' name='cart' disabled style="background-color:gray">Add to Cart <i
                                        class='fas fa-shopping-cart'></i></button>
                            </div>
                        </form>

                    <?php else: ?>

                        <form action='../buyorcart/buyorcart.php' method='post'>
                            <input type='hidden' name='id' value='<?php echo $brand['id']; ?>'>
                            <div class='itembutton'>

                                <button type='submit' name='cart'>Add to Cart <i class='fas fa-shopping-cart'></i></button>
                            </div>
                        </form>

                    <?php endif; ?>
                </div>
            <?php endforeach; ?>
            <button class="view-more" onclick="window.location.href='../shopByBrand/shopByBrandLorealParis.php'">view
                more</button>
        </div>

    </div>

    <div class="services">
        <h1>OUR SERVICES</h1>
        <img src="features/background.png" alt="makeup tools with pink background">
        <div class="servicesContent">
            <div class="service">
                <img src="features/nature.png" alt="">
                <p>Research based,vegan certified products with natural ingrediens</p>
            </div>
            <div class="service">
                <img src="features/delivery.png" alt="">
                <p>Fast delivery</p>
            </div>
            <div class="service">
                <img src="features/secure.png" alt="">
                <p>Secure payment options</p>
            </div>
            <div class="service">
                <img src="features/variety.png" alt="">
                <p>variety of products</p>
            </div>

        </div>
    </div>

    <?php
    include "../slideshow/slideshow.php";
    ?>

    <section class="news-section">
        <h2>Latest News & Beauty Trends</h2>
        <div class="news-container">
            <div class="news-card">
                <img src="news_images/new_lipstick.png" alt="New Product Launch">
                <div class="news-content">
                    <h3>Introducing Our New Vegan Lipstick Range!</h3>
                    <p>Explore our new line of vegan-certified lipsticks in a variety of bold shades. Perfect for every
                        occasion!</p>

                    <p class="news-date">September 20, 2024</p>
                </div>
            </div>
            <div class="news-card">
                <img src="news_images/trends.png" alt="Beauty Trends 2024">
                <div class="news-content">
                    <h3>Top Beauty Trends to Watch in 2024</h3>
                    <p>Stay ahead of the curve with these beauty trends that are set to take over 2024. From skincare to
                        makeup, we've got you covered.</p>

                    <p class="news-date">September 15, 2024</p>
                </div>
            </div>
            <div class="news-card">
                <img src="news_images/skincare.png" alt="Skincare Routine Tips">
                <div class="news-content">
                    <h3>5 Tips for Building a Sustainable Skincare Routine</h3>
                    <p>Learn how to build a simple, eco-friendly skincare routine using our range of natural and
                        sustainable products.</p>

                    <p class="news-date">September 10, 2024</p>
                </div>
            </div>
            <button class="view-more" onclick="window.location.href='../news/news.php'">view more</button>
        </div>
</div>
</section>
<section>
    <div class="testimonial-section">
        <h2>What Our Customers Say</h2>
        <div class="testimonial-carousel">
            <img id="back-btn" src="buttonImg/back.png" alt="back arrow">
            <div class="testimonials-container">
                <div class="testimonial">
                    <div class="customer-photo">
                        <img src="customerImg/customer1.png" alt="Customer 1">
                    </div>
                    <p class="quote">"The skincare products are absolutely amazing! My skin has never felt better."</p>
                    </br>
                    <p class="customer-name">- Sarah M.</p>
                </div>
                <div class="testimonial">
                    <div class="customer-photo">
                        <img src="customerImg/customer2.png" alt="Customer 2">
                    </div>
                    <p class="quote">"I'm so happy with my purchase! The lipsticks are long-lasting and vibrant."</p>
                    </br>
                    <p class="customer-name">- Lisa K.</p>
                </div>
                <div class="testimonial">
                    <div class="customer-photo">
                        <img src="customerImg/customer3.png" alt="Customer 3">
                    </div>
                    <p class="quote">"Best cosmetics I've ever used. Will definitely be ordering more!"</p></br>
                    <p class="customer-name">- Anna J.</p>
                </div>
            </div>
            <img id="next-btn" src="buttonImg/next-button.png" alt="next arrow">
        </div>
    </div>
</section>


<div class="newsletter">
    <img src="webImages/newsletter.jpg" alt="girl with paint and makeups on face">
    <div class="newsletterContent">
        <h2>LUXEAURA COSMETICS</h1>
            <h1>SUBSCRIBE TO OUR NEWSLETTER</h1>
            <div class="subscribeSection">
                <input class="email-input" type="text" placeholder="Your Email">
                <input class="submit-btn" type="submit" value="SUBSCRIBE">
            </div>
    </div>
</div>
<script src="home.js"></script>



<?php

include "../footer/footer.php";

?>