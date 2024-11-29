<?php
session_start();
include "../header/header.php";
include "../connection/connection.php";

if (isset($_SESSION['userId'])) {

    $userID = $_SESSION['userId'];
    if (!$connection) {
        die("Connection failed: " . mysqli_connect_error());
    }

    $sql = "SELECT f_name, email FROM customer WHERE id = $userID";
    $result = mysqli_query($connection, $sql);

    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $name = $row['f_name'];
        $email = $row['email'];
    } else {
        $name = '';
        $email = '';
    }
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us</title>
    <link rel="stylesheet" href="../contactus/css/contact_us.css">

</head>

<body>

    <!-- Header with title and images -->
    <div class="c_header_title_image_bg">
        <img class="c_header_imgL" src="../contactus/contactUsImages/brownrose-removebg-preview.png" alt="Flower Image">
        <h1 class="c_header_title">CONTACT US</h1>
        <div class="forsmall">
            <p><a href="../home/home.php">HOME</a> > CONTACT US</p>
        </div>
        <img class="c_header_imgR" src="../contactus/contactUsImages/aboutUsImage1-removebg-preview.png"
            alt="Right Image">
    </div>

    <?php
    include "../slideshow/slideshow.php";
    ?>

    <!-- Spacer -->
    <div class="spacer"></div>

    <div class="contact-container">
        <div class="contact-info">
            <p><strong>Hotline:</strong> 077 230 3030</p>
            <p><strong>Online Order Hotlines:</strong></p>
            <ul>
                <li>077 207 7020</li>
                <li>077 311 4172</li>
                <li>077 494 7233</li>
            </ul>
            <p><strong>Online Orders Email:</strong></p>
            <p><a href="mailto:onlineorders@luxeaura.lk">onlineorders@luxeaura.lk</a></p><br>

            <p><strong>Emails:</strong></p>
            <ul>
                <li><a href="mailto:sales@cosmetic.com">sales@cosmetic.com</a></li>
                <li><a href="mailto:info@cosmetic.com">info@cosmetic.com</a></li>
            </ul>

            <p><strong>Address:</strong></p>
            <p>174 Colombo Rd, Dalugama - Kelaniya 10370</p><br>

            <p><strong>SOCIAL NETWORKS</strong></p><br>
            <div class="social-icons">
                <a href="https://www.facebook.com/" target="_blank"><i class="bx bxl-facebook"></i></a>
                <a href="https://www.instagram.com/" target="_blank"><i class="bx bxl-instagram-alt"></i></a>
                <a href="https://www.youtube.com/" target="_blank"><i class="bx bxl-youtube"></i></a>
                <a href="https://www.linkedin.com/" target="_blank"><i class="bx bxl-linkedin"></i></a>
            </div>
        </div>

        <div class="map-container">
            <iframe src="https://www.google.com/maps?q=University+of+Kelaniya,+Sri+Lanka&hl=en&z=15&output=embed"
                width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy">
            </iframe>
        </div>
    </div>

    <div class="spacer"></div>

    <!-- Form and image columns -->
    <div class="container">
        <div class="column">
            <img src="../contactus/contactUsImages/conformimg.jpeg" style="width:100%" alt="Form Image">
        </div>

        <div class="column">
            <?php if (isset($_SESSION['userId'])): ?>

                <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
                    <div class="box">
                        <h2>SEND YOUR QUESTIONS</h2>
                        <label for="fname">Full Name</label>
                        <input type="text" id="fname" name="firstname" value="<?php echo htmlspecialchars($name); ?>">

                        <label for="email">Email</label>
                        <input type="text" id="email" name="email" value="<?php echo htmlspecialchars($email); ?>">

                        <label for="subject">Your Message</label>
                        <input type="hidden" name="userid" value="<?php echo $userID; ?>">
                        <textarea id="subject" name="question" placeholder="Write something.."
                            style="height:410px"></textarea>

                        <input type="submit" name="submit" value="Submit">
                    </div>
                </form>

            <?php else: ?>
                <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
    <div class="box">
        <h2>SEND YOUR QUESTIONS</h2>
        
        <label for="fname">Full Name</label>
        <input type="text" id="fname" name="firstname" value="" disabled>
        
        <label for="email">Email</label>
        <input type="text" id="email" name="email" value="" disabled>
        
        <label for="subject">Your Message</label>
        <input type="hidden" name="userid" value="" disabled>
        <textarea id="subject" name="question" placeholder="Write something.." style="height:410px" disabled></textarea>
        
        <input type="submit" name="submit" value="Submit" disabled>
    </div>
