<?php
  require_once "includes/class_autoloader.php";
  if (isset($_GET["member_id"]))
  {
    /** @var int $memberID */
    $memberID = $_GET["member_id"];
    $member = Member::CreateMemberFromID($memberID);
    $orders = $member->getOrders();
    $orderCount = count($orders);
  }
?>

<div class="orders-history-section">
  <div class="section-header">
    <h2 class="section-title">Order History</h2>
    <span class="item-count"><?php echo isset($orderCount) ? $orderCount : 0; ?> orders</span>
  </div>

  <?php
    if ($orderCount <= 0) 
    {
      echo "
      <div class='empty-history'>
        <svg class='empty-icon' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2'>
          <path d='M9 1H5a2 2 0 0 0-2 2v4M15 1h4a2 2 0 0 1 2 2v4M3 5h18M9 9h6M5 21h14a2 2 0 0 0 2-2V9H3v10a2 2 0 0 0 2 2Z'></path>
        </svg>
        <h3 class='empty-text'>No order history yet</h3>
        <p class='empty-hint'>Start shopping to see your previous orders</p>
        <a href='product_catalogue.php?query=' class='shop-button'>
          <span>BROWSE PRODUCTS</span>
        </a>
      </div>";
    }
    else
    {
      for ($i=0; $i < $orderCount; $i++)
      {
        $idx = $i+1;

        $sql = "SELECT P.OrderID, P.PaymentDate, OI.OrderID FROM Payment P, OrderItems OI
        WHERE P.OrderID = OI.OrderID";
        $dbh = new Dbhandler();
        $result = $dbh->conn()->query($sql);
        while ($row = $result->fetch_assoc()) {
          $paymentDate = $row["PaymentDate"];
        }

        echo "
        <div class='order-group'>
          <div class='order-group-header'>
            <span class='order-number'>Order #$idx</span>
            <span class='order-date'>$paymentDate</span>
          </div>

          <div class='order-items-list'>";

        $order = $orders[$i];
        $orderID = $order->getOrderID();
        $orderItems = $order->getOrderItems();
        $orderItemCount = count($orderItems);

        echo "
            <div class='order-header-row'>
              <div class='col-product'>Product</div>
              <div class='col-price'>Price</div>
              <div class='col-quantity'>Quantity</div>
              <div class='col-actions'>Action</div>
            </div>";

        $sumTotal = 0;
        for ($o=0; $o < $orderItemCount; $o++)
        {
          $orderItem = $orderItems[$o];
          $item = new Item($orderItem->getItemID());
          generateBoughtItem($item, $orderItem, $memberID);

          $quantity = $orderItem->getQuantity();
          $price = $orderItem->getPrice();
          $sumTotal += $price * $quantity;
        }

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
          </div>

          <div class='order-summary'>
            <div class='summary-row'>
              <span class='summary-label'>Items:</span>
              <span class='summary-value'>$orderItemCount</span>
            </div>
            <div class='summary-row'>
              <span class='summary-label'>Delivery:</span>
              <span class='summary-value'>$displayShipping<span class='voucher-badge'>$displaySVoucher</span></span>
            </div>
            <div class='summary-row'>
              <span class='summary-label'>Promo:</span>
              <span class='summary-value'>$displayPVoucher</span>
            </div>
            <div class='summary-row summary-total'>
              <span class='summary-label'>Total:</span>
              <span class='summary-value-total'>RM$sumTotal</span>
            </div>
          </div>
        </div>";
      }
    }
  ?>
</div>