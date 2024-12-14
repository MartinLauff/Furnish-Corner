<?php
// Include database connection
include 'db.php';

$error = null;
$success = null;

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Collect and sanitize input
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);
    $confirmPassword = trim($_POST['confirmpassword']);

    // Basic validation
    if (empty($username) || empty($password) || empty($confirmPassword)) {
        $error = "All fields are required.";
    } elseif ($password !== $confirmPassword) {
        $error = "Passwords do not match.";
    } elseif (strlen($password) < 8) {
        $error = "Password must be at least 8 characters long.";
    } else {
        // Check if the username already exists
        $sql = "SELECT * FROM User WHERE name = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $error = "Username is already taken.";
        } else {
            // Insert the new user into the database
            $sql = "INSERT INTO User (name, password,  role, isLogged) VALUES (?, ?, 'customer', TRUE)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ss", $username, $password);

            if ($stmt->execute()) {
               // Get the ID of the newly inserted user
              $userid = $conn->insert_id;

              // Retrieve the full user data
              $sql = "SELECT * FROM User WHERE userid = ?";
              $stmt = $conn->prepare($sql);
              $stmt->bind_param("i", $userid);
              $stmt->execute();
              $result = $stmt->get_result();

              if ($result->num_rows === 1) {
                  $user = $result->fetch_assoc();

                  // Start session and store user info
                  session_start();
                  $_SESSION['userid'] = $user['userid'];
                  $_SESSION['username'] = $user['name'];
                  $_SESSION['role'] = $user['role'];

                  $success = "Account created successfully. You are now logged in.";
              } else {
                  $error = "An error occurred while retrieving your account. Please log in.";
              }
            } else {
                $error = "An error occurred. Please try again.";
            }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" type="text/css" href="style.css" />
    <link rel="stylesheet" type="text/css" href="mystyle.css" />
    <title>Registration</title>
  </head>
  <body>
    <div class="top-bar">
      <h1>Create New Account!</h1>
      <div class="navCorner">
        <div class="theme-setting">
          <input id="theme-checkbox" onchange="setTheme(event)" type="checkbox" />
        </div>
      </div>
    </div>
    <div class="wrapper">
      <form id="registerForm" method="POST" action="registration.php">
        <div class="formGrid">
          <label for="username">Username</label>
          <input type="text" id="username" name="username" placeholder="username" />
          <label for="password">Enter password</label>
          <input type="password" id="password" name="password" placeholder="password" />
          <label for="confirmpassword">Confirm password</label>
          <input
            type="password"
            id="confirmpassword"
            name="confirmpassword"
            placeholder="confirm password"
          />
        </div>
        <?php if ($error): ?>
          <p id="error" style="color: red;"><?php echo $error; ?></p>
        <?php elseif ($success): ?>
          <p id="success" style="color: green;"><?php echo $success; ?></p>
        <?php endif; ?>
        <p id="error"></p>
        <input type="submit" value="Submit" />
      </form>
      <div class="links">
        <a href="login.php">Back to login</a>
      </div>
    </div>
    <script src="script.js"></script>
  </body>
</html>
