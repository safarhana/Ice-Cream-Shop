<?php include '../php/Update_user_controller.php'; ?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Ice Cream Delights - Update profile</title>

    <link rel="stylesheet" type="text/css" href="../css/User_style.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">

    <!-- Boxicons CDN Link -->

    <link rel="stylesheet" href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css">
</head>

<body>

    <?php include '../html/User_header.php'; ?>
    <div class="banner">
        <div class="detail">
            <h1>Update Profile</h1>
            <p>Keep your details updated for a personalized experience.</p>
            <span>
                <a href="Home_view.php">home</a>
                <i class="bx bx-right-arrow-alt"></i>Update Profile
            </span>
        </div>
    </div>

    <section class="form-container">
        <div class="heading">
            <h1>Update Profile Details</h1>
            <img src="../image/separator-img.png">
        </div>

        <form action="" method="post" enctype="multipart/form-data" class="register">
            <div class="img-box">
                <img src="../uploaded_files/<?= $fetch_profile['image']; ?>">
            </div>
            <div class="flex">
                <div class="col">
                    <div class="input-field">
                        <p>Your Name <span>*</span></p>
                        <input type="text" name="name" placeholder="<?= $fetch_profile['name']; ?>" class="box">
                    </div>
                    <div class="input-field">
                        <p>Your Email <span>*</span></p>
                        <input type="email" name="email" placeholder="<?= $fetch_profile['email']; ?>" class="box">
                    </div>
                    <div class="input-field">
                        <p>Select Picture <span>*</span></p>
                        <input type="file" name="image" accept="image/*" class="box">
                    </div>
                </div>

                <div class="col">
                    <div class="input-field">
                        <p>Old Password <span>*</span></p>
                        <input type="password" name="old_pass" placeholder="Enter your old password" class="box">
                    </div>
                    <div class="input-field">
                        <p>New Password <span>*</span></p>
                        <input type="password" name="new_pass" placeholder="Enter your new password" class="box">
                    </div>
                    <div class="input-field">
                        <p>Confirm Password <span>*</span></p>
                        <input type="password" name="cpass" placeholder="Confirm your old password" class="box">
                    </div>
                </div>
            </div>
            <input type="submit" name="submit" value="update profile" class="btn">
        </form>
    </section>


    <script src="../js/User_script.js"></script>
    <?php include '../html/Footer.php'; ?>

    <!-- custom js link -->


    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>

    <?php include '../php/Alert.php'; ?>
</body>

</html>