<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>IMAX Tech PC - Login</title>
  <link rel="stylesheet" href="static/css/gamer-forms.css">
  <?php include "header.php"; ?>
</head>
<body>

<div class="gamer-auth-container">
  <!-- Animated background elements -->
  <div class="gaming-bg-effects">
    <div class="hex-grid"></div>
    <div class="neon-line neon-line-1"></div>
    <div class="neon-line neon-line-2"></div>
    <div class="floating-particles"></div>
  </div>

  <form method="POST" action="includes/login.inc.php" class="gamer-form">
    <div class="form-content">
      <!-- Header with neon effect -->
      <div class="auth-header">
        <h1 class="gamer-title">
          <span class="neon-text">ENTER</span>
          <span class="gamer-subtitle">the Arena</span>
        </h1>
        <div class="header-divider"></div>
      </div>

      <!-- Form fields -->
      <div class="form-group">
        <div class="input-wrapper">
          <label for="username" class="input-label">
            <span class="icon-wrapper">
              <svg class="input-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                <circle cx="12" cy="7" r="4"></circle>
              </svg>
            </span>
            <span class="label-text">Username or Email</span>
          </label>
          <input 
            type="text" 
            name="username" 
            id="username" 
            class="gamer-input" 
            placeholder="Enter your credentials"
            required>
          <div class="input-glow"></div>
        </div>
      </div>

      <div class="form-group">
        <div class="input-wrapper">
          <label for="pwd" class="input-label">
            <span class="icon-wrapper">
              <svg class="input-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect>
                <path d="M7 11V7a5 5 0 0 1 10 0v4"></path>
              </svg>
            </span>
            <span class="label-text">Password</span>
          </label>
          <input 
            type="password" 
            name="pwd" 
            id="pwd" 
            class="gamer-input" 
            placeholder="••••••••••"
            required>
          <div class="input-glow"></div>
        </div>
      </div>

      <!-- Error Messages -->
      <div class="error-container">
        <?php
          if (isset($_GET["error"]))
          {
            echo '<div class="error-box">';
            if ($_GET["error"] == "empty_input")
              echo "<p>⚠️ Fill in all fields!</p>";
            else if ($_GET["error"] == "WrongLogin")
              echo "<p>⚠️ Incorrect credentials!</p>";
            else if ($_GET["error"] == "usernotfound")
              echo "<p>⚠️ User does not exist!</p>";
            else if ($_GET["error"] == "stmtfailed")
              echo "<p>⚠️ SQL ERROR! Try Again Later.</p>";
            else if ($_GET["error"] == "attemptReached")
              echo "<p>⚠️ Too many failed attempts! Try again in 15 seconds.</p>";
            echo '</div>';
          }
        ?>
      </div>

      <!-- Submit Button -->
      <button type="submit" name="submit" class="gamer-button gamer-button-primary">
        <span class="button-text">LOGIN</span>
        <span class="button-glow"></span>
      </button>

      <!-- Sign Up Link -->
      <div class="auth-footer">
        <p class="footer-text">Not yet a member?</p>
        <a href="signup.php" class="auth-link">
          <span>CREATE ACCOUNT</span>
          <span class="link-arrow">→</span>
        </a>
      </div>
    </div>
  </form>
</div>

<?php include "footer.php"; ?>
</body>
</html>
