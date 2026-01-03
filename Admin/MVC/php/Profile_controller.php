<?php
include '../db/Connect.php';

if (isset($_COOKIE['seller_id'])) {
    $seller_id = $_COOKIE['seller_id'];
} else {
    $seller_id = '';
    header('Location: Login_view.php');
    exit();
}

$select_products = $conn->prepare("SELECT * FROM `products` WHERE  seller_id = ?");
$select_products->bind_param("s", $seller_id);
$select_products->execute();
$select_products->store_result();
$total_products = $select_products->num_rows;

$select_orders = $conn->prepare("SELECT * FROM `orders` WHERE  seller_id = ?");
$select_orders->bind_param("s", $seller_id);
$select_orders->execute();
$select_orders->store_result();
$total_orders = $select_orders->num_rows;
?>