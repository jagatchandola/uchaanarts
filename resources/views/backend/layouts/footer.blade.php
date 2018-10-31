<!-- Footer CSS -->
<style type="text/css">
footer {background-color:#000; padding:40px 0}
.footerLink h4 {color:#888787; font-size:1.5rem}
.footerLink ul {margin:0; padding:0; list-style:none; margin-bottom:25px;}
.footerLink ul li {display:block; list-style:none}
.footerLink ul li a {color:#555; text-decoration:none; font-size:0.8rem}
.footerLink ul li a:hover {color:#e53424}
.socialMedia {margin:20px 0}
.socialMedia ul{margin:0; padding:0; list-style:none}
.socialMedia ul li {display:inline-block;  list-style:none}
.iconShape {width:30px; height:30px; background-color:#333; border-radius:50%; display:block; text-align:center; line-height:30px; color:#fff}
.iconShape:hover{color:#e53424}

.newLetter h5{color:#333; font-size:1.1rem}
.newLetter h6{color:#333; font-size:0.8rem}


.newsBox input {border:1px solid #e53325; padding:3.4px; font-size:13px; background:none}
.newsBox button { background-color:#e53325; border:2px solid #e53325; color:#fff}

</style>

<footer>
  <div class="container">
    <div class="row">
      <div class="col-md-5 col-lg-5 col-12 col-sm-12">
        <div class="row">
          <div class="col-md-6 col-lg-6 col-12 col-sm-6">
            <div class="footerLink">
              <h4 style="font-size:24px !important;">For Buyers</h4>
              <ul>
                <li><a style="font-size:16px !important;" href="{{ route('art-gallery') }}">Product</a></li>
                <li><a style="font-size:16px !important;" href="{{ route('events') }}">Events</a></li>
                <li><a style="font-size:16px !important;" href="{{ route('artists') }}">Artists</a></li>
              </ul>
            </div>
          </div>
          <div class="col-md-6 col-lg-6 col-12 col-sm-6">
            <div class="footerLink">
              <h4 style="font-size:24px !important;">For Artist</h4>
              <ul>
                <li><a style="font-size:16px !important;" href="/why-sell">Why Sell</a></li>
                <li><a style="font-size:16px !important;" href="{{ route('events') }}">Events</a></li>
              </ul>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-7 col-lg-7 col-12 col-sm-12">
        <div class="row">
          <div class="col-md-4 col-lg-4 col-12 col-sm-4">
            <div class="footerLink">
              <h4 style="font-size:24px !important;">About Us</h4>
              <ul>
                <li><a style="font-size:16px !important;" href="{{ route('testimonials') }}">Testimonials</a></li>
                <li><a style="font-size:16px !important;" href="{{ route('media') }}">Media Coverage</a></li>
              </ul>
            </div>
          </div>
          <div class="col-md-4 col-lg-4 col-12 col-sm-4">
            <div class="footerLink">
              <h4 style="font-size:24px !important;"> Uchaan Art</h4>
              <ul>
                <!-- <li><a href="#">Rangmahal Art Classes</a></li> -->
                <li><a style="font-size:16px !important;" href="/privacy-policy">Privacy Policy</a></li>
                <li><a style="font-size:16px !important;" href="/copyright-policy">Copyright Policy</a></li>
              </ul>
            </div>
          </div>
          <div class="col-md-4 col-lg-4 col-12 col-sm-4">
            <div class="footerLink">
              <h4 style="font-size:24px !important;">Top Categories</h4>
              <ul>
                <li><a style="font-size:16px !important;" href="/paintings">Paintings</a></li>
                <li><a style="font-size:16px !important;" href="/photography">Photography</a></li>
                <li><a style="font-size:16px !important;" href="/nature">Nature</a></li>
                <li><a style="font-size:16px !important;" href="/spritual">Spritual</a></li>
                <li><a style="font-size:16px !important;" href="/portrait">Portrait</a></li>
              </ul>
            </div>
          </div>
        </div>
      </div>
      <div class="clearfix"></div>
      <div class="col-md-6 col-lg-6 col-12 col-sm-12">
        <div class="socialMedia">
        <h5 style="color:#888787 !important; font-size:16px !important;">Connect with us</h5>
          <ul>
          <li class="d-none d-md-inline-block" >
              <li style="display:inline-block !important; margin:1% !important;"><a href="https://www.facebook.com/uchaanarts/" class="iconShape"><i class="fa fa-facebook-f"></i></a></li>
            <li style="display:inline-block !important; margin:1% !important;"><a href="https://twitter.com/teamuchaan" class="iconShape"><i class="fa fa-twitter"></i></a></li>
            <li style="display:inline-block !important; margin:1% !important;"><a href="https://plus.google.com/113335056267512558654" class="iconShape"><i class="fa fa-google-plus"></i></a></li>
            <li style="display:inline-block !important; margin:1% !important;"><a href="https://www.instagram.com/uchaanarts/" class="iconShape"><i class="fa fa-instagram"></i></a></li>
            <li style="display:inline-block !important; margin:1% !important;"><a href="https://www.youtube.com/channel/UCm8xRS3d7j24DNmxlJ_H44A" class="iconShape"><i class="fa fa-youtube"></i></a></li>               
              </li>
          </ul>
        </div>
      </div>
      <div class="col-md-6 col-lg-6 col-12 col-sm-12">
        <div class="newLetter">
          <h5 style="color:#888787 !important; font-size:16px !important;">Signup for our Newslatter</h5>
          <h6>Discover new art and collections added weekly</h6>
          <form class="newsBox">
            <div id="news-letter-msg-box"></div>
            <input type="text" id="news-letter-email" placeholder="Enter Email ID">
            <button type="button" id="news-letter"><i class="fa fa-sign-in"></i></button>
          </form>
        </div>
      </div>
    </div>
  </div>
</footer>
