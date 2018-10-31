@extends('layouts.app')

@section('style')
<link rel="stylesheet" type="text/css" href="{{ asset('/css/lightbox.min.css') }}">
@endsection
@section('script')
<script type="text/javascript" src="{{ asset('/js/lightbox-plus-jquery.min.js')}}"></script>
@endsection

@section('content')

<!--Carousel Start Here-->
@if(!empty($banners))
<div id="myCarousel" class="carousel slide" data-ride="carousel">
    <ol class="carousel-indicators">
        @php $i=0; @endphp
        @foreach($banners as $banner)
        <li data-target="#myCarousel" data-slide-to="{{$i}}" @if($i ==0) class="active" @endif></li>
        @php $i++; @endphp
        @endforeach
    </ol>
    <div class="carousel-inner">
        @php $i=0; @endphp
        @foreach($banners as $banner)
        <div class="carousel-item @if($i == 0) active @endif"> <img src="{{ \App\Helpers\Helper::getImage($banner->image, 6) }}" alt="First slide" class="img-fluid first-slide">
            <div class="container d-none d-md-block d-lg-block ">
                <div class="carousel-caption">
                    <h1>{{$banner->title}}</h1>
                    <p>{{$banner->description}}</p>
                    <p><a class="btn btn-lg btn-primary themeBtn" href="{{$banner->url}}" role="button">See More</a></p>
                </div>
            </div>
        </div>
        @php $i++; @endphp
        @endforeach

    </div>
    <a class="carousel-control-prev" href="#myCarousel" role="button" data-slide="prev"> <span class="carousel-control-prev-icon" aria-hidden="true"></span> <span class="sr-only">Previous</span> </a> <a class="carousel-control-next" href="#myCarousel" role="button" data-slide="next"> <span class="carousel-control-next-icon" aria-hidden="true"></span> <span class="sr-only">Next</span> </a> 
</div>
@endif
<!--Carousel Ends Here-->
<!--Section 1 Start Here-->
@if(!empty($categories))
<section class="themeSec2">
    <h2>Browse by category</h2>
    <div class="container" style="height:55% !important; width:55% !important;">
        <div class="owl-carousel owl-theme first-owl-carousel" >
            @foreach($categories as $category)
            <div class="item" style="height:55% !important; width:55% !important;">
                <img height="175" width="150" src="{{ \App\Helpers\Helper::getImage($category->image, 5) }}">
                <a href="/art-gallery/{{$category->cat_url}}" class="caption crousal-overlay">{{$category->cat_name}}</a>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endif
<!--Section 1 Ends Here-->
<!--Section 2 Start Here-->
<section class="themeSec1">
 <h2>Artist of the week</h2>
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-md-6 col-12 col-sm-12">
                <article class="themeSubs1">
                   
                    @if(!empty($weeklyStatus))
                    <div class="row">
                        <div class="col-lg-5 col-md-5 col-12 col-sm-12">
                            <img class="artist-week-image" src="{{ \App\Helpers\Helper::getImage($weeklyStatus->username.'/'.$weeklyStatus->profimg, 1) }}" alt="Card image cap">
                        </div>
                        <div class="col-lg-7 col-md-7 col-12 col-sm-12">
                            <blockquote class="blockquote aboutBio">
                                <h3>{{$weeklyStatus->uname}}</h3>
                                <p class="mb-0 text-justify"><?php echo \App\Helpers\Helper::readMore($weeklyStatus->about, route('artistdetails', $weeklyStatus->id),520); ?></p>
                            </blockquote>
                           
                        </div>
                    </div>
                    @endif
                </article>
            </div>
            <div class="col-lg-6 col-md-6 col-12 col-sm-12">
                
                <article class="themeSubs1">
                @if(!empty($weeklyArts))
                    <div class="owl-carousel owl-theme second-owl-carousel owl-loaded owl-drag">
                    <div class="owl-stage-outer">
                    <div class="owl-stage" style="">
                    @foreach($weeklyArts as $weekArt)  
                    
                    <div class="owl-item cloned" style="width: 1; margin-right: 10px;"><div class="item"><div class="imgFixbxhp"><a href="/artists/110/272"><img src="{{ \App\Helpers\Helper::getImage($weekArt->directory.'/imgs/'.$weekArt->fname.'.'.$weekArt->ext, 1) }}"></a></div></div></div>
                    @endforeach
                    </div>
                    </div>

                    </div>
                </article>

                <div class="text-center">
                 <a href="/artists/{{$weeklyStatus->id}}" class="btn btn-primary themeBtn">View Artwork</a>
                </div> 
                @endif
            </div>
        </div>
    </div>
