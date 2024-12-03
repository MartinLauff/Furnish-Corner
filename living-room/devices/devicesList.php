<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" type="text/css" href="../../style.css" />
    <link rel="stylesheet" type="text/css" href="../../mystyle.css" />
    <title>Devices Category</title>
  </head>
  <body>
    <div class="top-bar">
      <h1>Wellcome to our Devices assortmant</h1>
      <div class="theme-setting">
        <input id="theme-checkbox" onchange="setTheme(event)" type="checkbox" />
      </div>
    </div>
    <div class="wrapper">
      <div>
        <p>
          Here you can find living room devices to extend your smart home<br />
          <br />
          View our products: <br />
        </p>
      </div>
      <div>
        <table id="devicesList">
          <tr>
            <th align="left">Product</th>
            <th align="left">Decription</th>
            <th>Price</th>
            <th>Links</th>
            <th>Count</th>
            <th>Add to collection list</th>
          </tr>
          <tr>
            <td id="smartCurtains-name" align="left"><b>Smart Curtains</b></td>
            <td id="smartCurtains-description" align="left">
              Remote and time controled blinds
            </td>
            <td id="smartCurtains-price">149.00€</td>
            <td>
              <a href="/myWebShop/product.php?pid=5">See more</a>
            </td>
            <td id="smartCurtains" align="center">0</td>
            <td align="center">
              <button onclick='setItemCount("add", "smartCurtains")'>+</button>
              <button onclick='setItemCount("sub", "smartCurtains")'>-</button>
            </td>
          </tr>
          <tr>
            <td id="soundSystem-name" align="left"><b>Sound System</b></td>
            <td id="soundSystem-description" align="left">
              Sleek sound setup that blends with furnture
            </td>
            <td id="soundSystem-price">710.00€</td>
            <td>
              <a href="/myWebShop/product.php?pid=6">See more</a>
            </td>
            <td id="soundSystem" align="center">0</td>
            <td align="center">
              <button onclick='setItemCount("add", "soundSystem")'>+</button>
              <button onclick='setItemCount("sub", "soundSystem")'>-</button>
            </td>
          </tr>
        </table>
      </div>
      <hr />
      <div class="links">
        <a href="/myWebShop/living-room/livingRoomList.php">Go Back</a>
        <button onclick="deleteItems()" class="delete">Delete All Items</button>
        <div class="sum">
          <span>Sum: </span>
          <span id="sum">0.00</span>
          <span>€</span>
          <span> | Sum incl. VAT: </span>
          <span id="priceWTaxes">0.00</span>
          <span>€</span>
        </div>
      </div>
    </div>
    <div id="collectionList" class="wrapper"></div>
    <script src="script.js"></script>
  </body>
</html>