</form>

            <?php endif; ?>
        </div>
    </div>

    <div class="spacer2">
        <h2>FREQUENTLY ASKED QUESTIONS</h2>
    </div>

    <div class="faq-container">
        <div class="faq-item">
            <div class="faq-question">
                <span>WHAT SOLUTIONS DO YOU HAVE FOR ACNE?</span>
                <span class="faq-arrow">&#9662;</span>
            </div>
            <div class="faq-answer">
                We offer a wide range of acne treatments including serums, cleansers, and masks specially formulated for
                acne-prone skin.
            </div>
        </div>
        <div class="faq-item">
            <div class="faq-question">
                <span>HOW DO I RETURN A DAMAGED ITEM?</span>
                <span class="faq-arrow">&#9662;</span>
            </div>
            <div class="faq-answer">
                Kindly share your details to 0772077020 (WhatsApp) or email us at onlineorders@britishcosmetics.lk for
                damaged item returns.
            </div>
        </div>
        <div class="faq-item">
            <div class="faq-question">
                <span>CAN I RETURN OR EXCHANGE AN ITEM IF I DON'T LIKE IT?</span>
                <span class="faq-arrow">&#9662;</span>
            </div>
            <div class="faq-answer">
                Yes, you can return or exchange an item within 30 days of purchase if it’s in its original condition.
                Contact us for further instructions.
            </div>
        </div>
        <div class="faq-item">
            <div class="faq-question">
                <span>DO YOU SHIP INTERNATIONALLY?</span>
                <span class="faq-arrow">&#9662;</span>
            </div>
            <div class="faq-answer">
                Yes, we ship to many international destinations. Shipping fees and delivery times vary depending on the
                destination.
            </div>
        </div>
        <div class="faq-item">
            <div class="faq-question">
                <span>HOW CAN I TRACK MY ORDER?</span>
                <span class="faq-arrow">&#9662;</span>
            </div>
            <div class="faq-answer">
                Once your order has been dispatched, you will receive an email with the tracking number and a link to
                track your order online.
            </div>
        </div>
        <div class="faq-item">
            <div class="faq-question">
                <span>WHAT PAYMENT METHODS DO YOU ACCEPT?</span>
                <span class="faq-arrow">&#9662;</span>
            </div>
            <div class="faq-answer">
                We accept Visa, MasterCard for online orders.
            </div>
        </div>
        <div class="faq-item">
            <div class="faq-question">
                <span>WHAT IS YOUR RETURN POLICY?</span>
                <span class="faq-arrow">&#9662;</span>
            </div>
            <div class="faq-answer">
                You can return any item within 30 days of receiving your order as long as it is unused and in its
                original packaging.
            </div>
        </div>
        <div class="faq-item">
            <div class="faq-question">
                <span>DO YOU OFFER GIFT WRAPPING?</span>
                <span class="faq-arrow">&#9662;</span>
            </div>
            <div class="faq-answer">
                Yes, we offer a gift-wrapping service for an additional fee. You can select this option during the
                checkout process.
            </div>
        </div>
        <!-- More FAQ items -->
    </div>

    <?php
    // Handle form submission
    if (isset($_POST['submit'])) {
        $message = $_POST['question'];
        $userid = $_POST['userid'];

        // Sanitize input to prevent SQL injection
        $message = mysqli_real_escape_string($connection, $message);
        $userid = (int) $userid; // Ensure $userid is an integer
    
        // Prepare the SQL statement
        $sql = "INSERT INTO question (user_id, question) VALUES ($userid, '$message')";

        if (mysqli_query($connection, $sql)) {
            echo "<script>alert('Your message has been sent!');</script>";
        } else {
            echo "<script>alert('Error: " . mysqli_error($connection) . "');</script>";
        }
    }

    mysqli_close($connection);
    include "../footer/footer.php";
    ?>

    <script src="../contactus/JS/contact_us.js"></script>
    <script src="../contactus/JS/toggleMenu.js"></script>

</body>

</html>