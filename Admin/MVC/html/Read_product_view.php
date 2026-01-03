<?php include '../php/Read_product_controller.php'; ?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Ice Cream Delights - Read Products</title>
    <link rel="stylesheet" type="text/css" href="../css/Admin_style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">

    <link rel="stylesheet" href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css">
</head>

<body>

    <div class="main-container">
        <?php include 'Admin_header.php'; ?>

        <section class="read_post">
            <div class="heading">
                <h1>product detail</h1>
                <img src="../image/separator-img.png">
            </div>
            <div class="box-container">
                <?php
                $select_product = $conn->prepare("SELECT * FROM `products` WHERE id = ? AND seller_id = ?");
                $select_product->bind_param("ss", $get_id, $seller_id);
                $select_product->execute();
                $result_product = $select_product->get_result();

                if ($result_product->num_rows > 0) {
                    while ($fetch_product = $result_product->fetch_assoc()) {
                        ?>
                        <form action="" method="post" class="box">
                            <input type="hidden" name="product_id" value="<?= $fetch_product['id']; ?>">
                            <div class="status" style="color: <?php if ($fetch_product['status'] == 'active') {
                                echo 'limegreen';
                            } else {
                                echo 'coral';
                            } ?>;">
                                <?= $fetch_product['status']; ?>
                            </div>
                            <?php if ($fetch_product['image'] != '') { ?>
                                <img src="../uploaded_files/<?= $fetch_product['image']; ?>" class="image">
                            <?php } ?>
                            <div class="price">$
                                <?= $fetch_product['price']; ?>/-
                            </div>
                            <div class="title">
                                <?= $fetch_product['name']; ?>
                            </div>
                            <div class="content">
                                <?= $fetch_product['product_detail']; ?>
                            </div>

                            <div class="flex-btn">
                                <a href="Edit_product_view.php?id=<?= $fetch_product['id']; ?>" class="btn">edit</a>
                                <button type="submit" name="delete" class="btn"
                                    onclick="return confirm('delete this product?');">delete</button>
                                <a href="View_products_view.php" class="btn">go back</a>
                            </div>
                        </form>

                        <?php
                    }
                } else {
                    ?>
                    <div class="empty">
                        <p>no products added yet! <br>
                            <a href="Add_products_view.php" class="btn" style="margin-top: 1.5rem;">add products</a>
                        </p>
                    </div>
                    <?php
                }
                ?>
            </div>
        </section>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
    <?php include 'Alert.php'; ?>

    <script src="../js/Admin_script.js"></script>
</body>

</html>