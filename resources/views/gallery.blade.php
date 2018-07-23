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
                <li class="list" id="all"><a href="/art-gallery">All</a></li>
                @foreach($categories as $category)
                <li class="list" id="{{$category->cat_url}}"><a href="/art-gallery/{{$category->cat_url}}">{{$category->cat_name}}</a></li>
                @endforeach
                <li>Browse by category</li>
            </ul>
            @endif
          
          <div class="mobileFilter d-md-none d-lg-none">
            <h2>Select a Category</h2>
          <select class=" form-control">
            <option value="all">All</option>
            <option value="a">Abstract</option>
            
          </select>
          </div>
        </div>
        <div class="col-md-9 col-lg-10 col-12 col-sm-12" >
          <div class="row" id="parent">

            @if(!empty($arts))
                @foreach($arts as $art)
                <div class="col-lg-3 col-md-4 col-12 col-sm-6 a b box all">
                  <div class="artBox"> <a href="/product-details.html"><img src="{{ \App\Helpers\Helper::getImage($art->fname.'.'.$art->ext, 0) }}" class="img-fluid"></a>
                    <h3>{{ $art->title }}</h3>
                    <h2><i class="fas fa-rupee-sign"></i> {{ $art->totalPrice }}</h2>
                    <span>{{$art->uname}}</span> <a href="/product-details.html" class="btn btn-primary themebBtn">ADD TO CART</a> </div>
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
