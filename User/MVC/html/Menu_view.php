<?php include '../php/Menu_controller.php'; ?>
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
            <h1>Our Shop</h1>
            <p>Explore our wide range of products. Whether you're looking for
                new arrivals,<br> bestsellers, or exclusive item, we have something
                for everyone. Shop now and enjoy great deals.
            </p>
            <span>
                <a href="Home_view.php">home</a>
                <i class="bx bx-right-arrow-alt"></i>login
            </span>
        </div>
    </div>

    <div class="products">
        <div class="heading">
            <h1>Our Latest Flavors</h1>
            <img src="../image/separator-img.png">
        </div>

        <div class="box-container">
            <?php
            $select_products = $conn->prepare("SELECT * FROM `products` WHERE status= ?");
            $status = 'active';
            $select_products->bind_param("s", $status);
            $select_products->execute();
            $result_products = $select_products->get_result();

            if ($result_products->num_rows > 0) {
                while ($fetch_products = $result_products->fetch_assoc()) {
                    ?>

                    <form action="" method="post" class="box <?php if ($fetch_products['stock'] == 0) {
                        echo 'disabled';
                    } ?>">
                        <img src="../uploaded_files/<?= $fetch_products['image']; ?>" class="image">
                        <?php if ($fetch_products['stock'] > 9) { ?>
                            <span class="stock in">In Stock</span>
                        <?php } elseif ($fetch_products['stock'] > 0) { ?>
                            <span class="stock low">Hurry, Only <?= $fetch_products['stock']; ?> left!</span>
                        <?php } else { ?>
                            <span class="stock out">Out of Stock</span>
                        <?php } ?>

                        <div class="content">
                            <img src="../image/shape-19.png" alt="" class="shape">
                            <div class="button">
                                <div>
                                    <h3 class="name"><?= $fetch_products['name']; ?></h3>
                                </div>
                                <div>
                                    <button type="submit" name="add_to_cart"><i class="bx bx-cart"></i></button>
                                    <button type="submit" name="add_to_wishlist"><i class="bx bx-heart"></i></button>
                                    <a href="Product_detail_view.php?pid=<?= $fetch_products['id']; ?>"
                                        class="bx bxs-show">read</a>
                                </div>
                            </div>
                            <p class="price">Price: $<?= $fetch_products['price']; ?></p>
                            <input type="hidden" name="product_id" value="<?= $fetch_products['id']; ?>">
                            <div class="flex-btn">
                                <a href="checkout.php?get_id=<?= $fetch_products['id']; ?>" class="btn">Buy Now</a>
                                <input type="number" name="qty" required min="1" max="99" value="1" maxlength="2" class="qty">
                            </div>
                        </div>
                    </form>
                    <?php
                }
            } else {
                echo '<div class="empty">
            <p>No Products Added Yet!</p>
            </div>';
            }
            ?>
        </div>
    </div>

    <script src="../js/User_script.js"></script>

    <?php include '../html/Footer.php'; ?>

    <!-- custom js link -->


    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>

    <?php include '../php/Alert.php'; ?>

</body>

</html>