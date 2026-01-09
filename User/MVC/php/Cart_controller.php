<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: Login_view.php');
    exit();
}

$user_id = $_SESSION['user_id'];

if (isset($_POST['update_cart'])) {
    $cart_id = $_POST['cart_id'];
    $cart_id = filter_var($cart_id, FILTER_SANITIZE_STRING);
    $qty = $_POST['qty'];
    $qty = filter_var($qty, FILTER_SANITIZE_STRING);

    $update_cart = $conn->prepare("UPDATE `cart` SET qty = ? WHERE id = ?");
    $update_cart->bind_param("ss", $qty, $cart_id);
    $update_cart->execute();
    $success_msg[] = "Cart quantity updated successfully";
}

if (isset($_POST['delete_item'])) {
    $cart_id = $_POST['cart_id'];
    $cart_id = filter_var($cart_id, FILTER_SANITIZE_STRING);

    $verify_cart = $conn->prepare("SELECT * FROM `cart` WHERE id = ?");
    $verify_cart->bind_param("s", $cart_id);
    $verify_cart->execute();
    $result_verify_cart = $verify_cart->get_result();

    if ($result_verify_cart->num_rows > 0) {
        $delete_card_id = $conn->prepare("DELETE FROM `cart` WHERE id = ?");
        $delete_card_id->bind_param("s", $cart_id);
        $delete_card_id->execute();
        $success_msg[] = "Cart item deleted successfully";
    } else {
        $warning_msg[] = "Cart item already deleted";
    }

}

if (isset($_POST['empty_cart'])) {


    $verify_empty_cart = $conn->prepare("SELECT * FROM `cart` WHERE user_id = ?");
    $verify_empty_cart->bind_param("s", $user_id);
    $verify_empty_cart->execute();
    $result_verify_empty_cart = $verify_empty_cart->get_result();

    if ($result_verify_empty_cart->num_rows > 0) {
        $delete_card_id = $conn->prepare("DELETE FROM `cart` WHERE user_id = ?");
        $delete_card_id->bind_param("s", $user_id);
        $delete_card_id->execute();
        $success_msg[] = "Cart items emptied successfully";
    } else {
        $warning_msg[] = "Cart items already emptied";
    }
}


?>