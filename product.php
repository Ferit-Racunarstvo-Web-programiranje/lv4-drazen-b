<?php
  session_start();
  include('db.php');

  $user_id = session_id();

  $query = "SELECT SUM(quantity) as total_quantity FROM `cart` WHERE `user_id`='$user_id'";
  $result = mysqli_query($con, $query);
  $row = mysqli_fetch_assoc($result);
  $totalQuantity = $row['total_quantity'] + 0;

  if (isset($_GET['code']) && $_GET['code']!=""){
    $code = mysqli_real_escape_string($con, $_GET['code']);
    $result = mysqli_query($con, "SELECT * FROM `products` WHERE `code`='$code'");
    
    if(mysqli_num_rows($result) > 0){
      $row = mysqli_fetch_assoc($result);
    } else {
      echo "No product found!";
      exit;
    }

    if (isset($_POST['action']) && $_POST['action']=="add") {
      $quantity = isset($_POST['quantity']) ? intval($_POST['quantity']) : 1;

      $checkQuery = "SELECT * FROM `cart` WHERE `user_id`='$user_id' AND `product_code`='$code'";
      $checkResult = mysqli_query($con, $checkQuery);
      if (mysqli_num_rows($checkResult) > 0) {
        $update = "UPDATE `cart` SET `quantity`=`quantity`+'$quantity' WHERE `user_id`='$user_id' AND `product_code`='$code'";
        if (mysqli_query($con, $update)) {
          echo "<script>alert('Product quantity updated in cart!');</script>";
        } else {
          echo "Error: " . $update . "<br>" . mysqli_error($con);
        }
      } else {
        $insert = "INSERT INTO `cart` (`user_id`, `product_code`, `quantity`) VALUES ('$user_id', '$code', '$quantity')";
        if (mysqli_query($con, $insert)) {
          echo "<script>alert('Product added to cart!');</script>";
        } else {
          echo "Error: " . $insert . "<br>" . mysqli_error($con);
        }
      }
    }

  } else {
    echo "Invalid product!";
    exit;
  }


?>




<!DOCTYPE html>
<html>
<head>
    <title>Product Details</title>
    <link rel="stylesheet" type="text/css" href="styles/style.css" />
</head>
<body>
<header>
      <div class="header-holder">
        <h1><a href="index.php">Web Shop</a></h1>
        <div class="cart-container">
                <a href="cart.php">
                    <button class="cart-button">
                        Cart <span class="cart-badge"><?php echo $totalQuantity; ?></span>
                    </button>
                </a>
            </div>
      </div>
    </header>
    
    <div id="php-elements">
    <img src="<?php echo $row["image"]; ?>" alt="<?php echo $row["name"]; ?>">

    <div class="details">
        <h1><?php echo $row["name"]; ?></h1>
        <h2>Description:</h2>
        <p><?php echo $row["description"]; ?></p>
        <h2>Price:</h2>
        <p class="product-price"><?php echo "$".$row["price"]; ?></p>
        <form method="post" action="">
            <input type="hidden" name="action" value="add" />
            <label for="quantity">Quantity:</label>
            <input type="number" id="quantity" name="quantity" value="1" min="1" />
            <input type="submit" value="Add to Cart" />
        </form>
    </div>
</div>



</body>
</html>
