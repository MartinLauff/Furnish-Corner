<?php
// Include database connection
include 'db.php';

// Fetch user ID from session
$userid = $_SESSION['userid'];
$msg = '';

// Check if a cancel request is made
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['cancel_order_id'])) {
    $cancelOrderId = $_POST['cancel_order_id'];
    $updateSql = "UPDATE `OrderV1` SET orderStatus = 'Cancelled' WHERE orderid = ? AND userid = ?";
    $stmt = $conn->prepare($updateSql);
    $stmt->bind_param("ii", $cancelOrderId, $userid);
    if ($stmt->execute()) {
        $msg = "<h2 style='color: green;'>Order #$cancelOrderId has been cancelled.</h2>";
    } else {
        $msg = "<h2 style='color: red;'>Error cancelling order: " . $conn->error . "</h2>";
    }
}

// Fetch orders from the Order table
$sql = "
    SELECT 
        orderid,
        orderDate,
        totalPrice,
        orderStatus
    FROM 
        `OrderV1`
    WHERE 
        userid = ?
    ORDER BY 
        orderDate DESC
";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $userid);
$stmt->execute();
$result = $stmt->get_result();
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Orders</title>
    <link rel="stylesheet" type="text/css" href="style.css" />
    <link rel="stylesheet" type="text/css" href="mystyle.css" />
    <script>
      const isLoggedIn = <?php echo json_encode($isLoggedIn); ?>;
      const isCartFull = <?php echo json_encode($isCartFull); ?>;
    </script>
  </head>
  <body>
    <div class="top-bar">
      <h1>My Orders</h1>
      <div class="navCorner">
        <div class="theme-setting">
          <input id="theme-checkbox" onchange="setTheme(event)" type="checkbox" />
        </div>
      </div>
    </div>
    <div class="wrapper">
        <div class="order-list">
        <?php if ($result->num_rows > 0): ?>
                <table border="1">
                    <tr>
                        <th>Order ID</th>
                        <th>Date</th>
                        <th>Total Price</th>
                        <th>Status</th>
                        <th>Link</th>
                        <th>Actions</th>
                    </tr>
                    <?php while ($row = $result->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo $row['orderid']; ?></td>
                            <td><?php echo $row['orderDate']; ?></td>
                            <td><?php echo number_format($row['totalPrice'], 2); ?> €</td>
                            <td><?php echo $row['orderStatus']; ?></td>
                            <td>
                                <a href="order.php?orderid=<?php echo $row['orderid']; ?>">
                                    Open
                                </a>    
                            <td>
                                <?php if ($row['orderStatus'] !== 'Cancelled'): ?>
                                    <form method="POST" action="">
                                        <input type="hidden" name="cancel_order_id" value="<?php echo $row['orderid']; ?>" />
                                        <input type="submit" value="Cancel" style="margin: 0;"/>
                                    </form>
                                <?php else: ?>
                                    <span>Cancelled</span>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </table>
            <?php else: ?>
                <p>You have no orders.</p>
            <?php endif; ?>
            <?php if(isset($msg)): ?>
                <?php echo $msg; ?>    
            <?php endif; ?>
        </div>
      <div class="links">
        <a href="index.php">Return home</a>
        <a href="shoppingCart.php">Shopping cart</a>
      </div>
    </div>
    <script src="script.js">
    </script>
  </body>
</html>