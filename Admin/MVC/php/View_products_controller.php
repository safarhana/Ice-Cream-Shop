<?php
include '../db/Connect.php';

if (isset($_COOKIE['seller_id'])) {
    $seller_id = $_COOKIE['seller_id'];
} else {
    $seller_id = '';
    header('Location: Login_view.php');
    exit();
}

// Delete product 
if (isset($_POST['delete'])) {
    $p_id = $_POST['product_id'];
    $p_id = filter_var($p_id, FILTER_SANITIZE_STRING);

    $select_product = $conn->prepare("SELECT * FROM `products` WHERE id = ? AND seller_id = ?");
    $select_product->bind_param("ss", $p_id, $seller_id);
    $select_product->execute();
    $result_product = $select_product->get_result();
    $fetch_product = $result_product->fetch_assoc();

    if ($result_product->num_rows > 0) {
        if (!empty($fetch_product['image']) && file_exists('../uploaded_files/' . $fetch_product['image'])) {
            unlink('../uploaded_files/' . $fetch_product['image']);
        }

        $delete_product = $conn->prepare("DELETE FROM `products` WHERE id = ? AND seller_id = ?");
        $delete_product->bind_param("ss", $p_id, $seller_id);
        $delete_product->execute();
        $success_msg[] = "Product deleted successfully!";
    } else {
        $warning_msg[] = "Product not found or unauthorized action!";
    }
}
?>