<?php
// Include database connection
include 'db.php';

if (!isset($_SESSION['username'])) {
  die("You are not logged in!");
}

$username = $_SESSION['username'];


if (!empty($_POST['user_id'])) {
  $user_id = $_POST['user_id'];
};

$sql = "
          SELECT 
              o.orderid,
              u.name,
              u.userid,
              pb.name as product,
              o.quantity,
              o.orderDate,
              o.orderStatus
          FROM 
              Orders o
          LEFT JOIN ProductBase pb 
              ON o.productid = pb.subid
          LEFT JOIN User u
              ON o.userid = u.userid
          WHERE 
              o.userid = ? AND o.productid = ?
      ";

// Prepare the statement
$stmt = $conn->prepare($sql);

// Check if the statement was prepared successfully
if ($stmt) {
    // Bind parameters to the placeholders
    $stmt->bind_param("ii", $userid, $productid); // Replace $userid and $productid with appropriate variables
    
    // Execute the prepared statement
    $stmt->execute();
    
    // Get the result set
    $orders = $stmt->get_result();
} else {
    // Handle errors in preparing the statement
    echo "Error preparing statement: " . $conn->error;
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Customer</title>
    <link rel="stylesheet" type="text/css" href="style.css" />
    <link rel="stylesheet" type="text/css" href="mystyle.css" />
    <script>
      const isLoggedIn = <?php echo json_encode($isLoggedIn); ?>;
      const isCartFull = <?php echo json_encode($isCartFull); ?>;
    </script>
  </head>
  <body>
    <div class="top-bar">
      <h1>Profile information</h1>
      <div class="navCorner">
        <div class="theme-setting">
          <input id="theme-checkbox" onchange="setTheme(event)" type="checkbox" />
        </div>
      </div>
    </div>
    <div class="wrapper">
      <form id="editForm" method="PUT" action="customer.php">
        <div class="formGrid">
          <label for="name">Username</label>
          <input
            id="name"
            type="text"
            placeholder="username"
            disabled
            value="<?php echo htmlspecialchars($username); ?>"
            />
            <label for="pass">Password</label>
          </div>
          <input type="submit" value="Edit" />
      </form>
      <br>
      <br>
      <?php
      while ($row = $orders->fetch_assoc()) {
            if (!empty($row['userid'])) {
                if ($row['userid'] == $_SESSION['userid']){
                    continue;
                };
                echo "<tr>";
                echo "<td align='left'><b>" . $row['oderid'] . "</b></td>";
                echo "<td align='left'>" . $row['product'] . "</td>";
                echo "<td align='left'>" . $row['orderDate'] . "</td>";
                echo "<td align='left'>" . $row['orderStatus'] . "</td>";
                echo "<td>";
                echo "<form method='POST' action='customer.php'>";
                if ($row['orderStatus'] != 'Cancelled') {
                  echo "<input type='hidden' name='user_id' value='". $row['userid'] ."'/>";
                  echo "<input type='hidden' name='order_id' value='". $row['orderid'] ."'/>";
                  echo "<input type='hidden' name='orderstate' value='Cancelled'/>";
                  echo "<input type='submit' name='cancel' value='Cancell'/>";
                }
                echo "</form>";
                echo "</td>";
                echo "</tr>";
            }
        }
        ?>
      </table>
      <div class="links">
        <a href="index.php">Return home</a>
        <a href="logout.php">Log out</a>
        <a href="shoppingCart.php">Shopping cart</a>
      </div>
    </div>
    <script src="script.js">
    </script>
  </body>
</html>
<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $sql = "SELECT * FROM Orders WHERE orderid = ?";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->get_result();

    if (!empty($_POST['user_id'])) {
        $user_id = $_POST['user_id'];
    }
    if (!empty($_POST['orderstate'])) {
        $state = $_POST['orderstate'];
        $order_user_id = $_POST['userid'];
        $updateSql = "UPDATE Orders SET orderStatus = ? WHERE orderid = ?";
        $updateStmt = $conn->prepare($updateSql);
        $updateStmt->bind_param("si", $state, $order_id); // Bind $state and $order_id
        if ($updateStmt->execute()) {
            echo "Order updated successfully!";
        } else {
            echo "Error: " . $conn->error;
        }
    }
}
// Close the database connection
$conn->close();
?>
