<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ABC Cosmetic</title>
   <link rel="stylesheet" href="../css/contact_us.css">
   <script src="../JS/contact_us.js"></script>
</head>


<body>

<!-- Header with title and images -->
    <div class="c_header_title_image_bg">
        <!-- Left-hand image (flower), partially visible -->
        <img class="c_header_imgL" src="../images/brownrose-removebg-preview.png" alt="Flower Image">
        
        <!-- Centered heading -->
        <h1 class="c_header_title">CONTACT US</h1>
        
        <!-- Right-hand image -->
        <img class="c_header_imgR" src="../images/aboutUsImage1-removebg-preview.png" alt="Right Image">
    </div>

     <!-- Spacer between sections -->
     <div class="spacer"></div>

     <!-- google map section -->
     <div class="contact-container">
        <div class="contact-info">
            <h2>Contact Us</h2>
            <p><strong>Hotline:</strong> 077 230 3030</p>
            <p><strong>Online Order Hotlines:</strong></p>
            <ul>
                <li>077 207 7020</li>
                <li>077 311 4172</li>
                <li>077 494 7233</li>
            </ul>
            <p><strong>Emails:</strong></p>
            <ul>
                <li>sales@yourwebsite.com</li>
                <li>info@yourwebsite.com</li>
            </ul>
            <p><strong>Address:</strong></p>
            <p>174 Galle Rd, Dehiwala-Mount Lavinia 10370</p>
        </div>
        
        <div class="map-container">
            <!-- Embed Google Map -->
            <iframe
              src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1977.2585084280067!2d79.97248973229529!3d6.974646312450464!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3ae2585b270fc8c1%3A0xe9d99b64685d53d8!2sUniversity%20of%20Kelaniya!5e0!3m2!1sen!2slk!4v1695510970931!5m2!1sen!2slk"
              width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy" 
              referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>
    </div>


    <!-- Spacer between sections -->
    <div class="spacer"></div>
    
<!-- Form and image columns -->
    <div class="container">

        <div class="column">
                <!-- Left-side image -->
                <img src="../images/conformimg.jpeg" style="width:100%" alt="Form Image">
        </div>

        <div class="column">
            <!-- Right-side form -->
            <form action="/action_page.php">
              
                <div class="box">
                    <h2>SEND YOUR QUESTIONS</h2>
                    <label for="fname">Full Name</label>
                    <input type="text" id="fname" name="firstname" placeholder="Your name..">

                    <label for="email">Email</label>
                    <input type="text" id="email" name="email" placeholder="Your email..">
        
                    <label for="subject">Your Message</label>
                    <textarea id="subject" name="subject" placeholder="Write something.." style="height:170px"></textarea>
                    
                    <input type="submit" value="Submit">
                </div>
            </form>
        </div>
    </div>


<!-- Spacer between sections -->
     <div class="spacer2">
        <h2>FREQUENTLY ASKED QUESTIONS</h2>
     </div>


<!-- Frequently asked questions part -->
     <div class="faq-container">

        <div class="faq-item">
            <div class="faq-question">
                <span>WHAT SOLUTIONS DO YOU HAVE FOR ACNE?</span>
                <span class="faq-arrow">&#9662;</span>
            </div>
            <div class="faq-answer">
                We offer a wide range of acne treatments including serums, cleansers, and masks specially formulated for acne-prone skin.
            </div>
        </div>
    
        <div class="faq-item">
            <div class="faq-question">
                <span>HOW DO I RETURN A DAMAGED ITEM?</span>
                <span class="faq-arrow">&#9662;</span>
            </div>
            <div class="faq-answer">
                Kindly share your details to 0772077020 (WhatsApp) or email us at onlineorders@britishcosmetics.lk for damaged item returns.
            </div>
        </div>
    
        <div class="faq-item">
            <div class="faq-question">
                <span>CAN I RETURN OR EXCHANGE AN ITEM IF I DON'T LIKE IT?</span>
                <span class="faq-arrow">&#9662;</span>
            </div>
            <div class="faq-answer">
                Yes, you can return or exchange an item within 30 days of purchase if it’s in its original condition. Contact us for further instructions.
            </div>
        </div>

        <!-- Add more FAQs here -->
    </div>

  
</body>
</html>