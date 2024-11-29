<?php

// Include PHPMailer classes
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../vendor/autoload.php';  // Load Composer's autoloader

// Include database connection
include "../connection/connection.php";

if (isset($_POST['submit'])) {

    // Collect form data
    $name = $_POST['name'];
    $description = $_POST['description'];
    $price = $_POST['price'];

    // Check if a file was uploaded and get the file name
    $image = '';
    if (isset($_FILES['file']) && $_FILES['file']['error'] === UPLOAD_ERR_OK) {
        $image = $_FILES['file']['name'];
        $target_dir = "../uploads/";
        $target_file = $target_dir . basename($image);
        move_uploaded_file($_FILES["file"]["tmp_name"], $target_file);
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

        // Attach the uploaded image
        if (!empty($image) && file_exists($target_file)) {
            $mail->addAttachment($target_file, $image); // Attach the file with the original file name
        }

        // Content of the email
        $mail->isHTML(true);
        $mail->Subject = 'Update Product Details';
        $mail->Body = "
            <html>
            <head>
            <title>Update Product Details</title>
            </head>
            <body>
                <h2>Product Information</h2>
                <p><strong>Product Name:</strong> $name</p>
                <p><strong>Description:</strong> $description</p>
                <p><strong>Price:</strong> $$price</p>
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