<?php
include '../db/Connect.php';

// Check if seller is logged in
if (isset($_COOKIE['seller_id'])) {
    $seller_id = $_COOKIE['seller_id'];
} else {
    header('Location: Login_view.php');
    exit();
}
?>