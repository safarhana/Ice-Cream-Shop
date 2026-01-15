<?php
session_start();
include '../db/Connect.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: Login_view.php');
    exit();
}

$user_id = $_SESSION['user_id'];

if (isset($_POST['send_message'])) {

    if ($user_id != '') {

        $id = unique_id();

        $name = filter_var($_POST['name'], FILTER_SANITIZE_STRING);
        $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
        $subject = filter_var($_POST['subject'], FILTER_SANITIZE_STRING);
        $message = filter_var($_POST['message'], FILTER_SANITIZE_STRING);

        if (!empty($name) && !empty($email) && !empty($subject) && !empty($message)) {

            $verify_message = $conn->prepare("SELECT * FROM `message` WHERE user_id = ? AND name = ? AND email = ? AND subject = ? AND message = ?");
            $verify_message->bind_param("sssss", $user_id, $name, $email, $subject, $message);
            $verify_message->execute();
            $verify_message->store_result();

            if ($verify_message->num_rows > 0) {
                $warning_msg[] = 'Message already exists!';
            } else {
                $insert_message = $conn->prepare("INSERT INTO `message` (id, user_id, name, email, subject, message) VALUES (?,?,?,?,?,?)");
                $insert_message->bind_param("ssssss", $id, $user_id, $name, $email, $subject, $message);
                $insert_message->execute();
                $success_msg[] = 'Message sent successfully!';
            }

        } else {
            $warning_msg[] = 'All fields are required!';
        }

    } else {
        $warning_msg[] = 'Please login first!';
    }
}
?>