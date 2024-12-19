<?php
// Include database connection
include 'db.php';

// Initialize variables
$order = null;
$orderProducts = [];
$errorMessage = null;
$errorElement = '<div class="link-error" style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%);display: flex;align-items: center;flex-direction: column;"><h2 style="margin-left: 0">Invalid URL</h2><a href=/myWebShop>Go Back</a></div>';

// Check URL parameters for 'orderid'
if (!empty($_GET['orderid'])) {
    $orderid = $_GET['orderid'];

    // Fetch order details
    $orderSql = "
        SELECT 
            o.orderid,
            o.orderDate,
            o.totalPrice,
            o.orderStatus
        FROM 
            `OrderV1` o
        WHERE 
            o.orderid = ?
    ";
    $orderStmt = $conn->prepare($orderSql);
    $orderStmt->bind_param("i", $orderid);
    $orderStmt->execute();
    $orderResult = $orderStmt->get_result();

    if ($orderResult->num_rows > 0) {
        $order = $orderResult->fetch_assoc();

        // Fetch associated products
        $productSql = "
            SELECT 
                pb.name AS productName,
                pb.price AS productPrice,
                op.quantity AS productQuantity
            FROM 
                OrderProduct op
            JOIN 
                ProductBase pb ON op.productid = pb.pid
            WHERE 
                op.orderid = ?
        ";
        $productStmt = $conn->prepare($productSql);
        $productStmt->bind_param("i", $orderid);
        $productStmt->execute();
        $productResult = $productStmt->get_result();

        while ($product = $productResult->fetch_assoc()) {
            $orderProducts[] = $product;
        }
    } else {
        $errorMessage = "Order not found!";
    }
} else {
    echo $errorElement;
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" type="text/css" href="style.css" />
    <link rel="stylesheet" type="text/css" href="mystyle.css" />
    <title>Order #<?php echo htmlspecialchars($order['orderid'] ?? 'Error'); ?></title>
  </head>
  <body>
    <div class="top-bar">
      <h1>Order Details</h1>
      <div class="navCorner">
        <div class="theme-setting">
          <input id="theme-checkbox" onchange="setTheme(event)" type="checkbox" />
        </div>
      </div>
    </div>

    <div class="wrapper">
      <?php if ($errorMessage): ?>
        <div class="error-message">
          <h2>Error</h2>
          <p><?php echo htmlspecialchars($errorMessage); ?></p>
        </div>
      <?php elseif ($order): ?>
        <!-- Order Info -->
        <div class="order-info">
          <h2>Order #<?php echo htmlspecialchars($order['orderid']); ?></h2>
          <p><strong>Date:</strong> <?php echo htmlspecialchars($order['orderDate']); ?></p>
          <p><strong>Total Price:</strong> <?php echo number_format($order['totalPrice'], 2); ?>€</p>
          <p><strong>Status:</strong> <?php echo htmlspecialchars($order['orderStatus']); ?></p>
        </div>

        <!-- Associated Products -->
        <?php if (!empty($orderProducts)): ?>
          <h3>Products in this Order:</h3>
          <table border="1">
            <tr>
              <th>Product Name</th>
              <th>Price</th>
              <th>Quantity</th>
              <th>Line Total</th>
            </tr>
            <?php foreach ($orderProducts as $product): ?>
              <tr>
                <td><?php echo htmlspecialchars($product['productName']); ?></td>
                <td><?php echo number_format($product['productPrice'], 2); ?>€</td>
                <td><?php echo htmlspecialchars($product['productQuantity']); ?></td>
                <td><?php echo number_format($product['productPrice'] * $product['productQuantity'], 2); ?>€</td>
              </tr>
            <?php endforeach; ?>
          </table>
        <?php else: ?>
          <p>No products found for this order.</p>
        <?php endif; ?>
      <?php endif; ?>

      <div class="links">
        <a href="/myWebShop">Go Back</a>
      </div>
    </div>
    <script src="script.js"></script>
  </body>
</html>
