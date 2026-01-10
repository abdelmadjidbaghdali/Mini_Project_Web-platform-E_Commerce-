<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>IMAX Tech PC - Admin View Orders</title>
</head>
<?php
  include "header.php";
  include "static/pages/side_nav.html";
  include "static/pages/admin_nav.php";
?>
<body>
  <!-- manage users -->
  <div class="container" style="margin-top: 150px">
    <h3 class="page-title white-text">View Customers Cart/Orders </h3>
</div>
</body>

<script type="text/javascript">
  window.onload = function() {
    var elems  = document.querySelectorAll("input[type=range]");
    M.Range.init(elems);
  };
</script>
<?php include "footer.php"; ?>
</html>