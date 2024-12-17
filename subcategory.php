<?php
// Include database connection
include 'db.php';

$subCategory = null;
$products = null;
$errorElement = '<div class="link-error" style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%);display: flex;align-items: center;flex-direction: column;"><h2 style="margin-left: 0">Invalid URL</h2><a href=/myWebShop>Go Back</a></div>';

// Check URL parameters for 'catid' category id
if (isset($_GET['subid'])) {
  $subid = $_GET['subid'];
  if (empty($subid)) {
      echo $errorElement;
  } else {
      // Fetch category and subcategories with one query
    $sql = "
          SELECT 
              s.name AS category_name,
              s.description,
              s.categoryid, 
              pb.name, 
              pb.short_description, 
              pb.pid,
              pb.price
          FROM 
              Subcategory s
          LEFT JOIN ProductBase pb 
              ON s.subid = pb.subid
          WHERE 
              s.subid = ?;
      ";
      $stmt = $conn->prepare($sql);
      $stmt->bind_param("i", $subid);
      $stmt->execute();
      $products = $stmt->get_result();
      if ($products->num_rows === 0) {
        echo $errorElement; // Show error if no category or products are found
        exit;
    }

    // Fetch the first row to get category details
    $firstRow = $products->fetch_assoc();
  }
}

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" type="text/css" href="style.css" />
    <link rel="stylesheet" type="text/css" href="mystyle.css" />
    <title><?php echo $firstRow['category_name']; ?> Category</title>
    <script>
      const isLoggedIn = <?php echo json_encode($isLoggedIn); ?>;
      const isCartFull = <?php echo json_encode($isCartFull); ?>;
    </script>
  </head>
  <body>
    <div class="top-bar">
      <h1>Wellcome to our <?php echo $firstRow['category_name']; ?> assortmant</h1>
      <div class="navCorner">
        <div class="theme-setting">
          <input id="theme-checkbox" onchange="setTheme(event)" type="checkbox" />
        </div>
      </div>
    </div>
    <div class="wrapper">
      <div>
        <p>
        <?php echo $firstRow['description']; ?><br />
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
          <?php
            $products->data_seek(0);
            while ($row = $products->fetch_assoc()) {
                if (!empty($row['name'])) {
                  echo "<tr>";
                  echo "<td id='" . $row['pid'] . "-name' align='left'><b>" . $row['name'] . "</b></td>";
                  echo "<td id='" . $row['pid'] . "-description' align='left'>" . $row['short_description'] . "</td>";
                  echo "<td id='" . $row['pid'] . "-price'>" . $row['price'] . "€</td>";
                  echo "<td><a href='/myWebShop/product.php?pid=" . $row['pid'] . "'>See more</a></td>";
                  echo "<td id='" . $row['pid'] . "' align='center'>0</td>";
                  echo "<td align='center'>";
                  echo "<button onclick=\"setItemCount('add', " . $row['pid'] . ")\">+</button>";
                  echo "<button onclick=\"setItemCount('sub', " . $row['pid'] . ")\">-</button>";
                  echo "</td>";
                  echo "</tr>";                  
                }
            }
          ?>
        </table>
      </div>
      <hr />
      <div class="links">
      <a href="/myWebShop/category.php?catid=<?php echo $firstRow['categoryid']; ?>">Go Back</a>
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
    <script src="script.js">
    </script>
  </body>
</html>