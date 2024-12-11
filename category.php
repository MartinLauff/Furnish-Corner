<?php
// Include database connection
include 'db.php';

$subCategories = null;
$category = null;
$errorElement = '<div class="link-error" style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%);display: flex;align-items: center;flex-direction: column;"><h2 style="margin-left: 0">Invalid URL</h2><a href=/myWebShop>Go Back</a></div>';

// Check URL parameters for 'catid' category id
if (isset($_GET['catid'])) {
  $catid = $_GET['catid'];
  if (empty($catid)) {
      echo $errorElement;
  } else {
      // Fetch category and subcategories with one query
    $sql = "
          SELECT 
              c.name AS category_name, 
              s.subid, 
              s.name AS subcategory_name, 
              s.description
          FROM 
              Category c
          LEFT JOIN 
              Subcategory s ON c.catid = s.categoryid
          WHERE 
              c.catid = ?;
      ";
      $stmt = $conn->prepare($sql);
      $stmt->bind_param("i", $catid);
      $stmt->execute();
      $categoryAndSubcategories = $stmt->get_result();
      if ($categoryAndSubcategories->num_rows === 0) {
        echo $errorElement; // Show error if no category or subcategories are found
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
    <title>
    <?php 
      // Fetch the first row to display the category name in the title
      $firstRow = $categoryAndSubcategories->fetch_assoc();
      echo $firstRow['category_name'] . " Category"; 
      $categoryAndSubcategories->data_seek(0); // Reset result pointer for further use
      ?>
    </title>
  </head>
  <body>
    <div class="top-bar">
      <h1>Define Your <?php echo $firstRow['category_name']; ?></h1>
      <div class="theme-setting">
        <input id="theme-checkbox" onchange="setTheme(event)" type="checkbox" />
      </div>
    </div>
    <div class="wrapper">
      <div>
        <p>
          Here You can find all the things for Your <?php echo $firstRow['category_name']; ?><br />
          <br />
          View our products: <br />
        </p>
      </div>
      <table>
        <tr>
          <th align="left">Category</th>
          <th align="left">Decription</th>
          <th></th>
        </tr>
        <?php
        while ($row = $categoryAndSubcategories->fetch_assoc()) {
            if (!empty($row['subcategory_name'])) {
                echo "<tr>";
                echo "<td align='left'><b>" . $row['subcategory_name'] . "</b></td>";
                echo "<td align='left'>" . $row['description'] . "</td>";
                echo "<td><a href='subcategory.php?subid=" . $row['subid'] . "'>See more</a></td>";
                echo "</tr>";
            }
        }
        ?>
      </table>
      <hr />
      <a href="/myWebShop">Go Back</a>
    </div>
    <script src="script.js"></script>
  </body>
</html>
<?php
// Close the database connection
$conn->close();
?>