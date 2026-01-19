<?php
include '../db/Connect.php';
session_start();
$_SESSION = array();
session_destroy();
setcookie('seller_id', '', time() - 3600, '/');
header('Location: ../html/Login_view.php');
exit();
?>