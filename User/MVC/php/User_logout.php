<?php
include '../db/Connect.php';

session_start();
session_unset();
session_destroy();

setcookie('user_id', '', time() - 3600, '/');

header('Location: ../html/Login_view.php');
exit();
?>