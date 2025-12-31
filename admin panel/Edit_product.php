<?php
include '../components/Connect.php';

if (isset($_COOKIE['seller_id'])) {
    $seller_id = $_COOKIE['seller_id'];
} else {
    $seller_id = '';
    header('Location: Login.php');
    exit();
}

if(isset($_POST['product_id'])) {
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
    $update_product->execute([$name, $price, $description, $stock, $status, $product_id]);
    $success_msg[] = 'Product updated successfully';

    $old_image = $_POST['old_image'];
    $image = $_FILES['image']['name'];
    $image = filter_var($image, FILTER_SANITIZE_STRING);
    $image_size = $_FILES['image']['size'];
    $image_tmp_name = $_FILES['image']['tmp_name'];
    $image_folder = '../uploaded_files/'.$image;
  
    if (!empty($image)) {
        if ($image_size > 2000000) {
            $warning_msg[] = "Image size is too large";
        } else {
            $update_image = $conn->prepare("UPDATE `products` SET image = ? WHERE id = ?");
            $update_image->execute([$image, $product_id]);
            move_uploaded_file($image_tmp_name, $image_folder);
        
            if($old_image != $image && !empty($old_image)) {
                if(file_exists('../uploaded_files/'.$old_image)) {
                    unlink('../uploaded_files/'.$old_image);
                }
            }
            $success_msg[] = 'Image updated successfully!';
        }
    }
}

// DELETE IMAGE
if(isset($_POST['delete_image'])) {
    $select_image = $conn->prepare("SELECT image FROM `products` WHERE id = ?");
    $select_image->execute([$product_id]);
    $fetch_image = $select_image->fetch(PDO::FETCH_ASSOC);

    if($fetch_image && !empty($fetch_image['image'])){
        unlink('../uploaded_files/'.$fetch_image['image']);
        $update_image = $conn->prepare("UPDATE `products` SET image = '' WHERE id = ?");
        $update_image->execute([$product_id]);
        $success_msg[] = "Image deleted successfully!";   
    }
}

// DELETE PRODUCT
if(isset($_POST['delete_product'])) {
    $delete_image = $conn->prepare("SELECT image FROM `products` WHERE id = ?");
    $delete_image->execute([$product_id]);
    $fetch_delete_image = $delete_image->fetch(PDO::FETCH_ASSOC);

    if(!empty($fetch_delete_image['image'])) {
        unlink('../uploaded_files/'.$fetch_delete_image['image']);
    }
 
    $delete_products = $conn->prepare("DELETE FROM `products` WHERE id = ?");
    $delete_products->execute([$product_id]);
    header('Location: View_products.php');
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Ice Cream Delights - Edit Product</title>
    <link rel="stylesheet" type="text/css" href="../css/Admin_style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">


    <!-- BOXICONS CDN LINK -->

    <link rel="stylesheet" href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css">
</head>
<body>
  
<div class="main-container">
    <?php include '../components/Admin_header.php'; ?>
    <section class="post-editor">
        <div class="heading">
            <h1>Edit Product</h1>
            <img src="../image/separator-img.png">
        </div>
        <div class="box-container">
            <?php
            $select_product = $conn->prepare("SELECT * FROM `products` WHERE id = ? AND seller_id = ?");
            $select_product->execute([$product_id, $seller_id]);

            if ($select_product->rowCount() > 0) {
                while ($fetch_product = $select_product->fetch(PDO::FETCH_ASSOC)) {  
            ?>
            <div class="form-container">
                <form action="" method="post" enctype="multipart/form-data" class="register">

                    <input type="hidden" name="old_image" value="<?= $fetch_product['image']; ?>">
                    <input type="hidden" name="product_id" value="<?= $fetch_product['id']; ?>">

                    <div class="input-field">
                        <p>Product Status <span>*</span></p>
                        <select name="status" class="box">
                            <option value="<?= $fetch_product['status']; ?>" selected><?= $fetch_product['status']; ?></option>
                            <option value="active">active</option>
                            <option value="deactive">deactive</option>
                        </select>
                    </div>

                    <div class="input-field">
                        <p>Product Name <span>*</span></p>
                        <input type="text" name="name" value="<?= $fetch_product['name']; ?>" class="box">
                    </div>

                    <div class="input-field">
                        <p>Product Price <span>*</span></p>
                        <input type="number" name="price" value="<?= $fetch_product['price']; ?>" class="box">
                    </div>

                    <div class="input-field">
                        <p>Product Detail <span>*</span></p>
                        <textarea name="description" class="box"><?= $fetch_product['product_detail']; ?></textarea>
                    </div>

                    <div class="input-field">
                        <p>Product Stock <span>*</span></p>
                        <input type="number" name="stock" value="<?= $fetch_product['stock']; ?>" class="box" min="0" max="9999999999" maxlength="10">
                    </div>

                    <div class="input-field">
                        <p>Product Image <span>*</span></p>
                        <input type="file" name="image" accept="image/*" class="box">
                        <?php if($fetch_product['image'] != '') { ?>
                            <img src="../uploaded_files/<?= $fetch_product['image']; ?>" class="image" style="margin-bottom: 5px !important;">
                        <?php } ?>
                    </div>

                    <div style="display: flex; flex-direction: column; gap: 5px !important; width: 100% !important; margin: 0 !important; padding: 0 !important;">
                        <?php if($fetch_product['image'] != '') { ?>
                        <div style="display: flex; gap: 5px !important; width: 100% !important; margin: 0 !important;">
                            <button type="submit" name="delete_image" class="btn" style="flex: 1 !important; margin: 0 !important; width: 100% !important;">Delete Image</button>
                            <a href="View_products.php" class="btn" style="flex: 1 !important; margin: 0 !important; width: 100% !important; text-align: center; display: flex; align-items: center; justify-content: center;">Go Back</a>
                        </div>
                        <?php } else { ?>
                        <div style="display: flex; width: 100% !important; margin: 0 !important;">
                            <a href="View_products.php" class="btn" style="flex: 1 !important; margin: 0 !important; width: 100% !important; text-align: center; display: flex; align-items: center; justify-content: center;">Go Back</a>
                        </div>
                        <?php } ?>

                        <div style="display: flex; gap: 5px !important; width: 100% !important; margin: 0 !important;">
                            <button type="submit" name="update" class="btn" style="flex: 1 !important; margin: 0 !important; width: 100% !important;">Update Product</button>
                            <button type="submit" name="delete_product" class="btn" style="flex: 1 !important; margin: 0 !important; width: 100% !important;">Delete Product</button>
                        </div>
                    </div>

                </form>
            </div>
            <?php 
                } 
            } else {
                echo '<div class="empty"><p>no product added yet!</p></div>';
            }
            ?>
        </div>
    </section>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
<?php include '../components/Alert.php'; ?>

<!--custom js link -->

<script src="../js/Admin_script.js"></script>

</body>
</html>