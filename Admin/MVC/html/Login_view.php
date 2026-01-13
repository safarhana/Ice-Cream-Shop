<?php include '../php/Login_controller.php'; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ice Cream Delights - Seller Login Page</title>
        <link rel="stylesheet" type="text/css" href="../../../User/MVC/css/User_style.css">
    <link rel="stylesheet" type="text/css" href="../css/Admin_style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
    <link rel="stylesheet" href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css">
</head>

<body>

    <div class="form-container">
        <form action="" method="post" enctype="multipart/form-data" class="login">
            <h2>Login Now</h2>

            <div class="input-field">
                <p>Your Email <span>*</span></p>
                <input type="email" name="email" placeholder="Enter your email" maxlength="50" required class="box">
            </div>

            <div class="input-field">
                <p>Your Password <span>*</span></p>
                <input type="password" name="pass" placeholder="Enter your password" maxlength="50" required
                    class="box">
            </div>

            <p class="link">Do not have an account? <a href="Register_view.php">Register now</a></p>

            <input type="submit" name="submit" value="login now" class="btn">

        </form>
    </div>
    <?php include 'Footer.php' ?>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
    <?php include 'Alert.php'; ?>

</body>

</html>