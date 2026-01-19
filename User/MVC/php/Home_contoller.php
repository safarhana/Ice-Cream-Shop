<?php
include '../db/Connect.php';


session_start();

if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];

} else {
    $user_id = '';
}




if (isset($_POST['submit'])) {

    $email = $_POST['email'];
    $email = filter_var($email, FILTER_SANITIZE_STRING);

    $pass = $_POST['pass'];
    $pass = filter_var($pass, FILTER_SANITIZE_STRING);

    $hashed_pass = sha1($pass);

    // check credentials
    $select_user = $conn->prepare("SELECT * FROM `users` WHERE email = ? AND password = ?");
    $select_user->bind_param("ss", $email, $hashed_pass);
    $select_user->execute();
    $result = $select_user->get_result();

    $row = $result->fetch_assoc();

    if ($result->num_rows > 0) {
        setcookie('user', $row['user_id'], time() + 60 * 60 * 24 * 30, '/');
        header('Location: Home.php');
        exit();
    } else {
        $warning_msg[] = 'Incorrect email or password';
    }
}
?>