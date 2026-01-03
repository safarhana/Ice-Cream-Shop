<?php 
include 'components/Connect.php'; 

if(isset($_COOKIE['user_id'])){
    $user_id = $_COOKIE['user_id'];
}
else{
    $user_id = '';
}

if(isset($_POST['submit'])) {

  $email = $_POST['email'];
  $email = filter_var($email, FILTER_SANITIZE_STRING);

  $pass = $_POST['pass'];
  $pass = filter_var($pass, FILTER_SANITIZE_STRING);

  $hashed_pass = sha1($pass);

  // check credentials
  $select_user = $conn->prepare("SELECT * FROM `users` WHERE email = ? AND password = ?");
  $select_user->execute([$email, $hashed_pass]);

  $row = $select_user->fetch(PDO::FETCH_ASSOC);

  if($select_user->rowCount() > 0){
    setcookie('user', $row['user_id'], time() + 60 * 60 * 24 * 30, '/');
    header('Location: Home.php');
    exit();
  } else {
      $warning_msg[] = 'Incorrect email or password';
  }
} 
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Ice Cream Delights - User Login Page</title>
  <link rel="stylesheet" type="text/css" href="/Ice-Cream-Shop/css/User_style.css">
  <link rel="stylesheet" href="https://unpkg.com/swiper@7/swiper-bundle.min.css"
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">

    <!-- Boxicons CDN Link -->
    
    <link rel="stylesheet" href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css">

</head>
<body>

<?php include 'components/User_header.php'; ?>

<section class="home" id="home"></section>
    <div class="swiper home-slide">
        <div class="swiper-wrapper wrapper">
            <div class="swiper-slide slide">
                <div class="content">
                    <span>welcome to the</span>
                    <h3>Classic Ice <br><span>Cream Parlor</span></h3>
                    <p>Delight in our selection of premium ice cream, perfecly complemented by fresh berries.</p>
                    <a href="" class="btn">Order Now</a>
                </div>
                <div class="image">
                    <img src="./image/home-img-1.png" alt="">
                </div>
            </div>

            <div class="swiper-slide slide">
                <div class="content">
                    <span>welcome to the</span>
                    <h3>Classic Ice <br><span>Cream Parlor</span></h3>
                    <p>Savor our artisnal ice cream scoops served on fresh, crispy homemade waffle cones.</p>
                    <a href="" class="btn">Order Now</a>
                </div>
                <div class="image">
                    <img src="./image/home-img-2.png" alt="">
                </div>
            </div>
            
            <div class="swiper-slide slide">
                <div class="content">
                    <span>welcome to the</span>
                    <h3>Classic Ice <br><span>Cream Parlor</span></h3>
                    <p>Experience our gourmet ice cream paired with choco, caramel and fress berries.</p>
                    <a href="" class="btn">Order Now</a>
                </div>
                <div class="image">
                    <img src="./image/home-img-3.png" alt="">
                </div>
            </div>
        </div>
        <div class="swiper-pagination"></div>
    </div>
