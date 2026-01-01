<?php
include '../components/Connect.php';

if (isset($_COOKIE['seller_id'])) {
    $seller_id = $_COOKIE['seller_id'];
} else {
    $seller_id = '';
    header('Location: Login.php');
    exit();
}

// Update order payment status
if(isset($_POST['update_order'])) {
    $order_id = $_POST['order_id'];
    $order_id = filter_var($order_id, FILTER_SANITIZE_STRING);
    $update_payment = $_POST['update_payment'];
    $update_pay = $conn->prepare("UPDATE `orders` SET payment_status = ? WHERE id = ?");
    $update_pay->execute([$update_payment, $order_id]);
    $success_msg[] = 'Order payment status updated';
}

// Delete order
if(isset($_POST['delete_order'])) {
    $delete_id = $_POST['order_id']; 
    $delete_id = filter_var($delete_id, FILTER_SANITIZE_STRING);

    $verify_delete = $conn->prepare("SELECT * FROM `orders` WHERE id = ?");
    $verify_delete->execute([$delete_id]);

    if ($verify_delete->rowCount() > 0) {
        $delete_order = $conn->prepare("DELETE FROM `orders` WHERE id = ?");
        $delete_order->execute([$delete_id]);
        $success_msg[] = 'Order deleted';
    } else { 
        $warning_msg[] = 'Order already deleted';
    }
}
?>

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

    <div class="main-container">
        <?php include '../components/Admin_header.php'; ?>

        <section class="order-container">
            <div class="heading">
                <h1>Total order placed</h1>
                <img src="../image/separator-img.png">
            </div>

            <div class="box-container">
                <?php
                $select_order = $conn->prepare("SELECT * FROM `orders` WHERE seller_id = ?");
                $select_order->execute([$seller_id]);

                if ($select_order->rowCount() > 0) {
                    while($fetch_order = $select_order->fetch(PDO::FETCH_ASSOC)){ 
                ?>
                <div class="box">
                    <div class="status" style="color: <?php echo ($fetch_order['status'] == 'in progress') ? 'limegreen' : 'red'; ?>;">
                        <?= $fetch_order['status']; ?>
                    </div>

                    <div class="details">
                        <p>User Name: <span> <?= $fetch_order['name']; ?></span></p>
                        <p>User Id: <span> <?= $fetch_order['user_id']; ?></span></p>
                        <p>Placed On: <span> <?= $fetch_order['date']; ?></span></p>
                        <p>User Number: <span> <?= $fetch_order['number']; ?></span></p>
                        <p>User Email: <span> <?= $fetch_order['email']; ?></span></p>
                        <p>Total Price: <span> <?= $fetch_order['price']; ?></span></p>
                        <p>Payment Method: <span> <?= $fetch_order['method']; ?></span></p>
                        <p>User Address: <span> <?= $fetch_order['address']; ?></span></p>
                        
                        <form action="" method="post">
                            <input type="hidden" name="order_id" value="<?= $fetch_order['id']; ?>">
                            <select name="update_payment" class="box" style="width: 100%; margin: 1rem 0; border: 1px solid #ccc;">
                                <option disabled selected><?= $fetch_order['payment_status']; ?></option>
                                <option value="pending">pending</option>
                                <option value="order delivered">Order Delivered</option>
                            </select>
                            <div class="flex-btn">
                                <input type="submit" name="update_order" value="Update Payment" class="btn">
                                <input type="submit" name="delete_order" value="Delete Order" class="btn" onclick="return confirm('Delete this order?');">
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

</body>
</html>