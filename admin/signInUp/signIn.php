<?php 

include "../connection/connection.php";

if (isset($_POST['submit'])) {
   
    $email = $_POST['email'];
    $password = $_POST['password'];

            $admin_query = "select * from admin where email = '$email'";
            $result = mysqli_query($connection, $admin_query);
            if ($result) {
                $data = mysqli_fetch_all($result,MYSQLI_ASSOC);
            
                if($password==$data[0]['password']){
                    echo "Login successfully!";
                    session_start();
                     $_SESSION['adminId'] = $data[0]['id'];   
                     $_SESSION['email'] = $data[0]['email'];                                                                                            
                    header("Location:../manageproducts/manageProducts.php");
                }

            } else {
                $error_message = mysqli_error($connection);
                echo "<script>
                        alert('Error: " . addslashes($error_message) . "');
                      </script>";
            }
     
        }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style/signInUp.css">
</head>
<body>
<div class="loginContainer"> 
    <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post" id="signinForm">
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

<script src="scripts/signIn.js"></script>



