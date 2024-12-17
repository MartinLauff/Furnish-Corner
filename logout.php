<?php
// Include database connection
include 'db.php';

if (isset($_SESSION['userid'])) {
    $userid = $_SESSION['userid'];

    // Update `isLogged` to FALSE
    $sql = "UPDATE User SET isLogged = FALSE WHERE userid = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $userid);
    $stmt->execute();
}

// Destroy session and redirect to login
session_destroy();
header("Location: login.php");
exit;
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" type="text/css" href="mystyle.css" />
    <link rel="stylesheet" type="text/css" href="style.css" />
    <title>Logout</title>
    <script>
      const isLoggedIn = <?php echo json_encode($isLoggedIn); ?>;
      const isCartFull = <?php echo json_encode($isCartFull); ?>;
    </script>
  </head>
  <body>
    <div class="top-bar">
      <h2>You are loged out of your account</h2>
      <div class="navCorner">
        <div class="theme-setting">
          <input id="theme-checkbox" onchange="setTheme(event)" type="checkbox" />
        </div>
      </div>
    </div>
    <p class="wrapper">
      You can <a href="login.php">log in</a> to an account or return to the
      <a href="index.php">home page</a>
    </p>
    <script src="script.js">
    </script>
  </body>
</html>
