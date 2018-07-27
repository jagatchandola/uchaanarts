@extends('layouts.app')

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
    <div class="carousel-item @if($i == 0)active @endif"> <img src="{{ \App\Helpers\Helper::getImage($banner->image, 6) }}" alt="First slide" class="img-fluid first-slide">
      <div class="container d-none d-md-block d-lg-block ">
        <div class="carousel-caption">
          <h1>{{$banner->title}}</h1>
          <p>{{$banner->description}}</p>
          <p><a class="btn btn-lg btn-primary themeBtn" href="#" role="button">See More</a></p>
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
<section class="themeSec1">
  <h1>Browse by category</h1>
  <div class="container">
    <div class="owl-carousel owl-theme first-owl-carousel">
      @foreach($categories as $category)
      <div class="item"><img src="{{ \App\Helpers\Helper::getImage($category->image, 5) }}"><a href="/art-gallery/{{$category->cat_url}}" class="caption">{{$category->cat_name}}</a></div>
      @endforeach
    </div>
  </div>
</section>
@endif
<!--Section 1 Ends Here-->
<!--Section 2 Start Here-->
<section class="themeSec2">
  <div class="container">
    <div class="row">
      <div class="col-lg-6 col-md-6 col-12 col-sm-12">
        <article class="themeSubs1">
          <h2>Artist of the week</h2>
          <div class="row">
            <div class="col-lg-5 col-md-5 col-12 col-sm-12">
              <img class="card-img-top" src="{{ asset('img/swagatika.jpg')}}" alt="Card image cap">
                
                  <p class="card-text">Swagatika Mohanty</p>
               
            </div>
            <div class="col-lg-7 col-md-7 col-12 col-sm-12">
              <blockquote class="blockquote aboutBio">
               <h3>Artist Bio</h3>
                <p class="mb-0 text-center font-italic">"The artist biography. It sounds so simple right ? who is more equipped to write about your life and work than you ? Well, sometimes it can be the hardest thing to write your own biography because you are too personally involved or are conscious about sounding too boastful. How do  you decide which life events are important ? Which are'nt? Organizing your own artistic journey into a succinct story can be a big challenge."</p>
              </blockquote>
              <a href="#" class="btn btn-primary themeBtn">View Artwork</a>
            </div>
          </div>
        </article>
      </div>
      <div class="col-lg-6 col-md-6 col-12 col-sm-12">
      <article class="themeSubs1">
       <h2>Upcoming Events</h2>
       <div class="owl-carousel owl-theme second-owl-carousel">
      <div class="item"><img src="{{ asset('img/slider/1.jpg')}}"><div class="captionBtm">22-07-2018<br>Uchaan Events<br>Noida, India</div></div>
      <div class="item"><img src="{{ asset('img/slider/2.jpg')}}"><div class="captionBtm">22-07-2018<br>Uchaan Events<br>Noida, India</div></div>
      <div class="item"><img src="{{ asset('img/slider/3.jpg')}}"><div class="captionBtm">22-07-2018<br>Uchaan Events<br>Noida, India</div></div>
      <div class="item"><img src="{{ asset('img/slider/4.jpg')}}"><div class="captionBtm">22-07-2018<br>Uchaan Events<br>Noida, India</div></div>
      <div class="item"><img src="{{ asset('img/slider/3.jpg')}}"><div class="captionBtm">22-07-2018<br>Uchaan Events<br>Noida, India</div></div>
    </div>
      </article>
       </div>
    </div>
  </div>
</section>
<!--Section 2 Ends Here-->

<!--Section 1 Start Here-->
@if(!empty($catalogues))
<section class="themeSec1">
 <h2>Creative Art</h2>
 <div class="container">
 <div class="row">
 @foreach($catalogues as $catalogue)
  <div class="col-md-4 col-lg-4 col-12 col-sm-12">
   <div class="artBox">
    <a href="/"><img src="{{ \App\Helpers\Helper::getImage($catalogue->fname.'.'.$catalogue->ext, 0) }}"><a href="/item/{{$catalogue->id}}" class="img-fluid"></a>
    <h3>{{$catalogue->title}}</h3>
    <h2>{{money_format($catalogue->totalPrice)}}</h2>
    <span>{{$catalogue->user_name}}</span>
   </div>
  </div>
  @endforeach

  <!-- <div class="col-md-4 col-lg-4 col-12 col-sm-12">
   <div class="artBox">
    <a href="/"><img src="{{ asset('img/slider/2.jpg')}}" class="img-fluid"></a>
    <h3>TITLE</h3>
    <h2>15,000</h2>
    <span>Abhishek Sharma</span>
   </div>
  </div>
  <div class="col-md-4 col-lg-4 col-12 col-sm-12">
   <div class="artBox">
    <a href="/"><img src="{{ asset('img/slider/3.jpg')}}" class="img-fluid"></a>
    <h3>TITLE</h3>
    <h2>15,000</h2>
    <span>Abhishek Sharma</span>
   </div>
  </div> -->

  <div class="col-lg-12 text-center">
   <a class="btn btn-primary themeBtn mt-5" href="#">View Artwork</a>
  </div>
 </div>
 </div>
</section>
@endif
<!--Section 1 Ends Here-->

<!--Section 2 Start Here-->
@if(!empty($artists))
<section class="themeSec2">
<div class="container">
<div class="col-lg-12 col-md-12 col-12 col-sm-12">
      <article class="themeSubs1">
       <h2>Creative Modern Artist</h2>
       <div class="owl-carousel owl-theme third-owl-carousel">
       @foreach($artists as $artist)
       
      <div class="item"><img src="{{ \App\Helpers\Helper::getImage($artist['profimg'], 1) }}"><a href="/artists/{{$artist['id']}}" class="captionBtn1">View Artwork</a><div class="captionBtm">{{$artist['uname']}}</div></div>
      @endforeach
      <!-- <div class="item"><img src="{{ asset('img/slider/2.jpg')}}"><a href="#" class="captionBtn1">View Artwork</a><div class="captionBtm">Amit Srivastava</div></div>
      <div class="item"><img src="{{ asset('img/slider/3.jpg')}}"><a href="#" class="captionBtn1">View Artwork</a><div class="captionBtm">Anil Kaira</div></div>
      <div class="item"><img src="{{ asset('img/slider/4.jpg')}}"><a href="#" class="captionBtn1">View Artwork</a><div class="captionBtm">Abhishek Sharma</div></div>
      <div class="item"><img src="{{ asset('img/slider/3.jpg')}}"><a href="#" class="captionBtn1">View Artwork</a><div class="captionBtm">Amit Srivastava</div></div> -->
    </div>
      </article>
       </div>
</div>     
</section>
@endif
<!--Section 2 Ends Here-->
@endsection
