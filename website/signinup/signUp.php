<?php 
include "../header/header.php";

if (isset($_POST['submit'])) {
    // Capture the form inputs
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $phone = $_POST['phone'];

    // Insert customer data into the 'customer' table
    $customer_query = "INSERT INTO customer (f_name, l_name, email, password, phone_number) 
                       VALUES ('$fname', '$lname', '$email', '$password', '$phone')";

    if (mysqli_query($connection, $customer_query)) {
        // Get the last inserted customer ID
        $customer_id = mysqli_insert_id($connection);

        // Insert an empty cart for the new customer into the 'cart' table
        $cart_query = "INSERT INTO cart (customer_id) VALUES ('$customer_id')";

        if (mysqli_query($connection, $cart_query)) {
            // Redirect to sign-in page if both customer and cart were created successfully
            echo "New customer and cart added successfully!";
            header("Location:signIn.php");
        } else {
            $error_message = mysqli_error($connection);
            echo "<script>
                    alert('Error while creating cart: " . addslashes($error_message) . "');
                  </script>";
        }
    } else {
        $error_message = mysqli_error($connection);
        echo "<script>
                alert('Error while creating customer: " . addslashes($error_message) . "');
              </script>";
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
    <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post" id="signupForm">
        <h2>SIGN UP</h2>
        <div>
            <label for="fname">First Name</label>
            <input type="text" id="fname" name="fname">
            <span class="error" id="fnameError"></span>
        </div>

        <div>
            <label for="lname">Last Name</label>
            <input type="text" name="lname" id="lname">
            <span class="error" id="lnameError"></span>
        </div>

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
            <label for="confirmPassword">Confirm Password</label>
            <input type="password" id="confirmPassword" name="confirmPassword">
            <span class="error" id="confirmPasswordError"></span>
        </div>

        <div>
            <label for="phone">Phone Number</label>
            <input type="tel" name="phone" id="phone">
            <span class="error" id="phoneError"></span>
        </div>

        <div>
            <input type="submit" value="Submit" name="submit">
        </div>

        <p>I already have an account.<a href="signIn.php">SIGN IN</a></p>
    </form>
</div>

<script src="scripts/signup.js"></script>

<?php include "../footer/footer.php";?>
