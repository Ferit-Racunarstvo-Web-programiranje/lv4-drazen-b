<?php
  session_start();
  include('db.php');

  $user_id = session_id();
  
  $query = "SELECT SUM(quantity) as total_quantity FROM `cart` WHERE `user_id`='$user_id'";
  $result = mysqli_query($con, $query);
  $row = mysqli_fetch_assoc($result);
  $totalQuantity = $row['total_quantity'] + 0;

  $query = "SELECT c.product_code, SUM(c.quantity) as quantity, p.name, p.price, p.image 
          FROM `cart` c 
          LEFT JOIN `products` p ON c.product_code = p.code 
          WHERE c.user_id='$user_id' 
          GROUP BY c.product_code";
  $result = mysqli_query($con, $query);


?>

<!DOCTYPE html>
<html>
<head>
    <title>Cart</title>
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
    <h1>Cart</h1>

    <?php if(mysqli_num_rows($result) > 0) { ?>
    <table>
        <thead>
            <tr>
                <th>Product</th>
                <th>Quantity</th>
                <th>Price</th>
                <th>Total</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php while($row = mysqli_fetch_assoc($result)) { ?>
                <tr>
                    <td><?php echo $row['name']; ?></td>
                    <td>
                        <form method="post" action="update_cart.php">
                            <input type="hidden" name="product_code" value="<?php echo $row['product_code']; ?>" />
                            <input type="number" name="quantity" value="<?php echo $row['quantity']; ?>" min="1" />
                            <input type="submit" value="Update" />
                        </form>
                    </td>
                    <td><?php echo "$".$row['price']; ?></td>
                    <td><?php echo "$".($row['price'] * $row['quantity']); ?></td>
                    <td>
                        <form method="post" action="delete_from_cart.php">
                            <input type="hidden" name="product_code" value="<?php echo $row['product_code']; ?>" />
                            <input type="submit" value="Delete" />
                        </form>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
    <form method="get" action="order.php">
        <input type="submit" value="Order">
    </form>
<?php } else { ?>
    <p>Cart is empty!</p>
<?php } ?>


    </div>

</body>
</html>
