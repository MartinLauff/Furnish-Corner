<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" type="text/css" href="style.css" />
    <link rel="stylesheet" type="text/css" href="mystyle.css" />
    <title>Furnish Corner</title>
  </head>
  <body>
    <div class="top-bar">
      <h1>Furnish Corner</h1>
      <div class="theme-setting">
        <input id="theme-checkbox" onchange="setTheme(event)" type="checkbox" />
      </div>
    </div>
    <p style="width: 50%">
      Transform your home with stylish, high-quality furniture for living rooms
      and bedrooms. Our collection combines comfort, functionality, and modern
      design to suit every taste. Create the perfect space to relax.
    </p>
    <nav class="navbar">
      <ul>
        <li>
          <a href="living-room/livingRoomList.php">Living Room</a>
        </li>
        <li>
          <a href="bedroom/bedroomList.php">Bedroom</a>
        </li>
        <li>
          <a href="login.php">Log in</a>
        </li>
        <li>
          <a href="customer.php">Profile</a>
        </li>
        <li>
          <a href="about.php">About</a>
        </li>
      </ul>
    </nav>
    <div class="index-grid">
      <a class="grid-item" href="product.php?pid=1">
        <img src="imgs/wardrobe.jpg" alt="wardrobe" />
        <div class="overlay-text">
          <h4>Classic Wardrobe</h4>
          <span>Perfect Blend of Style and Function for Your Bedroom</span>
        </div>
      </a>
      <a class="grid-item" href="product.php?pid=5">
        <img src="imgs/curtains.jpg" alt="curtains" />
        <div class="overlay-text">
          <h4>Smart Curtains</h4>
          <span>Smart Curtains – Where Function Meets Elegance</span>
        </div>
      </a>
      <a class="grid-item" href="product.php?pid=8">
        <img src="imgs/couch.jpg" alt="couch" />
        <div class="overlay-text">
          <h4>L-Shaped Couch</h4>
          <span>Designed for Lounging, Styled for Living</span>
        </div>
      </a>
      <a class="grid-item" href="product.php?pid=3">
        <img src="imgs/bed.webp" alt="bed" />
        <div class="overlay-text">
          <h4>Double Bed</h4>
          <span>Spacious Comfort for Restful Nights</span>
        </div>
      </a>
    </div>
    <script src="script.js"></script>
  </body>
</html>
