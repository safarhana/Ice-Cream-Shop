<?php include '../php/Profile_controller.php'; ?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Ice Cream Delights - Seller Profile</title>
    <link rel="stylesheet" type="text/css" href="../css/Admin_style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">

    <!-- Boxicons CDN link -->
    <link rel="stylesheet" href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css">
</head>

<body>

    <div class="main-container">
        <?php include 'Admin_header.php'; ?>

        <section class="seller-profile">
            <div class="heading">
                <h1>Profile Details</h1>
                <img src="../image/separator-img.png">
            </div>

            <div class="details">
                <div class="seller">
                    <img src="../uploaded_files/<?= $fetch_profile['image']; ?>">
                    <h3 class="name">
                        <?= $fetch_profile['name']; ?>
                    </h3>
                    <span>Seller</span>
                    <a href="Update_view.php" class="btn">Update Profile</a>
                </div>
                <div class="flex">
                    <div class="box">
                        <span>
                            <?= $total_products; ?>
                        </span>
                        <p>Total Products</p>
                        <a href="View_products_view.php" class="btn">View Products</a>
                    </div>
                    <div class="box">
                        <span>
                            <?= $total_orders; ?>
                        </span>
                        <p>Total Orders Placed</p>
                        <a href="Admin_order_view.php" class="btn">View Orders</a>
                    </div>
                </div>

            </div>
    </div>
    </section>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
    <?php include 'Alert.php'; ?>
    <script src="../js/Admin_script.js"></script>

</body>

</html>