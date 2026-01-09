<?php
include '../db/Connect.php';

session_start();

if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];

} else {
    $user_id = '';
}

include '../php/Add_wishlist_controller.php';
include '../php/Add_cart_controller.php';
?>