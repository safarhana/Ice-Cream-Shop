<?php include '../php/About_us_controller.php'; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ice Cream Delights - About Us Page</title>
    <link rel="stylesheet" type="text/css" href="../css/User_style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">

    <!-- Boxicons CDN Link -->

    <link rel="stylesheet" href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css">

</head>

<body>

    <?php include '../php/User_header.php'; ?>

    <div class="banner">
        <div class="detail">
            <h1>About Us</h1>
            <p>At Ice Delights, we craft the finest ice cream using quality<br>ingredients creating unforgetatable
                flavors that bring joy to every scoop.</p>
            <span>
                <a href="Home.php">Home</a>
                <i class="bx bx-right-arrow-alt"></i>about us
            </span>
        </div>
    </div>
    <div class="journey">
        <div class="box-container">
            <div class="box"></div>
            <div class="heading">
                <span>The Ice Cream Dream</span>
                <h1>Our journey began with a simple dream</h1>
                <img src="../image/separator-img.png">
            </div>
            <p>Our goal is to make the best ice cream using only the finest,natural
                ingredients. From rich creamy classics to adventurous new creations,
                every flavor is meticulously crafted to perfection. We take pride in
                offering a diverse range of options, including dairy-free, vegan, and
                gluten-free choices to cater to every palate.
            </p>
            <div class="flex-btn">
                <a href="" class="btn">Read More</a>
                <a href="menu.php" class="btn">visit our shop</a>
            </div>

            <div class="box">
                <img src="../image/journey-img.jpg" class="img">
            </div>
        </div>
    </div>

    <!--mission section-->

    <div class="story">
        <div class="heading">
            <h1>Our Mission</h1>
            <img src="../image/separator-img.png">
        </div>
        <p>We strive to foster a welcoming<br> and joyful environment where customers
            of<br> all ages can gather, celebrate, and make lasting memories.<br> Our
            commitment extends beyond serving great ice cream.</p>
        <a href="menu.php" class="btn">Our Service</a>
    </div>

    <div class="container">
        <div class="box-container">
            <div class="img-box">
                <img src="../image/flavors.jpg">
            </div>
            <div class="box">
                <div class="heading">
                    <h1>Variety Flavors</h1>
                    <img src="../image/separator-img.png">
                </div>
                <p>At Ice Cream Delights, we believe every scoop should tell a
                    story. From classic vanilla and rich chocolate to exotic
                    mango and tangy raspberry sorbet, our flavor are crafted to
                    delight every palate. Whether you prefer dairy-free, vegan or
                    gluten-free options, we have something for everyone. Discover the
                    joy of variety with every bite.
                    <a href="" class="btn">View All Flavors</a>
                </p>
            </div>
        </div>
    </div>

    <!--story section end-->

    <script src="https://unpkg.com/swiper@7/swiper-bundle.min.js"></script>
    <?php include '../php/Footer.php'; ?>


    <script src="../js/User_script.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>

    <?php include '../php/Alert.php'; ?>

</body>

</html>