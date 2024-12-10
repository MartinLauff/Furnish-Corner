<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" type="text/css" href="style.css" />
    <link rel="stylesheet" type="text/css" href="mystyle.css" />
    <title>Living Room Category</title>
  </head>
  <body>
    <div class="top-bar">
      <h1>Define Your living room</h1>
      <div class="theme-setting">
        <input id="theme-checkbox" onchange="setTheme(event)" type="checkbox" />
      </div>
    </div>
    <div class="wrapper">
      <div>
        <p>
          Here You can find all the things for Your living room<br />
          <br />
          View our products: <br />
        </p>
      </div>
      <table>
        <tr>
          <th align="left">Product</th>
          <th align="left">Decription</th>
          <th></th>
        </tr>
        <tr>
          <td align="left"><b>Devices</b></td>
          <td align="left">Devices for inproved life comfort</td>
          <td>
            <a href="devices/devicesList.php">See more</a>
          </td>
        </tr>
        <tr>
          <td align="left"><b>Couches</b></td>
          <td align="left">Couches for extra coziness</td>
          <td>
            <a href="couches/couchesList.php">See more</a>
          </td>
        </tr>
      </table>
      <hr />
      <a href="/myWebShop">Go Back</a>
    </div>
    <script src="script.js"></script>
  </body>
</html>
