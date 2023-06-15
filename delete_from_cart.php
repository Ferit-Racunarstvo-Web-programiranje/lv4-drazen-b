<?php
  session_start();
  include('db.php');

  $user_id = session_id();

  if (isset($_POST['product_code']) && $_POST['product_code']!="") {
    $code = mysqli_real_escape_string($con, $_POST['product_code']);

    
    $delete = "DELETE FROM `cart` WHERE `user_id`='$user_id' AND `product_code`='$code'";
    if (mysqli_query($con, $delete)) {
      echo "<script>alert('Product removed from cart!');window.location='cart.php';</script>";
    } else {
      echo "Error: " . $delete . "<br>" . mysqli_error($con);
    }

  } else {
    echo "Invalid product!";
    exit;
  }
?>
