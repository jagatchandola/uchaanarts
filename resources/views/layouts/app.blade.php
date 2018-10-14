<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name') }}</title>

	<link rel="icon" href="favicon.ico">

	<!-- Bootstrap core CSS -->
  <link href="{{ asset('/css/bootstrap.min.css') }}" rel="stylesheet">
	<link href="{{ asset('/css/bootstrap-lightbox.min.css') }}" rel="stylesheet">
	<link href="{{ asset('/css/fontawesome.css') }}" rel="stylesheet">
	<link href="{{ asset('/css/owl.carousel.min.css') }}" rel="stylesheet">
	<link href="{{ asset('/css/owl.theme.default.css') }}" rel="stylesheet">
	<!-- Custom styles for this template -->
	<link href="{{ asset('/css/style.css') }}" rel="stylesheet">

	<link href="https://fonts.googleapis.com/css?family=Ubuntu:300,400,400i,700,700i" rel="stylesheet">
	
  @yield('style')

	<!-- Scripts -->
    <script src="{{ asset('js/jquery-1.11.2.min.js') }}" defer></script>

</head>
<body>
<!-- Header start ====================== -->
<header>
    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-12 col-md-1 col-lg-1 col-xl-1">
          <div class="logoRight text-md-left">
            <a href="/">
              <img src="/img/logo.png" class="img-fluid">
            </a>
          </div>
        </div>
        <div class="col-sm-12 col-md-11 col-lg-11 col-xl-11">
          <div class="header-top-row">
            <ul class="header-top-row-list text-md-right">
              <li class="d-none d-md-inline-block">
                <a href="mailto:uchaanartz@gmail.com">
                  <span class="header-small-icons"><img src="/img/mail.png" /></span>
                  uchaanartz@gmail.com
                </a>
              </li>
              <li class="d-none d-md-inline-block">
                <a href="tel:+918860277388">
                  <span class="header-small-icons"><img src="/img/phn.png" /></span>
                  +91 88602 77388
                </a>
              </li>
              @guest
              <li>
                <a href="#">LOGIN</a>
                <div class="custom-dropdown hover-dropdown position-absolute">
                  <div class="content-box">
                    <ul class="dropdown-list text-left">
                      <li>
                        <a href="{{ route('login') }}" class="p-3"> Login </a>
                      </li>
                      <!-- <li>
                        <a href="{{ route('login') }}" class="p-3"> Artist Login </a>
                      </li>
                      <li>
                        <a href="{{ route('login') }}" class="p-3">
                          Buyer Login
                        </a>
                      </li> -->
                    </ul>
                  </div>
                </div>
              </li>
              <li><a href="{{ route('register') }}">REGISTER</a></li>
              @else
              <li>
                <span style="color: white;">Welcome {{Auth::user()->uname}}</span> 
                <a href="{{ route('logout-custom') }}"
                   onclick="event.preventDefault();
                                 document.getElementById('logout-form').submit();">
                    {{ __('Logout') }}
                </a>

                @can('isAdmin')
                    <a href="{{ route('backend-dashboard') }}" target="_blank">{{ ('Admin') }}</a>
                @endcan
                
                @can('isArtist')
                    <a href="{{ route('backend-dashboard') }}" target="_blank">{{ ('Artist') }}</a>
                @endcan
                <form id="logout-form" action="{{ route('logout-custom') }}" method="POST" style="display: none;">
                    @csrf
                </form>
              </li>
              @endguest
              <li>
                <a @if(isset($_SESSION['cart']) && count($_SESSION['cart']) > 0) href="{{route('checkout')}}" @else href="javascript:;" @endif>
                    <img src="/img/cart.png" />
                    <span style="color: red;" id="cart-item-count">
                        <?php
                            echo isset($_SESSION['cart']) ? count($_SESSION['cart']) : 0;
                        ?>
                    </span>
                </a>
