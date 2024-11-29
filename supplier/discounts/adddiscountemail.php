<?php

// Include PHPMailer classes
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../vendor/autoload.php';  // Load Composer's autoloader

// Include database connection
include "../connection/connection.php";

if (isset($_POST['adddiscount'])) {

    // Collect form data
    $productid = $_POST['product'];
    $amount = $_POST['amount'];

    $psql = "select p.name  from product as p where p.id = '$productid'";
    $presult = mysqli_query($connection, $psql);
    if($presult){
        $pdata = mysqli_fetch_all($presult,MYSQLI_ASSOC);
    }
    $name = $pdata[0]['name'];

    // Set up PHPMailer
    $mail = new PHPMailer(true);

    try {
        // SMTP server configuration
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';  // Use Gmail's SMTP server
        $mail->SMTPAuth = true;
        $mail->Username = 'madushanp835@gmail.com';  // Your Gmail email address
        $mail->Password = 'whta sprh bjfn ycns';   // Your Gmail email password or App Password
        $mail->SMTPSecure = 'tls';
        $mail->Port = 587;

        // Email details
        $mail->setFrom('madushanp835@gmail.com', 'pubudu');  // Sender's email and name
        $mail->addAddress('rashmikanethsarani119@gmail.com');           // Recipient's email address

        // Content of the email
        $mail->isHTML(true);
        $mail->Subject = 'Add discount Product';
        $mail->Body = "
            <html>
            <head>
            <title>Add discount Product</title>
            </head>
            <body>
                <h2>Product Information</h2>
                 <p><strong>Product Id:</strong> $productid</p>
                <p><strong>Product Name:</strong> $name</p>
                <p><strong>Amount:</strong> $amount</p>
            </body>
            </html>";

        // Send the email
        $mail->send();
        echo "<script>
        alert('Email sent successfully.');
        window.location.href = '../discounts/discounts.php';
    </script>";


    } catch (Exception $e) {
        echo "Failed to send email. Error: {$mail->ErrorInfo}";
    }

    // Close the database connection
    mysqli_close($connection);
}

?>