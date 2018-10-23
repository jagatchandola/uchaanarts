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
            <ul class="header-top-row-list text-right">
              <li class="hide d-md-inline-block">
                <a href="mailto:uchaanartz@gmail.com">
                  <span class="header-small-icons"><img src="/img/mail.png" /></span>
                  uchaanartz@gmail.com
                </a>
              </li>
              <li class="hide d-md-inline-block">
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
                <span style="color: maroon;">Welcome {{Auth::user()->uname}}</span> 
                <a href="{{ route('backend-logout') }}"
                   onclick="event.preventDefault();
                                 document.getElementById('logout-form').submit();">
                                 <i class="fa fa-sign-out fa-fw"></i>
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
                <a href="#">
                  <img src="/img/cart.png" />
                </a>
                
              </li>
              <li>
                <a href="#">
                  <img src="/img/love.png" />
                </a>
                
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
            <ul class="mobile-inline-list hide">
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
      
      <li class="nav-item {{ request()->is('events*') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('events') }}">{{ __('Events') }}</a>
                      </li>
                        <li class="nav-item {{ request()->is('art-gallery*') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('art-gallery') }}">{{ __('Art Gallery') }}</a>
                      </li>
      <li class="nav-item {{ request()->is('artists*') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('artists') }}">{{ __('Artist') }}</a>
                      </li>
      <li class="nav-item {{ request()->is('arts-competition') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('arts-competition') }}">{{ __('Arts Competition') }}</a>
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