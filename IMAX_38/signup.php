<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>IMAX Tech - Sign Up</title>
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

  <form action="includes/signup.inc.php" method="POST" class="gamer-form gamer-form-signup">
    <div class="form-content">
      <!-- Header with neon effect -->
      <div class="auth-header">
        <h1 class="gamer-title">
          <span class="neon-text">JOIN</span>
          <span class="gamer-subtitle">the Game</span>
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
            <span class="label-text">Username</span>
          </label>
          <input 
            type="text" 
            name="username" 
            id="username" 
            class="gamer-input" 
            placeholder="5-12 characters"
            minlength="5" 
            maxlength="12"
            required>
          <div class="input-glow"></div>
          <span class="field-hint">Min 5, Max 12 characters</span>
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
            placeholder="8-20 characters"
            minlength="8" 
            maxlength="20"
            required>
          <div class="input-glow"></div>
          <span class="field-hint">Min 8, Max 20 characters</span>
        </div>
      </div>

      <div class="form-group">
        <div class="input-wrapper">
          <label for="repeat_pwd" class="input-label">
            <span class="icon-wrapper">
              <svg class="input-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect>
                <path d="M7 11V7a5 5 0 0 1 10 0v4"></path>
              </svg>
            </span>
            <span class="label-text">Confirm Password</span>
          </label>
          <input 
            type="password" 
            name="repeat_pwd" 
            id="repeat_pwd" 
            class="gamer-input" 
            placeholder="••••••••••"
            maxlength="20"
            required>
          <div class="input-glow"></div>
        </div>
      </div>

      <div class="form-group">
        <div class="input-wrapper">
          <label for="email" class="input-label">
            <span class="icon-wrapper">
              <svg class="input-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <rect x="2" y="4" width="20" height="16" rx="2"></rect>
                <path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7"></path>
              </svg>
            </span>
            <span class="label-text">Email</span>
          </label>
          <input 
            type="email" 
            name="email" 
            id="email" 
            class="gamer-input" 
            placeholder="your@email.com"
            maxlength="25"
            required>
          <div class="input-glow"></div>
        </div>
      </div>

      <!-- Error Messages -->
      <div class="error-container">
        <?php
          if (isset($_GET["error"]))
          {
            if ($_GET["error"] == "empty_input")
              echo '<div class="error-box"><p>⚠️ Fill in all fields!</p></div>';
            else if ($_GET["error"] == "invalid_uid")
              echo '<div class="error-box"><p>⚠️ Choose a proper username!</p></div>';
            else if ($_GET["error"] == "passwords_dont_match")
              echo '<div class="error-box"><p>⚠️ Passwords do not match!</p></div>';
            else if ($_GET["error"] == "username_taken")
              echo '<div class="error-box"><p>⚠️ Username/Email already taken!</p></div>';
            else if ($_GET["error"] == "none")
            {
              echo '<div class="success-box"><p>✓ Account created successfully!</p><p>Redirecting to login...</p></div>';
              echo '<META HTTP-EQUIV="Refresh" Content="2; URL=login.php">';
              exit();
            }
          }
        ?>
      </div>

      <!-- Submit Button -->
      <button type="submit" name="submit" class="gamer-button gamer-button-primary">
        <span class="button-text">CREATE ACCOUNT</span>
        <span class="button-glow"></span>
      </button>

      <!-- Login Link -->
      <div class="auth-footer">
        <p class="footer-text">Already have an account?</p>
        <a href="login.php" class="auth-link">
          <span>SIGN IN</span>
          <span class="link-arrow">→</span>
        </a>
      </div>
    </div>
  </form>
</div>

<?php include "footer.php"; ?>
</body>
</html>