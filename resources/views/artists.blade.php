@extends('layouts.app')

@section('style')
<style type="text/css">
  ul.alpha-filter{list-style: none; padding: 0}
  ul.alpha-filter li{display: inline;}
  ul.alpha-filter li a{padding:3px 6px; margin-right:1px; background-color:#ccc; }
  ul.alpha-filter li a.active-filter{color:#e53424; }
</style>
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12 col-sm-12">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Artists</li>
                </ol>
            </nav>
        </div>
    </div>
</div>
<!--Section 1 Stat Here-->
<section class="themeSec1 bgWhite">
  <h1>Modern Artist</h1>
  <div class="container">
   <div>
     {{ \App\Helpers\Helper::getArtistFilter($_GET) }}
   </div>

   <div class="productPbox">
     <div class="row">
     @if (!empty($artists))
        @foreach($artists as $artist)
       <div class="col-lg-2 col-md-2 col-12 col-sm-6">
        
         <div class="artBox"> 
		        <a href="/artists/{{ $artist->id}}"><img src="{{ \App\Helpers\Helper::getImage($artist->username .'/'. $artist->profimg, 1) }}" class="img-fluid"></a>
            <span>{{ $artist->uname }}</span>
             <a href="/artists/{{ $artist->id}}" class="btn btn-primary themebBtn">View Artwork</a>
         </div>
       </div>
       @endforeach
        <div class="col-md-12 col-sm-12 clearfix">
          <div class="col-md-6 col-lg-6 col-sm-12 col-12 offset-md-3 offset-lg-3">
            <nav aria-label="Page navigation example align-center">
              
              {{$artists->appends($_GET)->links()}}
            </nav>
          </div>       
        </div>

     @else
        <div class="col-md-12 text-center">
            <span>Sorry no artists avialable right now.</span>
        </div>
     @endif
     </div>  
  </div>
   </div>
</section>
<!--Section 1 Ends Here-->

@endsection
