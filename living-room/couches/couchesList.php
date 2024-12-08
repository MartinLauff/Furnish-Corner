<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" type="text/css" href="../../style.css" />
    <link rel="stylesheet" type="text/css" href="../../mystyle.css" />
    <title>Couches Category</title>
  </head>
  <body>
    <div class="top-bar">
      <h1>Wellcome to our Couches assortmant</h1>
      <div class="theme-setting">
        <input id="theme-checkbox" onchange="setTheme(event)" type="checkbox" />
      </div>
    </div>
    <div class="wrapper">
      <div>
        <p>
          Here you can find couches that make you don't want to leave home<br>
            <br>
            View our products: <br>
        </p>
    </div>
    <div>
        <table id="couchesList">
          <tr>
            <th align="left">Product</th>
            <th align="left">Decription</th>
            <th>Price</th>
            <th>Links</th>
            <th>Count</th>
            <th>Add to collection list</th>
          </tr>
          <tr>
            <td id="sofa-name" align="left">
              <b>Sofa</b>
            </td>
            <td id="sofa-description" align="left">Small couch to place in front of a TV</td>
            <td id="sofa-price">399.00€</td>
            <td>
              <a href="/myWebShop/product.php?pid=7">See more</a>
            </td>
            <td id="sofa" align="center">0</td>
            <td align="center">
              <button onclick='setItemCount("add", "sofa")'>+</button>
              <button onclick='setItemCount("sub", "sofa")'>-</button>
            </td>
          </tr>
          <tr>
            <td id="lSapedSectional-name" align="left"><b>L-Shaped-sectional Couch</b></t>
            <td id="lSapedSectional-description" align="left">A comfy place for a quik nap</td>
            <td id="lSapedSectional-price">1525.00€</td>
            <td>
              <a href="/myWebShop/product.php?pid=8">See more</a>
            </td>
            <td id="lSapedSectional" align="center">0</td>
            <td align="center">
              <button onclick='setItemCount("add", "lSapedSectional")'>+</button>
              <button onclick='setItemCount("sub", "lSapedSectional")'>-</button>
            </td>
          </tr>
        </table>
      </div>
      <hr>
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
    <script src="../../script.js"></script>
  </body>
</html>