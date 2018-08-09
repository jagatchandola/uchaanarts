@extends('layouts.app')

@section('content')

<!--Section 1 Stat Here-->
<section class="themeSec1 bgWhite">
  <h1>Artist Profile</h1>
  <div class="container">
   <div class="artistBiobx">
     <div class="row">
            <div class="col-lg-3 col-md-3 col-12 col-sm-12">
              <img class="card-img-top img-fluid" src="{{ \App\Helpers\Helper::getImage($artists['username'].'/'.$artists['profimg'], 1) }}" alt="Card image cap">
                <p class="card-text">{{$artists['uname']}}</p>
            </div>
            <div class="col-lg-9 col-md-9 col-12 col-sm-12">
              <blockquote class="blockquote aboutBio">
               <h3>Artist Bio</h3>
                <p class="mb-0 ">"{{$artists['about']}}"</p>
              </blockquote>
            </div>
          </div>
   </div>         
  </div>
</section>
<!--Section 1 Ends Here-->

<!--sectionAddcart Start here-->
<div class="sectionAddcart">
 <div class="container">
   <div class="artistBiobx">
     <div class="row">
       @if(!empty($catalogues))
            @foreach($catalogues as $catalogue) 
               <div class="col-lg-3 col-md-3 col-12 col-sm-6">
                 <div class="artBox"> <a href="{{route('artist-art', [$artists['id'], $catalogue['id']])}}"><img src="{{ \App\Helpers\Helper::getImage($catalogue['username'].'/imgs/'.$catalogue['fname'].'.'.$catalogue['ext'], 1) }}" class="img-fluid"></a>
                    <h3>{{$catalogue['title']}}</h3>
                    <h2><i class="fas fa-rupee-sign"></i> {{\App\Helpers\Helper::getFormattedPrice($catalogue['totalPrice'])}}</h2>
                    <a href="#" class="btn btn-primary themebBtn">ADD TO CART</a>
                 </div>
               </div>
            @endforeach
        @endif
     </div>
   </div>         
  </div>
</div>
<!--sectionAddcart Ends here-->

@endsection
