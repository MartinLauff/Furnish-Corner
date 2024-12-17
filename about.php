<?php
// Include database connection
include 'db.php';
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" type="text/css" href="style.css" />
    <link rel="stylesheet" type="text/css" href="mystyle.css" />
    <title>About Furnish Corner</title>
    <script>
      const isLoggedIn = <?php echo json_encode($isLoggedIn); ?>;
      const isCartFull = <?php echo json_encode($isCartFull); ?>;
    </script>
  </head>
  <body>
    <div class="top-bar">
      <h1>About us</h1>
      <div class="navCorner">
        <div class="theme-setting">
          <input id="theme-checkbox" onchange="setTheme(event)" type="checkbox" />
        </div>
      </div>
    </div>
    <div class="wrapper">
      <strong>Welcome to our company</strong>
      <p>
        The Furnish Corner was webshop created for Web Technologies practical
        course in 2024
      </p>
      <a href="index.php">Return home</a>
      <span>Tel. no.:</span>
      <a href="tel:+1234567890">+49 1234567890</a>
      <span>Email: </span>
      <a href="mailto:samplemail@example.com">samplemail@example.com</a>
    </div>
    <script src="script.js">
    </script>
  </body>
</html>
