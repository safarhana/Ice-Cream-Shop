<?php
session_start();
include '../db/Connect.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: Login_view.php');
    exit();
}

$user_id = $_SESSION['user_id'];


$select_orders = $conn->prepare("SELECT * FROM `orders` WHERE  user_id = ?");
$select_orders->bind_param("s", $user_id);
$select_orders->execute();
$select_orders->store_result();
$total_orders = $select_orders->num_rows;

$select_message = $conn->prepare("SELECT * FROM `message` WHERE  user_id = ?");
$select_message->bind_param("s", $user_id);
$select_message->execute();
$select_message->store_result();
$total_message = $select_message->num_rows;
?>