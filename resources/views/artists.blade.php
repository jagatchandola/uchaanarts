@extends('layouts.app')

@section('content')
<!--Section 1 Stat Here-->
<section class="themeSec1 bgWhite">
  <h1>Modern Artist</h1>
  <div class="container">
   <div class="productPbox">
     <div class="row">
     @if (!empty($artists))
        @foreach($artists as $artist)
       <div class="col-lg-3 col-md-3 col-12 col-sm-6">
        
         <div class="artBox"> 
		  <div class="imgFixbx">  <a href="/artists/{{ $artist->id}}"><img src="{{ \App\Helpers\Helper::getImage($artist->username .'/'. $artist->profimg, 1) }}" class="img-fluid"></a></div>
            <span>{{ $artist->uname }}</span>
             <a href="/artists/{{ $artist->id}}" class="btn btn-primary themebBtn">View Artwork</a>
         </div>
       </div>
       @endforeach
       
       <!-- <div class="col-md-3 col-lg-3 col-sm-12 col-12 offset-lg-4">
          <nav aria-label="Page navigation example">
            <ul class="pagination themePegination">
              <li class="page-item"><a class="page-link" href="#">Previous</a></li>
              <li class="page-item"><a class="page-link" href="#">1</a></li>
              <li class="page-item"><a class="page-link" href="#">2</a></li>
              <li class="page-item"><a class="page-link" href="#">3</a></li>
              <li class="page-item"><a class="page-link" href="#">Next</a></li>
            </ul>
          </nav>
        </div> -->

        <div class="col-md-12 col-sm-12 clearfix">
          
          <div class="col-md-6 col-lg-6 col-sm-12 col-12 offset-md-3 offset-lg-3">
            <nav aria-label="Page navigation example align-center">
              {{$artists->links()}}
            </nav>
          </div>       
        </div>

     @else
        <div class="col-md-12">
            Sorry no artists avialable right now.
        </div>
     @endif

     </div>  
  </div>
   </div>
</section>
<!--Section 1 Ends Here-->

@endsection
