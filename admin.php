<?php
// Include database connection
include 'db.php';

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
    <script>
      const isLoggedIn = <?php echo json_encode($isLoggedIn); ?>;
      const isCartFull = <?php echo json_encode($isCartFull); ?>;
    </script>
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
        <h3>
          Wellcome to the admin console<br />
          <br />
          Manage Users: <br />
        </h3>
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
      <hr />
      <div class="links">
        <a href="/myWebShop">Go Back</a>
        <a href="logout.php">Log out</a>
      </div>
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
                echo "<h2 style='color: green;text-align: center;'>User blocked successfully!</h2>";
              } else {
                echo "Error: " . $conn->error;
              }
            } else if ($block_user === 'Unblock'){
              $updateSql = "UPDATE User SET isBlocked = FALSE WHERE userid = ?";
              $updateStmt = $conn->prepare($updateSql);
              $updateStmt->bind_param("i", $user_id);
              if ($updateStmt->execute()) {
                echo "<h2 style='color: green;text-align: center;'>User unblocked successfully!</h2>";
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
              echo "<h2 style='color: green;text-align: center;'>Order updated successfully!</h2>";
          } else {
                  echo "Error: " . $conn->error;
          }
        }
    }
}
// Close the database connection
$conn->close();
?>

