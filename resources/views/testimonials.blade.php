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
     <div class="row" style="margin:1% !important;">
     <div class="col-lg-2 col-md-2 col-x-12 col-sm-3">
       <img src="{{ \App\Helpers\Helper::getImage($testimonail->image, 2) }}" height="150" width="150" class="rounded-circle">
      </div>
      <div class="col-lg-10 col-md-10 col-xs-12 col-sm-9">
       <p><?php echo $testimonail->content; ?></p>
       <p><?php echo $testimonail->name; ?>,<?php echo $testimonail->designation; ?></p>
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
