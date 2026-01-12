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
                            <input type="text" name="name" maxlength="50" placeholder="Enter your name" required>
                        </div>

                        <div class="input-field">
                            <p>your number<span>*</span></p>
                            <input type="text" name="number" maxlength="50" placeholder="Enter your number" required>
                        </div>

                        <div class="input-field">
                            <p>your email<span>*</span></p>
                            <input type="email" name="email" maxlength="50" placeholder="Enter your email" required>
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
                <button type="submit" name="place_order">place order</button>
            </form>

        </div>
    </div>



    <script src="../js/User_script.js"></script>
    <?php include '../html/Footer.php'; ?>

    <!-- custom js link -->


    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>

    <?php include '../php/Alert.php'; ?>

</body>

</html>