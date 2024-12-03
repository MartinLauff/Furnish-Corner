<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" type="text/css" href="../../style.css" />
    <link rel="stylesheet" type="text/css" href="../../mystyle.css" />
  </head>
  <body>
    <div class="top-bar">
      <h1>Wellcome to our Beds assortmant</h1>
      <div class="theme-setting">
        <input id="theme-checkbox" onchange="setTheme(event)" type="checkbox" />
      </div>
    </div>
    <div class="wrapper">
      <div>
        <p>
          Here you can find a comfortable bed that matches your expectations and
          fits perfectly to your bedroom<br />
          <br />
          View our products: <br />
        </p>
      </div>
      <div>
        <table id="bedsList">
          <tr>
            <th align="left">Product</th>
            <th align="left">Decription</th>
            <th>Size</th>
            <th>Price</th>
            <th>Links</th>
            <th>Count</th>
            <th>Add to collection list</th>
          </tr>
          <tr>
            <td id="kidsBed-name" align="left"><b>Kids Bed</b></td>
            <td id="kidsBed-description" align="left">
              Bed frame with storage
            </td>
            <td>90x200cm</td>
            <td id="kidsBed-price">219.99€</td>
            <td>
              <a href="/myWebShop/product.php?pid=4">See more</a>
            </td>
            <td id="kidsBed" align="center">0</td>
            <td align="center">
              <button onclick='setItemCount("add", "kidsBed")'>+</button>
              <button onclick='setItemCount("sub", "kidsBed")'>-</button>
            </td>
          </tr>
          <tr>
            <td id="doubleBed-name" align="left"><b>Double Bed</b></td>
            <td id="doubleBed-description" align="left">
              Large bed frame with padded headbord
            </td>
            <td>160x200cm</td>
            <td id="doubleBed-price">549.99€</td>
            <td>
              <a href="/myWebShop/product.php?pid=3">See more</a>
            </td>
            <td id="doubleBed" align="center">0</td>
            <td align="center">
              <button onclick='setItemCount("add", "doubleBed")'>+</button>
              <button onclick='setItemCount("sub", "doubleBed")'>-</button>
            </td>
          </tr>
        </table>
      </div>
      <hr />
      <div class="links">
        <a href="/myWebShop/bedroom/bedroomList.php">Go Back</a>
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
    <script src="../../script.js"></script>
  </body>
</html>
