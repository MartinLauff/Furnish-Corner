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
    <title>Devices Category</title>
  </head>
  <body>
    <div class="top-bar">
      <h1>Wellcome to our <?php if (!empty($firstRow['category_name'])) {echo htmlspecialchars($firstRow['category_name']);} ?> assortmant</h1>
      <div class="theme-setting">
        <input id="theme-checkbox" onchange="setTheme(event)" type="checkbox" />
      </div>
    </div>
    <div class="wrapper">
      <div>
        <p>
        <?php echo htmlspecialchars($firstRow['description']); ?><br />
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
            while ($row = $products->fetch_assoc()) {
                if (!empty($row['name'])) {
                    echo "<tr>";
                    echo "<td id='smartCurtains-name' align='left'><b>". htmlspecialchars($row['name']) . "</b></td>";
                    echo "<td id='smartCurtains-description' align='left'>" . htmlspecialchars($row['short_description']) . "</td>";
                    echo "<td id='smartCurtains-price'>". htmlspecialchars($row['prive']) ."€</td>";
                    echo "<td><a href='/myWebShop/product.php?pid=". $row['pid'] ."'>See more</a></td>";
                    echo "<td id='smartCurtains' align='center'>0</td>";
                    echo "<td align='center'><button onclick='setItemCount('add', 'smartCurtains')'>+</button><button onclick='setItemCount('sub', 'smartCurtains')'>-</button></td>";
                    echo "</tr>";
                }
            }
          ?>
        </table>
      </div>
      <hr />
      <div class="links">
        <?php 
        $firstRow = $products->fetch_assoc();
        if (!empty($row['name'])) {
            echo "<a href='/myWebShop/category.php?catid=". htmlspecialchars($row['categoryid']). ">Go Back</a>";
        }
        ?>
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