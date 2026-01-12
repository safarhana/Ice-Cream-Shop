<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: Login_view.php');
    exit();
}

$user_id = $_SESSION['user_id'];

include '../db/Connect.php';

include 'Add_cart_controller.php';



if (isset($_POST['delete_item'])) {
    $wishlist_id = $_POST['wishlist_id'];
    $wishlist_id = filter_var($wishlist_id, FILTER_SANITIZE_STRING);

    $verify_wishlist = $conn->prepare("SELECT * FROM `wishlist` WHERE id = ?");
    $verify_wishlist->bind_param("s", $wishlist_id);
    $verify_wishlist->execute();
    $result_verify_wishlist = $verify_wishlist->get_result();

    if ($result_verify_wishlist->num_rows > 0) {
        $delete_wishlist_id = $conn->prepare("DELETE FROM `wishlist` WHERE id = ?");
        $delete_wishlist_id->bind_param("s", $wishlist_id);
        $delete_wishlist_id->execute();
        $success_msg[] = "Wishlisted item deleted successfully";
    } else {
        $warning_msg[] = "Wishlisted item already deleted";
    }

}

?>