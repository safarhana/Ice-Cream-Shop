<?php include '../php/Admin_order_detail_controller.php'; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Ice Cream Delights - Order Details</title>
    <link rel="stylesheet" type="text/css" href="../css/Admin_style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
    <link rel="stylesheet" href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css">
</head>

<body>
    <?php include 'Admin_header.php'; ?>
    <div class="main-container">
        <section class="order-container">
            <div class="heading">
                <h1>Order Details</h1>
                <img src="../image/separator-img.png">
                <p><a href="Admin_order_view.php" class="btn" style="margin-top: 1rem;">Back to Orders</a></p>
            </div>

            <div class="box-container">
                <?php
                $select_order = $conn->prepare("SELECT * FROM `orders` WHERE id = ? AND seller_id = ?");
                $select_order->bind_param("ss", $get_id, $seller_id);
                $select_order->execute();
                $result_order = $select_order->get_result();

                if ($result_order->num_rows > 0) {
                    while ($fetch_order = $result_order->fetch_assoc()) {
                        ?>
                        <div class="box">
                            <div class="status"
                                style="color: <?php echo ($fetch_order['status'] == 'in progress' || $fetch_order['status'] == 'delivered') ? 'limegreen' : 'red'; ?>;">
                                <?= $fetch_order['status']; ?>
                            </div>

                            <div class="details">
                                <p>Product Name: <span>
                                        <?= $fetch_order['name']; ?>
                                    </span></p>
                               
                                <?php
                                // Fetch product details for image and name
                                $select_product = $conn->prepare("SELECT * FROM `products` WHERE id = ?");
                                $select_product->bind_param("s", $fetch_order['product_id']);
                                $select_product->execute();
                                $fetch_product = $select_product->get_result()->fetch_assoc();
                                ?>
                                <div style="text-align: center; margin-bottom: 1rem;">
                                    <img src="../uploaded_files/<?= $fetch_product['image']; ?>" class="image"
                                        style="height: 100px; width: 100px; object-fit: cover;">
                                    <p style="font-weight: bold;">
                                        <?= $fetch_product['name']; ?> (x
                                        <?= $fetch_order['qty']; ?>)
                                    </p>
                                </div>

                                <p>User Name: <span>
                                        <?= $fetch_order['name']; ?>
                                    </span></p>
                                <p>User Id: <span>
                                        <?= $fetch_order['user_id']; ?>
                                    </span></p>
                                <p>Placed On: <span>
                                        <?= $fetch_order['date']; ?>
                                    </span></p>
                                <p>User Number: <span>
                                        <?= $fetch_order['number']; ?>
                                    </span></p>
                                <p>User Email: <span>
                                        <?= $fetch_order['email']; ?>
                                    </span></p>
                                <p>Item Price: <span>
                                        <?= $fetch_order['price']; ?>
                                    </span></p>
                                <p>Total Price: <span>
                                        <?= $fetch_order['price'] * $fetch_order['qty']; ?>
                                    </span></p>
                                <p>Payment Method: <span>
                                        <?= $fetch_order['method']; ?>
                                    </span></p>
                                <p>User Address: <span>
                                        <?= $fetch_order['address']; ?>
                                    </span></p>

                                <form action="" method="post">
                                    <input type="hidden" name="order_id" value="<?= $fetch_order['id']; ?>">
                                   
                                    <select name="update_payment" class="box"
                                        style="width: 100%; margin: 1rem 0; border: 1px solid #ccc;">
                                        <option disabled selected>
                                            <?= $fetch_order['payment_status']; ?>
                                        </option>
                                        <option value="pending">pending</option>
                                        <option value="order delivered">Order Delivered</option>
                                    </select>
                                    <div class="flex-btn">
                                        <button type="submit" name="update_order" class="btn">Update Order</button>
                                        <button type="submit" name="delete_order" class="btn"
                                            onclick="return confirm('Delete this order?');">Delete Order</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <?php
                    }
                } else {
                    echo '<div class="empty"><p>No details found for this order</p></div>';
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