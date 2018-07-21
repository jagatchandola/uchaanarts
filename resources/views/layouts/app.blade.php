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
<!--Header start Here-->
<header>
  <div class="col-md-6 col-12 col-sm-12 col-lg-3 d-none d-md-block d-lg-block">
    <div class="logoRight"><a href="/"><img src="{{ asset('img/uchaan-logo.jpg')}}" class="img-fluid"></a></div>
  </div>
  <div class="container">
    <div class="row">
      <div class="col-md-3 col-12 col-sm-12 col-lg-4 offset-lg-3 offset-md-0 offset-sm-0">
        <div class="logo d-md-none d-lg-none d-col-block d-sm-block"><a href="/"><img src="{{ asset('img/logo-mobile.png')}}" class="img-fluid"></a></div>
      </div>
      <div class="col-md-6 col-12 col-sm-12 col-lg-5">
        <nav class="topMenu float-lg-right float-sm-none float-col-none float-md-right">
      @guest  
		
        <a href="{{ route('login') }}">Login</a>
    
        <a href="{{ route('register') }}">Register</a> 
      @else
        <span>Welcome {{Auth::user()->uname}}</span> 
        <a href="{{ route('logout-custom') }}"
           onclick="event.preventDefault();
                         document.getElementById('logout-form').submit();">
            {{ __('Logout') }}
        </a>

        <form id="logout-form" action="{{ route('logout-custom') }}" method="POST" style="display: none;">
            @csrf
        </form>
      @endguest
		<a href="/" title="Add to Cart"><i class="fas fa-cart-arrow-down"></i></a></nav>
		<div class="clearfix"></div>
        <form class="searchBox float-lg-right float-sm-none float-col-none float-md-right">
          <input type="text" placeholder="Search">
          <button type="button"><i class="fa fa-search"></i></button>
        </form>
      </div>
    </div>
    <nav class="navbar navbar-expand-lg navbar-light myNav">
      <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarsExample09" aria-controls="navbarsExample09" aria-expanded="false" aria-label="Toggle navigation"> <span class="navbar-toggler-icon"></span> </button>
      <div class="collapse navbar-collapse" id="navbarsExample09">
        <ul class="navbar-nav ml-auto ">
          <li class="nav-item  {{ request()->is('home') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('home') }}">{{ __('Home') }}</a>
          </li>
      <li class="nav-item {{ request()->is('aboutus') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('aboutus') }}">{{ __('About') }}</a>
                      </li>
      <li class="nav-item {{ request()->is('events*') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('events') }}">{{ __('Events') }}</a>
                      </li>
                        <li class="nav-item {{ request()->is('art-gallery*') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('art-gallery') }}">{{ __('Art Gallery') }}</a>
                      </li>
      <li class="nav-item {{ request()->is('artists*') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('artists') }}">{{ __('Artists') }}</a>
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
</header>
<!--Header Ends Here-->

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
                <li><a href="#">Why Sell</a></li>
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
                <li><a href="#">Privacy Policy</a></li>
                <li><a href="#">Copyright Policy</a></li>
              </ul>
            </div>
          </div>
          <div class="col-md-4 col-lg-4 col-12 col-sm-4">
            <div class="footerLink">
              <h4>Top Categories</h4>
              <ul>
                <li><a href="#">Paintings</a></li>
                <li><a href="#">Photography</a></li>
                <li><a href="#">Nature</a></li>
                <li><a href="#">Spritual</a></li>
                <li><a href="#">Portrait</a></li>
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
            <input type="text" placeholder="Enter Email ID">
            <button type="button"><i class="fas fa-sign-in-alt"></i></button>
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
<script src="{{ asset('js/owl.carousel.min.js')}}"></script>
<script src="{{ asset('js/custom.js')}}"></script>

@yield('script')
<script type="text/javascript">
//    $(document).ready(function() {
//        $('#dob').datepicker();
//    });
</script>

</body>
</html>
