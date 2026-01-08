<?php include '../php/Register_controller.php'; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ice Cream Delights - User Registration Page</title>

    <link rel="stylesheet" type="text/css" href="../css/User_style.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">

    <!-- Boxicons CDN Link -->

    <link rel="stylesheet" href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css">
</head>

<body>

    <?php include '../php/User_header.php'; ?>
    <div class="banner">
        <div class="detail">
            <h1>register</h1>
            <p>Join us today to get access to exclusive offers, features, and more. It's quick and <br> easy to create
                an account, and you'll be able to enjoy all the benefits we have to offer.</p>
            <span>
                <a href="Home.php">home</a>
                <i class="bx bx-right-arrow-alt"></i>register
            </span>
        </div>
    </div>


    <div class="form-container">
        <form action="" method="post" enctype="multipart/form-data" class="register">

            <h2>Register Now</h2>

            <div class="flex">

                <div class="col">
                    <div class="input-field">
                        <p>Your Name <span>*</span></p>
                        <input type="text" name="name" placeholder="Enter your name" maxlength="50" required
                            class="box">
                    </div>

                    <div class="input-field">
                        <p>Your Email <span>*</span></p>
                        <input type="email" name="email" placeholder="Enter your email" maxlength="50" required
                            class="box">
                    </div>
                </div>

                <div class="col">
                    <div class="input-field">
                        <p>Your Password <span>*</span></p>
                        <input type="password" name="pass" placeholder="Enter your password" maxlength="50" required
                            class="box">
                    </div>

                    <div class="input-field">
                        <p>Confirm Password <span>*</span></p>
                        <input type="password" name="cpass" placeholder="Confirm your password" maxlength="50" required
                            class="box">
                    </div>
                </div>

            </div>

            <div class="input-field">
                <p>Your Picture <span>*</span></p>
                <input type="file" name="image" accept="image/*" required class="box">
            </div>

            <p class="link">Already have an account? <a href="Login_view.php">Login now</a></p>

            <input type="submit" name="submit" value="register now" class="btn">

        </form>
    </div>

    <?php include '../php/Footer.php'; ?>

    <!-- custom js link -->
    <script src="../js/User_script.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>

    <?php include '../php/Alert.php'; ?>



</body>

</html>