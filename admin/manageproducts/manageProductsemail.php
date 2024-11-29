<?php


use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../vendor/autoload.php';  


include "../connection/connection.php";

if (isset($_GET['productname'])) {

    $name = $_GET['productname'];
    $description = $_GET['productdescription'];
    $price = $_GET['productprice'];
    $brand = $_GET['brand'];       
    $category = $_GET['category'];
    $quantity = $_GET['quantity'];


    $mail = new PHPMailer(true);

    try {
       
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';  
        $mail->SMTPAuth = true;
        $mail->Username = 'madushanp835@gmail.com'; 
        $mail->Password = 'whta sprh bjfn ycns';  
        $mail->SMTPSecure = 'tls';
        $mail->Port = 587;

       
        $mail->setFrom('madushanp835@gmail.com', 'pubudu'); 
        $mail->addAddress('rashmikanethsarani119@gmail.com');           


       
        $mail->isHTML(true);
        $mail->Subject = 'Product Details Updated';
        $mail->Body = "
            <html>
            <head>
            <title>Product Details Updated</title>
            </head>
            <body>
                <h2>Updated Product Information</h2>
                <p><strong>Product Name:</strong> $name</p>
                <p><strong>Description:</strong> $description</p>
                <p><strong>Price:</strong> $$price</p>
                <p><strong>Brand:</strong> $brand</p>
                <p><strong>Category:</strong> $category</p>
                <p><strong>Quantity:</strong> $quantity</p>
            </body>
            </html>";

       
        $mail->send();
        echo "<script>
        alert('Email sent successfully.');
        window.location.href = '../manageproducts/manageProducts.php';
    </script>";
    

    } catch (Exception $e) {
        echo "Failed to send email. Error: {$mail->ErrorInfo}";
    }

    mysqli_close($connection);
}

?>


