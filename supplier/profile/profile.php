<?php include "../header/header.php"; ?>

<?php
session_start();

if (isset($_SESSION['supplierID'])) {
    $supplierid = $_SESSION['supplierID'];
    $brandid = $_SESSION['brandId'];

    $sql = "select s.*,b.name as bname from supplier as s join brand_category as b on b.id = s.brand_id   where s. id = '$supplierid'";
    $result = mysqli_query($connection, $sql);
    if (!$result) {
        echo "<script>alert('Cant get supplier data!')</script>";
    } else {
        if (mysqli_num_rows($result) > 0) {
            $supplierdata = mysqli_fetch_all($result, MYSQLI_ASSOC);
        }
    }

    $ordersql = "select op.*,p.price,o.status from order_product as op
    join product as p on op.product_id = p.id
    join orders as o on op.order_id = o.id
    where brand_id = 
    '$brandid'";
        $order = mysqli_query($connection, $ordersql);
        if (!$order) {
            echo "<script>alert('Cant get order data!')</script>";
        } else {
            if (mysqli_num_rows($order) > 0) {
                $orderdata = mysqli_fetch_all($order, MYSQLI_ASSOC);
            }
        }
    
    } else {
        header('Location:../signin/signin.php');
    }
    
    
    ?>
    
<link rel="stylesheet" href="../profile/style/profile.css">

<?php
include "../navbar/navbar.php";
?>

<div class="profile">
        <h2>Profile</h2>
        <form>

            <label for="name">Name:</label>
            <input type="text" id="name" value="<?php echo $supplierdata[0]['name']; ?>" readonly>

            <label for="contactInfo">Email:</label>
            <input type="text" id="contactInfo" value="<?php echo $supplierdata[0]['email']; ?>" readonly>


            <label for="companyName">Company Name:</label>
            <input type="text" id="companyName" value="<?php echo $supplierdata[0]['bname']; ?>" readonly><br><br>

        </form>
    </div>



<?php include "../footer/footer.php"; ?>