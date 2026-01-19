<?php
include '../db/Connect.php';

if (isset($_COOKIE['seller_id'])) {
    $seller_id = $_COOKIE['seller_id'];
} else {
    $seller_id = '';
    header('Location: Login.php');
    exit();
}

if (isset($_POST['product_id'])) {
    $product_id = $_POST['product_id'];
} elseif (isset($_GET['id'])) {
    $product_id = $_GET['id'];
} else {
    $product_id = '';
}

// EDIT PRODUCT
if (isset($_POST['update'])) {
    $name = filter_var($_POST['name'], FILTER_SANITIZE_STRING);
    $price = filter_var($_POST['price'], FILTER_SANITIZE_STRING);
    $description = filter_var($_POST['description'], FILTER_SANITIZE_STRING);
    $stock = filter_var($_POST['stock'], FILTER_SANITIZE_STRING);
    $status = filter_var($_POST['status'], FILTER_SANITIZE_STRING);

    $update_product = $conn->prepare("UPDATE `products` SET name =?, price =?, product_detail = ?, stock =?, status =? WHERE id = ?");
    $update_product->bind_param("ssssss", $name, $price, $description, $stock, $status, $product_id);
    $update_product->execute();
    $success_msg[] = 'Product updated successfully';

    $old_image = $_POST['old_image'];
    $image = $_FILES['image']['name'];
    $image = filter_var($image, FILTER_SANITIZE_STRING);
    $image_size = $_FILES['image']['size'];
    $image_tmp_name = $_FILES['image']['tmp_name'];
    $image_folder = '../uploaded_files/' . $image;

    if (!empty($image)) {
        if ($image_size > 2000000) {
            $warning_msg[] = "Image size is too large";
        } else {
            $update_image = $conn->prepare("UPDATE `products` SET image = ? WHERE id = ?");
            $update_image->bind_param("ss", $image, $product_id);
            $update_image->execute();
            move_uploaded_file($image_tmp_name, $image_folder);

            if ($old_image != $image && !empty($old_image)) {
                if (file_exists('../uploaded_files/' . $old_image)) {
                    unlink('../uploaded_files/' . $old_image);
                }
            }
            $success_msg[] = 'Image updated successfully!';
        }
    }
}

// DELETE IMAGE
if (isset($_POST['delete_image'])) {
    $select_image = $conn->prepare("SELECT image FROM `products` WHERE id = ?");
    $select_image->bind_param("s", $product_id);
    $select_image->execute();
    $result_image = $select_image->get_result();
    $fetch_image = $result_image->fetch_assoc();

    if ($fetch_image && !empty($fetch_image['image'])) {
        unlink('../uploaded_files/' . $fetch_image['image']);
        $update_image = $conn->prepare("UPDATE `products` SET image = '' WHERE id = ?");
        $update_image->bind_param("s", $product_id);
        $update_image->execute();
        $success_msg[] = "Image deleted successfully!";
    }
}

// DELETE PRODUCT
if (isset($_POST['delete_product'])) {
    $delete_image = $conn->prepare("SELECT image FROM `products` WHERE id = ?");
    $delete_image->bind_param("s", $product_id);
    $delete_image->execute();
    $result_delete_image = $delete_image->get_result();
    $fetch_delete_image = $result_delete_image->fetch_assoc();

    if (!empty($fetch_delete_image['image'])) {
        unlink('../uploaded_files/' . $fetch_delete_image['image']);
    }

    $delete_products = $conn->prepare("DELETE FROM `products` WHERE id = ?");
    $delete_products->bind_param("s", $product_id);
    $delete_products->execute();
    header('Location: View_products.php');
    exit();
}
?>