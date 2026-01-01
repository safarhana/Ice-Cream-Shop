<header>
    <div class="logo">
        <img src="../image/logo.png" width="200">
    </div>

    <div class ="right">
        <div class="bx bxs-user" id="user-btn"></div>
       <div class="toggle-btn"><i class="fas fa-bars"></i></div>
    </div>

    <div class="profile-detail">

        <?php
        $select_profile = $conn->prepare("SELECT * FROM `sellers` WHERE id = ?");
        $select_profile->execute([$seller_id]);
        if($select_profile->rowCount() > 0) {
        $fetch_profile = $select_profile->fetch(PDO::FETCH_ASSOC);

        }

        ?>



        <div class="profile">
            <img src="../uploaded_files/<?=$fetch_profile['image']; ?>" class="logo-img" width="150">
            <p><?=$fetch_profile['name']; ?></p>

            <div class ="flex-btn">
                <a href="Profile.php" class="btn">profile</a>
                <a href="../components/Admin_logout.php" onclick="return confirm('logout from this website');" class="btn">logout</a>
            </div>
        </div>

        <?php  ?>

    </div>

 </header>



<div class="sidebar-container">

    <div class = "sidebar">

        <?php
        $select_profile = $conn->prepare("SELECT * FROM `sellers` WHERE id = ?");
        $select_profile->execute([$seller_id]);
        if($select_profile->rowCount() > 0){
            $fetch_profile = $select_profile->fetch(PDO::FETCH_ASSOC);
        ?>

        <div class="profile">
            <img src="../uploaded_files/<?=$fetch_profile['image']; ?>" class="logo-img" width="100">
            <p><?=$fetch_profile['name']; ?></p> </div>
        <?php } ?>



        <h5>Menu</h5>

        <div class="navbar">

            <ul>
                <li><a href="Dashboard.php"><i class="bx bxs-home-smile"></i>Dashboard</a></li>
                <li><a href="Add_products.php"><i class="bx bxs-shopping-bags"></i>Add products</a></li>
                <li><a href="View_products.php"><i class="bx bxs-food-menu"></i>View Products</a></li>
                <li><a href="User_accounts.php"><i class="bx bxs-user-detail"></i>Accounts</a></li>
                <li><a href="../components/Admin_logout.php" onclick="return confirm('logout from this website');"><i
                class="bx bxs-log-out"></i>logout</a></li> </ul>

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