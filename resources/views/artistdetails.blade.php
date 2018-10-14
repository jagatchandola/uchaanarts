@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12 col-sm-12">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Artist Detail</li>
                </ol>
            </nav>
        </div>
    </div>
</div>
<!--Section 1 Stat Here-->
<section class="themeSec1 bgWhite">

<h1>{{$artists['uname']}}</h1>
  <div class="row">
  <div class="container">
    <div class="col-lg-12 col-md-12 col-12 col-sm-12">
      <img class="artis-img-top img-fluid" src="{{ \App\Helpers\Helper::getImage($artists['username'].'/'.$artists['profimg'], 1) }}" alt="Card image cap"/>
    </div>
  </div>
  </div>

  <!-- <h1>Artist Profile</h1> -->
  <div id="exTab1" class="container"> 
    
    <ul  class="nav nav-pills">
      <li class="active">
        <a  href="#1a" data-toggle="tab" class="active">Artwork for Sales</a>
      </li>
      <li style="padding-right: 5px; padding-left: 5px"> | </li>
      <li><a href="#2a" data-toggle="tab">Artis Profile</a>
      
      </li>
    </ul>
    <div class="tab-content clearfix">
        <div class="tab-pane active" id="1a">

      <p>The artist biography. It sounds so simple right ? who is more equipped to write about your life and work than you ? Well, sometimes it can be the hardest thing to write your own biography because you are too personally involved or are conscious about sounding too boastful.</p>
      @if(!empty($catalogues))
          <div class="artistBiobx">
    <h3> Art Work</h3>
    <div class="row">

      @foreach($catalogues as $catalogue) 
       
         <div class="col-lg-4 col-md-4 col-12 col-sm-6">
           <div class="artBox"> <a href="/artists/{{$catalogue['artist_id']}}/{{$catalogue['id']}}"><img src="{{ \App\Helpers\Helper::getImage($catalogue['username'].'/imgs/'.$catalogue['fname'].'.'.$catalogue['ext'], 1) }}" class="img-fluid"></a>
              <h3>{{$catalogue['title']}}</h3>
              <h2> <i class="fas fa-rupee-sign"></i> {{\App\Helpers\Helper::getFormattedPrice($catalogue['totalPrice'])}}</h2>
        
        
        <span>By:Amit Srivatsava</span>
        <p>{{$catalogue['surface']}} | {{$catalogue['size']}}</p>
              <a href="#" class="btn btn-primary themebBtn">ADD TO CART</a>
       </div>
         </div>

      @endforeach

      <div class="col-lg-12 text-center">
        <a id="loadMore" class="btn btn-primary themeBtn mt-3" href="#">Load More</a>
      </div>
     </div>
   </div>     
  @endif
      </div>
        <div class="tab-pane" id="2a">
          @if(!empty($artists['about']))
          <h4>About Me</h4>
          <p>{{ strip_tags($artists['about']) }}</p>
          @endif
          @if(!empty($artists['education']))
          <h4>Education</h4>
          <p>{{ strip_tags($artists['education']) }}</p>
          @endif
          @if(!empty($artists['awards']))
          <h4>Award & Recognition</h4>
          <p>{{ strip_tags($artists['awards']) }}</p>
          @endif
        </div>
    </div>
  </div>
</section>
<!--Section 1 Ends Here-->


@endsection