<!--                <div class="custom-dropdown hover-dropdown position-absolute">
                  <div class="content-box p-3">
                    <div class="row pb-3 align-items-center">
                      <div class="col-sm-5 col-5"> <img src="/img/prd-8.jpg" /></div>
                      <div class="col-sm-7 col-7 text-center">
                        <div class="cart-item-name">Title</div>
                        <div class="cart-item-price"><i class="fas fa-rupee-sign"></i>1500</div>
                      </div>
                    </div>

                    <div class="row pb-3 align-items-center">
                      <div class="col-sm-5 col-5"> <img src="/img/prd-8.jpg" /></div>
                      <div class="col-sm-7 col-7 text-center">
                        <div class="cart-item-name">Title</div>
                        <div class="cart-item-price"><i class="fas fa-rupee-sign"></i>1500</div>
                      </div>
                    </div>

                  </div>
                  <div>
                    <div class="text-center p-3">
                      <span class="sub-total-title text-uppercase">Sub-Total : </span>
                      <span class="sub-total-price"><i class="fas fa-rupee-sign"></i>14000</span>
                    </div>
                    <div class="checkout-btn-container text-center p-3">
                     <a href="/checkout.html"><input type="button" name="btn" value="Check-out" class="btn btn-lg btn-primary themeBtn text-uppercase" /></a>
                    </div>
                  </div>
                </div>-->
              </li>
              <li>
                <a href="#">
                  <img src="/img/love.png" />
                </a>
                <div class="custom-dropdown hover-dropdown position-absolute">
                  <div class="content-box p-3">
                    <div class="row pb-3 align-items-center">
                      <div class="col-sm-5 col-5"> <img src="/img/prd-8.jpg" /></div>
                      <div class="col-sm-7 col-7 text-center">
                        <div class="cart-item-name">Title</div>
                        <div class="cart-item-price"><i class="fas fa-rupee-sign"></i>1500</div>
                      </div>
                    </div>

                    <div class="row pb-3 align-items-center">
                      <div class="col-sm-5 col-5"> <img src="/img/prd-8.jpg" /></div>
                      <div class="col-sm-7 col-7 text-center">
                        <div class="cart-item-name">Title</div>
                        <div class="cart-item-price"><i class="fas fa-rupee-sign"></i>1500</div>
                      </div>
                    </div>

                  </div>
                  <div>
                    <div class="text-center p-3">
                      <span class="sub-total-title text-uppercase">Sub-Total : </span>
                      <span class="sub-total-price"><i class="fas fa-rupee-sign"></i>14000</span>
                    </div>
                    <div class="checkout-btn-container text-center p-3">
                      <a href="/wishlist.html"><input type="button" name="btn" value="View Wishlist" class="btn btn-lg btn-primary themeBtn text-uppercase"/></a>
                    </div>
                  </div>
                </div>
              </li>
              <li>
                <a href="#">
                  <img src="/img/search.png" />
                </a>
                <div class="custom-dropdown jquery-dropdown position-absolute">
                  <div class="content-box p-3">
                    <input type="text" name="search" value="" placeholder="Search" class="search-txt" />
                  </div>
                </div>
              </li>
            </ul>
          </div>


          <nav class="navbar navbar-expand-lg navbar-light header-main-nav-container">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
              aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
            </button>
            <ul class="mobile-inline-list d-none">
              <li>
                <a href="mailto:uchaanartz@gmail.com"><img src="/img/mail.png" /></a>
              </li>
              <li>
                <a href="tel:+918860277388"><img src="/img/phn.png" /></a>
              </li>
            </ul>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
              <ul class="navbar-nav mr-auto header-main-nav text-uppercase">
                <li class="nav-item  {{ request()->is('home') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('home') }}">{{ __('Home') }}</a>
          </li>
      <li class="nav-item {{ request()->is('aboutus') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('aboutus') }}">{{ __('About') }}</a>
                      </li>
      <li class="nav-item {{ request()->is('arts-competition') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('arts-competition') }}">{{ __('Arts Competition') }}</a>
                      </li>
      <li class="nav-item {{ request()->is('events*') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('events') }}">{{ __('Events') }}</a>
                      </li>
                        <li class="nav-item {{ request()->is('art-gallery*') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('art-gallery') }}">{{ __('Art Gallery') }}</a>
                      </li>
      <li class="nav-item {{ request()->is('artists*') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('artists') }}">{{ __('Artist') }}</a>
                      </li>
      <li class="nav-item {{ request()->is('testimonials*') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('testimonials') }}">{{ __('Testimonials') }}</a>
                      </li>
                        <li class="nav-item {{ request()->is('media*') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('media') }}">{{ __('Media Coverage') }}</a>
                      </li>
                        <li class="nav-item {{ request()->is('contactus*') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('contactus') }}">{{ __('Contact Us') }}</a>
                      </li>
              </ul>

            </div>
          </nav>


        </div>
      </div>
    </div>
  </header>
