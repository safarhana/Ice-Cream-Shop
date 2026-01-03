<?php
include '../db/Connect.php';

if (isset($_POST['submit'])) {

    $email = $_POST['email'];
    $email = filter_var($email, FILTER_SANITIZE_STRING);

    $pass = $_POST['pass'];
    $pass = filter_var($pass, FILTER_SANITIZE_STRING);

    $hashed_pass = sha1($pass);

    // check credentials
    $select_seller = $conn->prepare("SELECT * FROM `sellers` WHERE email = ? AND password = ?");
    $select_seller->bind_param("ss", $email, $hashed_pass);
    $select_seller->execute();
    $result_seller = $select_seller->get_result();
    $row = $result_seller->fetch_assoc();

    if ($result_seller->num_rows > 0) {
        setcookie('seller_id', $row['id'], time() + 60 * 60 * 24 * 30, '/');
        header('Location: Dashboard_view.php');
        exit();
    } else {
        $warning_msg[] = 'Incorrect email or password';
    }
}
?>