<?php
include '../db/Connect.php';

if (isset($_COOKIE['user_id'])) {
    $user_id = $_COOKIE['user_id'];
} else {
    $user_id = '';
}

include '../php/Add_wishlist.php';
include '../php/Add_cart.php';
?>