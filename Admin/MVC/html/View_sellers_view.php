<?php include '../php/View_sellers_controller.php'; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Ice Cream Delights - User Accounts</title>
    <link rel="stylesheet" type="text/css" href="../css/Admin_style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
    <link rel="stylesheet" href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css">
</head>

<body>
    <div class="main-container">
        <?php include 'Admin_header.php'; ?>

        <section class="user-container">
            <div class="heading">
                <h1>View Sellers</h1>
                <img src="../image/separator-img.png" alt="separator">
            </div>

            <div class="box-container">
                <?php

                $select_sellers = $conn->prepare("SELECT * FROM `sellers`");
                $select_sellers->execute();
                $result_sellers = $select_sellers->get_result();

                if ($result_sellers->num_rows > 0) {
                    while ($fetch_sellers = $result_sellers->fetch_assoc()) {
                        $user_id = $fetch_sellers['id'];
                        ?>
                        <div class="box">
                            <img src="../uploaded_files/<?= $fetch_sellers['image']; ?>" alt="Seller Image">
                            <p>Seller ID: <span>
                                    <?= htmlspecialchars($user_id); ?>
                                </span></p>
                            <p>Seller Name: <span>
                                    <?= htmlspecialchars($fetch_sellers['name']); ?>
                                </span></p>
                            <p>Seller Email: <span>
                                    <?= htmlspecialchars($fetch_sellers['email']); ?>
                                </span></p>
                        </div>
                        <?php
                    }
                } else {

                    echo '<div class="empty"><p>No users registered yet!</p></div>';
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