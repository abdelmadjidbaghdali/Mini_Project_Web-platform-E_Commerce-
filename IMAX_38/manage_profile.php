<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>IMAX Tech - Manage Account</title>
  <link rel="stylesheet" href="static/css/profile-management.css">
  <?php include "header.php"; ?>
</head>
<body>

<div class="profile-container">
  <!-- Page Header -->
  <div class="profile-header">
    <h1 class="profile-title">
      <span class="neon-text">ACCOUNT</span>
      <span class="profile-subtitle">Settings</span>
    </h1>
    <div class="header-divider"></div>
  </div>

  <!-- Main Profile Card -->
  <div class="profile-card-wrapper">
    <div class="profile-card">
      <!-- Card Header with Action Button -->
      <div class="card-header-top">
        <h2 class="card-title">Personal Information</h2>
        <button id="edit" class="btn-edit" onclick="confirm_edit(this)">
          <span class="btn-text">EDIT</span>
          <span class="btn-icon">✎</span>
        </button>
      </div>

      <!-- Status Message -->
      <div class="status-message" id="msg-container">
        <p id="msg" class="status-text"></p>
      </div>

      <?php
        if (isset($_GET["error"]))
        {
          if ($_GET["error"] == "empty_input")
            echo "<script>document.getElementById('msg').innerHTML = '⚠️ Fill in all fields!'; document.getElementById('msg-container').className = 'status-message error-show';</script>";
          else if ($_GET["error"] == "invalid_uid")
            echo "<script>document.getElementById('msg').innerHTML = '⚠️ Choose a proper username!'; document.getElementById('msg-container').className = 'status-message error-show';</script>";
          else if ($_GET["error"] == "passwords_dont_match")
            echo "<script>document.getElementById('msg').innerHTML = '⚠️ Passwords do not match!'; document.getElementById('msg-container').className = 'status-message error-show';</script>";
          else if ($_GET["error"] == "stmtfailed")
            echo "<script>document.getElementById('msg').innerHTML = '⚠️ Something went wrong, please try again!'; document.getElementById('msg-container').className = 'status-message error-show';</script>";
          else if ($_GET["error"] == "username_taken")
            echo "<script>document.getElementById('msg').innerHTML = '⚠️ Username already taken!'; document.getElementById('msg-container').className = 'status-message error-show';</script>";
          else if ($_GET["error"] == "none")
          {
            echo "<script>document.getElementById('msg').innerHTML = '✓ Profile updated successfully!'; document.getElementById('msg-container').className = 'status-message success-show';</script>";
          }
        }
      ?>

      <!-- Form Content -->
      <form class="profile-form" action="includes/manage_profile.inc.php" method="POST">
        <!-- Username Field -->
        <div class="form-group">
          <div class="input-wrapper">
            <label for="username" class="input-label">
              <span class="icon-wrapper">
                <svg class="form-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                  <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                  <circle cx="12" cy="7" r="4"></circle>
                </svg>
              </span>
              <span class="label-text">Username</span>
            </label>
            <?php
            echo "<input type='hidden' name='id' value='$memberID'/>";
            echo "<input disabled class='profile-input' minlength='5' maxlength='12' name='username' id='username' type='text' value='$username' placeholder='5-12 characters' required/>";
            ?>
            <div class="input-glow"></div>
            <span class="field-hint">Min 5, Max 12 characters</span>
          </div>
        </div>

        <!-- Email Field -->
        <div class="form-group">
          <div class="input-wrapper">
            <label for="email" class="input-label">
              <span class="icon-wrapper">
                <svg class="form-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                  <rect x="2" y="4" width="20" height="16" rx="2"></rect>
                  <path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7"></path>
                </svg>
              </span>
              <span class="label-text">Email</span>
            </label>
            <?php
            echo "<input disabled class='profile-input' name='email' id='email' type='email' value='$email' placeholder='your@email.com' required/>";
            ?>
            <div class="input-glow"></div>
          </div>
        </div>

        <!-- Password Field -->
        <div class="form-group">
          <div class="input-wrapper">
            <label for="pwd" class="input-label">
              <span class="icon-wrapper">
                <svg class="form-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                  <rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect>
                  <path d="M7 11V7a5 5 0 0 1 10 0v4"></path>
                </svg>
              </span>
              <span class="label-text">New Password</span>
            </label>
            <input disabled class='profile-input' name="pwd" id="pwd" type="password" minlength="8" maxlength="20" placeholder="••••••••••" required/>
            <div class="input-glow"></div>
            <span class="field-hint">Min 8, Max 20 characters</span>
          </div>
        </div>

        <!-- Repeat Password Field -->
        <div class="form-group">
          <div class="input-wrapper">
            <label for="repeat_pwd" class="input-label">
              <span class="icon-wrapper">
                <svg class="form-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                  <rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect>
                  <path d="M7 11V7a5 5 0 0 1 10 0v4"></path>
                </svg>
              </span>
              <span class="label-text">Confirm Password</span>
            </label>
            <input disabled class='profile-input' name="repeat_pwd" id="repeat_pwd" type="password" maxlength="20" placeholder="••••••••••" required/>
            <div class="input-glow"></div>
          </div>
        </div>

        <!-- Submit Button -->
        <div class="form-actions">
          <button disabled id="update_acc" type="submit" name="update" class="btn-submit btn-primary">
            <span class="button-text">UPDATE ACCOUNT</span>
            <span class="button-glow"></span>
          </button>
        </div>
      </form>
    </div>
  </div>
</div>

<?php include "footer.php"; ?>

<script>
  // Disable and enable input fields
  var id = document.getElementsByName("id")[0];
  var username = document.getElementsByName("username")[0];
  var email = document.getElementsByName("email")[0];
  var pwd = document.getElementsByName("pwd")[0];
  var repeatPwd = document.getElementsByName("repeat_pwd")[0];
  var submitBtn = document.querySelector("#update_acc");
  var editBtn = document.querySelector("#edit");

  function confirm_edit(btn) {
    id.disabled = !id.disabled;

    if (id.disabled) {
      username.disabled = true;
      email.disabled = true;
      pwd.disabled = true;
      repeatPwd.disabled = true;
      submitBtn.disabled = true;
      editBtn.classList.remove("editing");
      btn.innerHTML = '<span class="btn-text">EDIT</span><span class="btn-icon">✎</span>';
    } else {
      username.disabled = false;
      email.disabled = false;
      pwd.disabled = false;
      repeatPwd.disabled = false;
      submitBtn.disabled = false;
      editBtn.classList.add("editing");
      btn.innerHTML = '<span class="btn-text">CANCEL</span><span class="btn-icon">✕</span>';
    }
  }

  // Timed message fade out
  setTimeout(fade_message, 3500);

  function fade_message() {
    var msgContainer = document.getElementById("msg-container");
    if (msgContainer.classList.contains("error-show") || msgContainer.classList.contains("success-show")) {
      msgContainer.classList.add("fade-out");
    }
  }
</script>

</body>
</html>