<?php
  session_start();
  include('db.php');

  $user_id = session_id();

  if (isset($_POST['product_code']) && isset($_POST['quantity'])) {
    $product_code = mysqli_real_escape_string($con, $_POST['product_code']);
    $quantity = intval($_POST['quantity']);

    $query = "UPDATE `cart` SET `quantity`='$quantity' WHERE `product_code`='$product_code' AND `user_id`='$user_id'";

    if (mysqli_query($con, $query)) {
      header("Location: cart.php");
    } else {
      echo "Error: " . $query . "<br>" . mysqli_error($con);
    }
  }
?>
