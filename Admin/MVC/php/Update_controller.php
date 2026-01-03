<?php
include '../db/Connect.php';


if (isset($_COOKIE['seller_id'])) {
    $seller_id = $_COOKIE['seller_id'];
} else {
    $seller_id = '';
    header('Location: Login_view.php');
    exit();
}

if (isset($_POST['submit'])) {
    $select_seller = $conn->prepare("SELECT * FROM `sellers` WHERE id = ? LIMIT 1");
    $select_seller->bind_param("s", $seller_id);
    $select_seller->execute();
    $result_seller = $select_seller->get_result();
    $fetch_seller = $result_seller->fetch_assoc();


    $prev_pass = $fetch_seller['password'];
    $prev_image = $fetch_seller['image'];

    $name = $_POST['name'];
    $name = filter_var($name, FILTER_SANITIZE_STRING);

    $email = $_POST['email'];
    $email = filter_var($email, FILTER_SANITIZE_STRING);

    // update name
    if (!empty($name)) {
        $update_name = $conn->prepare("UPDATE `sellers` SET name = ? WHERE id = ?");
        $update_name->bind_param("ss", $name, $seller_id);
        $update_name->execute();
        $success_msg[] = 'Name updated successfully';
    }

    // update email
    if (!empty($email)) {
        $select_email = $conn->prepare("SELECT * FROM `sellers` WHERE id != ? AND email = ?");
        $select_email->bind_param("ss", $seller_id, $email);
        $select_email->execute();
        $select_email->store_result();

        if ($select_email->num_rows > 0) {
            $warning_msg[] = 'Email already exists';
        } else {
            $update_email = $conn->prepare("UPDATE `sellers` SET email = ? WHERE id = ?");
            $update_email->bind_param("ss", $email, $seller_id);
            $update_email->execute();
            $success_msg[] = 'Email updated successfully';
        }
    }

    //update image
    $image = $_FILES['image']['name'];
    $image = filter_var($image, FILTER_SANITIZE_STRING);
    $ext = pathinfo($image, PATHINFO_EXTENSION);
    $rename = unique_id() . '.' . $ext;
    $image_size = $_FILES['image']['size'];
    $image_tmp_name = $_FILES['image']['tmp_name'];
    $image_folder = '../uploaded_files/' . $rename;

    if (!empty($image)) {
        if ($image_size > 2000000) {
            $warning_msg[] = 'Image size is too large';
        } else {
            $update_email = $conn->prepare("UPDATE `sellers` SET image = ? WHERE id = ?");
            $update_email->bind_param("ss", $rename, $seller_id);
            $update_email->execute();
            move_uploaded_file($image_tmp_name, $image_folder);

            if ($prev_image != '' && $prev_image != $rename) {
                unlink('../uploaded_files/' . $prev_image);
            }

            $success_msg[] = 'Image updated successfully';
        }
    }

    //update password
    $empty_pass = 'da39a3ee5e6b4b0d3255bfef95601890afd80709';
    $old_pass = sha1($_POST['old_pass']);
    $old_pass = filter_var($old_pass, FILTER_SANITIZE_STRING);

    $new_pass = sha1($_POST['new_pass']);
    $new_pass = filter_var($new_pass, FILTER_SANITIZE_STRING);

    $cpass = sha1($_POST['cpass']);
    $cpass = filter_var($cpass, FILTER_SANITIZE_STRING);

    if ($old_pass != $empty_pass) {
        if ($old_pass != $prev_pass) {
            $warning_msg[] = 'Old password not matched';
        } elseif ($new_pass != $cpass) {
            $warning_msg[] = 'Passwords do not match';
        } else {
            if ($new_pass != $empty_pass) {
                $update_pass = $conn->prepare("UPDATE `sellers` SET password = ? WHERE id = ?");
                $update_pass->bind_param("ss", $cpass, $seller_id);
                $update_pass->execute();
                $success_msg[] = 'Password updated successfully';
            } else {
                $warning_msg[] = 'Please enter a new password';
            }
        }
    }
}
?>