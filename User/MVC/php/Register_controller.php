<?php
include '../db/Connect.php';

if (isset($_COOKIE['user_id'])) {
    $user_id = $_COOKIE['user_id'];
} else {
    $user_id = '';
}

if (isset($_POST['submit'])) {

    $id = unique_id();

    $name = $_POST['name'];
    $name = filter_var($name, FILTER_SANITIZE_STRING);

    $email = $_POST['email'];
    $email = filter_var($email, FILTER_SANITIZE_STRING);

    $pass = $_POST['pass'];
    $pass = filter_var($pass, FILTER_SANITIZE_STRING);

    $cpass = $_POST['cpass'];
    $cpass = filter_var($cpass, FILTER_SANITIZE_STRING);

    $image = $_FILES['image']['name'];
    $image = filter_var($image, FILTER_SANITIZE_STRING);

    $ext = pathinfo($image, PATHINFO_EXTENSION);
    $rename = unique_id() . '.' . $ext;

    $image_size = $_FILES['image']['size'];
    $image_tmp_name = $_FILES['image']['tmp_name'];
    $image_folder = '../uploaded_files/' . $rename;

    // check if the seller already exists
    $select_users = $conn->prepare("SELECT * FROM `users` WHERE email = ?");
    $select_users->bind_param("s", $email);
    $select_users->execute();
    $select_users->store_result();

    if ($select_users->num_rows > 0) {
        $warning_msg[] = 'Email already exists';
    } else {


        $hashed_pass = sha1($pass);

        // insert new seller
        $insert_user = $conn->prepare("INSERT INTO `users` (user_id, name, email, password, image) VALUES (?, ?, ?, ?, ?)");
        $insert_user->bind_param("sssss", $id, $name, $email, $hashed_pass, $rename);

        if ($insert_user->execute()) {
            move_uploaded_file($image_tmp_name, $image_folder);
            $success_msg[] = 'Registered successfully!';
        } else {
            $error_msg[] = 'Registration failed';
        }

    }

}
?>