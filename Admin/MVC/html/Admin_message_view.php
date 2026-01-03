<?php include '../php/Admin_message_controller.php'; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Ice Cream Delights - Admin Messages</title>
    <link rel="stylesheet" type="text/css" href="../css/Admin_style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">

    <!--Boxicons  CDN link -->
    <link rel="stylesheet" href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css">
</head>

<body>
    <div class="main-container">
        <?php include 'Admin_header.php'; ?>

        <section class="message-container">

            <div class="heading">
                <h1>Unread messages</h1>
                <img src="../image/separator-img.png">
            </div>

            <div class="box-container">
                <?php
                $select_message = $conn->prepare("SELECT * FROM `message` ");
                $select_message->execute();
                $result_message = $select_message->get_result();

                if ($result_message->num_rows > 0) {
                    while ($fetch_message = $result_message->fetch_assoc()) {
                        ?>

                        <div class="box">
                            <h3 class="name">
                                <?= $fetch_message['name']; ?>
                            </h3>
                            <h4>
                                <?= $fetch_message['subject']; ?>
                            </h4>
                            <p>
                                <?= $fetch_message['message']; ?>
                            </p>
                            <form action="" method="post">
                                <input type="hidden" name="delete_id" value="<?= $fetch_message['id']; ?>">
                                <input type="submit" name="delete_msg" value="Delete Message" class="btn" onclick="return confirm('
                      Delete this message?');">
                            </form>
                        </div>
                        <?php
                    }
                } else {
                    echo '<div class="empty">
              <p>No unread message yet!</p>
              </div>';
                }
                ?>
            </div>
        </section>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
    <?php include 'Alert.php'; ?>
    <!--custom js link -->
    <script src="../js/Admin_script.js"></script>


</body>

</html>