<?php
if (isset($_POST['add_to_wishlist'])) {
    if ($user_id != '') {
        $id = unique_id();
        $product_id = $_POST['product_id'];


        $verify_wishlist = $conn->prepare("SELECT * FROM `wishlist` WHERE user_id = ? AND product_id = ?");
        $verify_wishlist->bind_param("ss", $user_id, $product_id);
        $verify_wishlist->execute();
        $result_wishlist = $verify_wishlist->get_result();

        $cart_num = $conn->prepare("SELECT * FROM `cart` WHERE user_id = ? AND product_id = ?");
        $cart_num->bind_param("ss", $user_id, $product_id);
        $cart_num->execute();
        $result_cart_num = $cart_num->get_result();

        if ($result_wishlist->num_rows > 0) {

            $warning_msg[] = 'Product already added to wishlist!';

        } elseif ($result_cart_num->num_rows > 0) {
            $warning_msg[] = 'Product already exists in your cart';
        } elseif ($user_id != '') {
            $select_price = $conn->prepare("SELECT * FROM `products` WHERE id = ? LIMIT 1");
            $select_price->bind_param("i", $product_id);
            $select_price->execute();
            $fetch_price = $select_price->get_result()->fetch_assoc();

            $insert_wishlist = $conn->prepare("INSERT INTO `wishlist` (id, user_id, product_id, price) VALUES (?, ?, ?, ?)");
            $insert_wishlist->bind_param("ssss", $id, $user_id, $product_id, $fetch_price['price']);
            $insert_wishlist->execute();
            $success_msg[] = 'Product added to wishlist!';
        }
    } else {
        $warning_msg[] = 'Please login first!';
    }
}
?>