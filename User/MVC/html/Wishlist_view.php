<?php include '../php/Wishlist_controller.php'; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ice Cream Delights - user wishlist page</title>
    <link rel="stylesheet" type="text/css" href="../css/User_style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">

    <!-- Boxicons CDN Link -->

    <link rel="stylesheet" href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css">

</head>

<body>
    <?php include '../html/User_header.php'; ?>
    <div class="banner">
        <div class="detail">
            <h1>Wishlist</h1>
            <p>Your Wishlist.</p>
            <span>
                <a href="Home.php">home</a>
                <i class="bx bx-right-arrow-alt"></i>Wishlist
            </span>
        </div>
    </div>

    <div class="products">
        <div class="heading">
            <h1>My Wishlist</h1>
            <img src="../image/separator-img.png" alt="">
        </div>

        <div class="box-container">
            <?php
            $grand_total = 0;
            $select_wishlist = $conn->prepare("SELECT * FROM `wishlist` WHERE user_id = ?");
            $select_wishlist->bind_param("s", $user_id);
            $select_wishlist->execute();
            $result_wishlist = $select_wishlist->get_result();
            if ($result_wishlist->num_rows > 0) {
                while ($fetch_wishlist = $result_wishlist->fetch_assoc()) {
                    $select_product = $conn->prepare("SELECT * FROM `products` WHERE id = ?");
                    $select_product->bind_param("s", $fetch_wishlist["product_id"]);
                    $select_product->execute();
                    $result_product = $select_product->get_result();


                    if ($result_product->num_rows > 0) {
                        $fetch_product = $result_product->fetch_assoc();

                        ?>

                        <form action="" method="post" class="box <?php if ($fetch_product['stock'] == 0) {
                            echo 'disabled';
                        } ?>">
                            <input type="hidden" name="wishlist_id" value="<?= $fetch_wishlist['id']; ?>">
                            <img src="../uploaded_files/<?= $fetch_product['image']; ?>" class="image">
                            <?php if ($fetch_product['stock'] > 9) { ?>
                                <span class="stock in">In Stock</span>
                            <?php } elseif ($fetch_product['stock'] > 0) { ?>
                                <span class="stock low">Hurry, Only <?= $fetch_product['stock']; ?> left!</span>
                            <?php } else { ?>
                                <span class="stock out">Out of Stock</span>
                            <?php } ?>

                            <div class="content">
                                <img src="../image/shape-19.png" alt="" class="shape">
                                <div class="button">

                                    <div>
                                        <h3>
                                            <?= $fetch_product['name']; ?>
                                        </h3>
                                    </div>
                                    <div>
                                        <button type="submit" name="add_to_cart"><i class="bx bx-cart"></i></button>
                                        <a href="view_page.php?pid=<?= $fetch_product['id']; ?>" class="bx bxs-show"></a>
                                        <button type="submit" name="delete_item"
                                            onclick="return confirm('Delete this item from wishlist?');"><i
                                                class="bx bx-x"></i></button>
                                    </div>

                                </div>


                                <input type="hidden" name="product_id" value="<?= $fetch_product['id']; ?>">
                                <div class="flex">
                                    <p class="price">Price: $<?= $fetch_product['price']; ?></p>
                                </div>

                                <div class="flex">
                                    <input type="hidden" name="qty" required min="1" value="1" max="99" maxlength="2" class="qty">
                                    <a href="checkout.php?get_id=<?= $fetch_product['id']; ?>" class="btn">Buy Now</a>
                                </div>
                            </div>
                        </form>
                        <?php
                        $grand_total += $fetch_wishlist['price'];
                    } else {
                        echo '<div class="empty">
                    <p>No Products Added Yet!</p>
                    </div>';
                    }
                }
            }
            ?>
        </div>

    </div>

    <script src="../js/User_script.js"></script>
    <script src="https://unpkg.com/swiper@7/swiper-bundle.min.js"></script>
    <?php include '../html/Footer.php'; ?>




    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>

    <?php include '../php/Alert.php'; ?>
</body>

</html>