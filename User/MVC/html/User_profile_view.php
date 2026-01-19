<?php include '../php/User_profile_controller.php'; ?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Ice Cream Delights - User Profile</title>
    <link rel="stylesheet" type="text/css" href="../css/User_style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">

    <!-- Boxicons CDN link -->
    <link rel="stylesheet" href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css">
</head>

<body>


    <?php include '../html/User_header.php'; ?>
    <div class="banner">
        <div class="detail">
            <h1>Profile</h1>
            <p>View and manage your account information all in one place.<br>Keep your details updated for a
                personalized experience.
            <p>
                <span>
                    <a href="Home_view.php">home</a>
                    <i class="bx bx-right-arrow-alt"></i>Profile
                </span>
        </div>
    </div>

    <section class="profile">
        <div class="heading">
            <h1>Profile Details</h1>
            <img src="../image/separator-img.png">
        </div>

        <div class="details">
            <div class="user">
                <img src="../uploaded_files/<?= $fetch_profile['image']; ?>">
                <h3 class="name">
                    <?= $fetch_profile['name']; ?>
                </h3>
                <span>User</span>
                <a href="Update_user_view.php" class="btn">Update Profile</a>
            </div>
            <div class="box-container">
                <div class="box">
                    <div class="flex">
                        <i class="bx bxs-folder-minus"></i>
                        <h3><?= $total_orders; ?></h3>
                    </div>
                    <a href="Orders_view.php" class="btn">View Products</a>
                </div>
            </div>

        </div>

        <script src="../js/User_script.js"></script>
        <?php include '../html/Footer.php'; ?>

        <!-- custom js link -->


        <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>

        <?php include '../php/Alert.php'; ?>


</body>

</html>