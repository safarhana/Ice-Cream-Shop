<div class="products">
    <div class="box-container">
        <?php
        $select_products = $conn->prepare("SELECT * FROM `products` WHERE status= ?");
        $status = 'active';
        $select_products->bind_param("s", $status);
        $select_products->execute();
        $result_products = $select_products->get_result();

        if ($result_products->num_rows > 0) {
            while ($fetch_products = $result_products->fetch_assoc()) {
                ?>

                <form action="" method="post" class="box <?php if ($fetch_products['stock'] == 0) {
                    echo 'disabled';
                } ?>">
                    <img src="../uploaded_files/<?= $fetch_products['image']; ?>" class="image">
                    <?php if ($fetch_products['stock'] > 9) { ?>
                        <span class="stock in">In Stock</span>
                    <?php } elseif ($fetch_products['stock'] > 0) { ?>
                        <span class="stock low">Hurry, Only
                            <?= $fetch_products['stock']; ?> left!
                        </span>
                    <?php } else { ?>
                        <span class="stock out">Out of Stock</span>
                    <?php } ?>

                    <div class="content">
                        <img src="../image/shape-19.png" alt="" class="shape">
                        <div class="button">
                            <div>
                                <h3 class="name">
                                    <?= $fetch_products['name']; ?>
                                </h3>
                            </div>
                            <div>
                                <button type="submit" name="add_to_cart"><i class="bx bx-cart"></i></button>
                                <button type="submit" name="add_to_wishlist"><i class="bx bx-heart"></i></button>
                                <a href="Product_detail_view.php?pid=<?= $fetch_products['id']; ?>" class="bx bxs-show">read</a>
                            </div>
                        </div>
                        <p class="price">Price: $
                            <?= $fetch_products['price']; ?>
                        </p>
                        <input type="hidden" name="product_id" value="<?= $fetch_products['id']; ?>">
                        <div class="flex-btn">
                            <a href="checkout.php?get_id=<?= $fetch_products['id']; ?>" class="btn">Buy Now</a>
                            <input type="number" name="qty" required min="1" max="99" value="1" maxlength="2" class="qty">
                        </div>
                    </div>
                </form>
                <?php
            }
        } else {
            echo '<div class="empty">
            <p>No Products Added Yet!</p>
            </div>';
        }
        ?>
    </div>
</div>