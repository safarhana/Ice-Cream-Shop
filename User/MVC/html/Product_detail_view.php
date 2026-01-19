<?php include '../php/Product_detail_controller.php'; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Ice Cream Delights-Our Shop Page</title>

    <link rel="stylesheet" type="text/css" href="../css/User_style.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">

    <!-- Boxicons CDN Link -->

    <link rel="stylesheet" href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css">

</head>

<body>
    <?php include '../html/User_header.php'; ?>

    <div class="banner">
        <div class="detail">
            <h1>Product detail</h1>
            <p>Discover all the information about our products here.<br>Explore features, specifications,
                and pricing to help you make an informed decision.
            </p>
            <span>
                <a href="Home_view.php">home</a>
                <i class="bx bx-right-arrow-alt"></i>product detail
            </span>
        </div>
    </div>

    <section class="view_page">
        <div class="heading">
            <h1>Product Detail</h1>
            <img src="../image/separator-img.png">
        </div>

        <?php

        if (isset($_GET['pid'])) {
            $pid = $_GET['pid'];

            $select_products = $conn->prepare("SELECT * FROM `products` WHERE id= ?");
            $select_products->bind_param("s", $pid);
            $select_products->execute();
            $result_products = $select_products->get_result();

            if ($result_products->num_rows > 0) {
                while ($fetch_products = $result_products->fetch_assoc()) {
                    ?>

                    <form action="" method="post" class="box">
                        <div class="img-box">
                            <img src="../uploaded_files/<?= $fetch_products['image']; ?>" class="image">
                        </div>
                        <div class="detail">

                            <?php if ($fetch_products['stock'] > 9) { ?>
                                <span class="stock in">In Stock</span>
                            <?php } elseif ($fetch_products['stock'] > 0) { ?>
                                <span class="stock low">Hurry, Only <?= $fetch_products['stock']; ?> left!</span>
                            <?php } else { ?>
                                <span class="stock out">Out of Stock</span>
                            <?php } ?>
                            <p class="price"><?= $fetch_products['price']; ?></p>
                            <div class="name"><?= $fetch_products['name']; ?></div>
                            <p class="product-detail"><?= $fetch_products['product_detail']; ?></p>
                            <input type="hidden" name="product_id" value="<?= $fetch_products['id']; ?>">
                            <div class="button">
                                <button type="submit" name="add_to_wishlist" class="btn">Add to Wishlist<i
                                        class="bx bx-heart"></i></button>
                                <input type="hidden" name="qty" value="1" min="0" class="quantity">
                                <button type="submit" name="add_to_cart" class="btn">Add to Cart<i class="bx bx-cart"></i></button>


                            </div>

                        </div>

                    </form>
                    <?php
                }
            }
        }
        ?>
    </section>
    <div class="products">
        <div class="heading">
            <h1>Related Products</h1>
            <p>Explore a selection of our most popular and highly-rated products.</p>
            <img src="../image/separator-img.png" alt="">
        </div>
        <?php include 'Shop_view.php'; ?>
    </div>


    <script src="../js/User_script.js"></script>

    <?php include '../html/Footer.php'; ?>

    <!-- custom js link -->


    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>

    <?php include '../php/Alert.php'; ?>

</body>

</html>