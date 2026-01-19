<?php include '../php/View_products_controller.php'; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Ice Cream Delights - Your Products</title>
    <link rel="stylesheet" type="text/css" href="../css/Admin_style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
    <link rel="stylesheet" href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css">
</head>

<body>

    <div class="main-container">
        <?php include 'Admin_header.php'; ?>

        <section class="show-post">
            <div class="heading">
                <h1>your products</h1>
                <img src="../image/separator-img.png" alt="separator">
            </div>

            <div class="box-container">
                <?php
                $select_products = $conn->prepare("SELECT * FROM `products` WHERE seller_id = ?");
                $select_products->bind_param("s", $seller_id);
                $select_products->execute();
                $result_products = $select_products->get_result();

                if ($result_products->num_rows > 0) {
                    while ($fetch_products = $result_products->fetch_assoc()) {
                        ?>
                        <form action="" method="post" class="box">
                            <input type="hidden" name="product_id" value="<?= $fetch_products['id']; ?>">

                            <?php if ($fetch_products['image'] != '') { ?>
                                <img src="../uploaded_files/<?= $fetch_products['image']; ?>" class="image">
                            <?php } ?>

                            <div class="status"
                                style="color: <?php echo ($fetch_products['status'] == 'active') ? 'limegreen' : 'coral'; ?>;">
                                <?= $fetch_products['status']; ?>
                            </div>

                            <div class="price">$
                                <?= $fetch_products['price']; ?>/-
                            </div>

                            <div class="content">
                                <img src="../image/shape-19.png" class="shap">
                                <div class="title">
                                    <?= $fetch_products['name']; ?>
                                </div>
                                <div class="flex-btn">
                                    <a href="Edit_product_view.php?id=<?= $fetch_products['id']; ?>" class="btn">edit</a>
                                    <button type="submit" name="delete" class="btn"
                                        onclick="return confirm('delete this product?');">delete</button>
                                    <a href="Read_product_view.php?post_id=<?= $fetch_products['id']; ?>" class="btn">read</a>
                                </div>
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