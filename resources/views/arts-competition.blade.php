@extends('layouts.app')

@section('content')
<!-- Breadcrumb Start Here -->
<div class="container-fluid">
	<div class="row">
		<div class="col-12 col-sm-12">
			<nav aria-label="breadcrumb">
					<ol class="breadcrumb">
						<li class="breadcrumb-item"><a href="/">Home</a></li>
					<li class="breadcrumb-item active" aria-current="page">Art Competition</li>
					</ol>
			</nav>
		</div>
	</div>
</div>
<!-- Breadcrumb End Here -->
<!--Section 1 Stat Here-->
<section class="themeSec1 bgWhite">

  <div class="container">
   <div class="testimonialBx">
    <h1>Online Art Competition</h1>
    <div class="row">
              
        <div class="col-xs-6 col-sm-4 col-md-4">            
            <div class="event-thumbnail">
				 <div class="event-caption">
                    <h4>Online Competition Title</h4>
                    <p>Event End Date : 25/July/2018</p>
                    <p><a class="btn btn-primary themeBtn mt-3" href="art-competition-detail.html">Check Detail</a>
                    </p>
                </div>
                <img src="assets/img/painting-competition.jpg" alt="Online Competition">
            </div>
		</div>
		
    </div>

	</div>
  </div>
</section>
<!--Section 1 Ends Here-->


@endsection
