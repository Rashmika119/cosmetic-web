<?php

include "../header/header.php";

session_start();
if(!isset($_SESSION['userId'])){
    header("Location:../signinup/signin.php");
}

$userid = $_SESSION['userId'];

$sql = "select * from customer where id = '$userid'";
$result = mysqli_query($connection,$sql);
if(!$result){
    echo "<script> alert('user data not found')</script>";
}
$userdata = mysqli_fetch_all($result, MYSQLI_ASSOC);


if(isset($_POST['logout'])){
    
    session_destroy();
    header("Location:../signinup/signin.php");
}


?>

<link rel="stylesheet" href="styles/profilestyle.css">

<div class="mainImage">
    <img src="images/pic1.png" alt="" class="pic1">
    <h1>Profile</h1>
    <h3>HOME > DASHBOARD</h3>
    <img src="images/pic2.png" alt="" class="pic2">
</div>


<div class="dashboard">

<div class="linkssection">

    <div class="useremail">
        <div class="icon">
        <i class="fas fa-user"></i>
        </div>
    <div>
    <p>Hellow,</p>
    <p><?PHP  echo $userdata[0]['f_name'];?></p>
    </div>
    </div>

    <div class="links">
        <ul>  <li><a href="account.php">Account</a></li>
            <li><a href="orders.php">Orders</a></li>
          
            <li><a href="../cart/cart.php">Cart</a></li>
            
            <li><a href="logout.php">Log Out</a></li>
        </ul>
    </div>

</div>

<div class="details">
   <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post" onsubmit="return confirm('Are you sure you want to logout?')">
    <p style="color: red;margin-bottom: 20px">This will Logout your account</p>
    <button type="submit" name="logout" class="logout"> Log Out</button>
   </form>
</div>

</div>

<?php include "../footer/footer.php";?>