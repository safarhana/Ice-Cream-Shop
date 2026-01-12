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
      <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec at eros nulla.<br> Mauris
        id elit tempus, tempus purus ac, maximus dui. Integer porta placerat gravida.</p>
    </div>
  </div>



  <script src="../js/User_script.js"></script>
  <?php include '../html/Footer.php'; ?>

  <!-- custom js link -->


  <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>

  <?php include '../php/Alert.php'; ?>

</body>

</html>