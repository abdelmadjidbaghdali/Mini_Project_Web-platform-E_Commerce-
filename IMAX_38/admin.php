<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>IMAX Tech - Admin Panel</title>
  <link rel="stylesheet" href="static/css/admin-dashboard.css">
  <?php 
    include "header.php";
    include "static/pages/side_nav.html";
    include "static/pages/admin_nav.php";
    require_once "includes/class_autoloader.php";
  ?>
</head>
<body>
  <!-- Dashboard Header -->
  <div class="admin-dashboard">
    <!-- Top Section: Stats Cards -->
    <div class="admin-header">
      <h1 class="admin-title">Dashboard</h1>
      <div class="header-subtitle">System Overview & Analytics</div>
    </div>

    <!-- Stats Grid -->
    <div class="stats-grid">
      <!-- SignUps Card -->
      <div class="stat-card">
        <div class="stat-card-header">
          <div class="stat-icon-wrapper signup-card">
            <svg class="stat-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
              <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
              <circle cx="9" cy="7" r="4"></circle>
              <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
              <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
            </svg>
          </div>
          <div class="stat-label">Sign Ups</div>
        </div>
        <div class="stat-value" id="signup">
          <?php 
            $sql = "SELECT * FROM Members";
            $conn = new Dbhandler();
            $result = $conn->conn()->query($sql) or die($conn->conn()->error);
            $signUpCount = $result->num_rows;
          ?>
          <span class="value"><?php echo($signUpCount); ?></span>
        </div>
        <div class="stat-footer">
          <a href="admin_report.php#user" class="stat-link">View Report</a>
          <a href="admin_manage_users.php" class="stat-link">Manage</a>
        </div>
      </div>

      <!-- Products Card -->
      <div class="stat-card">
        <div class="stat-card-header">
          <div class="stat-icon-wrapper products-card">
            <svg class="stat-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
              <path d="M6 2L3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"></path>
              <line x1="3" y1="6" x2="21" y2="6"></line>
              <path d="M16 10a4 4 0 0 1-8 0"></path>
            </svg>
          </div>
          <div class="stat-label">Products</div>
        </div>
        <div class="stat-value" id="products">
          <?php 
            $sql = "SELECT * FROM Items";
            $conn = new Dbhandler();
            $result = $conn->conn()->query($sql) or die($conn->conn()->error);
            $productCount = $result->num_rows;
          ?>
          <span class="value"><?php echo($productCount); ?></span>
        </div>
        <div class="stat-footer">
          <a href="admin_report.php#product" class="stat-link">View Report</a>
          <a href="admin_manage_products.php" class="stat-link">Manage</a>
        </div>
      </div>

      <!-- Total Orders Card -->
      <div class="stat-card">
        <div class="stat-card-header">
          <div class="stat-icon-wrapper orders-card">
            <svg class="stat-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
              <circle cx="9" cy="21" r="1"></circle>
              <circle cx="20" cy="21" r="1"></circle>
              <path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"></path>
            </svg>
          </div>
          <div class="stat-label">Total Orders</div>
        </div>
        <div class="stat-value" id="order">
          <?php 
            $sql = "SELECT M.*, O.*, P.* FROM Members M, Orders O, Payment P
            WHERE M.PrivilegeLevel = 0 AND P.OrderID = O.OrderID  AND M.MemberID = O.MemberID ORDER BY P.PaymentDate DESC";
            $conn = new Dbhandler();
            $result = $conn->conn()->query($sql) or die($conn->conn()->error);
            $orderCount = $result->num_rows;
          ?>
          <span class="value"><?php echo($orderCount); ?></span>
        </div>
        <div class="stat-footer">
          <a href="admin_report.php#order" class="stat-link">View Report</a>
          <a href="admin_view_orders.php" class="stat-link">Manage</a>
        </div>
      </div>

      <!-- Today's Orders Card -->
      <div class="stat-card">
        <div class="stat-card-header">
          <div class="stat-icon-wrapper today-card">
            <svg class="stat-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
              <path d="M6 9l6 6 6-6"></path>
              <circle cx="12" cy="12" r="10"></circle>
            </svg>
          </div>
          <div class="stat-label">Today's Orders</div>
        </div>
        <div class="stat-value" id="order1">
          <?php 
            $sql = "SELECT M.*, O.*, P.* FROM Members M, Orders O, Payment P
              WHERE M.PrivilegeLevel = 0 AND P.OrderID = O.OrderID  AND M.MemberID = O.MemberID 
              AND P.PaymentDate = CURDATE() ORDER BY P.PaymentDate DESC";

            $conn = new Dbhandler();
            $result = $conn->conn()->query($sql) or die($conn->conn()->error);
            $orderCountNew = $result->num_rows;
          ?>
          <span class="value"><?php echo($orderCountNew); ?></span>
          <?php if ($orderCountNew > 0): ?>
            <span class="value-badge">new</span>
          <?php endif; ?>
        </div>
        <div class="stat-footer">
          <a href="admin_view_orders.php" class="stat-link">View Orders</a>
        </div>
      </div>
    </div>

    <!-- Reviews Section -->
    <div class="reviews-section">
      <div class="reviews-header">
        <h2 class="reviews-title">Product Reviews</h2>
        <div class="reviews-subtitle">Latest customer feedback</div>
      </div>
      
      <div class="reviews-container">
        <table class="reviews-table" id="pagination">
          <thead>
            <tr>
              <th>Product</th>
              <th>Customer</th>
              <th>Rating</th>
              <th>Review</th>
              <th>Date</th>
            </tr>
          </thead>
          <tbody>
            <?php 
              $oper = new adminContr;
              $oper->showReviews();
            ?>
          </tbody>
        </table>
        <div class="pagination-controls">
          <span class="pagination-info" id="total_reg"></span>
          <ul class="pagination pager" id="myPager"></ul>
        </div>
      </div>
    </div>
  </div>
</body>


<script type="text/javascript">
  $(document).ready(function(){
    $('#pagination').pageMe({
      pagerSelector:'#myPager',
      activeColor: 'blue',
      prevText:'Previous',
      nextText:'Next',
      showPrevNext:true,
      hidePageNumbers:false,
      perPage:3
    });
    autoSyncTotalOrder();
    autoSyncTodayOrder();
    autoSyncTotalSignUp();
  });

  function autoSyncTotalOrder(){
    $("#order").load(location.href + " #order", function(){
      setTimeout(autoSyncTotalOrder, 3000);
    });
  }

  function autoSyncTodayOrder(){
    $("#order1").load(location.href + " #order1", function(){
      setTimeout(autoSyncTodayOrder, 3000);
    });
  }

  function autoSyncTotalSignUp(){
    $("#signup").load(location.href + " #signup", function(){
      setTimeout(autoSyncTotalSignUp, 3000);
    });
  }
</script>

</html>