</section>

    <div class="service">
        <div class="box-container">
            <div class="box">
                <div class="icon">
                    <div class="icon-box">
                        <img src="image/services.png" class="img1">
                        <img src="image/service (1).png" class="img2">
                    </div>
                </div>
                <div class="detail">
                    <h4>delivery</h4>
                    <span>100% secure</span>
                </div>
            </div>

            <div class="box">
                <div class="icon">
                    <div class="icon-box">
                        <img src="image/service (2).png" class="img1">
                        <img src="image/service (3).png" class="img2">
                    </div>
                </div>
                <div class="detail">
                    <h4>payment</h4>
                    <span>100% secure</span>
                </div>
            </div>

            <div class="box">
                <div class="icon">
                    <div class="icon-box">
                        <img src="image/service (5).png" class="img1">
                        <img src="image/service (6).png" class="img2">
                    </div>
                </div>
                <div class="detail">
                    <h4>support</h4>
                    <span>24/7 hours</span>
                </div>
            </div>

            <div class="box">
                <div class="icon">
                    <div class="icon-box">
                        <img src="image/service (7).png" class="img1">
                        <img src="image/service (8).png" class="img2">
                    </div>
                </div>
                <div class="detail">
                    <h4>gift service</h4>
                    <span>support gift service</span>
                </div>
            </div>

            <div class="box">
                <div class="icon">
                    <div class="icon-box">
                        <img src="image/service .png" class="img1">
                        <img src="image/service (1).png" class="img2">
                    </div>
                </div>
                <div class="detail">
                    <h4>return</h4>
                    <span>7 days free return</span>
                </div>
            </div>

            <div class="box">
                <div class="icon">
                    <div class="icon-box">
                        <img src="image/service (2).png" class="img1">
                        <img src="image/service (3).png" class="img2">
                    </div>
                </div>
                <div class="detail">
                    <h4>payment</h4>
                    <span>100% secure</span>
                </div>
            </div>
        </div>
    </div>

    <div class="categories">
        <div class="heading">
            <h1>Explore Our Categories</h1>
            <img src="image/separator-img.png">
        </div>
        <div class="box-container">
            <div class="box">
                <img src="image/categories1.jpg">
                <a href="menu.php" class="btn">Sundaes</a>
            </div>
        </div>
        <div class="box-container">
            <div class="box">
                <img src="image/categories2.jpg">
                <a href="menu.php" class="btn">Ice cream cones</a>
            </div>
        </div>
        <div class="box-container">
            <div class="box">
                <img src="image/categories3.jpg">
                <a href="menu.php" class="btn">Milkshake</a>
            </div>
        </div>
        <div class="box-container">
            <div class="box">
                <img src="image/categories4.jpg">
                <a href="menu.php" class="btn">Seasonal Flavors</a>
            </div>
        </div>
    </div>

    <img src="image/menu-banner.jpg" class="menu-banner">
    <div class="taste">
        <div class="heading">
            <span>Taste</span>
            <img src="image/separator-img.png" alt="separator-img">
            <h1>Our Natural Ingredients</h1>
        </div>
        <div class="box-container">
            <div class="box vanilla">
                <img src="image/vanilla-image.webp" alt="vanilla">
                <div class="detail">
                    <h1>Vanilla</h1>
                    <p>Bourbon vanilla berries imported directly from Madagascar.</p>
                </div>
            </div>
            <div class="box chocolate">
                <img src="image/chocolate-image.webp" alt="Chocolate">
                <div class="detail">
                    <h1>Chocolate</h1>
                    <p>We are valroha partners and we use a selection of single origin and grand cru.</p>
                </div>
            </div>
            <div class="box chocolate">
                <img src="image/chocolate-image.webp" alt="Chocolate">
                <div class="detail">
                    <h1>Chocolate</h1>
                    <p>We are valroha partners and we use a selection of single origin and grand cru.</p>
                </div>
            </div>
            <div class="box milk">
                <img src="image/milk-image.webp" alt="Milk">
                <div class="detail">
                    <h1>Chocolate</h1>
                    <p>Milk from the Fucci farm of Conselic. From Jersey cows which have the characteristic</p>
                </div>
            </div>
        </div>
    </div>

    <div class="ice-container">
        <div class="overlay"></div>
        <div class="detail">
            <h1>Ice cream turns every moment<br>into something special</h1>
            <p>Discover the magic in every scoop, <br>flavors crafted to brighten your day. 
                Relish in the sweetness of cool treats, <br>made to bring smiles and joy, bite after bite.
                Let out dessets brng smile to your face and a spark to your day!
            </p>
            <a href="menu.php" class="btn">Shop Now</a>
        </div>
    </div>

    <div class="taste2">
        <div class="t-banner">
            <div class="overlay"></div>
            <div class="detail">
                <h1>savor the sweetness of life</h1>
                <p>Let out desserts bring a smile to your face and a spark to your day</p>
            </div>
        </div>
        <div class="box-container">
            <div class="box">
                <div class="box-overlay"></div>
                <img src="image/type1.webp" alt="Fruit ice Cream">
                    <div class="box-details fadeIn-bottom">
                        <h1>fruits ice cream</h1>
                        <p>find your taste for desserts</p>
                        <a href="menu.php" class="btn">explore more</a>
                    </div>
            </div>
             <div class="box">
                <div class="box-overlay"></div>
                <img src="image/type2.webp" alt="Strawberry and Lingonberry">
                    <div class="box-details fadeIn-bottom">
                        <h1>Strawberry and Lingonberry</h1>
                        <p>find your taste for desserts</p>
                        <a href="menu.php" class="btn">explore more</a>
                    </div>
            </div>

            <div class="box">
                <div class="box-overlay"></div>
                <img src="image/type3.webp" alt="Strawberry">
                    <div class="box-details fadeIn-bottom">
                        <h1>Strawberry and Coffee cookies ice cream</h1>
                        <p>find your taste for desserts</p>
                        <a href="menu.php" class="btn">explore more</a>
                    </div>
            </div>

            <div class="box">
                <div class="box-overlay"></div>
                <img src="image/type4.webp" alt="Bubble Mochi Ice Cream">
                    <div class="box-details fadeIn-bottom">
                        <h1>Bubble Mochi Ice Cream</h1>
                        <p>find your taste for desserts</p>
                        <a href="menu.php" class="btn">explore more</a>
                    </div>
            </div>

            <div class="box">
                <div class="box-overlay"></div>
                <img src="image/type5.webp" alt="Mango Ice Cream">
                    <div class="box-details fadeIn-bottom">
                        <h1>Mango Ice Cream</h1>
                        <p>find your taste for desserts</p>
                        <a href="menu.php" class="btn">explore more</a>
                    </div>
            </div>

            <div class="box">
                <div class="box-overlay"></div>
                <img src="image/type6.webp" alt="Chocolate Ice Cream">
                    <div class="box-details fadeIn-bottom">
                        <h1>Chocolate Ice Cream</h1>
                        <p>find your taste for desserts</p>
                        <a href="menu.php" class="btn">explore more</a>
                    </div>
            </div>
        </div>
    </div>

    <div class="flavor">
        <div class="box-container">
            <img src="image/left-banner.JPG" alt="promotional Banner">
            <div class="detail">
                <h1>Hot deal! Sale up to <span>20% off</span></h1>
                <p>Limited time only</p>
                <a href="menu.php" class="btn">shop now</a>
            </div>
        </div>
    </div>


  <?php include 'components/Footer.php'; ?>
  

     <script src = "/Ice-Cream-Shop/js/User_script.js"></script>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
    
    <?php include 'components/Alert.php'; ?>

</body>
</html>