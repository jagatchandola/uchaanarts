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
     <div class="row">
      <div class="col-lg-12 col-md-12 col-12 col-sm-12">
       <img src="{{ \App\Helpers\Helper::getImage('media-1.jpg', 7) }}" class="img-fluid">
      </div>
      </div>
    </div>
  </div>
</section>
<!--footer Start Here-->
@endsection
