<?php include '../php/Order_detail_controller.php'; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ice Cream Delights - View my page</title>
    <link rel="stylesheet" type="text/css" href="../css/User_style.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">

    <!-- Boxicons CDN Link -->

    <link rel="stylesheet" href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css">

</head>

<body>

    <?php include '../html/User_header.php'; ?>
    <div class="banner">
        <div class="detail">
            <h1>Order Detail</h1>
            <p>Review all the information about your order, including items <br> purchased, keep track of your
                order and manage your purchase with ease</p>
            <span>
                <a href="Home.php">home</a>
                <i class="bx bx-right-arrow-alt"></i>Order Detail
            </span>
        </div>
    </div>

    <div class="order-detail">
        <div class="heading">
            <h1>My Orders Detail</h1>
            <p>Get a detailed summary of your order and manange your order efficiently with ease.</p>
            <img src="../image/separator-img.png" alt="Separator Image">
        </div>
        <div class="box-container">
            <?php
            $grand_total = 0;
            $select_order = $conn->prepare("SELECT * FROM `orders` WHERE id = ?");
            $select_order->bind_param("s", $get_id);
            $select_order->execute();
            $result_order = $select_order->get_result();

            if ($result_order->num_rows > 0) {
                while ($fetch_order = $result_order->fetch_assoc()) {
                    $select_product = $conn->prepare("SELECT * FROM `products` WHERE id = ? LIMIT 1");
                    $select_product->bind_param("s", $fetch_order['product_id']);
                    $select_product->execute();
                    $result_product = $select_product->get_result();

                    if ($result_product->num_rows > 0) {
                        while ($fetch_product = $result_product->fetch_assoc()) {
                            $sub_total = $fetch_order['price'] * $fetch_order['qty'];
                            $grand_total += $sub_total;
                            ?>

                            <div class="box" <?php if ($fetch_order['status'] == 'canceled') {
                                echo 'style="border: 2px solid red;"';
                            } ?>>
                                <img src="../../../Admin/MVC/uploaded_files/<?= $fetch_product['image']; ?>" class="image">
                                <p class="date">
                                    <i class="bx bx-calendar-alt"></i>
                                    <?= $fetch_order['date']; ?>
                                </p>
                                <div class="content">
                                    <img src="../../../Admin/MVC/image/shape-19.png" class="shape">
                                    <div class="row">
                                        <h3 class="name">
                                            <?= $fetch_product['name']; ?> (x
                                            <?= $fetch_order['qty']; ?>)
                                        </h3>
                                        <p class="price">Price:
                                            <?= $fetch_product['price']; ?>/-
                                        </p>
                                        <p class="status" <?php
                                        if ($fetch_order['status'] == 'delivered') {
                                            echo 'style="color: orange;"';
                                        } elseif ($fetch_order['status'] == 'canceled') {
                                            echo 'style="color: red;"';
                                        } else {
                                            echo 'style="color: green;"';
                                        }
                                        ?>>
                                            <?= $fetch_order['status']; ?>
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <?php
                        }
                    }
                }
            } else {
                echo '<p class="empty">No orders have been placed yet!</p>';
            }
            ?>
        </div>
    </div>


    <div style="text-align:center; margin-bottom: 2rem;">
        <?php
        $check_status = $conn->prepare("SELECT status FROM `orders` WHERE id = ? LIMIT 1");
        $check_status->bind_param("s", $get_id);
        $check_status->execute();
        $status_result = $check_status->get_result();
        if ($status_result->num_rows > 0) {
            $s = $status_result->fetch_assoc()['status'];
            if ($s != 'canceled' && $s != 'delivered') {
                ?>
                <form action="" method="post">
                    <button type="submit" class="btn" name="cancel"
                        onclick="return confirm('Do you want to cancel this entire order?');">Cancel Order</button>
                </form>
                <?php
            }
        }
        ?>
    </div>

    <?php include '../html/Footer.php'; ?>

    <!-- custom js link -->
    <script src="../js/User_script.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>

    <?php include '../php/Alert.php'; ?>

</body>

</html>