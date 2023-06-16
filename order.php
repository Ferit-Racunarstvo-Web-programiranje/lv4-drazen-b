<?php
    session_start();
    include('db.php');

    $user_id = session_id();

    function getTotalQuantity($con, $user_id) {
        $query = "SELECT SUM(quantity) as total_quantity FROM `cart` WHERE `user_id`='$user_id'";
        $result = mysqli_query($con, $query);
        $row = mysqli_fetch_assoc($result);
        return $row['total_quantity'] + 0;
    }

    $totalQuantity = getTotalQuantity($con, $user_id);

    $query = "SELECT c.product_code, SUM(c.quantity) as quantity, p.name, p.price, p.image 
            FROM `cart` c 
            LEFT JOIN `products` p ON c.product_code = p.code 
            WHERE c.user_id='$user_id' 
            GROUP BY c.product_code";
    $result = mysqli_query($con, $query);

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if(mysqli_num_rows($result) <= 0){
            echo "<script>alert('Cannot place order. Cart is empty!');</script>";
        }else{
            $delete_query = "DELETE FROM `cart` WHERE `user_id`='$user_id'";
            if(mysqli_query($con, $delete_query)){
                echo "<script>alert('Order is placed!');</script>";
                
                $totalQuantity = getTotalQuantity($con, $user_id);
            }else{
                echo "<script>alert('Failed to place order!');</script>";
            }
        }
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

    <?php if(isset($order_success)) echo '<p class="success-message">'.$order_success.'</p>'; ?>
    <?php if(isset($order_fail)) echo '<p class="error-message">'.$order_fail.'</p>'; ?>

    <form method="post" action="">
        <h2 class="h2-order">Shipping address:</h2>
        <input type="text" name="address" required />

        <h2 class="h2-order">Your order:</h2>
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
