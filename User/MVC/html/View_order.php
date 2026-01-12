<?php include '../php/View_order_controller.php'; ?>
<?php include '../php/Orders_controller.php'; ?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Ice Cream Delights - View my page</title>
  <link rel="stylesheet" type="text/css" href="../css/User_style.css">

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">

  <!-- Boxicons CDN Link -->

  <link rel="stylesheet" href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css">

</head>

<body>

  <?php include '../html/User_header.php'; ?>
  <div class="banner">
    <div class="detail">
      <h1>Order Detail</h1>
      <p>Review all the information about your order, including items <br> purchased, keep track of your
        order and manage your purchase with ease</p>
      <span>
        <a href="Home.php">home</a>
        <i class="bx bx-right-arrow-alt"></i>Order Detail
      </span>
    </div>
  </div>

  <div class="order-detail">
    <div class="heading">
      <h1>My Orders Detail</h1>
      <p>Get a detailed summary of your order and manange your order efficiently with ease.</p>
      <img src="../image/separator-img.png" alt="Separator Image">
    </div>
    <div class="box-container">
      <?php
      $grand_total = 0;
      $select_order = $conn->prepare("SELECT * FROM `orders` WHERE id = ? LIMIT 1");
      $select_order->bind_param("i", $get_id);
      $select_order->execute();
      $result_order = $select_order->get_result();

      if ($result_order->num_rows > 0) {
        while ($fetch_order = $result_order->fetch_assoc()) {
          $select_product = $conn->prepare("SELECT * FROM `products` WHERE id = ? LIMIT 1");
          $select_product->bind_param("i", $fetch_order['product_id']);
          $select_product->execute();
          $result_product = $select_product->get_result();

          if ($result_product->num_rows > 0) {
            while ($fetch_product = $result_product->fetch_assoc()) {
              $sub_total = $fetch_order['price'] * $fetch_order['qty'];
              $grand_total = $sub_total;
              ?>

              <div class="box">
                <div class="col">
                  <p class="title">
                    <i class="bx bxs-calender-alt"></i><?= $fetch_order['date']; ?>
                  </p>
                  <img src="uploaded_files/<?= $fetch_product['image']; ?>" class="image" alt="<?= $fetch_product
                    ['name']; ?>">
                  <p class="price">$<?= $fetch_product['price']; ?>/-</p>
                  <h3 class="name"><?= $fetch_product['name']; ?></h3>
                  <p class="grand-total">
                    Total amount payable : <span><?= $grand_total; ?>/-</span>
                  </p>
                </div>
                <div class="col">
                  <p class="title">Billing Address</p>
                  <p class="user">
                    <i class="bi bi-person-bounding-box"></i> <?= $fetch_order['name']; ?>
                  </p>
                  <p class="user">
                    <i class="bi bi-phone"></i> <?= $fetch_order['number']; ?>
                  </p>
                  <p class="user">
                    <i class="bi bi-envelope"></i> <?= $fetch_order['email']; ?>
                  </p>
                  <p class="user">
                    <i class="bi bi-pin-map-fill"></i> <?= $fetch_order['address']; ?>
                  </p>
                  <p class="status" style="color: <?php
                  if ($fetch_order['status'] == 'delivered') {
                    echo 'green';
                  } elseif ($fetch_order['status'] == 'canceled') {
                    echo 'red';
                  } else {
                    echo 'orange';
                  }
                  ?>"> <?= $fetch_order['status']; ?></p>

                  <?php if ($fetch_order['status'] == 'canceled') { ?>
                    <p>Website: Cancelled Order</p>
                    <a href="Checkout.php?get_id=<?= $fetch_product['id']; ?>" class="btn" style="line-height:
                  3;">Order Again</a>
                  <?php } else { ?>
                    <form action="" method="post">
                      <button type="submit" class="btn" name="cancel" onclick="return confirm('Don't you want
                    to cancel this order?');">Cancel
                      </button>
                    </form>
                  <?php } ?>
                </div>
              </div>
            <?php

            }

          }

        }
      } else {
        echo '<p class="empty">No orders have been placed yet!</p>';
      }
      ?>
    </div>
  </div>

  <?php include '../html/Footer.php'; ?>

  <!-- custom js link -->
  <script src="../js/User_script.js"></script>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>

  <?php include '../php/Alert.php'; ?>

</body>

</html>