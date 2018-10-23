@extends('layouts.app')

@section('content')
<div class="container-fluid">
  <div class="row">
    <div class="col-12 col-sm-12">
      <nav aria-label="breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="">Home</a></li>
            <li class="breadcrumb-item"><a href="/arts-competitio">Art Competition</a></li>
            <li class="breadcrumb-item active" aria-current="page">Art Competition Artis Page</li>
          </ol>
      </nav>
    </div>
  </div>
</div>
<!-- Breadcrumb End Here -->

<section class="themeSec1 bgWhite">

  <div class="container">
    <div class="artistBiobx">
      <div class="row">
            <div class="col-lg-6 col-md-6 col-12 col-sm-6">
              <h4 class="sep-text"> Artist Detail</h4>
              <img class="art-competition-artist" src="{{ \App\Helpers\Helper::getImage($participatedArts->username.'/'.$participatedArts->profimg, 1) }}" alt="Card image cap">
                <p class="sep-text">Name : {{ $participatedArts->uname }}</p>
              <p Class="sep-text">About Artist:</p>
              <p>{{ $participatedArts->about_artist }}</p>
            </div>
            <div class="col-lg-6 col-md-6 col-12 col-sm-6">
              <h4 class="sep-text"> Art Work Detail</h4>
              <img class="art-competition-artwork" src="{{ \App\Helpers\Helper::getImage($participatedArts->username.'/imgs/'. $participatedArts->fname.'.'.$participatedArts->ext, 1) }}" alt="{{ $participatedArts->title }}">
                <p class="sep-text">{{ $participatedArts->title }}<Br/>
                Medium: {{ $participatedArts->surface }}<Br/>
                Size: {{ $participatedArts->size }}
                <p Class="sep-text">Work Detail</p>
                <p>{{ $participatedArts->about }}</p>
                <div class="col-md text-center">
                <a class="btn btn-primary themeBtn mt-3" href="/">Buy Now</a>
                </div>
            </div>
      </div>
      <div class="sharethis-inline-share-buttons"></div>
   </div>     
  </div>
</section>
<!--Section 1 Ends Here-->
@endsection