</section>
<!--Section 2 Ends Here-->

@if(!empty($upcomingEvents))

<section class="themeSec2">
    <h2>Upcoming Events</h2>
    <div class="container">
         @if(!empty($upcomingEvents))
        <div class="owl-carousel owl-theme first-owl-carousel">
            @foreach($upcomingEvents as $event)
            <div class="item">

             <div class="imgFixbxhp">
             <a href="/events/{{$event->id}}">
            <img src="{{ \App\Helpers\Helper::getImage($event->eurl.'/'.$event->banner, 3) }}"></a><div class="captionBtm">{{date("d-m-Y", strtotime($event->start_date))}}<br>Uchaan Events<br>{{$event->venue}}</div></div></div>
            @endforeach
        </div>
        @endif
    </div>
</section>

@endif      

<!--Section 1 Start Here-->
@if(!empty($catalogues))
<section class="themeSec2">
    <h2>Creative Art</h2>
    <div class="container">
        <div class="row">
            @foreach($catalogues as $catalogue)
            <div class="col-md-4 col-lg-4 col-12 col-sm-12">
                <div class="item artBox">
                 <div class="imgFixbxhp">
                    <a href="/artists/{{$catalogue->user_id}}/{{$catalogue->id}}"><img class="img-fluid" src="{{ \App\Helpers\Helper::getImage($catalogue->directory.'/imgs/'.$catalogue->fname.'.'.$catalogue->ext, 1) }}">
                    </div>
                    <a href="/item/{{$catalogue->id}}" class="img-fluid"></a>
                        <h3>{{$catalogue->title}}</h3>
                        <h2><i class="fas fa-rupee-sign"></i> {{ \App\Helpers\Helper::getFormattedPrice($catalogue->totalPrice) }}</h2>
                        <span>By {{$catalogue->user_name}}</span>
                        <p>{{$catalogue->surface }} | {{$catalogue->size }}</p>
                        @if($catalogue->quantity > 0)
                        <a href="{{ route('product-enquiry', $catalogue->id) }}" class="btn btn-primary themebBtn">ADD TO CART</a> 
                        @else
                        <a href="javascript:;" class="btn btn-primary themebBtn">OUT OF STOCK</a>
                        @endif
                </div>
            </div>
            @endforeach

            <div class="col-lg-12 text-center">
                <a class="btn btn-primary themeBtn mt-5" href="{{ route('art-gallery') }}">View Artwork</a>
            </div>
        </div>
    </div>
</section>
@endif
<!--Section 1 Ends Here-->

<!--Section 2 Start Here-->
@if(!empty($artists))
<section class="themeSec1">
    <div class="container">
        <div class="col-lg-12 col-md-12 col-12 col-sm-12">
            <article class="themeSubs1">
                <h2>Creative Modern Artist</h2>
                <div class="owl-carousel owl-theme third-owl-carousel">
                    @foreach($artists as $artist)

                    <div class="item">
                         <div class="imgFixbxhp">
                            <img class="img-fluid" src="{{ \App\Helpers\Helper::getImage($artist['username'].'/'.$artist['profimg'], 1) }}">
                       
                        <a href="{{ route('artistdetails', $artist['id']) }}" class="captionBtn1">View Artwork</a>

                        
                         </div>
                            <div class="captionBtm">{{$artist['uname']}}</div>                        
                    </div>
                    @endforeach
                    
                </div>
            </article>
        </div>
    </div>     
</section>
@endif
<!--Section 2 Ends Here-->
@endsection
