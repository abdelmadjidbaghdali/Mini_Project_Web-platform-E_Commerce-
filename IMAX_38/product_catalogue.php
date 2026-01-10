<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>IMAX Tech PC - Product Catalogue</title>
  <?php 
    require_once "header.php";
    require_once "includes/product_catalogue.inc.php";
  ?>
</head>

<body>
  <main>
    <div class="catalog-wrapper">
      <!-- Sidebar Filters -->
      <aside class="catalog-filters">
        <form id="form-filter" action="" method="GET">
          <input type="hidden" name="query" value="<?php if(isset($_GET["query"])) 
            echo($_GET["query"]); ?>">

          <!-- Category Filter -->
          <div class="filter-section">
            <h5 class="filter-title">Category</h5>
            <ul id="filter_dropdown" class="dropdown-content black">
              <li><a class="cyan-text page-title" onclick="select_category(this)">Clear</a></li>
              <li><a class="cyan-text page-title" onclick="select_category(this)">PC Packages</a></li>
              <li><a class="cyan-text page-title" onclick="select_category(this)">Monitor & Audio</a></li>
              <li><a class="cyan-text page-title" onclick="select_category(this)">Peripherals</a></li>
            </ul>
            <a class="btn filter-btn dropdown-trigger" data-target="filter_dropdown">
              <?php
                $category = -1;
                if (isset($_GET["category"])) $category = $_GET["category"];

                if ($category != -1) echo(CATEGORY_NAMES[$category]);
                else echo("Select Category");
                echo("<input type='hidden' name='category' value=$category>");
              ?>
              <i class="material-icons">arrow_drop_down</i>
            </a>
          </div>

          <!-- Sort Filter -->
          <div class="filter-section">
            <h5 class="filter-title">Sort By Price</h5>
            <ul id="sort_dropdown" class="dropdown-content black">
              <li><a class="page-title" onclick="select_sort(this)">Clear</a></li>
              <li><a class="page-title" onclick="select_sort(this)">Price low to high</a></li>
              <li><a class="page-title" onclick="select_sort(this)">Price high to low</a></li>
            </ul>
            <a class="btn filter-btn dropdown-trigger" data-target="sort_dropdown">
              <?php
                $sort = -1;
                if (isset($_GET["sort"])) $sort = $_GET["sort"];
                if ($sort != -1) echo(SORT_NAMES[$sort]);
                else echo("Sort Type");
                echo("<input type='hidden' name='sort' value=$sort>");
              ?>
              <i class="material-icons">arrow_drop_down</i>
            </a>
          </div>

          <!-- Brand Filter -->
          <div class="filter-section">
            <h5 class="filter-title">Brand</h5>
            <ul id="choose_dropdown" class="dropdown-content black">
              <li><a class="cyan-text page-title" onclick="select_brand(this)">Clear</a></li>
              <li><a class="cyan-text page-title" onclick="select_brand(this)">Asus</a></li>
              <li><a class="cyan-text page-title" onclick="select_brand(this)">MSI</a></li>
              <li><a class="cyan-text page-title" onclick="select_brand(this)">Razer</a></li>
              <li><a class="cyan-text page-title" onclick="select_brand(this)">Logitech</a></li>
              <li><a class="cyan-text page-title" onclick="select_brand(this)">Viewsonic</a></li>
              <li><a class="cyan-text page-title" onclick="select_brand(this)">Acer</a></li>
              <li><a class="cyan-text page-title" onclick="select_brand(this)">HyperX</a></li>
              <li><a class="cyan-text page-title" onclick="select_brand(this)">Steelseries</a></li>
              <li><a class="cyan-text page-title" onclick="select_brand(this)">Corsair</a></li>
            </ul>
            <a class="btn filter-btn dropdown-trigger" data-target="choose_dropdown">
              <?php
                $brand = -1;
                if (isset($_GET["brand"])) $brand = $_GET["brand"];

                if ($brand != -1) echo(BRAND_NAMES[$brand]);
                else echo("Select Brand");
                echo("<input type='hidden' name='brand' value=$brand>");
              ?>
              <i class="material-icons">arrow_drop_down</i>
            </a>
          </div>
        </form>
      </aside>

      <!-- Products Grid -->
      <section class="products-container">
        <?php
          searchItems($category, $brand, $sort);
        ?>
      </section>
    </div>
  </main>

  <script>
    $(document).ready(() => {
      form = document.getElementById("form-filter");
      category = document.getElementsByName("category")[0];
      brand = document.getElementsByName("brand")[0];
      sort = document.getElementsByName("sort")[0];
    });

    var form, category, brand, sort, view;

    var categoryBy = {
      "Clear": -1,
      "PC Packages": 0,
      "Monitor & Audio": 1,
      "Peripherals": 2
    };

    var brandBy = {
      "Clear": -1,
      "Asus": 0,
      "MSI": 1,
      "Razer": 2,
      "Logitech": 3,
      "Viewsonic": 4,
      "Acer": 5,
      "HyperX": 6,
      "Steelseries": 7,
      "Corsair": 8
    }

    var sortBy = {
      "Clear": -1,
      "Price low to high": 0,
      "Price high to low": 1
    };

    function select_category(selectedItem) {
      var categoryID = categoryBy[selectedItem.textContent];
      category.value = categoryID;
      form.submit();
    }

    function select_brand(selectedBrand) {
      var brandID = brandBy[selectedBrand.textContent];
      brand.value = brandID;
      form.submit();
    }

    function select_sort(selectedSort) {
      var sortID = sortBy[selectedSort.textContent];
      sort.value = sortID;
      form.submit();
    }
  </script>

  <?php include_once "footer.php"; ?>
</body>
</html>