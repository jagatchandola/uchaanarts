@extends('layouts.app')

@section('style')
<link rel="stylesheet" type="text/css" href="{{ asset('/css/lightbox.min.css') }}">
@endsection
@section('script')
<script type="text/javascript" src="{{ asset('/js/lightbox-plus-jquery.min.js')}}"></script>
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12 col-sm-12">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Event Detail</li>
                </ol>
            </nav>
        </div>
    </div>
</div>
<!--Section 1 Stat Here-->
<section class="themeSec1 bgWhite">
    <div class="container">
        <h1>{{ $eventDetails->etitle }} - {{ date('jS F', strtotime($eventDetails->start_date)) }} - {{ date('jS F Y', strtotime($eventDetails->end_date)) }}</h1>
        <div class="artistBiobx">
            <div class="row">
                
                
                
                
                <div class="col-lg-5 col-md-5 col-12 col-sm-12">
                    <div class="aboutBio">
                        <h3 class="text-md-left text-lg-left text-center">
                            Date - {{ date('jS', strtotime($eventDetails->start_date)) }} to {{ date('jS F Y', strtotime($eventDetails->end_date)) }}<br>
                            Time -  <br/>
                            Venue - {{ $eventDetails->venue }}<br/>
                        </h3>
                        <p class="text-md-left text-lg-left text-center"><?php echo $eventDetails->about; ?></p>
                        <br>
                        <h3 class="text-center">Event Fees</h3>
                        <table class="text-center">
                            <tr>
                                <th>Art works/Photographs</th>
                                <th>Space Rental Fee</th>
                            </tr>
                            <tr>
                                <td>{{ $eventDetails->no_of_entries }} {{ $eventDetails->no_of_entries > 1 ?'Entries':'Entry'}}</td>
                                <td><i class="fas fa-rupee-sign"></i> {{ number_format($eventDetails->fees) }}/-</td>
                            </tr>
                        </table>
                    </div>
                </div>

                <div class="col-lg-7 col-md-7 col-12 col-sm-12">
                    @if(!empty($eventArts))
                    <div class="owl-carousel owl-theme fourth-owl-carousel">
                        
                        @foreach($eventArts as $eventArt)
                        <div class="item"><img src="{{ \App\Helpers\Helper::getImage($eventArt->username .'/imgs/'.$eventArt->fname . '.' . $eventArt->ext, 1) }}" class="img-fluid"></div>
                        <div class="item"><img src="{{ \App\Helpers\Helper::getImage($eventArt->username.'/'.$eventArt->profimg, 1) }}" class="imgSmall" title="{{ $eventArt->uname }}"></div>                        
                        <!-- <div class="item"><img src="/uploads/banners/-1539692073.jpg" alt="First slide" class="img-fluid first-slide"></div>
                        <div class="item"><img src="/uploads/banners/-1539692073.jpg" alt="First slide" class="img-fluid first-slide"></div>                         -->
                        @endforeach
                    </div>
                    @endif
                </div>
            </div>
        </div>		  
    </div>
</section>
<!--Section 1 Ends Here-->

<section class="themeSec1 bgWhite">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-12 col-sm-12"> 
                <div class="contentBx">
                @if(!empty($eventDetails->concept_note))
                    <h2>Concept Note</h2>
                    <p><?php echo $eventDetails->concept_note; ?></p>
                @endif
                @if(!empty($eventDetails->artists))
                    <h2>Participating Artist</h2>
                    <p><?php echo $eventDetails->artists; ?></p>
                @endif
                    @if(!empty($eventDetails->last_date) && strtotime($eventDetails->last_date) > strtotime(date("Y-m-d")))
                    <div class="text-center">
                    @auth
                    @can('isArtist')
                    <a href="{{ route('participate-event', $eventDetails->id) }}" target="_blank" class="btn btn-primary themeBtn mt-5">Participate Now</a>
                    @endcan
                    @else
                      <a class="btn btn-primary themeBtn mt-3" href="/login">Participate in Competition</a>
                    @endauth
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</section>


<!-- Photo Gallery -->
<!--sectionAddcart Start here-->
@if (!empty($moments))
<div class="sectionAddcart">
 <div class="container">
   <div class="aboutUsbx themeSubs1 ">
       
    <h2>Event Memorable Moments</h2>
        
    <div class="row">
    @foreach ($moments as $moment)
            <div class="col-lg-3 col-md-3 col-sm-4">
                <div class="artBox"> 
				<div class="imgFixbx">
                    <a href="{{ \App\Helpers\Helper::getImage($moment->eurl.'/slides/'.$moment->image, 3) }}" data-lightbox="{{$moment->title}}" data-title="{{$moment->title}}">
                        <img src="{{ \App\Helpers\Helper::getImage($moment->eurl.'/slides/'.$moment->image, 3) }}" class="img-fluid">
                    </a>
					</div>
                    <h3>{{$moment->title}}</h3>

                </div>
            </div>
    @endforeach
    </div> 
    
    
  </div>
</div>
</div>
@endif
<!--sectionAddcart Ends here-->
@endsection
