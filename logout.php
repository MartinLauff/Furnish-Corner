<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" type="text/css" href="mystyle.css" />
    <link rel="stylesheet" type="text/css" href="style.css" />
    <title>Logout</title>
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
    <script src="script.js"></script>
  </body>
</html>
