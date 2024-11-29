<?php
include "../header/header.php";
session_start();

if (isset($_GET['type'])) {

    if ($_GET['type'] == 'cash') {
        if (isset($_SESSION['userId'])) {
            $customer_id = $_SESSION['userId'];
            $t = $_GET['amount']; // Example: "LKR2300"
            $tamount = preg_replace('/[^0-9]/', '', $t);
            $tamount = floor($tamount / 100); 


            $status = "Pending";
            $due_date = date('Y-m-d', strtotime("+14 days"));
            $address = $_SESSION['orderaddress'];


            $sql = "INSERT INTO orders (status, due_date, customer_id, address) VALUES ('$status', '$due_date', $customer_id, '$address')";

            if (mysqli_query($connection, $sql)) {

                $order_id = mysqli_insert_id($connection);


                $cart_id = $_SESSION['cartId'];
                $cartQuery = "SELECT product_id, quantity FROM cart_product WHERE cart_id = $cart_id";
                $cartResult = mysqli_query($connection, $cartQuery);


                if (mysqli_num_rows($cartResult) > 0) {

                    while ($cartItem = mysqli_fetch_assoc($cartResult)) {
                        $product_id = $cartItem['product_id'];
                        $quantity = $cartItem['quantity'];


                        $orderProductSql = "INSERT INTO order_product (order_id, product_id, quantity) VALUES ($order_id, $product_id, $quantity)";
                        if (!mysqli_query($connection, $orderProductSql)) {
                            echo "Error: " . mysqli_error($connection);
                        }
                    }
                }

                $cartDelete = "delete FROM cart_product WHERE cart_id = '$cart_id'";
                $daleteResult = mysqli_query($connection, $cartDelete);

                //echo "<script>alert('$tamount')</script>";
                $paysql = "insert into payment (amount,account_number,provider,customer_id	,order_id,status) values('$tamount','none','none','$customer_id','$order_id','Pending')";
                $payresult = mysqli_query($connection, $paysql);

                if ($daleteResult) {
                    echo "<script>alert('Order confirmed successfully.')</script>";
                }

            } else {
                echo "Error: " . mysqli_error($connection);
            }


            mysqli_close($connection);

        } else {
            header("Location: ../signinup/signIn.php");
            exit();
        }

    } elseif ($_GET['type'] == "card") {
        if (isset($_SESSION['userId'])) {
            $customer_id = $_SESSION['userId'];
            $cardType = $_SESSION['cardType'];
            $cardNumber = $_SESSION['cardNumber'];
            $amount = $_SESSION['totalOrderCost'];

            $status = "Pending";
            $due_date = date('Y-m-d', strtotime("+14 days"));
            $address = $_SESSION['orderaddress'];


            $sql = "INSERT INTO orders (status, due_date, customer_id, address) VALUES ('$status', '$due_date', $customer_id, '$address')";

            if (mysqli_query($connection, $sql)) {

                $order_id = mysqli_insert_id($connection);


                $cart_id = $_SESSION['cartId'];
                $cartQuery = "SELECT product_id, quantity FROM cart_product WHERE cart_id = $cart_id";
                $cartResult = mysqli_query($connection, $cartQuery);


                if (mysqli_num_rows($cartResult) > 0) {

                    while ($cartItem = mysqli_fetch_assoc($cartResult)) {
                        $product_id = $cartItem['product_id'];
                        $quantity = $cartItem['quantity'];


                        $orderProductSql = "INSERT INTO order_product (order_id, product_id, quantity) VALUES ($order_id, $product_id, $quantity)";
                        if (!mysqli_query($connection, $orderProductSql)) {
                            echo "Error: " . mysqli_error($connection);
                        }
                    }
                }

                $cartDelete = "delete FROM cart_product WHERE cart_id = '$cart_id'";
                $daleteResult = mysqli_query($connection, $cartDelete);

                $paysql = "insert into payment (amount,account_number,provider,customer_id	,order_id,status) values('$amount','$cardType','$cardNumber','$customer_id','$order_id','Paid')";
                $payresult = mysqli_query($connection, $paysql);

                if ($daleteResult) {
                    echo "<script>alert('Order confirmed successfully.')</script>";
                }



            } else {
                echo "Error: " . mysqli_error($connection);
            }


            mysqli_close($connection);

        } else {
            header("Location: ../signinup/signIn.php");
            exit();
        }

    }


}
?>

<link rel="icon" type="image/png" href="../logo.png">
<link rel="stylesheet" type="text/css" href="../confirm/styles/confirm.css">

<div class="topic_header">
    <img id="header-img1" src="images/img1.png">
    <img id="header-img2" src="images/img2.png">
</div>

<div class="content">
    <img src="../confirm/images/happy.gif">
    <h2>Your order is</h2>
    <h1>SUCCESSFULLY COMPLETED!</h1>
</div>

<?php
include "../footer/footer.php";
?>