<?php

  require_once "includes/order.inc.php";
  require_once "includes/class_autoloader.php";

  if (isset($_GET["member_id"]))
  {
    $memberID = $_GET["member_id"];
    $member = Member::CreateMemberFromID($memberID);
    $cart = $member->getCart();
    $cartID = $cart->getOrderID();
    $cartItems = $cart->getOrderItems();
    $cartItemCount = count($cartItems);
  }

  if (isset($_GET["remove_item"])){
    $orderItemID = $_GET["remove_item"];
    $sql = "DELETE FROM OrderItems WHERE OrderItemID = $orderItemID";
    $conn = new Dbhandler();
    $conn->conn()->query($sql) or die($conn->conn()->error);
    header("location: cart.php?member_id=$memberID");
  }
?>

<div class="cart-items-section">
  <div class="section-header">
    <h2 class="section-title">Shopping Items</h2>
    <span class="item-count"><?php echo isset($cartItemCount) ? $cartItemCount : 0; ?> items</span>
  </div>

  <div class="cart-items-wrapper">
    <?php
      if (isset($cartItems))
      {
        if ($cartItemCount <= 0) 
        {
          echo "
          <div class='empty-cart'>
            <svg class='empty-icon' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2'>
              <circle cx='9' cy='21' r='1'></circle>
              <circle cx='20' cy='21' r='1'></circle>
              <path d='M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6'></path>
            </svg>
            <h3 class='empty-text'>Your cart is empty</h3>
            <p class='empty-hint'>Add some products to get started</p>
            <a href='product_catalogue.php?query=' class='shop-button'>
              <span>SHOP NOW</span>
            </a>
          </div>";
        }
        else
        {
          echo "
          <div class='cart-header-row'>
            <div class='col-product'>Product</div>
            <div class='col-price'>Price</div>
            <div class='col-quantity'>Quantity</div>
            <div class='col-actions'>Actions</div>
          </div>";
          
          $sumTotal = 0;
          for ($c=0; $c < $cartItemCount; $c++)
          {
            $orderItem = $cartItems[$c];
            $item = new Item($orderItem->getItemID());
            generateItem($item, $orderItem, $memberID);

            $quantity = $orderItem->getQuantity();
            $price = $orderItem->getPrice();
            $sumTotal = $sumTotal + $price * $quantity;
          }
        }
      }
    ?>
  </div>

  <!-- Cart Summary Card -->
  <div class="cart-summary-card">
    <h3 class="summary-title">Order Summary</h3>
    
    <form action="payment.php" method="GET" class="summary-form">
      <div class="summary-table">
        <div class="summary-row">
          <span class="summary-label">Total Items:</span>
          <span class="summary-value"><?php echo isset($cartItemCount) ? $cartItemCount : 0; ?></span>
        </div>

        <?php
          if (isset($sumTotal))
          {
            if ($sumTotal >= 200){
              $displayShipping = 0;
              $displaySVoucher = " (Shipping voucher applied)";
            }
            else if ($sumTotal < 200){
              $displayShipping = 25;
              $displaySVoucher = "";
            } 
            if ($displayShipping === 0) $displayShipping = "RM0";
            else $displayShipping = "RM$displayShipping";

            if ($sumTotal >= 2000){
              $shippingTotal = $sumTotal - 100;
              $displayPVoucher = "-RM100 (Promo voucher applied)";
            }
            else if ($sumTotal >= 200 && $sumTotal < 2000){ 
              $shippingTotal = $sumTotal;
              $displayPVoucher = "None (min spend not reached)";
            }
            else if ($sumTotal < 200){ 
              $shippingTotal = $sumTotal + 25;
              $displayPVoucher = "None (min spend not reached)";
            }
            $sumTotal = number_format($shippingTotal, 2);

            echo "
            <div class='summary-row'>
              <span class='summary-label'>Delivery:</span>
              <span class='summary-value'>$displayShipping<span class='voucher-badge'>$displaySVoucher</span></span>
            </div>
            <div class='summary-row'>
              <span class='summary-label'>Promo Voucher:</span>
              <span class='summary-value'>$displayPVoucher</span>
            </div>
            <div class='summary-row summary-total'>
              <span class='summary-label'>Total:</span>
              <span class='summary-value-total'>RM$sumTotal</span>
            </div>";
          }
        ?>
      </div>

      <?php if (!isset($_GET["view_order"]) && isset($cartItemCount) && $cartItemCount > 0) { ?>
      <div class="summary-actions">
        <button type="submit" class="btn-checkout">
          <span class="btn-text">PROCEED TO CHECKOUT</span>
          <span class="btn-glow"></span>
        </button>
        <input type="hidden" name="order_id" value="<?php echo isset($cartID) ? $cartID : ''; ?>">
        <input type="hidden" name="view_order" value="1">
        <input type="hidden" name="member_id" value="<?php echo isset($memberID) ? $memberID : ''; ?>">
      </div>
      <?php } ?>
    </form>
