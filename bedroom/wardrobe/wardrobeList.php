<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" type="text/css" href="../../style.css" />
    <link rel="stylesheet" type="text/css" href="../../mystyle.css" />
    <title>Wardrobes Category</title>
  </head>
  <body>
    <div class="top-bar">
      <h1>Wellcome to our Wardrobes assortmant</h1>
      <div class="theme-setting">
        <input id="theme-checkbox" onchange="setTheme(event)" type="checkbox" />
      </div>
    </div>
    <div class="wrapper">
      <div>
        <p>
          Here you can find vriaty of Warderobes to make your place more
          funtkional and oganised while impoving the rooms loocks and
          atmosphere<br />
          <br />
          View our products: <br />
        </p>
      </div>
      <div>
        <table id="wardrobeList">
          <tr>
            <th align="left">Product</th>
            <th align="left">Decription</th>
            <th>Price</th>
            <th>Links</th>
            <th>Count</th>
            <th>Add to collection list</th>
          </tr>
          <tr>
            <td id="classicWardrobe-name" align="left">
              <b>Classic Wardrobe</b>
            </td>
            <td id="classicWardrobe-description" align="left">
              Based Wardrobe made from artisan oak
            </td>
            <td id="classicWardrobe-price">249.99€</td>
            <td>
              <a href="/myWebShop/product.php?pid=1">See more</a>
            </td>
            <td id="classicWardrobe" align="center">0</td>
            <td align="center">
              <button onclick='setItemCount("add", "classicWardrobe")'>
                +
              </button>
              <button onclick='setItemCount("sub", "classicWardrobe")'>
                -
              </button>
            </td>
          </tr>
          <tr>
            <td id="closetSystem-name" align="left"><b>Closet System</b></td>
            <td id="closetSystem-description" align="left">
              A wall-to-wall wardrobe with extra containing space
            </td>
            <td id="closetSystem-price">599.99€</td>
            <td>
              <a href="/myWebShop/product.php?pid=2">See more</a>
            </td>
            <td id="closetSystem" align="center">0</td>
            <td align="center">
              <button onclick='setItemCount("add", "closetSystem")'>+</button>
              <button onclick='setItemCount("sub", "closetSystem")'>-</button>
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
