@extends('layouts.app')

@section('content')

<!--Section 1 Stat Here-->
<section class="themeSec1 bgWhite">
  <div class="container">
   <div class="testimonialBx">
    <h1>Testimonials</h1>
    
    @if(!empty($testimonails))
     @foreach($testimonails as $testimonail)
     <div class="row">
      <div class="col-lg-9 col-md-9 col-xs-12 col-sm-8">
       <p>{{ $testimonail->content }}</p>
      </div>
      <div class="col-lg-3 col-md-3 col-x-12 col-sm-4">
       <img src="{{ \App\Helpers\Helper::getImage($testimonail->image, 2) }}" class="img-fluid">
      </div>
       
       <div class="col-lg-12 col-md-12 col-xs-12 col-sm-12 text-right">
       
      <p class="font-weight-bold">{{ $testimonail->name }}</p>
      </div>
      
      </div>
    @endforeach
    @endif

    </div>
  </div>
</section>

@endsection
