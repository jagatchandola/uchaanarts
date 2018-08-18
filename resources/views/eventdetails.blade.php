@extends('layouts.app')

@section('style')
<link rel="stylesheet" type="text/css" href="{{ asset('/css/lightbox.min.css') }}">
@endsection
@section('script')
<script type="text/javascript" src="{{ asset('/js/lightbox-plus-jquery.min.js')}}"></script>
@endsection

@section('content')
<!--Section 1 Stat Here-->
<section class="themeSec1 bgWhite">
    <div class="container">
        <h1>{{ $eventDetails->etitle }} - {{ date('jS F', strtotime($eventDetails->start_date)) }} - {{ date('jS F Y', strtotime($eventDetails->end_date)) }}</h1>
        <div class="artistBiobx">
            <div class="row">
                
                <div class="col-lg-7 col-md-7 col-12 col-sm-12">
                    @if(!empty($eventArts))
                    <div class="owl-carousel owl-theme fourth-owl-carousel">
                        
                        @foreach($eventArts as $eventArt)
                        <div class="item"><img src="{{ \App\Helpers\Helper::getImage($eventArt->username .'/imgs/'.$eventArt->fname . '.' . $eventArt->ext, 1) }}" class="img-fluid"></div>
                        <div class="item"><img src="{{ \App\Helpers\Helper::getImage($eventArt->username.'/'.$eventArt->profimg, 1) }}" class="imgSmall" title="{{ $eventArt->uname }}"></div>                        
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
                    <p><?php echo  $eventDetails->concept_note; ?></p>
                @endif
                @if(!empty($eventDetails->artists))
                    <h2>Participating Artist</h2>
                    <p><?php echo $eventDetails->artists; ?></p>
                @endif
                    @can('isArtist')
                    <div class="text-center"><a href="{{ route('participate-event', $eventDetails->id) }}" target="_blank" class="btn btn-primary themeBtn mt-5">Participate Now</a></div>
                    @endcan
                </div>
            </div>
        </div>
    </div>
</section>



<!--sectionAddcart Start here-->
<div class="sectionAddcart">
 <div class="container">
   <div class="aboutUsbx themeSubs1 ">
       
    @if (!empty($moments))
    <h2>Uchaan Memorable Moments </h2>
        
    <div class="row">
    @foreach ($moments as $moment)
            <div class="col-lg-3 col-md-3 col-sm-4">
                <div class="artBox"> 
                    <a href="{{ \App\Helpers\Helper::getImage($moment->eurl.'/slides/'.$moment->image, 3) }}" data-lightbox="{{$moment->title}}" data-title="{{$moment->title}}">
                        <img src="{{ \App\Helpers\Helper::getImage($moment->eurl.'/slides/'.$moment->image, 3) }}" class="img-fluid">
                    </a>
                    <h3>{{$moment->title}}</h3>
                </div>
            </div>
    @endforeach
    </div> 
    @endif
  </div>
</div>
</div>
<!--sectionAddcart Ends here-->
@endsection
