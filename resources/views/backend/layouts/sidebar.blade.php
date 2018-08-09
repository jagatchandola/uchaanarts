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
                <li>
                    <a href="#"><i class="fa fa-user fa-fw"></i> User Profile</a>
                </li>
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

@else
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="navbar-header">
            <a class="navbar-brand" href="{{ route('backend-dashboard') }}">{{ ('Uchaan Arts') }}</a>
        </div>

        @if (Auth::user()->image_uploaded == 0)
            <div class="navbar-header">
                <span style="color: white; margin-left: 300px; padding-top: 20px;">Please upload a image to get approved</span>
            </div>
        @elseif (Auth::user()->admin_approved == 0)
            <div class="navbar-header">
                <span style="color: white; margin-left: 300px; padding-top: 20px;">Approval pending</span>
            </div>
        @endif
        <ul class="nav navbar-right navbar-top-links">        
            <li class="dropdown">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                    <i class="fa fa-user fa-fw"></i>{{Auth::user()->uname}} <b class="caret"></b>
                </a>
                <ul class="dropdown-menu dropdown-user">
                    <li>
                        <a href="#"><i class="fa fa-user fa-fw"></i> User Profile</a>
                    </li>
                    <li class="divider"></li>
                    <li>
                        <a href="{{ route('backend-logout') }}"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                    </li>
                </ul>
            </li>
        </ul>

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