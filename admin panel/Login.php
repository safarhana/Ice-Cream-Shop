<?php 
include '../components/Connect.php'; 

if(isset($_POST['submit'])) {

  $email = $_POST['email'];
  $email = filter_var($email, FILTER_SANITIZE_STRING);

  $pass = $_POST['pass'];
  $pass = filter_var($pass, FILTER_SANITIZE_STRING);

  // check credentials
  $select_seller = $conn->prepare("SELECT * FROM `sellers` WHERE email = ? AND password = ?");
  $select_seller->execute([$email, $pass]);

  $row = $select_seller->fetch(PDO::FETCH_ASSOC);

  if($select_seller->rowCount() > 0){
    setcookie('seller_id', $row['id'], time() + 60 * 60 * 24 * 30, '/');
    header('Location: Dashboard.php');
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
  <title>Ice Cream Delights - Seller Login Page</title>
  <link rel="stylesheet" type="text/css" href="../css/Admin_style.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
</head>
<body>
  
  <div class="form-container">
    <form action="" method="post" enctype="multipart/form-data" class="login">
      <h2>Login Now</h2>

      <div class="input-field">
        <p>Your Email <span>*</span></p>
        <input type="email" name="email" placeholder="Enter your email" maxlength="50" required class="box">
      </div>

      <div class="input-field">
        <p>Your Password <span>*</span></p>
        <input type="password" name="pass" placeholder="Enter your password" maxlength="50" required class="box">
      </div>

      <p class="link">Do not have an account? <a href="Register.php">Register now</a></p>

      <input type="submit" name="submit" value="login now" class="btn">

    </form>
  </div>
  
  <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
  <?php include '../components/Alert.php'; ?>

</body>
</html>