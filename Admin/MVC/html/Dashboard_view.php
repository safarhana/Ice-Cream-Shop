<?php include '../php/Dashboard_controller.php'; ?>
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
        <?php include 'Admin_header.php'; ?>

        <section class="dashboard">
            <div class="heading">
                <img src="../image/separator-img.png">
            </div>

            <div class="box-container">
                <div class="box">
                    <h3>welcome !</h3>
                    <p>
                        <?= $fetch_profile['name']; ?>
                    </p>
                    <a href="Update_view.php" class="btn">update profile</a>
                </div>

                <div class="box">
                    <?php
                    $select_message = $conn->prepare("SELECT * FROM `message`");
                    $select_message->execute();
                    $select_message->store_result();
                    $number_of_msg = $select_message->num_rows;
                    ?>
                    <h3>
                        <?= $number_of_msg; ?>
                    </h3>
                    <p>unread messages</p>
                    <a href="Admin_message_view.php" class="btn">see message</a>
                </div>

                <div class="box">
                    <?php
                    $select_products = $conn->prepare("SELECT * FROM `products` WHERE seller_id= ? ");
                    $select_products->bind_param("s", $seller_id);
                    $select_products->execute();
                    $select_products->store_result();
                    $number_of_products = $select_products->num_rows;
                    ?>
                    <h3>
                        <?= $number_of_products; ?>
                    </h3>
                    <p>Add new product</p>
                    <a href="Add_products_view.php" class="btn">add products</a>
                </div>

                <div class="box">
                    <?php
                    $active_status = 'active';
                    $select_active_products = $conn->prepare("SELECT * FROM `products` WHERE seller_id= ? AND status = ?");
                    $select_active_products->bind_param("ss", $seller_id, $active_status);
                    $select_active_products->execute();
                    $select_active_products->store_result();
                    $number_of_active_products = $select_active_products->num_rows;
                    ?>
                    <h3>
                        <?= $number_of_active_products; ?>
                    </h3>
                    <p>total active products</p>
                    <a href="View_products_view.php" class="btn">active products</a>
                </div>

                <div class="box">
                    <?php
                    $deactive_status = 'deactive';
                    $select_deactive_products = $conn->prepare("SELECT * FROM `products` WHERE seller_id= ? AND status = ?");
                    $select_deactive_products->bind_param("ss", $seller_id, $deactive_status);
                    $select_deactive_products->execute();
                    $select_deactive_products->store_result();
                    $number_of_deactive_products = $select_deactive_products->num_rows;
                    ?>
                    <h3>
                        <?= $number_of_deactive_products; ?>
                    </h3>
                    <p>total deactive products</p>
                    <a href="View_products_view.php" class="btn">deactive products</a>
                </div>

                <div class="box">
                    <?php
                    $select_users = $conn->prepare("SELECT * FROM `users`");
                    $select_users->execute();
                    $select_users->store_result();
                    $number_of_users = $select_users->num_rows;
                    ?>
                    <h3>
                        <?= $number_of_users; ?>
                    </h3>
                    <p>users account</p>
                    <a href="User_accounts_view.php" class="btn">see users</a>
                </div>

                <div class="box">
                    <?php
                    $select_sellers = $conn->prepare("SELECT * FROM `sellers`");
                    $select_sellers->execute();
                    $select_sellers->store_result();
                    $number_of_sellers = $select_sellers->num_rows;
                    ?>
                    <h3>
                        <?= $number_of_sellers; ?>
                    </h3>
                    <p>sellers account</p>
                    <a href="View_sellers_view.php" class="btn">see selllers</a>
                </div>

                <div class="box">
                    <?php
                    $select_orders = $conn->prepare("SELECT * FROM `orders` WHERE seller_id = ?");
                    $select_orders->bind_param("s", $seller_id);
                    $select_orders->execute();
                    $select_orders->store_result();
                    $number_of_orders = $select_orders->num_rows;
                    ?>
                    <h3>
                        <?= $number_of_orders; ?>
                    </h3>
                    <p>Total orders</p>
                    <a href="Admin_order_view.php" class="btn">total orders</a>
                </div>

                <div class="box">
                    <?php
                    $progress_status = 'in progress';
                    $select_confirm_orders = $conn->prepare("SELECT * FROM `orders` WHERE seller_id = ? AND status = ?");
                    $select_confirm_orders->bind_param("ss", $seller_id, $progress_status);
                    $select_confirm_orders->execute();
                    $select_confirm_orders->store_result();
                    $number_of_confirm_orders = $select_confirm_orders->num_rows;
                    ?>
                    <h3>
                        <?= $number_of_confirm_orders; ?>
                    </h3>
                    <p>Pending orders</p>
                    <a href="Admin_order_view.php" class="btn">confirmed orders</a>
                </div>

                <div class="box">
                    <?php
                    $canceled_status = 'canceled';
                    $select_canceled_orders = $conn->prepare("SELECT * FROM `orders` WHERE seller_id = ? AND status = ?");
                    $select_canceled_orders->bind_param("ss", $seller_id, $canceled_status);
                    $select_canceled_orders->execute();
                    $select_canceled_orders->store_result();
                    $number_of_canceled_orders = $select_canceled_orders->num_rows;
                    ?>
                    <h3>
                        <?= $number_of_canceled_orders; ?>
                    </h3>
                    <p>canceled placed</p>
                    <a href="Admin_order_view.php" class="btn">canceled orders</a>
                </div>
            </div>
        </section>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>

    <?php include 'Alert.php'; ?>

    <!-- custom js link -->
    <script src="../js/Admin_script.js"></script>

</body>

</html>