<!-- Header end ========================= -->

@yield('content')

<!--footer 2 Start Here-->
<footer>
  <div class="container">
    <div class="row">
      <div class="col-md-5 col-lg-5 col-12 col-sm-12">
        <div class="row">
          <div class="col-md-6 col-lg-6 col-12 col-sm-6">
            <div class="footerLink">
              <h4>For Buyers</h4>
              <ul>
                <li><a href="{{ route('art-gallery') }}">Product</a></li>
                <li><a href="{{ route('events') }}">Events</a></li>
                <li><a href="{{ route('artists') }}">Artists</a></li>
              </ul>
            </div>
          </div>
          <div class="col-md-6 col-lg-6 col-12 col-sm-6">
            <div class="footerLink">
              <h4>For Artist</h4>
              <ul>
                <li><a href="/why-sell">Why Sell</a></li>
                <li><a href="{{ route('events') }}">Events</a></li>
              </ul>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-7 col-lg-7 col-12 col-sm-12">
        <div class="row">
          <div class="col-md-4 col-lg-4 col-12 col-sm-4">
            <div class="footerLink">
              <h4>About Us</h4>
              <ul>
                <li><a href="{{ route('testimonials') }}">Testimonials</a></li>
                <li><a href="{{ route('media') }}">Media Coverage</a></li>
              </ul>
            </div>
          </div>
          <div class="col-md-4 col-lg-4 col-12 col-sm-4">
            <div class="footerLink">
              <h4> Uchaan Art</h4>
              <ul>
                <li><a href="#">Rangmahal Art Classes</a></li>
                <li><a href="/privacy-policy">Privacy Policy</a></li>
                <li><a href="/copyright-policy">Copyright Policy</a></li>
              </ul>
            </div>
          </div>
          <div class="col-md-4 col-lg-4 col-12 col-sm-4">
            <div class="footerLink">
              <h4>Top Categories</h4>
              <ul>
                <li><a href="/paintings">Paintings</a></li>
                <li><a href="/photography">Photography</a></li>
                <li><a href="/nature">Nature</a></li>
                <li><a href="/spritual">Spritual</a></li>
                <li><a href="/portrait">Portrait</a></li>
              </ul>
            </div>
          </div>
        </div>
      </div>
      <div class="clearfix"></div>
      <div class="col-md-6 col-lg-6 col-12 col-sm-12">
        <div class="socialMedia">
          <ul>
            <li><a href="" class="iconShape"><i class="fab fa-facebook-f"></i></a></li>
            <li><a href="" class="iconShape"><i class="fab fa-twitter"></i></a></li>
            <li><a href="" class="iconShape"><i class="fab fa-pinterest-p"></i></a></li>
            <li><a href="" class="iconShape"><i class="fab fa-tumblr"></i></a></li>
            <li><a href="" class="iconShape"><i class="fab fa-instagram"></i></a></li>
            <li><a href="" class="iconShape"><i class="fab fa-youtube"></i></a></li>
          </ul>
        </div>
      </div>
      <div class="col-md-6 col-lg-6 col-12 col-sm-12">
        <div class="newLetter">
          <h5>Signup for our Newslatter</h5>
          <h6>Discover new art and collections added weekly</h6>
          <form class="newsBox">
            <div id="news-letter-msg-box"></div>
            <input type="text" id="news-letter-email" placeholder="Enter Email ID">
            <button type="button" id="news-letter"><i class="fas fa-sign-in-alt"></i></button>
          </form>
        </div>
      </div>
    </div>
  </div>
</footer>
<!--footer 2 Ends Here-->

<script src="{{ asset('js/jquery-3.3.1.slim.min.js')}}" ></script>
<script src="{{ asset('js/popper.min.js')}}"></script>
<script src="{{ asset('js/bootstrap.min.js')}}"></script>
<script src="{{ asset('js/bootstrap-lightbox.min.js')}}"></script>
<script src="{{ asset('js/owl.carousel.min.js')}}"></script>
<script src="{{ asset('js/custom.js')}}"></script>

@yield('script')

</body>
</html>
