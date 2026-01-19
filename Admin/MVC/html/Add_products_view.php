<?php include '../php/Add_products_controller.php'; ?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Ice Cream Delights - Add Products</title>
    <link rel="stylesheet" type="text/css" href="../css/Admin_style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
    <link rel="stylesheet" href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css">
</head>

<body>

    <div class="main-container">
        <?php include 'Admin_header.php'; ?>
        <section class="post-editor">
            <div class="heading">
                <h1>Add Product</h1>
                <img src="../image/separator-img.png">
            </div>

            <div class="form-container">
                <form action="" method="post" enctype="multipart/form-data" class="register">
                    <div class="input-field">
                        <p>Product Name <span>*</span></p>
                        <input type="text" name="name" maxlength="100" placeholder="Add product name" required
                            class="box">
                    </div>

                    <div class="input-field">
                        <p>Product Price <span>*</span></p>
                        <input type="number" name="price" maxlength="100" placeholder="Add product price" required
                            class="box">
                    </div>

                    <div class="input-field">
                        <p>Product Detail <span>*</span></p>
                        <textarea name="description" required maxlength="1000" placeholder="Add product description"
                            class="box"></textarea>
                    </div>

                    <div class="input-field">
                        <p>Product Stock <span>*</span></p>
                        <input type="number" name="stock" maxlength="10" min="0" max="999999" placeholder="Add stock"
                            required class="box">
                    </div>

                    <div class="input-field">
                        <p>Product Image <span>*</span></p>
                        <input type="file" name="image" accept="image/*" required class="box">
                    </div>

                    <div class="flex-btn">
                        <input type="submit" name="publish" value="Add Product" class="btn">
                        <input type="submit" name="draft" value="Save as Draft" class="btn">
                    </div>
                </form>
            </div>
        </section>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
    <?php include 'Alert.php'; ?>
    <script src="../js/Admin_script.js"></script>

</body>

</html>