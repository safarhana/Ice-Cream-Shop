<?php
include '../db/Connect.php';

if (isset($_COOKIE['seller_id'])) {
    $seller_id = $_COOKIE['seller_id'];
} else {
    $seller_id = '';
    header('Location: Login_view.php');
    exit();
}

?>