@extends('layouts.app')

@section('content')
<!-- Breadcrumb Start Here -->
<div class="container-fluid">
    <div class="row">
        <div class="col-12 col-sm-12">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/">Home</a></li>
                <li class="breadcrumb-item "><a href="/arts-competition">Art Competition</a></li>
                <li class="breadcrumb-item active" aria-current="page">Art Competition Detail</li>
                </ol>
            </nav>
        </div>
    </div>
</div>
<!-- Breadcrumb End Here -->

<!--Section 1 Stat Here-->
<section class="themeSec1 bgWhite">  
    <h1>Art Competition & Contest </h1>
  <div class="container">
   <div class="aboutUsbx">
     <div class="row">
        <div class="col-lg-6 col-md-6 col-12 col-sm-12 col-xs-12">
          <img src="{{ \App\Helpers\Helper::getImage($onlineEventDetail->eurl.'/'.$onlineEventDetail->banner, 3) }}" class="artBox">
            
        </div>
        <div class="col-lg-6 col-md-6 col-12 col-sm-12 col-xs-12">
          <blockquote class="blockquote aboutBio text-left">
             <h3>{{ $onlineEventDetail->etitle }}</h3>
             <h3>Dead Line: {{ date('d/M/Y', strtotime($onlineEventDetail->end_date)) }}</h3>
             <h3> Description</h3>
             <p class="mb-0 ">{{ $onlineEventDetail->about }} </p>
          </blockquote>
          <blockquote class="blockquote aboutBio text-left">
            <h3>Judging & Notification</h3>
            <p class="mb-0 ">
                <abbr>
                    To provide a dedicated platform for deserving artists and nurture more creative spirit and aesthetic temperament among all….
                </abbr>
                </p>
          </blockquote>
          
          @if(!empty($onlineEventDetail->last_date) && strtotime($onlineEventDetail->last_date) > strtotime(date("Y-m-d")))            
          <div class="col-md-12 col-12 col-sm-12 col-xs-12 text-center">
            @auth
              @can('isArtist')
                <a class="btn btn-primary themeBtn mt-3" href="/admin/online/events">Participate in Competition</a>
              @endcan
            @else
              <a class="btn btn-primary themeBtn mt-3" href="/login">Participate in Competition</a>
            @endauth

          </div>
          @endif
        </div>

   </div>   
  
  </div>
</section>
<!--Section 1 Ends Here-->

<!--sectionAddcart Start here-->
@if(!empty($participatedArts))
<div class="sectionAddcart">
 <div class="container">
   <div class="aboutUsbx themeSubs1 ">
    <h2>Participated Art</h2>
     <div class="row">
        @foreach($participatedArts as $art )
        <div class="col-lg-3 col-md-3 col-12 col-sm-6">
         <div class="artBox"> <a href="/arts-competition/{{$art->contid}}/{{$art->artist_id}}/{{$art->id}}"><img src="{{ \App\Helpers\Helper::getImage($art->username.'/imgs/'. $art->fname.'.'.$art->ext, 1) }}" class="img-fluid"></a>
         </div>
        </div>
        @endforeach
     <div class="col-lg-12 text-center">
   <a id="loadMore" class="btn btn-primary themeBtn mt-3" href="#">Load More</a>
  </div>
   </div>         
  </div>
</div>
</div>
@endif
<!--sectionAddcart Ends here-->
<!--section how to enter start here-->

  <div class="container">
  
   <div class="aboutUsbx">
   
     <div class="row">
        <div class="col-lg-12 col-md-12 col-12 col-sm-12 col-xs-12">
        <div class="aboutUsbx blockquote">
        <h2>How to Enter</h2>
        
        <p>
            <ol>
                <li>Login/Register Artis Account</li>
                <li>Submit your ArtvWorks</li>
                <li>Admin will aprrove your account</li>
                <li>Submite the art to the online competition from your dashboad</li>

            </ol>
        </p>    
        <h2>Term & Condition</h2>
        <p>
        All artwork must be a digital file saved in either .jpg or .png formats. File size must be no larger than 10MB in size. File dimensions must be at least 2,400 pixels wide by 2,400 pixels tall (33 inches by 33 inches at 72 dpi - 840mm by 840mm at 72 dpi). Note: The image does not need to be square. The narrowest measurement must meet the minimum size requirements.

        We'll also need your student's First Name only, Age Range, Country and State or Province for each submitted piece of art.
        </p>
        @if(!empty($onlineEventDetail->last_date) && strtotime($onlineEventDetail->last_date) > strtotime(date("Y-m-d")))
        <div class="col-md-12 col-12 col-sm-12 col-xs-12 text-center">
          @auth
            @can('isArtist')
              <a class="btn btn-primary themeBtn mt-3" href="/admin/online/events">Participate in Competition</a>
            @endcan
          @else
            <a class="btn btn-primary themeBtn mt-3" href="/login">Participate in Competition</a>
          @endauth

        </div>
        @endif
        
        </div>
        
     </div>
     </div>
    </div>
</div>  
<
<!--section how to enter End here-->
<!--Section Result start here-->
@if(!empty($participatedPrize))
<div class="sectionAddcart">
  <div class="container">
   <div class="aboutUsbx themeSubs1 ">
    <h2>Result</h2>
     <div class="row">
       <div class="col-lg-12 col-md-12 col-12 col-sm-12">
        <div class="table-responsive">          
            <table class="table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Amount Awarded</th>
                        </tr>
                </thead>
                <tbody>
                @foreach($participatedPrize as $prize)
                  <tr>
                      <td>{{ $prize->position }}</td>
                      <td>{{ $prize->uname }}</td>
                      <td><i class="fas fa-rupee-sign"></i>{{ $prize->prize }}</td>
                  </tr>
                @endforeach
                    
                </tbody>
            </table>
        </div>
       </div>
     </div>
    </div> 
  </div>
</div>  
@endif
<!--Section 1 Ends Here-->


@endsection
