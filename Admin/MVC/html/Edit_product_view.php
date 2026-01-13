<?php include '../php/Edit_product_controller.php'; ?>
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
        <?php include 'Admin_header.php'; ?>
        <section class="post-editor">
            <div class="heading">
                <h1>Edit Product</h1>
                <img src="../image/separator-img.png">
            </div>
            <div class="box-container">
                <?php
                $select_product = $conn->prepare("SELECT * FROM `products` WHERE id = ? AND seller_id = ?");
                $select_product->bind_param("ss", $product_id, $seller_id);
                $select_product->execute();
                $result_product = $select_product->get_result();

                if ($result_product->num_rows > 0) {
                    while ($fetch_product = $result_product->fetch_assoc()) {
                        ?>
                        <div class="form-container">
                            <form action="" onsubmit="return handleEditProduct()" method="post" enctype="multipart/form-data"
                                class="register">

                                <input type="hidden" name="old_image" value="<?= $fetch_product['image']; ?>">
                                <input type="hidden" name="product_id" value="<?= $fetch_product['id']; ?>">

                                <div class="input-field">
                                    <p>Product Status <span>*</span></p>
                                    <select name="status" class="box">
                                        <option value="<?= $fetch_product['status']; ?>" selected>
                                            <?= $fetch_product['status']; ?>
                                        </option>
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
                                    <input type="number" name="stock" value="<?= $fetch_product['stock']; ?>" class="box"
                                        min="0" max="9999999999" maxlength="10">
                                </div>

                                <div class="input-field">
                                    <p>Product Image <span>*</span></p>
                                    <input type="file" name="image" accept="image/*" class="box">
                                    <?php if ($fetch_product['image'] != '') { ?>
                                        <img src="../uploaded_files/<?= $fetch_product['image']; ?>" class="image"
                                            style="margin-bottom: 5px !important;">
                                    <?php } ?>
                                </div>

                                <div
                                    style="display: flex; flex-direction: column; gap: 5px !important; width: 100% !important; margin: 0 !important; padding: 0 !important;">
                                    <?php if ($fetch_product['image'] != '') { ?>
                                        <div
                                            style="display: flex; gap: 5px !important; width: 100% !important; margin: 0 !important;">
                                            <button type="submit" name="delete_image" class="btn"
                                                style="flex: 1 !important; margin: 0 !important; width: 100% !important;">Delete
                                                Image</button>
                                            <a href="View_products_view.php" class="btn"
                                                style="flex: 1 !important; margin: 0 !important; width: 100% !important; text-align: center; display: flex; align-items: center; justify-content: center;">Go
                                                Back</a>
                                        </div>
                                    <?php } else { ?>
                                        <div style="display: flex; width: 100% !important; margin: 0 !important;">
                                            <a href="View_products_view.php" class="btn"
                                                style="flex: 1 !important; margin: 0 !important; width: 100% !important; text-align: center; display: flex; align-items: center; justify-content: center;">Go
                                                Back</a>
                                        </div>
                                    <?php } ?>

                                    <div
                                        style="display: flex; gap: 5px !important; width: 100% !important; margin: 0 !important;">
                                        <button type="submit" name="update" class="btn"
                                            style="flex: 1 !important; margin: 0 !important; width: 100% !important;">Update
                                            Product</button>
                                        <button type="submit" name="delete_product" class="btn"
                                            style="flex: 1 !important; margin: 0 !important; width: 100% !important;">Delete
                                            Product</button>
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

    <script src="../js/Edit_product_validation.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
    <script src="../js/Admin_script.js"></script>
    <?php include 'Alert.php'; ?>

</body>

</html>