<?php
  require_once "class_autoloader.php";

  const CATEGORY_NAMES = ["PC Packages", "Monitor & Audio", "Peripherals"];
  const BRAND_NAMES = ["Asus", "MSI", "Razer", "Logitech", "Viewsonic", "Acer", "HyperX", "Steelseries", "Corsair"];
  const SORT_NAMES = ["Price low to high", "Price high to low"];
  const VIEW_NAMES = ["List"];

  /**
   * Converts database price to realistic Algerian DZD pricing
   * @param float $dbPrice Original database price
   * @param string $itemName Name of the item for category detection
   * @param string $itemBrand Brand of the item
   * @return string Formatted price in DZD
   */
  function convertToDZD($dbPrice, $itemName = "", $itemBrand = "") {
    // Pricing ranges for different product categories (in DZD)
    $pricingMap = [
      'mouse' => ['min' => 2000, 'max' => 15000],
      'keyboard' => ['min' => 5000, 'max' => 25000],
      'headset' => ['min' => 6000, 'max' => 30000],
      'mousepad' => ['min' => 1000, 'max' => 8000],
      'monitor' => ['min' => 25000, 'max' => 120000],
      'gpu' => ['min' => 50000, 'max' => 400000],
      'cpu' => ['min' => 25000, 'max' => 150000],
      'ram' => ['min' => 8000, 'max' => 60000],
      'ssd' => ['min' => 7000, 'max' => 50000],
      'psu' => ['min' => 9000, 'max' => 40000],
      'case' => ['min' => 12000, 'max' => 60000],
      'pc package' => ['min' => 150000, 'max' => 800000],
    ];

    // Detect product category from name and brand
    $lowerName = strtolower($itemName);
    $lowerBrand = strtolower($itemBrand);

    $category = 'default';
    if (strpos($lowerName, 'mouse') !== false && strpos($lowerName, 'pad') === false) {
      $category = 'mouse';
    } elseif (strpos($lowerName, 'keyboard') !== false) {
      $category = 'keyboard';
    } elseif (strpos($lowerName, 'headset') !== false || strpos($lowerName, 'headphone') !== false) {
      $category = 'headset';
    } elseif (strpos($lowerName, 'mousepad') !== false || strpos($lowerName, 'pad') !== false) {
      $category = 'mousepad';
    } elseif (strpos($lowerName, 'monitor') !== false) {
      $category = 'monitor';
    } elseif (strpos($lowerName, 'gpu') !== false || strpos($lowerName, 'graphics') !== false || strpos($lowerName, 'rtx') !== false || strpos($lowerName, 'gtx') !== false) {
      $category = 'gpu';
    } elseif (strpos($lowerName, 'cpu') !== false || strpos($lowerName, 'processor') !== false || strpos($lowerName, 'ryzen') !== false || strpos($lowerName, 'intel') !== false) {
      $category = 'cpu';
    } elseif (strpos($lowerName, 'ram') !== false || strpos($lowerName, 'memory') !== false) {
      $category = 'ram';
    } elseif (strpos($lowerName, 'ssd') !== false || strpos($lowerName, 'nvme') !== false) {
      $category = 'ssd';
    } elseif (strpos($lowerName, 'psu') !== false || strpos($lowerName, 'power supply') !== false) {
      $category = 'psu';
    } elseif (strpos($lowerName, 'case') !== false || strpos($lowerName, 'chassis') !== false) {
      $category = 'case';
    } elseif (strpos($lowerName, 'pc') !== false || strpos($lowerName, 'bundle') !== false) {
      $category = 'pc package';
    }

    // Get pricing range for category
    $range = isset($pricingMap[$category]) ? $pricingMap[$category] : ['min' => 5000, 'max' => 50000];

    // Map the database price to the realistic range using hash-based distribution
    $hashValue = crc32($itemName . $itemBrand) % 100;
    $percentage = $hashValue / 100;
    $dzPrice = $range['min'] + ($range['max'] - $range['min']) * $percentage;

    // Format with comma separator
    return number_format($dzPrice, 0, '', ',') . " DZD";
  }

  function searchItems($category, $brand, $sort){
    $searchName = "";
    if (isset($_GET["query"])) $searchName = $_GET["query"];

    /** 
     * @var Item[] $items
     */
    $sql = "SELECT ItemID FROM Items WHERE (Name LIKE '%$searchName%')";

    // only limit to a number
    if ($category != -1) $sql .= " AND Category = $category";

    if ($brand != -1){
      $brandName = BRAND_NAMES[$brand];
      $sql .= " AND Brand = '$brandName'";
    }

    if ($sort == 0) $sql .= " ORDER BY SellingPrice ASC";
    else if ($sort == 1) $sql .= " ORDER BY SellingPrice DESC";

    $sql .= " LIMIT 50";
    $conn = new Dbhandler();
    $result = $conn->conn()->query($sql) or die($conn->conn()->error);

    $items = array();

    if ($result->num_rows < 1)
      echo "<h5 class='white-text bold center' style='padding-top: 150px'>
        0 result is returned. Please try other search result as the selected products is not available</h5>";

    while ($row = $result->fetch_assoc())
    {
      $itemID = $row["ItemID"];
      array_push($items, new Item($itemID));
    }

    generateItemList($items);
  }

  /**
  * @param Item[] $items
  */
  function generateItemList($items){
    if (count($items) === 0) {
      echo "<div class='empty-results'>
        <h5>No Products Found</h5>
        <p>0 results returned. Please try other filters or search terms as the selected products are not available.</p>
      </div>";
      return;
    }

    echo "<div class='products-grid'>";

    foreach ($items as $item) {
      if ($item->getQuantityInStock() <= 0) {
        continue;
      }

      $itemID = $item->getItemID();
      $image = $item->getImage();
      $name = $item->getName();
      $brand = $item->getBrand();
      $price = $item->getSellingPrice();
      $formattedPrice = convertToDZD($price, $name, $brand);

      $hasReviews = $item->HasReviews();
      $avgRatings = $item->getAvgRatings();
      $soldCount = $item->checkSoldCount() ?? 0;

      $ratingDisplay = "No ratings";
      $ratingWidth = 0;
      $reviewCount = 0;

      if ($hasReviews) {
        $reviews = $item->GetReviews();
        $reviewCount = count($reviews);
        $intRating = $avgRatings * 5 / 100;

        if ($intRating >= 10) {
          $intRating = $intRating / $reviewCount;
          $intRating = number_format((float)$intRating, 2, '.', '');
          $ratingWidth = $intRating * 20;
        } else {
          $ratingWidth = $avgRatings;
        }

        $ratingDisplay = number_format($ratingWidth / 20, 1, '.', '');
      }

      echo "
      <div class='product-card'>
        <a href='product.php?item_id=$itemID'>
          <div class='product-image'>
            <img src='product_images/$image' alt='$name'>
          </div>
          <div class='product-info'>
            <h6 class='product-name'>$name</h6>
            <div class='product-price'>$formattedPrice</div>
            <div class='product-ratings'>
              <div class='ratings-container'>
                <span class='rating-value'>$ratingDisplay</span>
                <div class='ratings'>
                  <div class='full-stars' style='width: " . $ratingWidth . "%'></div>
                </div>";

      if ($hasReviews) {
        echo "<span class='rating-text'>$reviewCount Reviews</span>";
      } else {
        echo "<span class='rating-text'>No ratings yet</span>";
      }

      echo "
              </div>
              <div class='product-sold'>" . $soldCount . " Sold</div>
            </div>
          </div>
        </a>
      </div>";
    }

    echo "</div>";
  }