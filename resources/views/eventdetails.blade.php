@extends('layouts.app')

@section('content')
<!--Section 1 Stat Here-->
<section class="themeSec1 bgWhite">
    <div class="container">
        <h1>{{ $eventDetails->etitle }} - {{ date('jS F', strtotime($eventDetails->start_date)) }} - {{ date('jS F Y', strtotime($eventDetails->end_date)) }}</h1>
        <div class="artistBiobx">
            <div class="row">
                
                <div class="col-lg-7 col-md-7 col-12 col-sm-12">
                    @if(empty($eventArts))
                    <div class="owl-carousel owl-theme fourth-owl-carousel">
                        
                        @foreach($eventArts as $eventArt)
                        <div class="item"><img src="{{ \App\Helpers\Helper::getImage($eventArt->fname . '.' . $eventArt->ext, 0) }}"></div>
                        <div class="item"><img src="{{ \App\Helpers\Helper::getImage($eventArt->profimg, 1) }}" class="imgSmall" title="{{ $eventArt->uname }}"></div>                        
                        @endforeach
                    </div>
                    @endif
                </div>
                
                
                <div class="col-lg-5 col-md-5 col-12 col-sm-12">
                    <div class="aboutBio">
                        <h3 class="text-md-left text-lg-left text-center">Inauguaration by-Qazi M Raghib<br/>
                            Date - {{ date('jS', strtotime($eventDetails->start_date)) }} to {{ date('jS F Y', strtotime($eventDetails->end_date)) }}<br>
                            {{ $eventDetails->venue }}
                        </h3>
                        <p class="text-md-left text-lg-left text-center">{{ $eventDetails->about }}</p>
                        <br>
                        <h3 class="text-center">Event Fees</h3>
                        <table class="text-center">
                            <tr>
                                <th>Art works/Photographs</th>
                                <th>Space Rental Fee</th>
                            </tr>
                            <tr>
                                <td>2 Entries</td>
                                <td><i class="fas fa-rupee-sign"></i> {{ number_format($eventDetails->fees) }}/-</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>		  
    </div>
</section>
<!--Section 1 Ends Here-->

<section class="themeSec1 bgWhite">
    <h2>Concept Note</h2>
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-12 col-sm-12"> 
                <div class="contentBx">
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>

                    <h2>Participating Artist</h2>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>

                    @can('isArtist')
                    <div class="text-center"><a href="{{ route('participate-event', $eventDetails->id) }}" target="_blank" class="btn btn-primary themeBtn mt-5">Participate Now</a></div>
                    @endcan
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
