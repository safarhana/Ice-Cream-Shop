<?php include '../php/Orders_controller.php'; ?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Ice Cream Delights - Order Page</title>
  <link rel="stylesheet" type="text/css" href="../css/User_style.css">

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">

  <!-- Boxicons CDN Link -->

  <link rel="stylesheet" href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css">

</head>

<body>

  <?php include '../html/User_header.php'; ?>
  <div class="banner">
    <div class="detail">
      <h1>My Orders</h1>
      <p>View and manage all of your orders in one place. <br>You can track the status of your orders,
        view order details, and more.</p>
      <span>
        <a href="Home_view.php">home</a>
        <i class="bx bx-right-arrow-alt"></i>My Orders
      </span>
    </div>
  </div>

  <div class="orders">
    <div class="heading">
      <h1>My Orders</h1>
      <img src="../image/separator-img.png">
    </div>
    <div class="box-container">
      <?php
      $select_orders = $conn->prepare("SELECT * FROM `orders` WHERE user_id = ? ORDER BY date DESC");
      $select_orders->bind_param("i", $user_id);
      $select_orders->execute();
      $result_orders = $select_orders->get_result();

      if ($result_orders->num_rows > 0) {
        while ($fetch_orders = $result_orders->fetch_assoc()) {
          $product_id = $fetch_orders['product_id'];
          $select_products = $conn->prepare("SELECT * FROM `products` WHERE id = ?");
          $select_products->bind_param("s", $product_id);
          $select_products->execute();
          $result_products = $select_products->get_result();

          if ($result_products->num_rows > 0) {
            while ($fetch_products = $result_products->fetch_assoc()) {
              ?>
              <div class="box" <?php if ($fetch_orders['status'] == 'canceled') {
                echo 'style="border: 2px solid red;"
          ';
              } ?>>
                <a href="View_order.php?get_id=<?= $fetch_orders['id']; ?>">
                  <img src="../../../Admin/MVC/uploaded_files/<?= $fetch_products['image']; ?>" class="image">
                  <p class="date">
                    <i class="bx bx-calendar-alt"></i> <?= $fetch_orders['date']; ?>
                  </p>
                  <div class="content">
                    <img src="../../../Admin/MVC/image/shape-19.png" class="shape">
                    <div class="row">
                      <h3 class="name"><?= $fetch_products['name']; ?></h3>
                      <p class="price">Price: <?= $fetch_products['price']; ?>/-</p>
                      <p class="status" <?php
                      if ($fetch_orders['status'] == 'delivered') {
                        echo 'style="color: orange;"';
                      } elseif ($fetch_orders['status'] == 'canceled') {
                        echo 'style="color: red;"';
                      } else {
                        echo 'style="color: green;"';
                      }
                      ?>
                      >
                        <?= $fetch_orders['status']; ?>
                      </p>
                    </div>
                  </div>
                </a>
              </div>
              <?php
            }
          }
        }
      }
      ?>
    </div>
        
    <?php include '../html/Footer.php'; ?>

    <!-- custom js link -->
    <script src="../js/User_script.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>

    <?php include '../php/Alert.php'; ?>

</body>

</html>