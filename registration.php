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
      <div class="theme-setting">
        <input id="theme-checkbox" onchange="setTheme(event)" type="checkbox" />
      </div>
    </div>
    <div class="wrapper">
      <form id="registerForm">
        <div class="formGrid">
          <label for="username">Username</label>
          <input type="text" id="username" placeholder="username" />
          <label for="password">Enter password</label>
          <input type="password" id="password" placeholder="password" />
          <label for="confirmpassword">Confirm password</label>
          <input
            type="password"
            id="confirmpassword"
            placeholder="confirm password"
          />
        </div>
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
