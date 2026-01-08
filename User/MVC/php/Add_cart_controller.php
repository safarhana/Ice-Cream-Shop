<?php
if (isset($_POST['add_to_cart'])) {
    if ($user_id != '') {
        $id = unique_id();
        $product_id = $_POST['product_id'];
        $qty = $_POST['qty'];
        $qty = filter_var($qty, FILTER_SANITIZE_STRING);

        $verify_cart = $conn->prepare("SELECT * FROM `wishlist` WHERE user_id = ? AND product_id = ?");
        $verify_cart->bind_param("ii", $user_id, $product_id);
        $verify_cart->execute();
        $result_cart = $verify_cart->get_result();

        $max_cart_items = $conn->prepare("SELECT * FROM `cart` WHERE user_id = ? AND product_id = ?");
        $max_cart_items->bind_param("ii", $user_id, $product_id);
        $max_cart_items->execute();
        $result_max_cart_items = $max_cart_items->get_result();

        if ($result_cart->num_rows > 0) {

            $warning_msg[] = 'Product already added to wishlist!';

        } elseif ($result_max_cart_items->num_rows > 20) {
            $warning_msg[] = 'Your cart is full';
        } elseif ($user_id != '') {
            $select_price = $conn->prepare("SELECT * FROM `products` WHERE id = ? LIMIT 1");
            $select_price->bind_param("i", $product_id);
            $select_price->execute();
            $fetch_price = $select_price->get_result()->fetch_assoc();

            $insert_cart = $conn->prepare("INSERT INTO `cart` (id, user_id, product_id, price, qty) VALUES (?, ?, ?, ?, ?)");
            $insert_cart->bind_param("ssssss", $id, $user_id, $product_id, $fetch_price['price'], $qty);
            $insert_cart->execute();
            $success_msg[] = 'Product added to cart!';
        }
    } else {
        $warning_msg[] = 'Please login first!';
    }
}
?>