<?php
include "../header/header.php";
session_start();

// Redirect if the user is not logged in
if (!isset($_SESSION['userId'])) {
    header("Location:../signinup/signin.php");
    exit;
}

$userid = $_SESSION['userId'];

// Fetch user information using a prepared statement
$sql = "SELECT * FROM customer WHERE id = ?";
$stmt = mysqli_prepare($connection, $sql);
mysqli_stmt_bind_param($stmt, 'i', $userid);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

if (!$result || mysqli_num_rows($result) == 0) {
    echo "<script>alert('User data not found');</script>";
    exit;
}

$userdata = mysqli_fetch_assoc($result);
$fname = $userdata["f_name"];
$lname = $userdata["l_name"];
$phonenumber = $userdata["phone_number"];
$email = $userdata["email"];
$addressid = $userdata["address_id"];

// Handle user information update
if (isset($_POST['updateuserinfo'])) {
    $fname = $_POST["fname"];
    $lname = $_POST["lname"];
    $phonenumber = $_POST["phonenumber"];

    // Use prepared statement to update customer info
    $sql = "UPDATE customer SET f_name = ?, l_name = ?, phone_number = ? WHERE id = ?";
    $stmt = mysqli_prepare($connection, $sql);
    mysqli_stmt_bind_param($stmt, 'sssi', $fname, $lname, $phonenumber, $userid);
    $result = mysqli_stmt_execute($stmt);

    if ($result) {
        echo "<script>alert('Profile updated successfully');</script>";
    } else {
        echo "<script>alert('Failed to update profile');</script>";
    }
}

// Handle adding new address
if (isset($_POST['addaddress'])) {
    $street1 = $_POST['street1'];
    $street2 = $_POST['street2'];
    $district = $_POST['district'];
    $postalcode = $_POST['postalcode'];

    // Insert new address
    $sql = "INSERT INTO address (street_1, street_2, district, postal_code) VALUES (?, ?, ?, ?)";
    $stmt = mysqli_prepare($connection, $sql);
    mysqli_stmt_bind_param($stmt, 'ssss', $street1, $street2, $district, $postalcode);
    $result = mysqli_stmt_execute($stmt);

    if ($result) {
        $new_address_id = mysqli_insert_id($connection);

        // Update customer's address_id
        $update_sql = "UPDATE customer SET address_id = ? WHERE id = ?";
        $update_stmt = mysqli_prepare($connection, $update_sql);
        mysqli_stmt_bind_param($update_stmt, 'ii', $new_address_id, $userid);
        $update_result = mysqli_stmt_execute($update_stmt);

        if ($update_result) {
            // Update session with the new address ID
            $_SESSION['address_id'] = $new_address_id;

            // Refresh the page to display the new address
            echo "<script>
                    alert('Address added successfully');
                    window.location.href = 'account.php';
                  </script>";
        } else {
            echo "<script>alert('Failed to update customer address');</script>";
        }
    } else {
        echo "<script>alert('Failed to add address');</script>";
    }
}

// Handle address update
if (isset($_POST['editaddress'])) {
    $addressid = $_POST['addressid'];
    $street1 = $_POST['street1'];
    $street2 = $_POST['street2'];
    $district = $_POST['district'];
    $postalcode = $_POST['postalcode'];

    // Update existing address
    $sql = "UPDATE address SET street_1 = ?, street_2 = ?, district = ?, postal_code = ? WHERE id = ?";
    $stmt = mysqli_prepare($connection, $sql);
    mysqli_stmt_bind_param($stmt, 'ssssi', $street1, $street2, $district, $postalcode, $addressid);
    $result = mysqli_stmt_execute($stmt);

    if ($result) {
        echo "<script>alert('Address updated successfully');</script>";
    } else {
        echo "<script>alert('Failed to update address');</script>";
    }
}
?>

