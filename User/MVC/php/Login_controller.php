<?php
session_start();
include '../db/Connect.php';

if (isset($_POST['submit'])) {

    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $pass = filter_var($_POST['pass'], FILTER_SANITIZE_STRING);

    $hashed_pass = sha1($pass);

    $select_user = $conn->prepare(
        "SELECT user_id FROM users WHERE email = ? AND password = ?"
    );
    $select_user->bind_param("ss", $email, $hashed_pass);
    $select_user->execute();
    $result = $select_user->get_result();

    if ($row = $result->fetch_assoc()) {

        // ✅ SET SESSION
        $_SESSION['user_id'] = $row['user_id'];

        // optional (useful later)
        $_SESSION['login_time'] = time();

        header('Location: Home_view.php');
        exit();
    } else {
        $warning_msg[] = 'Incorrect email or password';
    }
}
