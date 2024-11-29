<?php
include "../header/header.php";

if (isset($_POST['submit'])) {

    $email = $_POST['email'];
    $password = $_POST['password'];

    $customer_query = "select cu.*,c.id as caid from customer as cu join cart as c on cu.id = c.customer_id where email = '$email'";
    $result = mysqli_query($connection, $customer_query);
    $data = mysqli_fetch_all($result, MYSQLI_ASSOC);
    if (!empty($data)) {

        if ($password == $data[0]['password']) {
            echo "Login successfully!";
            session_start();
            $_SESSION['userId'] = $data[0]['id'];
            $_SESSION['email'] = $data[0]['email'];
            $_SESSION['cartId'] = $data[0]['caid'];
            header("Location:../home/home.php");
        }

    } else {
        echo "<script>confirm('User not found!You can sign up in to the system.');
        window.location.href = '../signinup/signUp.php';</script>";
       // header("Location:../signinup/signUp.php");
        exit();
    }


}
?>

<link rel="stylesheet" href="styles/signInUp.css">

<div class="mainImage">
    <img src="images/pic1.png" alt="" class="pic1">
    <h1>My Account</h1>
    <h3>HOME > MY ACCOUNT</h3>
    <img src="images/pic2.png" alt="" class="pic2">
</div>

<div class="loginContainer">
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" id="signinForm">
        <h2>SIGN IN</h2>

        <div>
            <label for="email">Email</label>
            <input type="email" id="email" name="email">
            <span class="error" id="emailError"></span>
        </div>

        <div>
            <label for="password">Password</label>
            <input type="password" id="password" name="password">
            <span class="error" id="passwordError"></span>
        </div>

        <div>
            <input type="submit" value="Submit" name="submit">
        </div>

        <p>I donot have an account.<a href="signUp.php">SIGN UP</a></p>
    </form>
</div>

<script src="scripts/signin.js"></script>

<?php include "../footer/footer.php"; ?>