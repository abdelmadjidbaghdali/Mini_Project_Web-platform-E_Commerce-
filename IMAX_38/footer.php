<footer class="page-footer">
  <div class="row wide-container">
    <div class="col s3">
      <h4>IMAX Tech</h4>
      <p class="grey-text text-lighten-4">Your favorite Algerian online PC store.</p>
    </div>
    <div class="col s2">
      <h5>Support</h5>
      <p><a class='dropdown-trigger white-text bold' href='#' data-target='dropdown1'>Customer Care 
        <i class='material-icons' style='display: inline-flex; vertical-align: middle;'>arrow_drop_down</i>
      </a></p>
      <ul id='dropdown1' class='dropdown-content white'>
        <li><a href='aboutUs.php' class='black-text bold'>About Us</a></li>
        <li class='divider' tabindex='-1'></li>
        <li><a href='warranty_page.php' class='black-text bold'>Warranty</a></li>
        <li class='divider' tabindex='-1'></li>
        <li><a href='contactUs.php' class='black-text bold'>Contact Us</a></li>
      </ul>
    </div>
    <div class="col s2">
      <h5>Find Us</h5>
      <p class="bold">
        Saturday to Thursday : <br> 11.00am to 8.00pm
      </p>
      <p class="bold">
        COMPUTER SCIENCE FACULTY<br>
        <br> USTHB , BAB EZZEOUAR , ALGIERS<br>
        <br> Phone: +213 555 555 555<br>
      </p>
    </div>
    <div class="col s2">
      <h5>Social</h5>
      <a class="waves-effect waves-light btn" style="margin: 4px;">
        <i class="fa fa-facebook fa-fw"></i> Facebook
      </a>
      <a class="waves-effect waves-light btn" style="margin: 4px;">
        <i class="fa fa-instagram fa-fw"></i> Instagram
      </a>
    </div>
    <div class="col s3">
      <h5>Our Partners</h5>
      <img src="static/images/PARTNERS.png" alt="Partners" />
    </div>
  </div>
  <div class="footer-copyright">
    <div class="wide-container">© 2026 IMAX TECH All rights reserved.</div>
  </div>

  <script>
    $(document).ready(function() {
      $('.dropdown-trigger').dropdown({
        coverTrigger: false
      });

      $('#pagination').pageMe({
        pagerSelector:'#myPager',
        activeColor: 'blue',
        prevText:'Previous',
        nextText:'Next',
        showPrevNext:true,
        hidePageNumbers:false,
        perPage:5
      });
      
    })
  </script>

</footer>