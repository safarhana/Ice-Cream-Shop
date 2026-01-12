<header class="header">
    <section class="flex">
        <a href="Home_view.php" class="logo">
            <img src="../image/logo.png" width="130px">
        </a>
        <nav class="navbar">
            <a href="Home_view.php">home</a>
            <a href="About_us_view.php">about us</a>
            <a href="Menu_view.php">Shop</a>
            <a href="Orders_view.php">Order</a>
            <a href="Contact_view.php">Contact</a>
        </nav>
        <form action="Search_product_view.php" method="post" class="search-form">
            <input type="text" name="search_product" placeholder="Search product..." required maxlength="100">
            <button type="submit" class="bx bx-search-alt-2" id="search_product_btn"></button>
        </form>
        <div class="icons">
            <div class="bx bx-list-plus" id="menu-btn"></div>
            <div class="bx bx-search-alt-2" id="search-btn"></div>

            <?php
            $count_wishlist_item = $conn->prepare("SELECT * FROM `wishlist` WHERE user_id=?");
            $count_wishlist_item->bind_param("s", $user_id);
            $count_wishlist_item->execute();
            $count_wishlist_item->store_result();
            $total_wishlist_items = $count_wishlist_item->num_rows;

            ?>

            <a href="Wishlist_view.php">
                <i class="bx bx-heart"></i>
                <sup><?= $total_wishlist_items; ?></sup>
            </a>

            <?php
            $count_cart_item = $conn->prepare("SELECT * FROM `cart` WHERE user_id=?");
            $count_cart_item->bind_param("s", $user_id);
            $count_cart_item->execute();
            $count_cart_item->store_result();
            $total_cart_items = $count_cart_item->num_rows;

            ?>

            <a href="Cart_view.php">
                <i class="bx bx-cart"></i>
                <sup><?= $total_cart_items; ?></sup>
            </a>

            <div class="bx bx-user" id="user-btn"></div>
        </div>

        <div class="profile-detail">
            <?php
            $select_profile = $conn->prepare("SELECT * FROM `users` WHERE user_id=?");
            $select_profile->bind_param("s", $user_id);
            $select_profile->execute();
            $result_profile = $select_profile->get_result();

            if ($result_profile->num_rows > 0) {
                $fetch_profile = $result_profile->fetch_assoc();

                ?>

                <img src="../uploaded_files/<?= $fetch_profile['image']; ?>" alt="Profile Image">
                <h3 style="margin-bottom: 1rem;"><?= $fetch_profile['name']; ?></h3>
                <div class="flex-btn">
                    <a href="User_profile_view.php" class="btn">view profile</a>
                    <a href="../php/User_logout.php" onclick="return confirm('Logout from this website?');"
                        class="btn">logout</a>
                </div>

                <?php
            } else {
                ?>
                <h3 style="margin-bottom: 1rem;">please login or register</h3>
                <div class="flex-btn">
                    <a href="Login_view.php" class="btn">Login</a>
                    <a href="Register_view.php" class="btn">Register</a>
                </div>
                <?php
            }
            ?>
        </div>
    </section>
</header>