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
                    <li class="breadcrumb-item active" aria-current="page">About</li>
                </ol>
            </nav>
        </div>
    </div>
</div>
<!--Section 1 Stat Here-->
<section class="themeSec1 bgWhite">

<!--Section 1 Stat Here-->
  <h1>UCHAAN - A Group of Contemporary Artist </h1>
  <div class="container">
   <div class="aboutUsbx">
   <div class="row">
                   <div class="col-lg-12 col-md-12 col-12 col-sm-12">
              <blockquote class="blockquote aboutBio text-left">
         <h3>About Us</h3>
                <p class="mb-0 ">UCHAAN is an organisation with a main objective that has established itself as a nurturing ground for art and artist. Uchaan has a repertoire of not just the masters of art but also an impeccable range of contemporary artists from all parts of the country, whose works are showcased on a regular basis. The gallery has been doing shows in all forms of visual arts in its own distinguish way within the gallery as well as has taken art outside the confines to off site locations. Uchaan has taken the art to masses so as to maximise the reach and lure art enthusiasts far and wide. 
Uchaan has been organizing art shows, art workshops, art camps & painting competition pan India & abroad and through this endeavor it has able to take the art out of clutches of gallery system to the larger audiences of malls, hotels & other places wherein more people are encouraged to be the part of the journey called art.

</p>
</blockquote>
<blockquote class="blockquote aboutBio text-left">
<h3>Our Objective </h3>

<p class="mb-0 ">
<abbr>
To provide a dedicated platform for deserving artists and nurture more creative spirit and aesthetic temperament among all….
</abbr>
</p>

              </blockquote>
            </div>
          </div>
   </div>     
  </div>
</section>
<!--Section 1 Ends Here-->
<!--Section 1 Ends Here-->

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
                    <a href="{{ \App\Helpers\Helper::getImage($moment->image, 4) }}" data-lightbox="{{$moment->title}}" data-title="{{$moment->title}}">
                        <img src="{{ \App\Helpers\Helper::getImage($moment->image, 4) }}" class="img-fluid">
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

@endsection
