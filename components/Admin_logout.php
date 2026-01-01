<?php
include 'Connect.php';
session_start();
$_SESSION = array();
session_destroy();
setcookie('seller_id', '', time() - 3600, '/');
header('Location: ../admin panel/Login.php');
exit();
?>