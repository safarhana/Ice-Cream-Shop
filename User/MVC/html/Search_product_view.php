<?php include '../php/Search_product_controller.php'; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Ice Cream Delights - Search Products</title>

    <link rel="stylesheet" type="text/css" href="../css/User_style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
    <link rel="stylesheet" href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css">
</head>

<body>
    <?php include '../html/User_header.php'; ?>

    <div class="banner">
        <div class="detail">
            <h1>Search Products</h1>
            <p>Search our wide range of products. Whether you're looking for new arrivals, bestsellers, or exclusive
                items, we have something for everyone.</p>
            <span>
                <a href="Home.php">home</a>
                <i class="bx bx-right-arrow-alt"></i>Search products
            </span>
        </div>
    </div>

    <div class="products">
        <div class="heading">
            <h1>Search Result</h1>
            <img src="../image/separator-img.png" alt="separator">
        </div>

        <div class="box-container">
            <?php

            if (isset($_POST['search_product']) || isset($_POST['search_product_btn'])) {


                $search_products = $_POST['search_product'];
                $search_query = "%" . $search_products . "%";
                $status = 'active';


                $select_products = $conn->prepare("SELECT * FROM `products` WHERE name LIKE ? AND status = ?");


                $select_products->bind_param("ss", $search_query, $status);


                $select_products->execute();


                $result = $select_products->get_result();


                if ($result->num_rows > 0) {
                    while ($fetch_products = $result->fetch_assoc()) {
                        ?>
                        <form action="" method="post" class="box <?= ($fetch_products['stock'] == 0) ? 'disabled' : ''; ?>">
                            <img src="../../../Admin/MVC/uploaded_files/<?= $fetch_products['image']; ?>" class="image">

                            <?php if ($fetch_products['stock'] > 9): ?>
                                <span class="stock in">In Stock</span>
                            <?php elseif ($fetch_products['stock'] > 0): ?>
                                <span class="stock low">Hurry, Only <?= $fetch_products['stock']; ?> left!</span>
                            <?php else: ?>
                                <span class="stock out">Out of Stock</span>
                            <?php endif; ?>

                            <div class="content">
                                <img src="../image/shape-19.png" alt="" class="shape">
                                <div class="button">
                                    <div>
                                        <h3 class="name"><?= htmlspecialchars($fetch_products['name']); ?></h3>
                                    </div>
                                    <div>
                                        <button type="submit" name="add_to_cart"><i class="bx bx-cart"></i></button>
                                        <button type="submit" name="add_to_wishlist"><i class="bx bx-heart"></i></button>
                                        <a href="Product_detail_view.php?pid=<?= $fetch_products['id']; ?>" class="bx bxs-show"></a>
                                    </div>
                                </div>
                                <p class="price">Price: $<?= $fetch_products['price']; ?></p>
                                <input type="hidden" name="product_id" value="<?= $fetch_products['id']; ?>">
                                <div class="flex-btn">
                                    <a href="checkout_view.php?get_id=<?= $fetch_products['id']; ?>" class="btn">Buy Now</a>
                                    <input type="number" name="qty" required min="1" max="99" value="1" class="qty">
                                </div>
                            </div>
                        </form>
                        <?php
                    }
                } else {
                    echo '<div class="empty"><p>No products found for "' . htmlspecialchars($search_products) . '"!</p></div>';
                }
            } else {
                echo '<div class="empty"><p>Please search something else!</p></div>';
            }
            ?>
        </div>
    </div>

    <?php include '../html/Footer.php'; ?>

    <script src="../js/User_script.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
    <?php include '../php/Alert.php'; ?>

</body>

</html>