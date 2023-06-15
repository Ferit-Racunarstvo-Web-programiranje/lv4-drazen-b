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

if(empty($_SESSION["shopping_cart"])) {
    $_SESSION["shopping_cart"] = $cartArray;
    $status = "<div class='box'>Product is added to your cart!</div>";
}else{
    $array_keys = array_keys($_SESSION["shopping_cart"]);
    if(in_array($code,$array_keys)) {
	$status = "<div class='box' style='color:red;'>
	Product is already added to your cart!</div>";
    } else {
    $_SESSION["shopping_cart"] = array_merge(
    $_SESSION["shopping_cart"],
    $cartArray
    );
    $status = "<div class='box'>Product is added to your cart!</div>";
	}

	}
}
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
        <h1>Web Shop</h1>
        <div class="cart-container">
          <button class="cart-button">
            Cart <span class="cart-badge">0</span>
          </button>
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
          <button type="submit" class="buy-btn">Add to Cart</button>
          </form>
      </div>

      <?php
      }
?>
    </div>
  

    <div class="modal">
      <div class="modal-content">
        <span class="close">&times;</span>
        <h2>Cart</h2>
        <ul class="cart-items"></ul>
        <p>Total: <span class="cart-total">$0.00</span></p>
        <button class="buy-btn">Buy</button>
      </div>
    </div>
    <script src="script.js"></script>
  </body>

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