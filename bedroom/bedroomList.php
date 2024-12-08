<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Bedroom Category</title>
    <link rel="stylesheet" type="text/css" href="../style.css" />
    <link rel="stylesheet" type="text/css" href="../mystyle.css" />
  </head>
  <body>
    <div class="top-bar">
      <h1>Define Your bedroom</h1>
      <div class="theme-setting">
        <input id="theme-checkbox" onchange="setTheme(event)" type="checkbox" />
      </div>
    </div>
    <div class="wrapper">
      <div>
        <p>
          Here You can find all the things for Your bedroom<br />
          <br />
          View our products: <br />
        </p>
      </div>
      <div>
        <table>
          <tr>
            <th align="left">Product</th>
            <th align="left">Decription</th>
            <th align="left"></th>
          </tr>
          <tr>
            <td align="left"><b>Beds</b></td>
            <td align="left">Beds that match everyone</td>
            <td>
              <a href="beds/bedsList.php">See more</a>
            </td>
          </tr>
          <tr>
            <td align="left"><b>Wardrobes</b></td>
            <td align="left">Wardrobes in any sizes</td>
            <td>
              <a href="wardrobe/wardrobeList.php">See more</a>
            </td>
          </tr>
        </table>
      </div>
      <hr />
      <a href="/myWebShop">Go Back</a>
    </div>
    <script src="../script.js"></script>
  </body>
</html>
