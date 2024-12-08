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
      <div class="theme-setting">
        <input id="theme-checkbox" onchange="setTheme(event)" type="checkbox" />
      </div>
    </div>
    <div class="wrapper">
      <form id="loginForm">
        <div class="formGrid">
          <label for="name">Username</label>
          <input id="name" type="text" placeholder="username" />
          <label for="pass">Password</label>
          <input id="pass" type="password" placeholder="password" />
        </div>
        <p id="error"></p>
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
