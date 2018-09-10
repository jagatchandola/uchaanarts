@extends('layouts.app')

@section('style')
<link rel="stylesheet" type="text/css" href="{{ asset('/css/lightbox.min.css') }}">
@endsection
@section('script')
<script type="text/javascript" src="{{ asset('/js/lightbox-plus-jquery.min.js')}}"></script>
@endsection

@section('content')

<section class="themeSec1 bgWhite">
    <!--  <h1>UCHAAN - A Group of Contemporary Artist </h1>-->  
    <div class="container">
        <div class="productBx">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-12 col-sm-12">
                    <a href="{{ \App\Helpers\Helper::getImage($art->username .'/imgs/'. $art->fname.'.'.$art->ext, 1) }}" data-lightbox="art-details"><img class="card-img-top img-fluid" src="{{ \App\Helpers\Helper::getImage($art->username .'/imgs/'. $art->fname.'.'.$art->ext, 1) }}" alt=""></a>
<!--                    <a class="btn btn-primary themebBtn float-left mt-4" href="#">ADD TO CART</a>
                    <a class="btn btn-primary themebBtn float-right mt-4" href="{{ route('product-payment', $art->id) }}">BUY NOW</a>-->
                </div>
                <div class="col-lg-6 col-md-6 col-12 col-sm-12">
                    <blockquote class="blockquote aboutBio text-left">
                        <h3>{{ $art->title }}</h3>
                        <h5>INR {{ \App\Helpers\Helper::getFormattedPrice($art->totalPrice) }}</h5>
                        <p class="mb-0 "><?php echo $art->about; ?></p>
                    </blockquote>
                    <h5>Artwork details</h5>
                    <table class="">
                        <tr>
                            <td>Artist</td>
                            <td>{{ $art->uname }}</td>
                        </tr>
                        <tr>
                            <td>Category</td>
                            <td>{{ $art->cat_name }}</td>
                        </tr>
                        <tr>
                            <td>
                                <a href="{{ route('product-enquiry', $art->id) }}" class="btn btn-primary themebBtn" style="margin-top: 25px;">ADD TO CART</a>
                            </td>
                        </tr>
<!--				<tr>
                        <td>Painting Type</td>
                        <td>Acrylic</td>
                        </tr>
                        <tr>
                        <td>Subject</td>
                        <td>Impressionist</td>
                        </tr>
                        <tr>
                        <td>Surface</td>
                        <td>Canvas</td>
                        </tr>
                        <tr>
                        <td>Size</td>
                        <td>30*36inch</td>
                        </tr>-->
                    </table>
                </div>
            </div>
        </div>		  
    </div>
</section>
<!--Section 1 Ends Here-->

<!--Section 1 Start Here-->
@if (!empty($artistOtherArts))
<section class="themeSec1">
    <h2>Other works by Artist</h2>
    <div class="container">
        <div class="row">
            
                @php $i=1 @endphp
                @foreach($artistOtherArts as $otherArt)
                    <div class="col-md-3 col-lg-3 col-12 col-sm-6 blogBox moreBox" @if($i>4) style="display: none;" @endif>
                        <div class="artBox">
 <div class="imgFixbx">  
                            <a href="{{ route('artist-art', [$otherArt->artist_id, $otherArt->id]) }}"><img src="{{ \App\Helpers\Helper::getImage($otherArt->username .'/imgs/'. $otherArt->fname.'.'.$otherArt->ext, 1) }}" class="img-fluid"></a>
							</div>
                            <div class="paintingInfo">
                                <h3 class="mt-2">{{ $otherArt->title }}</h3>
                                <span>By {{$otherArt->user_name }}</span>
                                <!--<p>Oil on Canvas | 40*60 Inches</p>-->
                                <h2>{{ \App\Helpers\Helper::getFormattedPrice($otherArt->totalPrice) }}</h2>
                            </div>
                        </div>
                    </div>
                @php $i++ @endphp
                @endforeach

            <div class="col-lg-12 text-center">
                <a id="loadMore" class="btn btn-primary themeBtn mt-3" href="#">Load More</a>
            </div>
        </div>
    </div>
</section>
@endif
<!--Section 1 Ends Here-->

<!--Section 2 Start Here-->
@if (!empty($categoryArts))
<section class="themeSec2">
    <div class="container">
        <div class="col-lg-12 col-md-12 col-12 col-sm-12">
            <article class="themeSubs1">
                <h2>Related Product</h2>
                <div class="owl-carousel owl-theme fifth-owl-carousel">
                    
                    @foreach($categoryArts as $art)
                    <div class="item">
					<div class="imgFixAD">
					<a href="{{ route('artist-art', [$art->artist_id, $art->id]) }}"><img src="{{ \App\Helpers\Helper::getImage($art->username .'/imgs/'.$art->fname.'.'.$art->ext, 1) }}"></a></div>
                        <div class="captionBtm">
                            <div class="paintingInfo artBox">
                                <h3 class="mt-2">{{ $art->title }}</h3>
                                <span>By {{$art->uname}}</span>
                                <p>Oil on Canvas | 40*60 Inches</p>
                                <h2>{{ \App\Helpers\Helper::getFormattedPrice($art->totalPrice) }}</h2>
                            </div>
                        </div>
                    </div>
                    @endforeach                    
                </div>
            </article>
        </div>
    </div>	   
</section>
@endif
<!--Section 2 Ends Here-->
@section('style')
<script type="text/javascript">
$(function () {
    $('[data-spzoom]').spzoom();
});
</script>
@endsection
@endsection
