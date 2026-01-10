<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>IMAX Tech PC - Shopping Cart</title>
  <link rel="stylesheet" href="static/css/cart-page.css">
  <?php include "header.php"; ?>
</head>
<body>

<div class="cart-container">
  <!-- Page Header -->
  <div class="cart-header">
    <h1 class="cart-title">
      <span class="neon-text">SHOPPING</span>
      <span class="cart-subtitle">Cart</span>
    </h1>
    <div class="header-divider"></div>
  </div>

  <!-- Main Content -->
  <div class="cart-content">
    <?php include "includes/order.inc.php" ?>
    <?php include "static/pages/cart_items.php" ?>
    <?php include "static/pages/order_items.php" ?>
  </div>
</div>

<?php include "footer.php"; ?>

</body>
</html>