@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12 col-sm-12">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Media Coverage</li>
                </ol>
            </nav>
        </div>
    </div>
</div>
<!--Section 1 Stat Here-->
<section class="themeSec1 bgWhite">
  <div class="container">
   <div class="testimonialBx">
    <h1>UCHAAN ARTS - Media Coverage</h1>
     <div class="row" style="margin-bottom:25px !important;">

      @if(!empty($media))
     @foreach($media as $cover)
      <div class="col-lg-4 col-md-4 col-4 col-sm-4">
      <a href="{{ \App\Helpers\Helper::getImage($cover->image, 7) }}" target="_blank">
      <center><img src="{{ \App\Helpers\Helper::getImage($cover->image, 7) }}" height="200" width="300" class="">
       <h4 style="margin-top:8px !important; text-transform: uppercase !important;">{{$cover->title}}</h4></center>
        </a>
      </div>
      @endforeach
      @endif
      
      </div>
    </div>
  </div>
</section>
<!--footer Start Here-->
@endsection
