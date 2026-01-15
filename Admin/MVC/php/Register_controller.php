<?php
include '../db/Connect.php';

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
    $select_seller = $conn->prepare("SELECT * FROM `sellers` WHERE email = ?");
    $select_seller->bind_param("s", $email);
    $select_seller->execute();
    $select_seller->store_result();

    $select_seller_name = $conn->prepare("SELECT * FROM `sellers` WHERE name = ?");
    $select_seller_name->bind_param("s", $name);
    $select_seller_name->execute();
    $select_seller_name->store_result();

    if ($select_seller->num_rows > 0) {
        $warning_msg[] = 'Email already exists';
    } elseif ($select_seller_name->num_rows > 0) {
        $warning_msg[] = 'Username already exists';
    } else {

        if ($pass !== $cpass) {
            $warning_msg[] = 'Confirm password does not match!';
        } else {
            $hashed_pass = sha1($pass);

            // insert new seller
            $insert_seller = $conn->prepare("INSERT INTO `sellers` (id, name, email, password, image) VALUES (?, ?, ?, ?, ?)");
            $insert_seller->bind_param("sssss", $id, $name, $email, $hashed_pass, $rename);

            if ($insert_seller->execute()) {
                move_uploaded_file($image_tmp_name, $image_folder);
                $success_msg[] = 'Registered successfully!';
            } else {
                $error_msg[] = 'Registration failed';
            }
        }
    }

} // end of submit
?>