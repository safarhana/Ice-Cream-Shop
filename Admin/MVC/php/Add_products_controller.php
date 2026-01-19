<?php
include '../db/Connect.php';

if (isset($_COOKIE['seller_id'])) {
    $seller_id = $_COOKIE['seller_id'];
} else {
    $seller_id = '';
    header('Location: Login_view.php');
    exit();
}
//ADD PRODUCT
if (isset($_POST['publish'])) {
    $id = unique_id();
    $name = filter_var($_POST['name'], FILTER_SANITIZE_STRING);
    $price = filter_var($_POST['price'], FILTER_SANITIZE_STRING);
    $description = filter_var($_POST['description'], FILTER_SANITIZE_STRING);
    $stock = filter_var($_POST['stock'], FILTER_SANITIZE_STRING);
    $status = 'active';

    $image = $_FILES['image']['name'];
    $image = filter_var($image, FILTER_SANITIZE_STRING);
    $image_size = $_FILES['image']['size'];
    $image_tmp_name = $_FILES['image']['tmp_name'];
    $image_folder = '../uploaded_files/' . $image;


    $select_image = $conn->prepare("SELECT * FROM `products` WHERE image=? AND seller_id=?");
    $select_image->bind_param("ss", $image, $seller_id);
    $select_image->execute();
    $select_image->store_result();

    if ($image != '') {
        if ($select_image->num_rows > 0) {
            $warning_msg[] = "Image name already exists!";
        } elseif ($image_size > 2000000) {
            $warning_msg[] = "Image is too large!";
        } else {

            $insert_product = $conn->prepare("INSERT INTO `products`(id, seller_id, name, price, image, stock, product_detail, status) VALUES(?,?,?,?,?,?,?,?)");
            $insert_product->bind_param("ssssssss", $id, $seller_id, $name, $price, $image, $stock, $description, $status);
            $insert_product->execute();

            move_uploaded_file($image_tmp_name, $image_folder);
            $success_msg[] = "Product added successfully!";
        }
    }

}
//ADD PRODUCT TO DATABASE AS DRAFT
if (isset($_POST['draft'])) {
    $id = unique_id();
    $name = filter_var($_POST['name'], FILTER_SANITIZE_STRING);
    $price = filter_var($_POST['price'], FILTER_SANITIZE_STRING);
    $description = filter_var($_POST['description'], FILTER_SANITIZE_STRING);
    $stock = filter_var($_POST['stock'], FILTER_SANITIZE_STRING);
    $status = 'deactive';

    $image = $_FILES['image']['name'];
    $image = filter_var($image, FILTER_SANITIZE_STRING);
    $image_size = $_FILES['image']['size'];
    $image_tmp_name = $_FILES['image']['tmp_name'];
    $image_folder = '../uploaded_files/' . $image;


    $select_image = $conn->prepare("SELECT * FROM `products` WHERE image=? AND seller_id=?");
    $select_image->bind_param("ss", $image, $seller_id);
    $select_image->execute();
    $select_image->store_result();

    if ($image != '') {
        if ($select_image->num_rows > 0) {
            $warning_msg[] = "Image name already exists!";
        } elseif ($image_size > 2000000) {
            $warning_msg[] = "Image is too large!";
        } else {

            $insert_product = $conn->prepare("INSERT INTO `products`(id, seller_id, name, price, image, stock, product_detail, status) VALUES(?,?,?,?,?,?,?,?)");
            $insert_product->bind_param("ssssssss", $id, $seller_id, $name, $price, $image, $stock, $description, $status);
            $insert_product->execute();

            move_uploaded_file($image_tmp_name, $image_folder);
            $success_msg[] = "Product saved as draft successfully!";
        }
    }
}
?>