<?php
session_start();
include('db.php'); //povezivanje s bazom
$status="";
if (isset($_POST['code']) && $_POST['code']!=""){
$code = $_POST['code'];
$result = mysqli_query(
$con,
"SELECT * FROM `products` WHERE `code`='$code'"
);
$row = mysqli_fetch_assoc($result);
$name = $row['name'];
$code = $row['code'];
$price = $row['price'];
$image = $row['image'];

$cartArray = array(
	$code=>array(
	'name'=>$name,
	'code'=>$code,
	'price'=>$price,
	'quantity'=>1,
	'image'=>$image)
);

}

  $user_id = session_id();

  $query = "SELECT SUM(quantity) as total_quantity FROM `cart` WHERE `user_id`='$user_id'";
  $result = mysqli_query($con, $query);
  $row = mysqli_fetch_assoc($result);
  $totalQuantity = $row['total_quantity'] + 0;
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8" />
    <title>Web Shop</title>
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
  
    <div class="items-grid">
    <?php
      $product_result = mysqli_query($con, "SELECT * FROM `products`");
      while($product_row = mysqli_fetch_assoc($product_result)){
      ?>

    <div class="item">
        <form method="post" action="">
            <input type="hidden" name="code" value="<?php echo $product_row["code"]; ?>" />
            <div class="product-image"><img src="<?php echo $product_row["image"]; ?>" /></div>
            <div class="product-name"><?php echo $product_row["name"]; ?></div>
            <div class="product-price"><?php echo "$".$product_row["price"]; ?></div>
            <a href="product.php?code=<?php echo $product_row["code"]; ?>">
                <button type="button" class="buy-btn">Select</button>
            </a>
        </form>
    </div>

      <?php
      }
?>
    </div>

  <footer>
    <div class="footer-holder">
      <p>Web LV3</p>
      <div>
        <p>Made by: Drazen Bertic</p>
        <a href="https://www.freepik.com/free-vector/collection-mixed-pixelated-fruits_2632371.htm#query=pixel%20fruit&position=30&from_view=keyword&track=ais">Images by rawpixel.com</a>
      </div>
    </div>
  </footer>

</html>