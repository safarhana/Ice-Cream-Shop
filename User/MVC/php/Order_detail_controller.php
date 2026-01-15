<?php
include '../db/Connect.php';

session_start();
include '../db/Connect.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: Login_view.php');
    exit();
}

$user_id = $_SESSION['user_id'];

if (isset($_GET['get_id'])) {
    $get_id = $_GET['get_id'];
} else {
    $get_id = '';
    header('location:Orders_view.php');
}

if (isset($_POST['cancel'])) {
    $status = 'canceled';
    $update_order = $conn->prepare("UPDATE `orders` SET status = ? WHERE id = ?");
    $update_order->bind_param("ss", $status, $get_id);
    $update_order->execute();
    header('location:Orders_view.php');
    exit();
}
?>