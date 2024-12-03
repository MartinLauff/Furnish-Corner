<?php
// Load and decode the JSON file
$jsonData = file_get_contents('data/products.json');
if ($jsonData === false) {
    die("Error: Unable to load the JSON file!");
}

$products = json_decode($jsonData, true);
if ($products === null) {
    die("Error: Invalid JSON data!");
}

// Initialize variables
$product = null;
$categoryProducts = [];
$errorMessage = null;
$errorElement = '<a style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%);" href=/myWebShop>Go Back</a>';

// Check URL parameters for 'pid' (product) or 'category'
if (isset($_GET['pid'])) {
    $pid = $_GET['pid'];
    if (empty($pid)) {
        echo $errorElement;
    } else {
        // Find the product with the given ID
        foreach ($products as $item) {
            if ($item['pid'] == $pid) {
                $product = $item;
                break;
            }
        }
        if (!$product) {
            $errorMessage = "Product not found!";
        }
    }
}  else {
    echo $errorElement;
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" type="text/css" href="style.css" />
    <link rel="stylesheet" type="text/css" href="mystyle.css" />
    <title>
      <?php
      if (isset($product)) {
          echo $product['name'];
      } elseif (isset($category)) {
          echo "Category: $category";
      } else {
          echo "Error";
      }
      ?>
    </title>
  </head>
  <body class="productBody">
    <div class="top-bar">
      <h1><?php if($product) echo $product['name']?></h1>
      <div class="theme-setting">
        <input id="theme-checkbox" onchange="setTheme(event)" type="checkbox" />
      </div>
    </div>

    <?php if ($errorMessage): ?>
      <div class="error-message">
        <h2>Error</h2>
        <p><?php echo $errorMessage; ?></p>
      </div>
    <?php elseif (isset($product)): ?>
      <!-- Product Detail Page -->
      <div class="productPersentation">
        <div class="productImg">
          <img class="img" src="<?php echo $product['imagepath']; ?>" alt="<?php echo $product['name']; ?>" />
          <span class="overlay-text"><?php echo $product['name']; ?></span>
        </div>
        <span class="productDescription">
          <?php echo $product['description']; ?>
        </span>
      </div>
      <div class="productActionBar">
        <a href="/myWebShop/<?php echo $item['category']; ?>/<?php echo $item['subcategory']; ?>/<?php echo $item['subcategory']; ?>List.php">Go Back</a>
        <h3>Price: <?php echo $product['price']; ?>€</h3>
        <form action="addToCart.php" method="POST">
          <input type="submit" value="Add To Cart" />
        </form>
      </div>
    <?php endif; ?>
    <script src="script.js"></script>
  </body>
</html>
