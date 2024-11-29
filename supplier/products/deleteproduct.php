<?php

// Include PHPMailer classes
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../vendor/autoload.php';  // Load Composer's autoloader

// Include database connection
include "../connection/connection.php";

if (isset($_GET['pid'])) {

$pid = intval($_GET['pid']);

$sql = "select * from product where id = '$pid'";
$result = mysqli_query($connection, $sql);
if (mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_all($result, MYSQLI_ASSOC);
}

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
        $mail->Subject = 'Delete Product Details';
        $mail->Body = "
            <html>
            <head>
            <title>Delete Product Details</title>
            </head>
            <body>
                <h2>Product Information</h2>
                 <p><strong>Product Id:</strong>". $row[0]['id']."</p>
                <p><strong>Product Name:</strong>". $row[0]['name']."</p>
            </body>
            </html>";

        // Send the email
        $mail->send();
        echo "<script>
        alert('Email sent successfully.');
        window.location.href = '../products/product.php';
    </script>";
    
        
        
    } catch (Exception $e) {
        echo "Failed to send email. Error: {$mail->ErrorInfo}";
    }

    // Close the database connection
    mysqli_close($connection);
}

?>