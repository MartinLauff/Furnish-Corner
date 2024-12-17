<?php
// Include database connection
include 'db.php';

$error = null;
$success = null;
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    // Check if fields are empty
    if (empty($username) || empty($password)) {
        $error = "Username and password are required.";
    } else {
        // Query to find user
        $sql = "SELECT * FROM User WHERE name = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows === 1) {
            $user = $result->fetch_assoc();
            // Verify password
            if ($password === $user['password']) {
                // Update `isLogged` to TRUE
                $updateSql = "UPDATE User SET isLogged = TRUE WHERE userid = ?";
                $updateStmt = $conn->prepare($updateSql);
                $updateStmt->bind_param("i", $user['userid']);
                $updateStmt->execute();

                // Start session and store user info
                // session_start();
                $_SESSION['userid'] = $user['userid'];
                $_SESSION['username'] = $user['name'];
                $_SESSION['role'] = $user['role'];
                $success = "You are logged in!";
            } else {
                $error = "Invalid password.";
            }
        } else {
            $error = "User not found.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Login</title>
    <link rel="stylesheet" type="text/css" href="style.css" />
    <link rel="stylesheet" type="text/css" href="mystyle.css" />
    <script>
      const isLoggedIn = <?php echo json_encode($isLoggedIn); ?>;
      const isCartFull = <?php echo json_encode($isCartFull); ?>;
    </script>
  </head>
  <body>
    <div class="top-bar">
      <h1>Log in</h1>
      <div class="navCorner">
        <div class="theme-setting">
          <input id="theme-checkbox" onchange="setTheme(event)" type="checkbox" />
        </div>
      </div>
    </div>
    <div class="wrapper">
      <form id="loginForm" method="POST" action="login.php">
        <div class="formGrid">
          <label for="username">Username</label>
          <input id="name" name="username" type="text" placeholder="username" />
          <label for="password">Password</label>
          <input id="pass" name="password" type="password" placeholder="password" />
        </div>
        <?php if ($error): ?>
          <p id="error"><?php echo $error; ?></p>
        <?php endif; ?>
          <p id="error"></p>
        <?php if ($success): ?>
          <p id="success"><?php echo $success; ?></p>
        <?php endif; ?>
        <input type="submit" value="Submit" />
      </form>
      <div class="links">
        <a href="index.php">Return home</a>
        <a href="registration.php">Register</a>
      </div>
    </div>
    <script src="script.js"></script>
  </body>
</html>
