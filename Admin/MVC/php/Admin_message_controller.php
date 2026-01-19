<?php
include '../db/Connect.php';

if (isset($_COOKIE['seller_id'])) {
    $seller_id = $_COOKIE['seller_id'];
} else {
    $seller_id = '';
    header('Location: Login_view.php');
    exit();
}

// delete message from the db
if (isset($_POST['delete_msg'])) {
    $delete_id = $_POST['delete_id'];
    $delete_id = filter_var($delete_id, FILTER_SANITIZE_STRING);

    $verify_delete = $conn->prepare("SELECT * FROM `message` WHERE id = ?");
    $verify_delete->bind_param("s", $delete_id);
    $verify_delete->execute();
    $verify_delete->store_result();

    if ($verify_delete->num_rows > 0) {
        $delete_msg = $conn->prepare("DELETE FROM `message` WHERE id = ?");
        $delete_msg->bind_param("s", $delete_id);
        $delete_msg->execute();
        $success_msg[] = 'Message deleted successfully';
    } else {
        $warning_msg[] = 'Message already deleted or not found';
    }
}
?>