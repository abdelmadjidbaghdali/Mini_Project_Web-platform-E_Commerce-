<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>IMAX Tech - Manage Users Panel</title>
  <?php
    include "header.php"; 
    include "static/pages/side_nav.html";
    include "static/pages/admin_nav.php";
  ?>
</head>
<body>
  <div class="container" style="margin-top: 150px">
    <h3 class="page-title">Manage Users</h3>

    <!-- users list start -->
    <div class="rounded-card-parent center" style="margin-bottom: 100px">
      <div class="card rounded-card">
        <div class="card-content white-text">
          <span class="card-title orange-text bold">Users List - Sorted by latest 
            <button class='deep-orange btn'><a href="admin_manage_users.php"><i class='material-icons white-text'>refresh</i></a>
            </button>
          </span>

          <!-- search member input field start -->
          <form id="search_user" action="admin_manage_users.php" method="POST">
            <div class="row" style="margin: 0px;">
              <div class="input-field col s3" style = "color:azure">
                <input name="search_member" id="search_member" type="text" class="validate white-text" maxlength="20">
                <label for="search_member">Search member by name</label>
                <div class="errormsg">
                  <?php
                    if (isset($_GET["error"]))
                    {
                      if ($_GET["error"] == "emptysearch")
                      echo "<p>Empty Input!</p>";
                    }
                    ?>
                </div>
              </div>
            </div>
          </form>

          <!-- search member input field end -->
          
          <!-- search member result list start -->
          <form action="" method="GET">
            <table class="responsive-table center" id="pagination">
              <thead class="text-primary center">
                <tr>
                  <th>MemberID</th>
                  <th>Username</th>
                </tr>
              </thead>
              <tbody>
                <?php 
                  $oper = new adminContr;
                  $oper->usersList();
                ?>
              </tbody>
            </table>
            <div class="col-md-12 center text-center">
              <span class="left" id="total_reg"></span>
              <ul class="pagination pager" id="myPager"></ul>
            </div>
          </form>
        <!-- serach member result list end -->
        </div>
      </div>
    </div>
    <!-- users list end -->

    <!-- selected member details start -->
    <?php if (isset($_GET["inspect"])) { ?>
      <div class="rounded-card-parent center">
        <div class="card rounded-card">
          <div class="card-content white-text">
            <span class="card-title orange-text bold">Selected Member Details</span>
            <table class="responsive-table">
              <form action="admin_manage_users.php" method="GET">
                <thead class="text-primary center">
                  <tr><th>MemberID</th><th>Username</th><th>Email</th><th>Privilege Level</th></tr>
                </thead>
                <tbody>
                  <?php $oper->showInspectedUser(); ?>
                </tbody>
              </form>
            </table>
          </div>
        </div>
      </div>
    <?php } ?>

   
     
  </div>
</body>
<script>
  $(document).ready(function(){
    $('select').formSelect();

    $("#create").submit(function(e) {
      event.preventDefault();
      var username = $("#username").val();
      var pwd = $("#pwd").val();
      var repeat_pwd = $("#repeat_pwd").val();
      var level = $("#level").val();
      var email = $("#email").val();
      var submit = $("#submit_user").val();
      $("#message").load("includes/admin.inc.php", {
        username: username,
        pwd: pwd,
        repeat_pwd: repeat_pwd,
        level: level,
        email: email,
        submit: submit
      });
    })

  });
</script>

<?php include "footer.php"; ?>
</html>