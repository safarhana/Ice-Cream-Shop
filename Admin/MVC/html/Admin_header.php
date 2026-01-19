<header>
    <div class="logo">
        <img src="../image/logo.png" width="200">
    </div>

    <div class="right">
        <div class="bx bxs-user" id="user-btn"></div>
        <div class="toggle-btn"><i class="fas fa-bars"></i></div>
    </div>

    <div class="profile-detail">

        <?php
        $select_profile = $conn->prepare("SELECT * FROM `sellers` WHERE id = ?");
        $select_profile->bind_param("s", $seller_id);
        $select_profile->execute();
        $result_profile = $select_profile->get_result();

        if ($result_profile->num_rows > 0) {
            $fetch_profile = $result_profile->fetch_assoc();
        }
        ?>

        <div class="profile">
            <img src="../uploaded_files/<?= $fetch_profile['image']; ?>" class="logo-img" width="150">
            <p>
                <?= $fetch_profile['name']; ?>
            </p>

            <div class="flex-btn">
                <a href="Profile_view.php" class="btn">profile</a>
                <a href="../php/Admin_logout.php" onclick="return confirm('logout from this website');"
                    class="btn">logout</a>
            </div>
        </div>

    </div>

</header>

<div class="sidebar-container">

    <div class="sidebar">

        <?php
        $select_profile = $conn->prepare("SELECT * FROM `sellers` WHERE id = ?");
        $select_profile->bind_param("s", $seller_id);
        $select_profile->execute();
        $result_profile = $select_profile->get_result();

        if ($result_profile->num_rows > 0) {
            $fetch_profile = $result_profile->fetch_assoc();
            ?>

            <div class="profile">
                <img src="../uploaded_files/<?= $fetch_profile['image']; ?>" class="logo-img" width="100">
                <p>
                    <?= $fetch_profile['name']; ?>
                </p>
            </div>
        <?php } ?>

        <h5>Menu</h5>

        <div class="navbar">

            <ul>
                <li><a href="Dashboard_view.php"><i class="bx bxs-home-smile"></i>Dashboard</a></li>
                <li><a href="Add_products_view.php"><i class="bx bxs-shopping-bags"></i>Add products</a></li>
                <li><a href="View_products_view.php"><i class="bx bxs-food-menu"></i>View Products</a></li>
                <li><a href="User_accounts_view.php"><i class="bx bxs-user-detail"></i>Accounts</a></li>
                <li><a href="../php/Admin_logout.php" onclick="return confirm('logout from this website');"><i
                            class="bx bxs-log-out"></i>logout</a></li>
            </ul>

        </div>

        <h5>Find Us</h5>

        <div class="social-links">
            <i class="bx bxl-facebook"></i>
            <i class="bx bxl-instagram"></i>
            <i class="bx bxl-linkedin"></i>
            <i class="bx bxl-twitter"></i>
            <i class="bx bxl-pinterest-alt"></i>

        </div>

    </div>

</div>