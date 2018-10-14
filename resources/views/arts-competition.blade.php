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
        @if(!empty($onlineEvents))  
        @foreach($onlineEvents as $onlineEvent)  
        <div class="col-xs-6 col-sm-4 col-md-4">            
            <div class="event-thumbnail">
				 <div class="event-caption">
                    <h4>{{ $onlineEvent->etitle }}</h4>
                    <p>Event End Date : {{ !empty($onlineEvent->end_date) ? date('d/M/Y', strtotime($onlineEvent->end_date)) : '' }}</p>
                    <p>
                        <a class="btn btn-primary themeBtn mt-3" href="/arts-competition/{{$onlineEvent->id}}">Check Detail</a>
                    </p>
                </div>
                <img src="{{ \App\Helpers\Helper::getImage($onlineEvent->eurl.'/'.$onlineEvent->banner, 3) }}" alt="Online Competition" width="330" height="198">
            </div>
		</div>
        @endforeach
        @endif
		
    </div>

	</div>
  </div>
</section>
<!--Section 1 Ends Here-->


@endsection
