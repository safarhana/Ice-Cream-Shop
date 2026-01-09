<?php include '../php/Wishlist_controller.php'; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ice Cream Delights - user cart page</title>
    <link rel="stylesheet" type="text/css" href="../css/User_style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">

    <!-- Boxicons CDN Link -->

    <link rel="stylesheet" href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css">

</head>

<body>
    <?php include '../html/User_header.php'; ?>
    <div class="banner">
        <div class="detail">
            <h1>Cart</h1>
            <p>Your Cart.</p>
            <span>
                <a href="Home.php">home</a>
                <i class="bx bx-right-arrow-alt"></i>Cart
            </span>
        </div>
    </div>

    <div class="product">
        <div class="heading">
            <h1>My Cart</h1>
            <img src="../image/separator.png" alt="">
        </div>

        <div class="box-container">
            <?php
            $grand_total = 0;
            $select_cart = $conn->prepare("SELECT * FROM `cart` WHERE user_id = ?");
            $select_cart->bind_param("s", $user_id);
            $select_cart->execute();
            $result_cart = $select_cart->get_result();
            if ($result_cart->num_rows > 0) {
                while ($fetch_cart = $result_cart->fetch_assoc()) {
                    $select_product = $conn->prepare("SELECT * FROM `products` WHERE id = ?");
                    $select_product->bind_param("s", $fetch_cart["product_id"]);
                    $select_product->execute();
                    $result_product = $select_product->get_result();


                    if ($result_product->num_rows > 0) {
                        $fetch_product = $result_product->fetch_assoc();

                        ?>

                        <form action="" method="post" class="box <?php if ($fetch_product['stock'] == 0) {
                            echo 'disabled';
                        } ?>">
                            <input type="hidden" name="cart_id" value="<?= $fetch_cart['id']; ?>">
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
                                <h3 class="name"><?= $fetch_product['name']; ?></h3>
                                <div class="flex-btn">
                                    <p class="price">Price: $<?= $fetch_product['price']; ?></p>
                                    <input type="number" name="qty" required min="1" max="99" value="<?= $fetch_cart['qty']; ?>"
                                        maxlength="2" class="qty">
                                    <button type="submit" name="update_cart"><i class="fa fa-edit box"></i></button>
                                </div>

                                <div class="flex-btn">
                                    <p class="sub-total">Sub-Total:
                                        <span>$<?= $sub_total = ($fetch_product['price'] * $fetch_cart['qty']); ?></span>
                                    </p>
                                    <button type="submit" name="delete_item" class="btn"
                                        onclick="return confirm('Delete this item from cart?');">Delete</button>
                                </div>




                            </div>
                        </form>
                        <?php
                        $grand_total += $sub_total;
                    } else {
                        echo '<div class="empty">
                    <p>No Products Added Yet!</p>
                    </div>';
                    }
                }
            } else {

                echo '<div class="empty">
                    <p>No Products Added Yet!</p>
                    </div>';

            }
            ?>
        </div>

        <?php if ($grand_total != 0) { ?>
            <div class="cart-total">
                <p>Total Amount payable: <span>$<?= $grand_total ?></span></p>
                <div class="button">
                    <form action="" method="post">
                        <button type="submit" name="empty_cart" class="btn"
                            onclick="return confirm('Empty your cart?');">Empty Cart</button>
                    </form>
                    <a href="checkout.php" class="btn">Proceed to Checkout</a>
                </div>
            </div>
        <?php } ?>


    </div>
</body>

</html>