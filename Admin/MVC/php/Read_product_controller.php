<?php
include '../db/Connect.php';

if (isset($_COOKIE['seller_id'])) {
    $seller_id = $_COOKIE['seller_id'];
} else {
    $seller_id = '';
    header('Location: Login_view.php');
    exit();
}
$get_id = $_GET['post_id'];

// Delete product 
if (isset($_POST['delete'])) {
    $p_id = $_POST['product_id'];
    $p_id = filter_var($p_id, FILTER_SANITIZE_STRING);

    // Fixed logic: SELECT image first, then DELETE
    $select_image = $conn->prepare("SELECT * FROM `products` WHERE id = ? AND seller_id = ?");
    $select_image->bind_param("ss", $p_id, $seller_id);
    $select_image->execute();
    $result_image = $select_image->get_result();
    $fetch_delete_image = $result_image->fetch_assoc();

    if ($fetch_delete_image && !empty($fetch_delete_image['image'])) {
        unlink('../uploaded_files/' . $fetch_delete_image['image']);
    }

    $delete_product = $conn->prepare("DELETE FROM `products` WHERE id = ? AND seller_id = ?");
    $delete_product->bind_param("ss", $p_id, $seller_id);
    $delete_product->execute();

    header('Location:View_products_view.php');
}
?>