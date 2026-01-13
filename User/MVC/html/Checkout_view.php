<?php include '../php/Checkout_controller.php'; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ice Cream Delights - Checkout Page</title>
    <link rel="stylesheet" type="text/css" href="../css/User_style.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">

    <!-- Boxicons CDN Link -->

    <link rel="stylesheet" href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css">

</head>

<body>

    <?php include '../html/User_header.php'; ?>
    <div class="banner">
        <div class="detail">
            <h1>Checkout</h1>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec at eros nulla.<br> Mauris
                id elit tempus, tempus purus ac, maximus dui. Integer porta placerat gravida.</p>
            <span>
                <a href="Home_view.php">home</a>
                <i class="bx bx-right-arrow-alt"></i>Checkout
            </span>
        </div>
    </div>

    <div class="checkout">
        <div class="heading">
            <h1>Checkout</h1>
            <img src="../image/separator-img.png" alt="">
        </div>
        <div class="row">
            <form action="" method="post" class="register">
                <input type="hidden" name="p_id" value="<?= $get_id; ?>">
                <h3>billing details</h3>
                <div class="flex">
                    <div class="box">
                        <div class="input-field">
                            <p>your name<span>*</span></p>
                            <input type="text" name="name" maxlength="50" placeholder="Enter your name" class="input"
                                required>
                        </div>

                        <div class="input-field">
                            <p>your number<span>*</span></p>
                            <input type="text" name="number" maxlength="50" placeholder="Enter your number"
                                class="input" required>
                        </div>

                        <div class="input-field">
                            <p>your email<span>*</span></p>
                            <input type="email" name="email" maxlength="50" placeholder="Enter your email" class="input"
                                required>
                        </div>

                        <div class="input-field">
                            <p>Payment method<span>*</span></p>
                            <select name="method" class="input">
                                <option value="cash on delivery">cash on delivery</option>
                                <option value="credit or debit card">credit or debit card</option>
                                <option value="net banking">net banking</option>
                                <option value="paypal">paypal</option>
                            </select>
                        </div>

                        <div class="input-field">
                            <p>Address Type<span>*</span></p>
                            <select name="address_type" class="input">
                                <option value="home">Home</option>
                                <option value="office">Office</option>
                            </select>
                        </div>
                    </div>

                    <div class="box">
                        <div class="input-field">
                            <p>address line 01<span>*</span></p>
                            <input type="text" name="flat" maxlength="50" placeholder="e.g. flat or building name"
                                required>
                        </div>
                        <div class="input-field">
                            <p>address line 02<span>*</span></p>
                            <input type="text" name="street" maxlength="50" placeholder="e.g. street name" required>
                        </div>

                        <div class="input-field">
                            <p>city name<span>*</span></p>
                            <input type="text" name="city" maxlength="50" placeholder="e.g. city name" required>
                        </div>
                        <div class="input-field">
                            <p>country<span>*</span></p>
                            <input type="text" name="country" maxlength="50" placeholder="e.g. country name" required>
                        </div>
                        <div class="input-field">
                            <p>pin code<span>*</span></p>
                            <input type="text" name="pin" maxlength="6" min="0" placeholder="e.g. pin code" required>
                        </div>
                    </div>
                </div>
                <button type="submit" name="place_order" class="btn">place order</button>
            </form>
            <div class="summary">
                <h3>my bag</h3>
                <div class="box-container">
                    <?php
                    $grand_total = 0;
                    if (isset($_GET['get_id'])) {
                        $select_get = $conn->prepare("SELECT * FROM `products` WHERE id=?");
                        $select_get->bind_param("s", $_GET["get_id"]);
                        $select_get->execute();
                        $select_get_result = $select_get->get_result();
                        while ($fetch_get = $select_get_result->fetch_assoc()) {
                            $sub_total = $fetch_get['price'];
                            $grand_total += $sub_total;

                            ?>
                            <div class="flex">
                                 <img src="../../../Admin/MVC/uploaded_files/<?= $fetch_get['image']; ?>" alt="" class="image">
                                <div>
                                    <h3 class="name"><?= $fetch_get['name']; ?></h3>
                                    <p class="price"><?= $fetch_get['price']; ?></p>
                                </div>
                            </div>
                            <?php
                        }
                    } else {
                        $select_cart = $conn->prepare("SELECT * FROM `cart` WHERE user_id=?");
                        $select_cart->bind_param("s", $user_id);
                        $select_cart->execute();
                        $select_cart_result = $select_cart->get_result();

                        if ($select_cart_result->num_rows > 0) {
                            while ($fetch_cart = $select_cart_result->fetch_assoc()) {
                                $select_product = $conn->prepare("SELECT * FROM `products` WHERE id=?");
                                $select_product->bind_param("s", $fetch_cart['product_id']);
                                $select_product->execute();
                                $select_product_result = $select_product->get_result();
                                $fetch_product = $select_product_result->fetch_assoc();

                                $sub_total = ($fetch_cart['qty'] * $fetch_product['price']);
                                $grand_total += $sub_total;
                                ?>

                                <div class="flex">
                                   <img src="../../../Admin/MVC/uploaded_files/<?= $fetch_product['image']; ?>" alt=""
                                        class="image">
                                    <div>
                                        <h3 class="name"><?= $fetch_product['name']; ?></h3>
                                        <p class="price"><?= $fetch_product['price']; ?> X <?= $fetch_cart['qty']; ?></p>
                                    </div>


                                </div>
                                <?php
                            }
                        } else {
                            echo '<p class="empty">Your cart is empty!</p>';
                        }
                    }
                    ?>
                </div>
                <div class="grand-total">
                    <span>total payable amount</span>
                    <p><?= $grand_total; ?></p>
                </div>
            </div>
        </div>
    </div>



    <script src="../js/User_script.js"></script>
    <?php include '../html/Footer.php'; ?>

    <!-- custom js link -->


    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>

    <?php include '../php/Alert.php'; ?>

</body>

</html>