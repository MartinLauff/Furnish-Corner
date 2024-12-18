<?php
// Include database connection
include 'db.php';

error_reporting(E_ALL);
ini_set('display_errors', 1);

$errorElement = '<div class="link-error" style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%);display: flex;align-items: center;flex-direction: column;"><h2 style="margin-left: 0">Invalid URL</h2><a href=/myWebShop>Go Back</a></div>';


if (!isset($_SESSION['username'])) {
    die("You are not logged in!");
}

$username = $_SESSION['username'];

if (!empty($_POST['user_id'])) {
  $user_id = $_POST['user_id'];
};

$sql = "
          SELECT 
              u.userid,
              u.name,
              u.role,
              u.isBlocked
          FROM 
              User u
      ";
$users = $conn->query($sql);

$sql_ord = "
          SELECT 
              o.orderid,
              us.name,
              us.userid,
              pb.name as product,
              o.quantity,
              o.orderDate,
              o.orderStatus
          FROM 
              Orders o
          LEFT JOIN ProductBase pb 
              ON o.productid = pb.subid
          LEFT JOIN User u
              ON o.userid = us.userid
          WHERE 
              o.userid = ? AND o.productid = ?
      ";
$orders = $conn->query($sql_ord);



?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" type="text/css" href="style.css" />
    <link rel="stylesheet" type="text/css" href="mystyle.css" />
    <title>
    Admin
    </title>
  </head>
  <body>
    <div class="top-bar">
      <h1>Hi <?php echo htmlspecialchars($username); ?></h1>
      <div class="navCorner">
        <div class="theme-setting">
          <input id="theme-checkbox" onchange="setTheme(event)" type="checkbox" />
        </div>
      </div>
    </div>
    <div class="wrapper">
      <div>
        <p>
          Wellcome to the admin console<br />
          <br />
          Manage Users: <br />
        </p>
      </div>
      <table>
        <tr>
          <th align="left">UserId</th>
          <th align="left">User</th>
          <th align="left">Role</th>
          <th></th>
        </tr>
        <?php
        while ($row = $users->fetch_assoc()) {
            if (!empty($row['userid'])) {
                if ($row['userid'] == $_SESSION['userid']){
                    continue;
                };
                echo "<tr>";
                echo "<td align='left'><b>" . $row['userid'] . "</b></td>";
                echo "<td align='left'>" . $row['name'] . "</td>";
                echo "<td align='left'>" . $row['role'] . "</td>";
                echo "<td>";
                echo "<form method='POST' action='admin.php'>";
                echo "<input type='hidden' name='user_id' value='". $row['userid'] ."'/>";
                if ($row['isBlocked'] == 0) {
                    $blockstate = 'Block';
                } else if ($row['isBlocked'] == 1){
                    $blockstate = 'Unblock';
                };
                echo "<input type='submit' name='block' value='". $blockstate ."'/>";
                echo "</form>";
                echo "</td>";
                echo "</tr>";
            }
        }
        ?>
      </table>
      <br>
      <br>
      <table>
        <tr>
          <th align="left">User</th>
          <th align="left">Product</th>
          <th align="left">Amount</th>
          <th align="left">Time</th>
          <th align="left">Time</th>
          <th></th>
        </tr>
        <?php
        while ($row = $orders->fetch_assoc()) {
            if (!empty($row['orderid'])) {
                echo "<tr>";
                echo "<td align='left'><b>" . $row['name'] . "</b></td>";
                echo "<td align='left'>" . $row['product'] . "</td>";
                echo "<td align='left'>" . $row['quantity'] . "</td>";
                echo "<td align='left'>" . $row['orderDate'] . "</td>";
                echo "<td>";
                echo "<form method='POST' action='admin.php'>";
                echo "<input type='hidden' name='order_id' value='". $row['orderid'] ."'/>";
                echo "<select id='dropdown' name='options'>";
                echo "<option name'orderstate' value='Pending'>Pending</option>";
                echo "<option name'orderstate' value='Processing'>Processing</option>";
                echo "<option name'orderstate' value='Cancelled'>Cancelled</option>";
                echo "</select>";
                echo "<input type='submit' name='block' value='". $blockstate ."'/>";
                echo "</form>";
                echo "</td>";
                echo "</tr>";
            }
        }
        ?>
      </table>
      <hr />
      <a href="/myWebShop">Go Back</a>
      <a href="logout.php">Log out</a>
    </div>
    <script src="script.js"></script>
  </body>
</html>
<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $sql = "SELECT * FROM User WHERE name = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();

    if (!empty($_POST['user_id'])) {
        $user_id = $_POST['user_id'];
    }

    if (!empty($_POST['block'])) {
        $block_user = $_POST['block'];
        if ($block_user === 'Block'){
            $updateSql = "UPDATE User SET isBlocked = TRUE WHERE userid = ?";
            $updateStmt = $conn->prepare($updateSql);
            $updateStmt->bind_param("i", $user_id);
            if ($updateStmt->execute()) {
                echo "User updated successfully!";
            } else {
                echo "Error: " . $conn->error;
            }
        } else if ($block_user === 'Unblock'){
            $updateSql = "UPDATE User SET isBlocked = FALSE WHERE userid = ?";
            $updateStmt = $conn->prepare($updateSql);
            $updateStmt->bind_param("i", $user_id);
            if ($updateStmt->execute()) {
                echo "User updated successfully!";
            } else {
                echo "Error: " . $conn->error;
            }
                
        }
        if (!empty($_POST['orderstate'])) {
          $state = $_POST['orderstate'];
          $order_user_id = $_POST['userid'];
          $updateSql = "UPDATE Orders SET orderStatus = $state WHERE orderid = ?";
          $updateStmt = $conn->prepare($updateSql);
          $updateStmt->bind_param("i", $order_user_id);
          if ($updateStmt->execute()) {
              echo "Order updated successfully!";
          } else {
                  echo "Error: " . $conn->error;
          }
        }
    }
}
// Close the database connection
$conn->close();
?>

