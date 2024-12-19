<?php
// Include database connection
include 'db.php';

// Check if the cart is empty
$cart = isset($_SESSION['cart']) ? $_SESSION['cart'] : [];
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" type="text/css" href="style.css" />
    <link rel="stylesheet" type="text/css" href="mystyle.css" />
    <title>Shopping cart</title>
    <script>
      const isLoggedIn = <?php echo json_encode($isLoggedIn); ?>;
      let isCartFull = <?php echo json_encode($isCartFull); ?>;
    </script>
  </head>
  <body>
    <div class="top-bar">
      <h1>Your shopping cart</h1>
      <div class="navCorner">
        <div class="theme-setting">
          <input id="theme-checkbox" onchange="setTheme(event)" type="checkbox" />
        </div>
      </div>
    </div>
    <div class="wrapper" style="text-align: center;">
    <h2 style="margin: 0;" id="empty_cart"></h2>
    <?php if (empty($cart)): ?>
        <h2 style="margin: 0;">Your cart is empty.</h2>
    <?php else: ?>
        <table border="1">
            <tr>
                <th>Product</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Actions</th>
                <th>Remove</th>
            </tr>
            <?php 
            $grandTotal = 0;
            $amount = 0;
            foreach ($cart as $pid => $item):
                $amount += $item['quantity'];
                $price = $item['price'];
                if ($amount%10 == 0) {
                  $price = (int)$item['price']*0.9; 
                }
                $total = $price * $item['quantity'];
                $grandTotal += $total;
            ?>
                <tr data-pid="<?php echo $pid; ?>">
                    <td id="<?php echo $item['pid']; ?>-name"><?php echo $item['name']; ?></td>
                    <td id="<?php echo $item['pid']; ?>-price" align="center"><?php echo $price; ?>€</td>
                    <td id="<?php echo $item['pid']; ?>-quantity" align="center"><?php echo $item['quantity']; ?></td>
                    <td align="center">
                      <button onclick="updateQuantity('add', <?php echo $item['pid']; ?>)">+</button>
                      <button onclick="updateQuantity('sub', <?php echo $item['pid']; ?>)">-</button>
                    </td>
                    <td align="center">
                        <button onclick="removeItem(<?php echo $pid; ?>)">Delete</button>
                    </td>
                </tr>
            <?php endforeach; ?>
            <tr>
                <th colspan="3">Total</th>
                <th>
                    <span id="grandTotal">
                      <?php echo number_format($grandTotal * 1.19, 2); ?>
                    </span>
                  <span>€</span>
                </th>
                <th>
                  <span>Tax: </span>
                    <span id="taxAmount">
                      <?php echo number_format($grandTotal * 0.19, 2); ?>
                    </span>
                  <span>€</span>
                </th>
            </tr>
        </table>
    <?php endif; ?>
    <a style="margin-top: 2rem;display: inline-block;" href="customer.php">Back to profile</a>
    <?php if (!empty($cart)): ?>
      <form id="orderForm" method="POST" action="placeOrder.php">
        <input type="submit" value="Order" />
      </form>
    <?php endif; ?>
  </div>
    <script src="script.js">
    </script>
  </body>
</html>
