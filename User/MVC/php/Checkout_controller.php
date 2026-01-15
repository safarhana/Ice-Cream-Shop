<?php
session_start();
include '../db/Connect.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: Login_view.php');
    exit();
}

$user_id = $_SESSION['user_id'];

if (isset($_POST['place_order'])) {
    $name = $_POST['name'];
    $name = filter_var($name, FILTER_SANITIZE_STRING);

    $number = $_POST['number'];
    $number = filter_var($number, FILTER_SANITIZE_STRING);

    $email = $_POST['email'];
    $email = filter_var($email, FILTER_SANITIZE_EMAIL);

    $method = $_POST['method'];
    $method = filter_var($method, FILTER_SANITIZE_STRING);

    $address = $_POST['flat'] . ', ' . $_POST['street'] . ', ' . $_POST['city'] . ', ' . $_POST['country'] . ', ' . $_POST['pin'];
    $address = filter_var($address, FILTER_SANITIZE_STRING);

    $address_type = $_POST['address_type'];
    $address_type = filter_var($address_type, FILTER_SANITIZE_STRING);

    $method = $_POST['method'];
    $method = filter_var($method, FILTER_SANITIZE_STRING);

    $verify_cart = $conn->prepare("SELECT * FROM `cart` WHERE user_id = ?");
    $verify_cart->bind_param("s", $user_id);
    $verify_cart->execute();
    $result_cart = $verify_cart->get_result();

    if (isset($_GET['get_id'])) {
        $get_product = $conn->prepare("SELECT * FROM `products` WHERE id = ? LIMIT 1");
        $get_product->bind_param("s", $_GET['get_id']);
        $get_product->execute();
        $result_product = $get_product->get_result();
        if ($result_product->num_rows > 0) {
            while ($fetch_p = $result_product->fetch_assoc()) {
                $seller_id = $fetch_p['seller_id'];
                $id = unique_id();
                $qty = 1;
                $insert_order = $conn->prepare("INSERT INTO `orders`(id,user_id, seller_id, name, number, email, method, address, address_type, product_id, price,  qty) VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
                $insert_order->bind_param("ssssssssssss", $id, $user_id, $seller_id, $name, $number, $email, $method, $address, $address_type, $fetch_p['id'], $fetch_p['price'], $qty);
                $insert_order->execute();
            }
            header('Location: ../html/Orders_view.php');
        } else {
            $warning_msg[] = 'Something went wrong';
        }
    } elseif ($result_cart->num_rows > 0) {
        $id = unique_id();
        while ($fetch_cart = $result_cart->fetch_assoc()) {
            $s_product = $conn->prepare("SELECT * FROM `products` WHERE id = ? LIMIT 1");
            $s_product->bind_param("s", $fetch_cart['product_id']);
            $s_product->execute();
            $f_product = $s_product->get_result()->fetch_assoc();
            $seller_id = $f_product['seller_id'];

            $qty = $fetch_cart['qty'];
            $insert_order = $conn->prepare("INSERT INTO `orders`(id,user_id, seller_id, name, number, email, method, address, address_type, product_id, price,  qty) VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
            $insert_order->bind_param("ssssssssssss", $id, $user_id, $seller_id, $name, $number, $email, $method, $address, $address_type, $fetch_cart['product_id'], $fetch_cart['price'], $fetch_cart['qty']);
            $insert_order->execute();
        }

        if ($insert_order) {
            $delete_cart = $conn->prepare("DELETE FROM `cart` WHERE user_id = ?");
            $delete_cart->bind_param("s", $user_id);
            $delete_cart->execute();
            header('Location: ../html/Orders_view.php');
        } else {
            $warning_msg[] = 'Something went wrong';
        }


    } else {
        $warning_msg[] = 'Something went wrong';
    }

}
?>