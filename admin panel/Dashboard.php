<?php
include '../components/Connect.php';


if (isset($_COOKIE['seller_id'])) {
    $seller_id = $_COOKIE['seller_id'];
} else {
    $seller_id = '';
    header('Location: Login.php');
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Ice Cream Delights - Seller dashboard</title>
    
    <link rel="stylesheet" type="text/css" href="../css/Admin_style.css">
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">

    <!-- Boxicons CDN Link -->
    
    <link rel="stylesheet" href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css">
</head>
<body>
    <div class="main-container">
        <?php include '../components/Admin_header.php';  ?>

        <section class="dashboard">
            <div class="heading">
                <img src="../image/separator-img.png">
            </div>

            <div class="box-container">
                <div class="box">
                    <h3>welcome !</h3>
                    <p><?= $fetch_profile['name']; ?></p>
                    <a href="Update.php" class="btn">update profile</a>
                </div>

                <div class="box">
                    <?php
                    $select_message = $conn->prepare("SELECT * FROM `message`");
                    $select_message->execute();
                    $number_of_msg = $select_message->rowcount();
                    ?>
                    <h3><?= $number_of_msg; ?></h3>
                    <p>unread messages</p>
                    <a href="Admin_message.php" class="btn">see message</a>
                </div>

                <div class="box">
                    <?php
                    $select_products = $conn->prepare("SELECT * FROM `products` WHERE seller_id= ? ");
                    $select_products->execute([$seller_id]);
                    $number_of_products = $select_products->rowcount();
                    ?>
                    <h3><?= $number_of_products; ?></h3>
                    <p>products added</p>
                    <a href="Add_products.php" class="btn">add products</a>
                </div>

                <div class="box">
                    <?php
                    $select_active_products = $conn->prepare("SELECT * FROM `products` WHERE seller_id= ? AND status = ?");
                    $select_active_products->execute([$seller_id, 'active']);
                    $number_of_active_products = $select_active_products->rowcount();
                    ?>
                    <h3><?= $number_of_active_products; ?></h3>
                    <p>total active products</p>
                    <a href="View_products.php" class="btn">active products</a>
                </div>

                <div class="box">
                    <?php
                    $select_deactive_products = $conn->prepare("SELECT * FROM `products` WHERE seller_id= ? AND status = ?");
                    $select_deactive_products->execute([$seller_id, 'deactive']);
                    $number_of_deactive_products = $select_deactive_products->rowcount();
                    ?>
                    <h3><?= $number_of_deactive_products; ?></h3>
                    <p>total deactive products</p>
                    <a href="View_products.php" class="btn">deactive products</a>
                </div>

                   <div class="box">
                    <?php
                    $select_users = $conn->prepare("SELECT * FROM `users`");
                    $select_users->execute();
                    $number_of_users = $select_users->rowcount();
                    ?>
                    <h3><?= $number_of_users; ?></h3>
                    <p>users account</p>
                    <a href="User_accounts.php" class="btn">see users</a>
                </div>

                   <div class="box">
                    <?php
                    $select_sellers = $conn->prepare("SELECT * FROM `sellers`");
                    $select_sellers->execute();
                    $number_of_sellers = $select_sellers->rowcount();
                    ?>
                    <h3><?= $number_of_sellers; ?></h3>
                    <p>sellers account</p>
                    <a href="View sellers.php" class="btn">see selllers</a>
                </div>

                  <div class="box">
                    <?php
                    $select_orders = $conn->prepare("SELECT * FROM `orders` WHERE seller_id = ?");
                    $select_orders->execute([$seller_id]);
                    $number_of_orders = $select_orders->rowcount();
                    ?>
                    <h3><?= $number_of_orders; ?></h3>
                    <p>orders placed</p>
                    <a href="Admin_order.php" class="btn">total orders</a>
                </div>

                 <div class="box">
                    <?php
                    $select_confirm_orders = $conn->prepare("SELECT * FROM `orders` WHERE seller_id = ? AND status = ?
                        ");
                    $select_confirm_orders->execute([$seller_id, 'in progress']);
                    $number_of_confirm_orders = $select_confirm_orders->rowcount();
                    ?>
                    <h3><?= $number_of_confirm_orders; ?></h3>
                    <p>confirm placed</p>
                    <a href="Admin_order.php" class="btn">confirmed orders</a>
                </div>

                <div class="box">
                    <?php
                    $select_canceled_orders = $conn->prepare("SELECT * FROM `orders` WHERE seller_id = ? AND status = ?
                        ");
                    $select_canceled_orders->execute([$seller_id, 'canceled']);
                    $number_of_canceled_orders = $select_canceled_orders->rowcount();
                    ?>
                    <h3><?= $number_of_canceled_orders; ?></h3>
                    <p>canceled placed</p>
                    <a href="Admin_order.php" class="btn">canceled orders</a>
                </div>
            </div>
        </section>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
    
    <?php include '../components/Alert.php'; ?>

    <!-- custom js link -->
     <script src = "../js/Admin_script.js"></script>

</body>
</html>