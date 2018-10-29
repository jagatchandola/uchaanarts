@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12 col-sm-12">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Testimonials</li>
                </ol>
            </nav>
        </div>
    </div>
</div>
<!--Section 1 Stat Here-->
<section class="themeSec1 bgWhite">
  <div class="container">
   <div class="testimonialBx">
    <h1>Testimonials</h1>
    
    @if(!empty($testimonails))
     @foreach($testimonails as $testimonail)
     <div class="row testimonail-row">
      <div class="col-lg-9 col-md-9 col-xs-12 col-sm-8">
       <p><?php echo $testimonail->content; ?></p>
      </div>
      <div class="col-lg-3 col-md-3 col-x-12 col-sm-4">
       <img src="{{ \App\Helpers\Helper::getImage($testimonail->image, 2) }}" class="img-fluid">
      </div>
       
       <div class="col-lg-12 col-md-12 col-xs-12 col-sm-12 text-right">
       
      <p class="font-weight-bold">{{ $testimonail->name }}</p>
      </div>
      
      </div>
    @endforeach
    @else
      <div class="col-lg-12 col-md-12 col-xs-12 col-sm-12">
        No testimonials found.
      </div>
    @endif

    </div>
  </div>
</section>

@endsection
