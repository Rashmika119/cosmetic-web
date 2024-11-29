<?php

include "../connection/connection.php";
session_start();
if (isset($_SESSION['userId'])) {

    $userid = $_SESSION['userId'];
    print_r("user id " . $userid);

    if (isset($_POST['cart'])) {
        $productid = $_POST['id'];
        $quantity = isset($_POST['quantity']) ? $_POST['quantity'] : 1;
        print_r(" product id " . $productid);


        $sql1 = "select id from cart where customer_id = '$userid'";
        $result1 = mysqli_query($connection, $sql1);

        if ($result1) {

            $resultdata1 = mysqli_fetch_all($result1, MYSQLI_ASSOC);

            $cartid = $resultdata1[0]['id'];

            $sql4 = "select * from cart_product where cart_id = '$cartid' and Product_id = '$productid' ";
            $result4 = mysqli_query($connection, $sql4);

            if (mysqli_num_rows($result4) == 0) {

                $sql2 = "insert into cart_product (cart_id,Product_id,quantity) values ('$cartid','$productid','$quantity')";
                $result2 = mysqli_query($connection, $sql2);
                if ($result2) {

                    $sql3 = "UPDATE product SET quantity = quantity - '$quantity' WHERE id = '$productid' AND quantity > 0";
                    mysqli_query($connection, $sql3);

                    header("Location:../cart/cart.php");

                } else {

                   header("Location:../cart/cart.php");
                }
            } else {

                echo "<script>alert('already in the cart')</script>";
                header("Location:../cart/cart.php");

            }
        }
    }
   
} else {

    echo "<script>alert('cart add error')</script>";
    header("Location:../signinup/signIn.php");

}


?>