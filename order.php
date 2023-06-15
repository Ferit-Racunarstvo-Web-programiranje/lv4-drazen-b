<?php
  session_start();
  include('db.php');

  $user_id = session_id();

  $query = "SELECT c.product_code, SUM(c.quantity) as quantity, p.name, p.price, p.image 
            FROM `cart` c 
            LEFT JOIN `products` p ON c.product_code = p.code 
            WHERE c.user_id='$user_id' 
            GROUP BY c.product_code";
  $result = mysqli_query($con, $query);

  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  }

?>

<!DOCTYPE html>
<html>
<head>
    <title>Order</title>
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
    <h1>Order</h1>

    <form method="post" action="">
        <h2>Shipping address:</h2>
        <input type="text" name="address" required />

        <h2>Your order:</h2>
        <?php while($row = mysqli_fetch_assoc($result)) { ?>
            <p>
                <?php echo $row['name']; ?> 
                Quantity: <?php echo $row['quantity']; ?> 
                Price: <?php echo "$".($row['price'] * $row['quantity']); ?>
            </p>
        <?php } ?>

        <input type="submit" value="Confirm Order" />
    </form>
    </div>

</body>
</html>
