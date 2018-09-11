<!-- Navigation -->

@if (Auth::user()->user_role == 'admin')

<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <div class="navbar-header">
        <a class="navbar-brand" href="{{ route('backend-dashboard') }}">{{ ('Uchaan Arts') }}</a>
    </div>
    
    <ul class="nav navbar-right navbar-top-links">        
        <li class="dropdown">
            <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                <i class="fa fa-user fa-fw"></i>{{Auth::user()->uname}} <b class="caret"></b>
            </a>
            <ul class="dropdown-menu dropdown-user">
                
                <li class="divider"></li>
                <li>
                    <a href="{{ route('backend-logout') }}"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                </li>
            </ul>
        </li>
    </ul>
    <!-- /.navbar-top-links -->
    
    <div class="navbar-default sidebar" role="navigation">
        <div class="sidebar-nav navbar-collapse">
            <ul class="nav" id="side-menu">
                
                <li>
                    <a href="{{ route('backend-dashboard') }}" class="active"><i class="fa fa-dashboard fa-fw"></i>Dashboard</a>
                </li>
                <li>
                    <a href="#"><i class="fa fa-bar-chart-o fa-fw"></i>Artist<span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        <li>
                            <a href="{{ route('artists-list') }}">{{ ('All Artists') }}</a>
                        </li>
                        <li>
                            <a href="{{ route('pending-artists') }}">{{ ('Pending Artists') }}</a>
                        </li>
                    </ul>
                    <!-- /.nav-second-level -->
                </li>
                <li>
                    <a href="#"><i class="fa fa-bar-chart-o fa-fw"></i>Products<span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        <li>
                            <a href="{{ route('gallery-list') }}">All Products</a>
                        </li>
                        <li>
                            <a href="{{ route('pending-gallery') }}">Pending Products</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="#"><i class="fa fa-bar-chart-o fa-fw"></i>Category<span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        <li>
                            <a href="{{ route('category-list') }}">All Categories</a>
                        </li>
                        <li>
                            <a href="{{ route('add-category') }}">Add Category</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="#"><i class="fa fa-bar-chart-o fa-fw"></i>Event<span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        <li>
                            <a href="{{ route('events-list') }}">All Events</a>
                        </li>
                        <li>
                            <a href="{{ route('add-event') }}">Add Event</a>
                        </li>
                        <li>
                            <a href="{{ route('event-participants') }}">Event Participants</a>
                        </li>
                        <li>
                            <a href="{{ route('online-events-list') }}">Online Events</a>
                        </li>
                        <li>
                            <a href="{{ route('add-online-event') }}">Add Online Event</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="#"><i class="fa fa-bar-chart-o fa-fw"></i>Banner<span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        <li>
                            <a href="{{ route('banner-list') }}">All Banners</a>
                        </li>
                        <li>
                            <a href="{{ route('add-banner') }}">Add Banner</a>
                        </li>
                        
                    </ul>
                </li>
                <li>
                    <a href="#"><i class="fa fa-wrench fa-fw"></i>Customers<span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        <li>
                            <a href="{{ route('customers-list') }}">{{ ('All Customers') }}</a>
                        </li>
                    </ul>
                    <!-- /.nav-second-level -->
                </li>
                <li>
                    <a href="#"><i class="fa fa-bar-chart-o fa-fw"></i>About Us<span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        <li>
                            <a href="{{ route('add-aboutus-photos') }}">Add Photos</a>
                        </li>
                        
                    </ul>
                </li>
                <li>
                    <a href="#"><i class="fa fa-sitemap fa-fw"></i>{{ ('Billing') }}<span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        <li>
                            <a href="#">All Orders</a>
                        </li>
                    </ul>
                    <!-- /.nav-second-level -->
                </li>
                <li>
                    <a href="#"><i class="fa fa-sitemap fa-fw"></i>{{ ('Customer Queries') }}<span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        <li>
                            <a href="{{ route('query-list') }}">Queries</a>
                        </li>
                    </ul>
                    <!-- /.nav-second-level -->
                </li>
                <li>
                    <a href="#"><i class="fa fa-sitemap fa-fw"></i>Invoice<span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        <li>
                            <a href="#">{{ ('All Invoices') }}</a>
                        </li>
                    </ul>
                    <!-- /.nav-second-level -->
                </li>
                <li>
                    <a href="#"><i class="fa fa-sitemap fa-fw"></i>{{ ('Settings') }}<span class="fa arrow"></span></a>
                </li>
            </ul>
        </div>
    </div>
</nav>

@else
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="col-xs-12 col-sm-4 col-md-2 navbar-header">
            <a class="navbar-brand" href="{{ route('backend-dashboard') }}">{{ ('Uchaan Arts') }}</a>
        </div>
    
        <div class="col-xs-12 col-sm-4 col-md-7 text-center">
        @if (Auth::user()->image_uploaded == 0)
            <span class="notify-box"><i class="fa fa-info-circle"></i> Please upload a image to get approved</span>
        @elseif (Auth::user()->admin_approved == 0)
            <span class="notify-box"><i class="fa fa-info-circle"></i> Approval pending</span>
        @endif
        </div>
        <div class="col-xs-12 col-sm-4 col-md-3">
            <ul class="nav navbar-right navbar-top-links">        
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-user fa-fw"></i>{{Auth::user()->uname}} <b class="caret"></b>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        @if(Auth::user()->user_role == 'artist')
                        <li>
                            <a href="{{ route('artist-profile') }}"><i class="fa fa-user fa-fw"></i> User Profile</a>
                        </li>
                        @endif
                        <li class="divider"></li>
                        <li>
                            <a href="{{ route('backend-logout') }}"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
        <div class="navbar-default sidebar" role="navigation">
            <div class="sidebar-nav navbar-collapse">
                <ul class="nav" id="side-menu">
                    <li>
                        <a href="{{ route('backend-dashboard') }}" class="active"><i class="fa fa-dashboard fa-fw"></i>Dashboard</a>
                    </li>
                    <li>
                        <a href="#"><i class="fa fa-bar-chart-o fa-fw"></i>Products<span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li>
                                <a href="{{ route('gallery-list') }}">All Products</a>
                            </li>
                            <li>
                                <a href="{{ route('add-gallery') }}">Add Product</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="#"><i class="fa fa-bar-chart-o fa-fw"></i>Event<span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li>
                                <a href="{{ route('events-list') }}">All Events</a>
                            </li>
                            <li>
                                <a href="{{ route('online-events-list') }}">Online Events</a>
                            </li>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="#"><i class="fa fa-sitemap fa-fw"></i>{{ ('Billing') }}<span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li>
                                <a href="#">All Orders</a>
                            </li>
                        </ul>
                        <!-- /.nav-second-level -->
                    </li>
                    <li>
                        <a href="#"><i class="fa fa-sitemap fa-fw"></i>Invoice<span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li>
                                <a href="#">{{ ('All Invoices') }}</a>
                            </li>
                        </ul>
                        <!-- /.nav-second-level -->
                    </li>
                    <li>
                        <a href="#"><i class="fa fa-sitemap fa-fw"></i>{{ ('Settings') }}<span class="fa arrow"></span></a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

@endif