<?php
// Include database connection
include 'db.php';

$userid = $_SESSION['userid'];
$successMessage = '';
$errorMessage = '';

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name']);
    $password = trim($_POST['pass']);

    if (!empty($name) && !empty($password)) {
        // Update user data in the database
        $updateSql = "UPDATE User SET name = ?, password = ? WHERE userid = ?";
        $stmt = $conn->prepare($updateSql);
        $stmt->bind_param("ssi", $name, $password, $userid);

        if ($stmt->execute()) {
            $successMessage = "Your profile has been updated successfully.";
            $_SESSION['username'] = $name; // Update session username
        } else {
            $errorMessage = "Error updating profile: " . $conn->error;
        }
    } else {
        $errorMessage = "Both fields are required.";
    }
}

// Fetch the current user data
$userSql = "SELECT name FROM User WHERE userid = ?";
$stmt = $conn->prepare($userSql);
$stmt->bind_param("i", $userid);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $user = $result->fetch_assoc();
} else {
    die("User not found.");
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
  </head>
  <body>
    <div class="top-bar">
      <h1>Profile Information</h1>
      <div class="navCorner">
        <div class="theme-setting">
          <input id="theme-checkbox" onchange="setTheme(event)" type="checkbox" />
        </div>
      </div>
    </div>
    <div class="wrapper">
      <h2>Edit Your Profile</h2>
      <?php if ($successMessage): ?>
        <h3 style="color: green;" class="success-message"><?php echo $successMessage; ?></h3>
      <?php elseif ($errorMessage): ?>
        <h3 style="color: red;" class="error-message"><?php echo $errorMessage; ?></h3>
      <?php endif; ?>

      <form id="editForm" method="POST" action="customer.php">
        <div class="formGrid">
          <label for="name">Username</label>
          <input
            id="name"
            type="text"
            placeholder="username"
            name="name"
            value="<?php echo $user['name']; ?>"
          />
          <label for="pass">Password</label>
          <input
            id="password"
            type="password"
            placeholder="password"
            name="pass"
          />
        </div>
        <input type="submit" value="Edit" />
      </form>
      <br>
      <br>
      <div class="links">
        <a href="index.php">Return home</a>
        <a href="logout.php">Log out</a>
        <a href="shoppingCart.php">Shopping cart</a>
      </div>
    </div>
    <script src="script.js"></script>
  </body>
</html>
