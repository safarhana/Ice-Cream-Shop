<?php
include '../db/Connect.php';

if (isset($_COOKIE['seller_id'])) {
    $seller_id = $_COOKIE['seller_id'];
} else {
    $seller_id = '';
    header('Location: Login_view.php');
    exit();
}

// Update order payment status
if (isset($_POST['update_order'])) {
    $order_id = $_POST['order_id'];
    $order_id = filter_var($order_id, FILTER_SANITIZE_STRING);
    $update_payment = $_POST['update_payment'];

    $status = 'in progress';
    if ($update_payment == 'order delivered') {
        $status = 'delivered';
    }

    $update_pay = $conn->prepare("UPDATE `orders` SET payment_status = ?, status = ? WHERE id = ?");
    $update_pay->bind_param("sss", $update_payment, $status, $order_id);
    
    $update_pay->execute();
    $success_msg[] = 'Order payment status updated';
}

// Delete order
if (isset($_POST['delete_order'])) {
    $delete_id = $_POST['order_id'];
    $delete_id = filter_var($delete_id, FILTER_SANITIZE_STRING);

    $verify_delete = $conn->prepare("SELECT * FROM `orders` WHERE id = ?");
    $verify_delete->bind_param("s", $delete_id);
    $verify_delete->execute();
    $verify_delete->store_result();

    if ($verify_delete->num_rows > 0) {
        $delete_order = $conn->prepare("DELETE FROM `orders` WHERE id = ?");
        $delete_order->bind_param("s", $delete_id);
        $delete_order->execute();
        $success_msg[] = 'Order deleted';
    } else {
        $warning_msg[] = 'Order already deleted';
    }
}
?>