<link rel="stylesheet" href="styles/account.css">

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
                <p>Hello,</p>
                <p><?php echo htmlspecialchars($fname); ?></p>
            </div>
        </div>

        <div class="links">
            <ul> <li><a href="account.php">Account</a></li>
                <li><a href="orders.php">Orders</a></li>
               
                <li><a href="../cart/cart.php">Cart</a></li>
               
                <li><a href="logout.php">Log Out</a></li>
            </ul>
        </div>
    </div>

    <div class="details">
        <div class="mb"> 
            <form name="profileForm" action="<?php echo $_SERVER['PHP_SELF'];?>" method="post" onsubmit="return validateProfileForm()">
                <h2>Account Information</h2>
                <ul>
                    <li><strong>Name:</strong><input type="text" name="fname" value="<?php echo htmlspecialchars($fname); ?>" required></li>
                    <li><strong>Last Name:</strong><input type="text" name="lname" value="<?php echo htmlspecialchars($lname); ?>" required></li>
                    <li><strong>Email:</strong><?php echo htmlspecialchars($email); ?></li>
                    <li><strong>Phone:</strong><input type="text" name="phonenumber" value="<?php echo htmlspecialchars($phonenumber); ?>" required></li>
                </ul>
                <div class="account-actions">
                    <input type="hidden" name="userid" value="<?php echo htmlspecialchars($userid);?>">
                    <button class="edit-button" type="submit" name="updateuserinfo">Edit Profile</button>
                </div>
            </form>
        </div>
        <div class="mb">  
            <div class="addresses">
                <?php if ($addressid):
                    // Fetch the address
                    $sql = "SELECT * FROM address WHERE id = ?";
                    $stmt = mysqli_prepare($connection, $sql);
                    mysqli_stmt_bind_param($stmt, 'i', $addressid);
                    mysqli_stmt_execute($stmt);
                    $result = mysqli_stmt_get_result($stmt);

                    if ($result && mysqli_num_rows($result) > 0) {
                        $useraddressdata = mysqli_fetch_assoc($result);
                        $street1 = $useraddressdata["street_1"];
                        $street2 = $useraddressdata["street_2"];
                        $district = $useraddressdata["district"];
                        $postalcode = $useraddressdata["postal_code"];
                    } else {
                        echo "<script>alert('Address not found');</script>";
                    }
                ?>
                    <form name="addressForm" action="<?php echo $_SERVER['PHP_SELF'];?>" method="post" onsubmit="return validateAddressForm()">
                        <h3>Manage Addresses</h3>
                        <ul>
                            <li><strong>Street 1:</strong><input type="text" name="street1" value="<?php echo htmlspecialchars($street1); ?>" required></li>
                            <li><strong>Street 2:</strong><input type="text" name="street2" value="<?php echo htmlspecialchars($street2); ?>"></li>
                            <li><strong>District:</strong><input type="text" name="district" value="<?php echo htmlspecialchars($district); ?>" required></li>
                            <li><strong>Postal Code:</strong><input type="text" name="postalcode" value="<?php echo htmlspecialchars($postalcode); ?>" required></li>
                        </ul>
                        <input type="hidden" name="addressid" value="<?php echo $addressid?>">
                        <button class="edit-address-btn" type="submit" name="editaddress">Edit Address</button>
                    </form>
                <?php else: ?>
                    <form name="addressForm" action="<?php echo $_SERVER['PHP_SELF'];?>" method="post" onsubmit="return validateAddressForm()">
                        <p>Add Address:</p>
                        <ul>
                            <li><strong>Street 1:</strong><input type="text" name="street1" required></li>
                            <li><strong>Street 2:</strong><input type="text" name="street2"></li>
                            <li><strong>District:</strong><input type="text" name="district" required></li>
                            <li><strong>Postal Code:</strong><input type="text" name="postalcode" required></li>
                        </ul>
                        <button class="edit-address-btn" type="submit" name="addaddress">Add Address</button>
                    </form>
                <?php endif; ?>
            </div>
        

        </div>
       
           

    </div>
</div>

<script src="scripts/account.js"></script>

<?php include "../footer/footer.php"; ?>
