<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>IMAX Tech PC - Landing Page</title>
  <link rel="stylesheet" href="static/css/home-page.css">
  <?php 
    require "header.php"; 
    require_once "includes/class_autoloader.php";

    // database initialization on first run
    $dbinit = new InitDB();
    $dbinit->initDbExec();
  ?>
</head>
<body>
  <div class="slider">
    <ul class="slides">
      <li>
        <img src="./static/images/Video Games Rainbow GIF by HyperX.gif" alt="Build your dream setup"> 
        <div class="caption center-align">
          <h3></h3>
          <h5>Build your dream setup with Us.</h5>
        </div>
      </li>
      <li>
        <img src="./static/images/category_3.jpg" alt="IMAX Tech Gaming PCs"> 
        <div class="caption center-align">
          <h3>At IMAX Tech</h3>
          <h5>From pc to peripherals, we got u covered.</h5>
        </div>
      </li>
      <li>
        <img src="static/images/IMAXxx.png" alt="IMAX Tech Logo"> 
      </li>
      <li>
        <img src="./static/images/IM.png" alt="Gaming Setup"> 
        <div class="caption center-align">
          <h3></h3>
        </div>
      </li>
      <li>
        <img src="./static/images/carousel_4.gif" alt="Performance Showcase"> 
        <div class="caption center-align">
        </div>
      </li>
    </ul>
  </div>
  
  <section class="categories-section">
    <div class="section-header">
      <h4 class="section-title">Categories</h4>
    </div>
    <div class="categories-grid">
      <div class="category-card-wrapper">
        <a href="product_catalogue.php?category=0" class="category-card">
          <img src="static/images/category_1.gif" alt="PC Packages"/>
          <div class="category-label">
            <h5>PC PACKAGES</h5>
          </div>
        </a>
      </div>

      <div class="category-card-wrapper">
        <a href="product_catalogue.php?category=1" class="category-card">
          <img src="./static/images/category_3.jpg" alt="Monitor & Audio"/>
          <div class="category-label">
            <h5>MONITOR & AUDIO</h5>
          </div>
        </a>
      </div>

      <div class="category-card-wrapper">
        <a href="product_catalogue.php?category=2" class="category-card">
          <img src="./static/images/category_2.gif" alt="Peripherals"/>
          <div class="category-label">
            <h5>PERIPHERALS</h5>
          </div>
        </a>
      </div>
    </div>
  </section>

  <section class="about-section">
    <h3>BUILT BY ENTHUSIASTS FOR ENTHUSIASTS</h3>
    <h5>
      At <span class="about-brand-name">IMAX Tech PC</span>, We are a team of serious gamers and overclockers with a passion towards customized and fast PCs.
    </h5>
  </section>

  <section class="stats-section">
    <div class="stats-grid">
      <div class="stat-card">
        <h1 class="stat-count">15</h1>
        <h5 class="stat-label">Years Of History</h5>
      </div>
      <div class="stat-card">
        <h1 class="stat-count">10000</h1>
        <h5 class="stat-label">PCs Built</h5>
      </div>
      <div class="stat-card">
        <h1 class="stat-count">14</h1>
        <h5 class="stat-label">States Covered</h5>
      </div>
      <div class="stat-card">
        <h1 class="stat-count">100</h1>
        <h5 class="stat-label">% Satisfaction guaranteed</h5>
      </div>
    </div>
  </section>

  <section class="video-showcase-section">
    <h3 class="showcase-title">IMAX Tech PC - White PC Build</h3>
    <div class="video-wrapper" id="videoWrapper">
      <img id="videoThumbnail" src="static/images/ice_pc.png" alt="Click to play PC Build showcase video" style="cursor: pointer;">
      <video id="videoPlayer" style="display: none;" class="responsive-video" width="1280" height="720" controls muted>
        <source src="static/showcase.mp4" type="video/mp4">
        Your browser does not support the video tag.
      </video>
    </div>
  </section>

  <section class="why-choose-us-section">
    <div class="section-header">
      <h3 class="section-title-alt">WHY CHOOSE IMAX TECH</h3>
      <p class="section-subtitle-alt">Premium PC Building Excellence</p>
    </div>

    <div class="features-grid">
      <div class="feature-card">
        <div class="feature-icon">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
            <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.41 0-8-3.59-8-8s3.59-8 8-8 8 3.59 8 8-3.59 8-8 8zm3.5-9c.83 0 1.5-.67 1.5-1.5S16.33 8 15.5 8 14 8.67 14 9.5s.67 1.5 1.5 1.5zm-7 0c.83 0 1.5-.67 1.5-1.5S9.33 8 8.5 8 7 8.67 7 9.5 7.67 11 8.5 11zm3.5 6.5c2.33 0 4.31-1.46 5.11-3.5H6.89c.8 2.04 2.78 3.5 5.11 3.5z"/>
          </svg>
        </div>
        <h4 class="feature-title">Expert Assembly</h4>
        <p class="feature-description">Every PC is meticulously built and tested by seasoned overclockers and gaming enthusiasts who understand performance.</p>
      </div>

      <div class="feature-card">
        <div class="feature-icon">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
            <path d="M12 1L3 5v6c0 5.55 3.84 10.74 9 12 5.16-1.26 9-6.45 9-12V5l-9-4zm0 10.99h7c-.53 4.12-3.28 7.72-7 8.77V12H5V6.3l7-3.11v8.8z"/><path d="M10 17h4v-4h-4z"/>
          </svg>
        </div>
        <h4 class="feature-title">Quality & Warranty</h4>
        <p class="feature-description">100% original components with guaranteed warranty coverage. We stand behind every build with comprehensive protection.</p>
      </div>

      <div class="feature-card">
        <div class="feature-icon">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
            <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/><path d="M9 7h6"/>
          </svg>
        </div>
        <h4 class="feature-title">24/7 Support</h4>
        <p class="feature-description">Dedicated technical support team ready to help you maximize performance, troubleshoot issues, and optimize your setup.</p>
      </div>

      <div class="feature-card">
        <div class="feature-icon">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
            <path d="M12 1v22M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"/><circle cx="12" cy="7" r="1"/><circle cx="12" cy="17" r="1"/>
          </svg>
        </div>
        <h4 class="feature-title">Best Value</h4>
        <p class="feature-description">Competitive pricing with exclusive upgrade rebates. Get premium performance without breaking your budget.</p>
      </div>
    </div>
  </section>

  <script src="https://apps.elfsight.com/p/platform.js" defer></script>
  <div class="elfsight-app-dcc4934e-3eb0-4e18-98af-67fd2f034df1"></div>

  <?php require "footer.php"; ?>
</body>

<script src="static/js/dynamic-bg.js" defer></script>
<script>
  $(document).ready(function(){
    // Carousel initialization
    $('.slider').slider({full_width: true});

    // Video playback toggle
    const videoWrapper = document.getElementById('videoWrapper');
    const videoThumbnail = document.getElementById('videoThumbnail');
    const videoPlayer = document.getElementById('videoPlayer');
    
    if (videoThumbnail) {
      videoThumbnail.addEventListener('click', function() {
        this.style.display = 'none';
        videoPlayer.style.display = 'block';
        videoPlayer.play();
      });
    }

    // Counter animation
    $('.stat-count').each(function () 
    {
      $(this).prop('Counter', 0).animate({
        Counter: $(this).text()
      }, {
        duration: 4000,
        easing: 'swing',
        step: function (now) { $(this).text(Math.ceil(now)); }
      });
    });
  });
</script>
</html>