<?php include '../php/Contact_controller.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ice Cream Delights - Contact Us</title>

    <link rel="stylesheet" type="text/css" href="../css/User_style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
    <link rel="stylesheet" href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css">
</head>

<body>

<?php include '../html/User_header.php'; ?>

<div class="banner">
    <div class="detail">
        <h1>Contact Us Page</h1>
        <p>Have any questions or need support? Feel free to reach out to us . <br> Our team is here to help
         with any inquiries or assistance you need.</p>
        <span>
            <a href="Home.php">Home</a>
            <i class="bx bx-right-arrow-alt"></i> Contact Us Page
        </span>
    </div>
</div>

<div class="services">
    <div class="heading">
        <h1>Our Services</h1>
        <p>Just a few clicks to purchase products from us, saving your time and money</p>
        <img src="../image/separator-img.png">
    </div>

    <div class="box-container">
        <div class="box">
            <img src="../image/0.png">
            <h1>Free Shipping Fast</h1>
            <p>Enjoy fast and free delivery on all orders, ensuring you recieve your products quickly and
            with no additional cost.</p>
        </div>

        <div class="box">
            <img src="../image/1.png">
            <h1>Money Back & Guarantee</h1>
            <p>Your satisfaction is our priority. If you're not completely satisfied with your purchase, we offer a hassle-free money-back guarantee.</p>
        </div>

        <div class="box">
            <img src="../image/2.png">
            <h1>Online Support 24/7 Support</h1>
            <p>Our support team is available 24/7 to assist you with any questions or concerns you may have.</p>
        </div>
    </div>
</div>

<div class="form-container">
    <div class="heading">
        <h1>Drop Us a Line</h1>
        <p>Just a few clicks away from getting in touch.</p>
        <img src="../image/separator-img.png">
    </div>

    <form method="post" class="register">
        <div class="input-field">
            <label>Name<sup>*</sup></label>
            <input type="text" name="name" required placeholder="Enter your name" class="box">
        </div>

        <div class="input-field">
            <label>Email<sup>*</sup></label>
            <input type="email" name="email" required placeholder="Enter your email" class="box">
        </div>

        <div class="input-field">
            <label>Subject<sup>*</sup></label>
            <input type="text" name="subject" required placeholder="Reason..." class="box">
        </div>

        <div class="input-field">
            <label>Comment<sup>*</sup></label>
            <textarea name="message" cols="30" rows="10" required placeholder="Your Comment..." class="box"></textarea>
        </div>

        <button type="submit" name="send_message" class="btn">Send Message</button>
    </form>
</div>

<div class="address">
    <div class="heading">
        <h1>Our Contact Details</h1>
        <p>Just a few clicks to purchase products from us.</p>
        <img src="../image/separator-img.png">
    </div>

    <div class="box-container">
        <div class="box">
            <i class="bx bxs-map-alt"></i>
            <div>
                <h4>Address</h4>
                <p>132, My Street<br>Kingston, New York 12401</p>
            </div>
        </div>

        <div class="box">
            <i class="bx bxs-phone-incoming"></i>
            <div>
                <h4>Phone Number</h4>
                <p>(+1) 331-233-0909</p>
                <p>(+1) 331-333-0910</p>
            </div>
        </div>

        <div class="box">
            <i class="bx bxs-envelope"></i>
            <div>
                <h4>Email</h4>
                <p>Farhana18@gmail.com</p>
                <p>Farhana18@gmail.com</p>
            </div>
        </div>
    </div>
</div>

<?php include '../html/Footer.php'; ?>

<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
<?php include '../php/Alert.php'; ?>

</body>
</html>