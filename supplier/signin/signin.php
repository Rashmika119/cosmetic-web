<?php include("../header/header.php"); ?>

<?php

if (isset($_POST['submit'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM supplier WHERE email = '$email'";
    $result = mysqli_query($connection, $sql);
    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_all($result, MYSQLI_ASSOC);

        $sqlpassword = $row[0]["PASSWORD"];

        if ($password === $sqlpassword) {
            session_start();
            $_SESSION['supplierID'] = $row[0]["id"];
            $_SESSION["brandId"] = $row[0]["brand_id"];
            echo "<script>alert('Login Successful!')</script>";
            header("Location:../dashboard/dashboard.php");
            exit();
        } else{
            echo "<script>alert('Login Failed!')</script>";
        }
    }
    else{
        echo "<script>alert('Login Failed!')</script>";
    }
}

?>

<link rel="stylesheet" href="css/signin.css">


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
    </form>
</div>

<?php include("../footer/footer.php"); ?>