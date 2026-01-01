


<?php
include 'Connect.php';


setcookie('seller_id', '', time() -1, '/');


header('Location: ../admin panel/Login.php');
exit();
?>