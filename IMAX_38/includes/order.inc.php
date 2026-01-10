<?php 

require_once "class_autoloader.php";

/**
 * @param Item $item
 * @param OrderItemContr $cartItem
 * @param int $memberID
*/

function generateOrderDetails($item, $cartItem){
  $itemID = $item->getItemID();
  $quantityInStock = $item->getQuantityInStock();
  $itemName = $item->getName();
  $categoryIdx = $item->getCategory();
  $categoryName = Item::CATEGORY[$categoryIdx];
  $dbh = new Dbhandler();

  $sql = "SELECT I.Image from Items I WHERE I.ItemID = $itemID";
  $result = $dbh->conn()->query($sql) or die($dbh->conn()->error);
  $row = $result->fetch_assoc();
  $image = $row["Image"];

  $dateAdded = $cartItem->getAddedDateTime();
  $price = $cartItem->getPrice();
  $price = "DA" . $price;
  $quantity = $cartItem->getQuantity();
  $quantityDisplay = "x" . $quantity;
  $orderItemID = $cartItem->getOrderItemID();
  
  return [$itemID, $quantity, $quantityInStock, $image, $itemName, $price, $quantityDisplay, $orderItemID, $dateAdded, $categoryName];
}

function generateItem($item, $cartItem, $memberID){

  // admin view orders
  [$itemID, $quantity, $quantityInStock, $image, $itemName, $price, $quantityDisplay, $orderItemID, $dateAdded, $categoryName] 
    = generateOrderDetails($item, $cartItem, $memberID);

  $view_order = isset($_GET["view_order"]);
  $priceDisplay = str_replace("DA", "RM", $price);
  
  echo "
  <div class='cart-item'>
    <div class='item-image'>
      <img src='product_images/$image' alt='$itemName'>
    </div>
    <div class='item-details'>
      <h3 class='item-name'>$itemName</h3>
      <div class='item-meta'>
        <span class='meta-label'>Category:</span>
        <span class='meta-value'>$categoryName</span>
      </div>
      <div class='item-meta'>
        <span class='meta-label'>Added:</span>
        <span class='meta-value'>$dateAdded</span>
      </div>
    </div>
    <div class='item-price'>
      <span class='price-label'>Price</span>
      <span class='price-value'>$priceDisplay</span>
    </div>
    <div class='item-quantity'>
      <span class='quantity-label'>Qty</span>
      <span class='quantity-value'>$quantityDisplay</span>
    </div>
    <div class='item-actions'>
      <a href='product.php?item_id=$itemID' class='action-btn action-inspect' title='View Product'>
        <svg viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2'>
          <path d='M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z'></path>
          <circle cx='12' cy='12' r='3'></circle>
        </svg>
        <span>View</span>
      </a>";
  
  if (!$view_order)
  {
    echo "
      <form method='GET' style='display: inline;'>
        <input type='hidden' name='member_id' value='$memberID'>
        <input type='hidden' name='remove_item' value='$orderItemID'>
        <button type='submit' class='action-btn action-remove' title='Remove Item' 
          onclick=\"return confirm('Remove $itemName from cart?');\">
          <svg viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2'>
            <polyline points='3 6 5 6 21 6'></polyline>
            <path d='M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2'></path>
            <line x1='10' y1='11' x2='10' y2='17'></line>
            <line x1='14' y1='11' x2='14' y2='17'></line>
          </svg>
          <span>Remove</span>
        </button>
      </form>";
  }
  echo "
    </div>
  </div>";
}

function generateBoughtItem($item, $cartItem){
  [$itemID, $quantity, $quantityInStock, $image, $itemName, $price, $quantityDisplay, $orderItemID, $categoryName] 
    = generateOrderDetails($item, $cartItem);

  $view_order = isset($_GET["view_order"]);
  $priceDisplay = str_replace("DA", "RM", $price);

  echo "
  <div class='cart-item'>
    <div class='item-image'>
      <img src='product_images/$image' alt='$itemName'>
    </div>
    <div class='item-details'>
      <h3 class='item-name'>$itemName</h3>
      <div class='item-meta'>
        <span class='meta-label'>Category:</span>
        <span class='meta-value'>$categoryName</span>
      </div>
    </div>
    <div class='item-price'>
      <span class='price-label'>Price</span>
      <span class='price-value'>$priceDisplay</span>
    </div>
    <div class='item-quantity'>
      <span class='quantity-label'>Qty</span>
      <span class='quantity-value'>$quantityDisplay</span>
    </div>
    <div class='item-actions'>
      <a href='product.php?item_id=$itemID' class='action-btn action-inspect' title='View Product'>
        <svg viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2'>
          <path d='M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z'></path>
          <circle cx='12' cy='12' r='3'></circle>
        </svg>
        <span>View</span>
      </a>";
  
  if (!$view_order)
  {
    echo "
      <a href='review.php?review_item=$orderItemID' class='action-btn action-review' title='Write Review'>
        <svg viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2'>
          <path d='M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z'></path>
        </svg>
        <span>Review</span>
      </a>";
  }
  echo "
    </div>
  </div>";
}

function generateOrderSum($totalItems, $sumTotal, $displayShipping, $displaySVoucher, $displayPVoucher)
{
  echo(
    "<div class='col s4'>
      <div class='rounded-card-parent'>
        <div class='card rounded-card tint-glass-brown'>
          <div class='card-content white-text'>
            <h5 class='bold center'>Order Details</h5>
            <table class='responsive-table'>
              <tbody>
                <tr><th>Total Items:</th><td class='left'>$totalItems</td></tr>");
                echo("<tr><th>Delivery Charges:</th><td>");echo("$displayShipping $displaySVoucher</td></tr>");
                echo("<tr><th >Promo Voucher:</th><td >$displayPVoucher</td></tr>");
                echo("<tr><th>Sum Total:</th><td>DA$sumTotal</td></tr>");
                echo("<tr><th>Status:</th><td>Shipped (check email for status)</td></tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>"
  );
}