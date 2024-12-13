<?php
// Include database connection
include 'db.php';

// Initialize variables
$product = null;
$errorMessage = null;
$errorElement = '<div class="link-error" style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%);display: flex;align-items: center;flex-direction: column;"><h2 style="margin-left: 0">Invalid URL</h2><a href=/myWebShop>Go Back</a></div>';

// Check URL parameters for 'pid'
if (!empty($_GET['pid'])) {
  $pid = $_GET['pid'];
  $sql = "SELECT pb.name, p.description, p.imagepath, pb.price, pb.subid
          FROM productbase pb 
          LEFT JOIN product p 
          ON pb.pid = p.pid 
          WHERE p.pid = ?";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("i", $pid);
  $stmt->execute();
  $result = $stmt->get_result();

  if ($result->num_rows > 0) {
      $product = $result->fetch_assoc();
  } else {
      $errorMessage = "Product not found!";
  }
  } elseif (!empty($_GET['pid1'])) {
    $pid1 = $_GET['pid1'];
    $sql = "SELECT pb.name, p.description, p.imagepath, pb.price, pb.subid
            FROM productbase pb 
            LEFT JOIN product p 
            ON pb.pid = p.pid 
            WHERE p.pid = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $pid1);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $product = $result->fetch_assoc();
    } else {
        $errorMessage = "Product not found!";
    }
} else {
    echo $errorElement;
    exit;
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
      <div class="navCorner">
        <div class="theme-setting">
          <input id="theme-checkbox" onchange="setTheme(event)" type="checkbox" />
        </div>
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
        <a href="/myWebShop/subcategory.php?subid=<?php echo $product['subid']?>">Go Back</a>
        <h3>Price: <?php echo $product['price']; ?>€</h3>
        <form action="addToCart.php" method="POST">
          <input type="submit" value="Add To Cart" />
        </form>
      </div>
      <?php

if (!empty($_GET)) {
  // Convert the values of $_GET into a numerically indexed array
  $values = array_values($_GET);
  
  // Display parameters starting from the second one (index 1)
  for ($i = 1; $i < count($values); $i++) {
    foreach ($products as $item) {
      if ($item['pid'] == $values[$i]) {
        $product = $item;
      }
    }
    if ($errorMessage) {
      echo <<<HTML
              <div class="error-message">
                <h2>Error</h2>
                <p>$errorMessage</p>
              </div>
              HTML;
              continue; 
            } elseif (isset($product)) {
              echo <<<HTML
              <div class="top-bar">
                <h1>{$product['name']}</h1>
              </div>
              <div class="productPersentation">
                <div class="productImg">
                  <img class="img" src="{$product['imagepath']}" alt="{$product['name']}" />
                  <span class="overlay-text">{$product['name']}</span>
                </div>
                <span class="productDescription">
                  {$product['description']}
                </span>
              </div>
              <div class="productActionBar">
                <h3>Price: {$product['price']}€</h3>
                <form action="addToCart.php" method="POST">
                  <input type="submit" value="Add To Cart" />
                </form>
              </div>
              HTML;
            }
          }
        } else {
          echo "No query parameters found!";
        }
        ?>
        <?php endif; ?>
    <script src="script.js"></script>
  </body>
</html>