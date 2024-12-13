<?php
// Include database connection
include 'db.php';

$error = null;
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    // Check if fields are empty
    if (empty($username) || empty($password)) {
        $error = "Username and password are required.";
    } else {
        // Query to find user
        $sql = "SELECT * FROM User WHERE username = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows === 1) {
            $user = $result->fetch_assoc();
            // Verify password
            if (password_verify($password, $user['password'])) {
                session_start();
                $_SESSION['userid'] = $user['userid'];
                $_SESSION['username'] = $user['username'];
                $_SESSION['role'] = $user['role'];
                echo json_encode(['status' => 'success']);
                exit;
            } else {
                $error = "Invalid password.";
            }
        } else {
            $error = "User not found.";
        }
    }

    // Return error as JSON
    echo json_encode(['status' => 'error', 'message' => $error]);
    exit;
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
          <label for="name">Username</label>
          <input id="name" type="text" placeholder="username" />
          <label for="pass">Password</label>
          <input id="pass" type="password" placeholder="password" />
        </div>
        <?php if ($error): ?>
          <p id="error" style="color: red;"><?php echo $error; ?></p>
          <?php endif; ?>
          <p id="error" style="color: red;"></p>
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
