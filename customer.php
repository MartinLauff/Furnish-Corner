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
            value="sample username"
            />
            <label for="pass">Password</label>
            <input
            type="password"
            placeholder="password"
            disabled
            value="sample password"
            />
          </div>
          <input type="submit" value="Edit" />
      </form>
      <div class="links">
        <a href="index.php">Return home</a>
        <a href="logout.php">Log out</a>
        <a href="shoppingCart.php">Shopping cart</a>
      </div>
    </div>
    <script src="script.js"></script>
  </body>
</html>
