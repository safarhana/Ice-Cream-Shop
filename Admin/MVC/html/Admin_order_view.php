<?php include '../php/Admin_order_controller.php'; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Ice Cream Delights - Orders Page</title>
    <link rel="stylesheet" type="text/css" href="../css/Admin_style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
    <link rel="stylesheet" href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css">
</head>

<body>
    <?php include 'Admin_header.php'; ?>
    <div class="main-container">


        <section class="order-container">
            <div class="heading">
                <h1>Total order placed</h1>
                <img src="../image/separator-img.png">
            </div>

            <div class="box-container">
                <?php
                // Select unique order IDs for this seller
                $select_order = $conn->prepare("SELECT DISTINCT id FROM `orders` WHERE seller_id = ? ORDER BY date DESC");
                $select_order->bind_param("s", $seller_id);
                $select_order->execute();
                $result_order = $select_order->get_result();

                if ($result_order->num_rows > 0) {
                    while ($fetch_order_id = $result_order->fetch_assoc()) {

                        $order_id = $fetch_order_id['id'];

                        // Fetch one row to get general order details (User info, Date, etc.)
                        $order_details_query = $conn->prepare("SELECT * FROM `orders` WHERE id = ? LIMIT 1");
                        $order_details_query->bind_param("s", $order_id);
                        $order_details_query->execute();
                        $fetch_order = $order_details_query->get_result()->fetch_assoc();

                        // Calculate totals for this order
                        $count_items = $conn->prepare("SELECT COUNT(*) as total_items, SUM(qty*price) as total_price FROM `orders` WHERE id = ?");
                        $count_items->bind_param("s", $order_id);
                        $count_items->execute();
                        $count_result = $count_items->get_result()->fetch_assoc();
                        $total_items = $count_result['total_items'];
                        $total_price = $count_result['total_price'];
                        ?>
                        <div class="box">
                            <div class="status"
                                style="color: <?php echo ($fetch_order['status'] == 'in progress' || $fetch_order['status'] == 'delivered') ? 'limegreen' : 'red'; ?>;">
                                <?= $fetch_order['status']; ?>
                            </div>

                            <div class="details">
                                <p>User Name: <span><?= $fetch_order['name']; ?></span></p>
                                <p>User Id: <span><?= $fetch_order['user_id']; ?></span></p>
                                <p>Placed On: <span><?= $fetch_order['date']; ?></span></p>
                                <p>User Number: <span><?= $fetch_order['number']; ?></span></p>
                                <p>Total Price: <span><?= $total_price; ?>/-</span></p>
                                <p>Total Items: <span><?= $total_items; ?></span></p>

                                <form action="" method="post">
                                    <input type="hidden" name="order_id" value="<?= $fetch_order['id']; ?>">
                                    <div class="flex-btn">
                                        <a href="Admin_order_detail_view.php?get_id=<?= $fetch_order['id']; ?>" class="btn"
                                            style="width:100%; text-align:center;">View Details</a>
                                    </div>
                                    <div class="flex-btn" style="margin-top: 1rem;">
                                        <button type="submit" name="delete_order" class="btn"
                                            onclick="return confirm('Delete this entire order?');" style="width:100%;">Delete
                                            Order</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <?php
                    }
                } else {
                    echo '<div class="empty"><p>No order placed yet</p></div>';
                }
                ?>
            </div>
        </section>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
    <?php include 'Alert.php'; ?>
    <script src="../js/Admin_script.js"></script>

</body>

</html>