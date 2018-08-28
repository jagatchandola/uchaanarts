@extends('layouts.app')

@section('content')
<!--Section 1 Stat Here-->
<section class="themeSec1 bgWhite">
  <h1>Creative Art Work</h1>
  <div class="container">
    <div class="productPbox">
      <div class="row">
        <div class="col-md-3 col-lg-2 col-12 col-sm-12">
             @if(!empty($categories))
            <ul class="itemList d-none d-md-block d-lg-block">
                <li @if(!isset($cat_name)) class="list active" @else class="list" @endif id="all"><a href="/art-gallery">All</a></li>

                @php $active='' @endphp
                @foreach($categories as $category)                
                @if(isset($cat_name) && $cat_name == strtolower($category->cat_name))
                    @php $active=' active' @endphp
                @else
                    @php $active='' @endphp
                @endif
                <li class="list{{ $active }}" id="{{$category->cat_url}}"><a href="/art-gallery/{{$category->cat_url}}">{{$category->cat_name}}</a></li>
                @endforeach
            </ul>
            @endif
          
        </div>
        <div class="col-md-9 col-lg-10 col-12 col-sm-12" >
          <div class="row" id="parent">

            @if(!empty($arts))
                @foreach($arts as $art)
                <div class="col-lg-4 col-md-4 col-12 col-sm-6 a b box all">
                  <div class="artBox">
				   <div class="imgFixbx">  

				  <a href="{{ route('artist-art', [$art->artist_id, $art->id]) }}"> <img src="{{ \App\Helpers\Helper::getImage($art->username.'/imgs/'. $art->fname.'.'.$art->ext, 1) }}" class="img-fluid"></a>
				  </div>
              <a class="view-a" href="{{ route('artist-art', [$art->artist_id, $art->id]) }}"><h3>{{ $art->title }} </h3></a>
                <h2><i class="fas fa-rupee-sign"></i> {{ \App\Helpers\Helper::getFormattedPrice($art->totalPrice) }}</h2>
                <span>{{$art->uname}}</span> <a href="#" class="btn btn-primary themebBtn">ADD TO CART</a> </div>
                </div>
                @endforeach
            @else
            <div>Sorry no arts avialabe right now</div>
            @endif
            
            <div class="clearfix"></div>
          </div>
        </div>
      </div>
      <!--Pagination-->
      <div class="row">
        <div class="col-md-6 col-lg-6 col-sm-12 col-12 offset-md-3 offset-lg-3">
          <nav aria-label="Page navigation example">
            {{$arts->links()}}
          </nav>
        </div>
      </div>
      <!--Pagination Ends here-->
    </div>
  </div>
</section>
<!--Section 1 Ends Here-->

@endsection
